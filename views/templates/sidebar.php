<div class="sidebar">

    <div class="sidebar-cerrar">
        <h2>UpTask</h2>
        <img class="menu-cerrar" src="build/img/cerrar.svg" alt="cerrar menu">
    </div>
    
    <ul>
        <li><a class="enlace <?php echo ($titulo === 'Proyectos') ? 'activo' : '' ?>" href="/dashboard">Proyectos</a></li>
        <li><a class="enlace <?php echo ($titulo === 'Crear Proyecto') ? 'activo' : '' ?>" href="/crear-proyecto">Crear Proyecto</a></li>
        <li><a class="enlace <?php echo ($titulo === 'Mi Perfil') ? 'activo' : '' ?>" href="/perfil">Perfil</a></li>
    </ul>

    <div class="contenedor-boton-mobile">
        <a href="/logout">Cerrar Sesión</a>
    </div>
</div>