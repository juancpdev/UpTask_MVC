<?php 
if (isset($proyectoCreado) && $proyectoCreado) {
    echo "
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Proyecto Creado',
                text: 'El proyecto fue creado correctamente!',
                confirmButtonText: 'Ir al proyecto'
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = '/proyecto?id=" . $urlProyecto . "';
                }
            });
        };
    </script>
    ";
}
?>

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


<?php 
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    ";    
?>

