<?php 
if (isset($perfilActualizado) && $perfilActualizado) {
    echo "
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Perfil Actualizado',
                text: 'El perfil fue actualizado correctamente!',
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
    
    <a class="enlace-perfil" href="/cambiar-password">Cambiar Password</a>

        <form method="POST" class="formulario" action="/perfil">
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input 
                    type="text" 
                    name="nombre" 
                    placeholder="Tu nombre"
                    value="<?php echo $nombre ?>">
            </div>
            <div class="campo">
                <label for="email">Email: </label>
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Tu email"
                    value="<?php echo $email ?>">
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