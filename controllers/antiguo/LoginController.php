<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router)
    {
        $alertas=[];
        $auth = new Usuario;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            
            if(empty($alertas)){
                //Comprobar que exista el usuario
                $usuario = Usuario::where('email',$auth->email);
                if($usuario){
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //Autenticar el usuario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellidos;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if($usuario->admin === '1'){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('location: /admin');
                        }else{
                            header('location: /cita');
                        }
                        
                    
                    }else{
                        Usuario::setAlerta('error', 'Usuario no encontrado');
                    }
                }
            }
        $router->render('auth/login',[
            'alertas' => $alertas,
            'auth' => $auth
        ]);
        }
        }    
    
    public static function logout()
    {
        $_SESSION=[];
        header(
            'Location: /'
        );
    }
    public  static function forgot(Router $router)
    {
        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth =new Usuario($_POST);
            
            $alertas=$auth->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
                if($usuario && $usuario->confirmado === '1'){
                    //Generar un token
                    $usuario->generarToken();
                    
                    $usuario->guardar();

                    //Enviar el email
                    $email= new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta('exito', 'Revisa tu email');
                }else{
                    Usuario::setAlerta('error','Usuario no existe o no está confirmado');
                    
                }
               
            }
            }
        $alertas = Usuario::getAlertas();
        $router->render('auth/forgot',[
            'alertas' => $alertas
        ]);
    }
    public  static function recovery(Router $router)
    {
        $alertas = [];
        $error=false;
        $auth = new Usuario($_GET);
        $usuario = Usuario::where('token', $auth->token);
        if(empty($usuario)){
            Usuario::setAlerta('error','Token no válido');
            $error = true;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
            if(empty($alertas))
            {
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token= null;
                $resultado = $usuario->guardar();
                if($resultado)
                {
                    header('Location: /');
                }
            }
        }
        $alertas=Usuario::getAlertas();
        $router->render('auth/recovery', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
    public static function crear(Router $router)
    {
        $usuario = new Usuario;
        //Alertas vacías
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta(); 

            //Revisar que alerta esté vacío
            if(empty($alertas))
            {
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows)
                {
                    $alertas = Usuario::getAlertas();
                }
                else
                {
                    //Hashear el Password
                    $usuario->hashPassword();                    

                    //Generar un token
                    $usuario->generarToken();

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);                    
                    $email->enviarConfirmacion();

                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
                
                
                
            }
            
        }
        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje',[

        ]);
    }
    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            //Mostrar mensaje de error
            Usuario::setAlerta('error','Token no válido');
        }else{
            //Modificar a usuario confirmado
            $usuario->confirmado='1';
            $usuario->token = '0';
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Usuario confirmado');

        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas'=>$alertas
        ]);
    }
}

    


