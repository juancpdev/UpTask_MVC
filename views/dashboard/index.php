<?php include_once __DIR__ . "/header-dash.php" ?>
    <h3> <?php echo $titulo ?> </h3>

    <div class="seccion-proyectos">
        <?php if(!count($proyectos)) { ?>
            <div class="no-proyectos">
                <div class="parrafo"><p>No Hay Proyectos Aún</p></div>
                <div class="btn"><a href="/crear-proyecto">Crear Proyecto</a></div>
            </div>
        <?php } else { ?>
            <ul class="contenedor-proyectos">
                <?php foreach($proyectos as $proyecto) {?>
                    <li class="proyecto">
                        <a href="/proyecto?id=<?php echo $proyecto->url; ?>"><?php echo $proyecto->proyecto ?></a>
                    </li>
                <?php } ?>
            </ul>
        <?php }  ?>
    </div>

<?php include_once __DIR__ . "/footer-dash.php" ?>