<h1 class="nombre-pagina">Olvidé mi contraseña</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu emal a continuación</p>

<?php 
    include_once __DIR__."/../templates/alertas.php";
?>

<form  class="formulario" method="POST">
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Escribe tu e-mail" >
    </div>
    <div class="centrado">
        <input type="submit" class="boton" value="Enviar instrucciones">
    </div>
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/forgot">¿Olvidaste tu password?</a>
</div>

<!-- value="<?php echo $auth->email  ;?>" -->