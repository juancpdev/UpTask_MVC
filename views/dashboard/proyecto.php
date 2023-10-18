<?php include_once __DIR__ . "/header-dash.php" ?>
    <h3> <?php echo $proyecto->proyecto ?> </h3>

    <div class="contenedor-sm contenedor-proyecto">
        <div class="contenedor-tarea">
            <button id="boton-tarea" class="boton-tarea" type="button">+ Nueva Tarea</button>
        </div>

        <div class="filtros" id="filtros">
            <div class="filtros-input">
                <h2>Filtros:</h2>
                <div class="campo">
                    <label for="todas">Todas</label>
                    <input 
                        type="radio" 
                        id="todas" 
                        name="filtro" 
                        value=""
                        checked
                    >
                </div>
                <div class="campo">
                    <label id="label-completado" for="completado">Completado</label>
                    <input 
                        type="radio" 
                        id="completado" 
                        name="filtro" 
                        value="1"
                    >
                </div>
                <div class="campo">
                    <label id="label-pendiente" for="pendientes">Pendientes</label>
                    <input 
                        type="radio" 
                        id="pendientes" 
                        name="filtro" 
                        value="0"
                    >
                </div>
            </div>
        </div>

        <ul class="listado-tareas" id="listado-tareas"></ul>
    
    </div>

<?php include_once __DIR__ . "/footer-dash.php" ?>

<?php 
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script src='build/js/tarea.js'></script>
        <script src='build/js/alertas.js'></script>
    ";    
?>
