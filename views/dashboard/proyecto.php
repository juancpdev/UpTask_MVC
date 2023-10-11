<?php include_once __DIR__ . "/header-dash.php" ?>
    <h3> <?php echo $proyecto->proyecto ?> </h3>

    <div class="contenedor-sm contenedor-proyecto">
        <div class="contenedor-tarea">
            <button id="boton-tarea" class="boton-tarea" type="button">+ Nueva Tarea</button>
        </div>

        <ul class="listado-tareas" id="listado-tareas"></ul>
    
    </div>

<?php include_once __DIR__ . "/footer-dash.php" ?>

<?php 
    $script = '<script src="build/js/tarea.js"></script>';    
?>
