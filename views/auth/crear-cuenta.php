<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Rellena este formulario para crear tu cuenta de usuario</p>

<?php 
    include_once __DIR__."/../templates/alertas.php";
?>

<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre" value="<?php echo s($usuario->nombre) ;?>">
    </div>
    <div class="campo">
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Escribe tus apellidos" value="<?php echo s($usuario->apellidos) ;?>">
    </div>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="phone" id="telefono" name="telefono" placeholder="Escribe tu telefono" value="<?php echo s($usuario->telefono) ;?>">
    </div>
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Escribe tu e-mail" value="<?php echo s($usuario->email) ;?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Escribe tu password" >
    </div>
    <div class="centrado">
        <input type="submit" class="boton" value="Crear cuenta">
    </div>
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/forgot">¿Olvidaste tu password?</a>
</div>