<div class="barra-mobile">
    <h2>UpTask</h2>
    <img id="menu" src="build/img/menu.svg" alt="imagen menu">
</div>

<div class="barra">
    <div>
        <p>Hola: <span class="nombre"><?php echo $_SESSION["nombre"]; ?></span></p>
    </div>
    <div class="contenedor-boton">
        <a href="/logout" class="boton">Cerrar Sesión</a>
    </div>
</div>