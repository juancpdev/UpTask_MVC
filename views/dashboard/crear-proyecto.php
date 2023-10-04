<?php include_once __DIR__ . "/header-dash.php" ?>
    <h3> <?php echo $titulo ?> </h3>
    
    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form action="/crear-proyecto" method="POST" class="formulario">
            <?php include_once __DIR__ . "/formulario-proyecto.php" ?>
            <input class="boton" type="submit" value="Crear Proyecto">
        </form>
    </div>

<?php include_once __DIR__ . "/footer-dash.php" ?>