<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Fromulario</p>

<div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" placeholder="Nombre del Servicio" name="nombre" value="<?php echo $servicio->nombre; ?>">
</div>
<div class="campo">
    <label for="precio">Precio</label>
    <input type="text" id="precio" placeholder="Precio del Servicio" name="precio" value="<?php echo $servicio->precio; ?>">€
</div>