<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>
<?php 
    include_once __DIR__."/../templates/alertas.php";
?>
<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu email" name="email" >
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Introduce tu password">
    </div>
    <div class="centrado">
        <input type="submit" class="boton" value="Iniciar sesión">
    </div>
    
</form>
<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes cueta? Crea tu cuenta</a>
    <a href="/forgot">¿Olvidaste tu password?</a>
</div>