<?php 
if (isset($passActualizado) && $passActualizado) {
    echo "
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Password Actualizado',
                text: 'El password fue actualizado correctamente!',
                confirmButtonText: 'OK'
            })
        };
    </script>
    ";
}
?>

<?php include_once __DIR__ . "/header-dash.php" ?>
<h3> <?php echo $titulo ?> </h3>

    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>
        
        <a class="enlace-perfil" href="/perfil">Volver a perfil</a>

        <form method="POST" class="formulario" action="/cambiar-password">
            <div class="campo">
                <label for="password_actual">Actual: </label>
                <input 
                    type="password" 
                    name="password_actual" 
                    placeholder="Tu password Actual">
            </div>
            <div class="campo">
                <label for="password_nuevo">Nuevo: </label>
                <input 
                    type="password" 
                    name="password_nuevo" 
                    placeholder="Tu password Nuevo">
            </div>
            <input class="boton" type="submit" value="Guardar Cambios">
        </form>
    </div>
    
<?php include_once __DIR__ . "/footer-dash.php" ?>

<?php 
    $script .= "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    ";    
?>