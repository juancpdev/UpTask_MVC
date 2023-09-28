<div class="contenedor login">
    <h1>UpTask</h1>
    <p class="tagline">Crea y Administra tus Proyectos</p>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <form action="/" method="POST" class="formulario">
            <div class="campo">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    placeholder="Tu Email">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    placeholder="Tu Password">
            </div>
            <input class="boton" type="submit" value="Iniciar Sesión">
        </form>

        <div class="acciones">
            <p>¿Aún no tienes una cuenta?<a href="/crear"> <strong>Crear una</strong></a></p>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>

    </div>
</div>