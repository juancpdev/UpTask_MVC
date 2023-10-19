<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu acceso UpTask</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form action="/olvide" method="POST" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email:</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    placeholder="Tu Email">
            </div>
            <input class="boton" type="submit" value="Enviar Instrucciónes">
        </form>

        <div class="acciones">
            <p>¿Ya tienes una cuenta?<a href="/"> <strong>Iniciar Sesión</strong></a></p>
            <p>¿Aún no tienes una cuenta?<a href="/crear"> <strong>Crear una</strong></a></p>
        </div>

    </div>
</div>