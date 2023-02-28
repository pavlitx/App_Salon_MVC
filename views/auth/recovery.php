<h1 class="nombre-pagina">Reestablece tu password</h1>
<?php
use Model\Usuario;
$auth = new Usuario($_GET);
$usuario = Usuario::where('token', $auth->token);
?>
<?php 
    include_once __DIR__."/../templates/alertas.php";
?>
<?php if($error) return;  ?>
<p class="descripcion-pagina">Hola <?php echo $usuario->nombre ;?>, crea una nueva contraseña para tu cuenta</p>
<form class="formulario" method="POST">

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Introduce tu password">
    </div>
    <div class="centrado">
        <input type="submit" class="boton" value="Guardar Password">
    </div>
    
</form>
<div class="acciones">
    <a href="/">¿Ya tienes cuenta? inicia sesión</a>
    <a href="/forgot">¿Olvidaste tu password?</a>
</div>