(function() {
    const btnTarea = document.querySelector('#boton-tarea');
    btnTarea.addEventListener('click', mostrarModal);

    function mostrarModal() {
        const contenedorModal = document.createElement('DIV');
        contenedorModal.classList.add("modal");
        contenedorModal.innerHTML = `
            <form class='formulario nueva-tarea'>
                <legend>Añadir una nueva Tarea</legend>
                
                <div class="campo div-campo">
                    <label for="tarea" class="label-tarea">Tarea:</label>
                    <input 
                        type="text" 
                        name="tarea" 
                        id="tarea"
                        class="input-tarea" 
                        placeholder="Nueva Tarea"/>
                </div>
                <div class="opciones">
                    <input type="submit" class="enviar-nueva-tarea" value="Añadir" />
                    <button class="cerrar-modal" type="button">Cancelar</button>
                </div>
            </form>
            `;
        document.querySelector('.dashboard').appendChild(contenedorModal);

        setTimeout(() =>{
            const formu = document.querySelector('.formulario');
            formu.classList.add('animar');
        }, 0);

        contenedorModal.addEventListener('click', function(e) {
            e.preventDefault();

            if(e.target.classList.contains('cerrar-modal')) {
                const formu = document.querySelector('.formulario');
                formu.classList.add('cerrar');
                setTimeout(() =>{
                    contenedorModal.remove();
                }, 200);
            }

            if(e.target.classList.contains('enviar-nueva-tarea')) { 
                const tarea = document.querySelector('.input-tarea').value.trim();

                if(tarea === '') {
                    mostrarAlerta('El nombre de la tarea es Obligatorio', 'error', document.querySelector('.div-campo'));
                    return;
                }

                agregarTarea(tarea);
            }
        });


    }

    // Muestra un mensaje en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia) {
        const alertaPrevia = document.querySelector('.alertas');
        if(alertaPrevia) {
            alertaPrevia.remove();
        }
        const alerta = document.createElement('DIV');
        alerta.classList.add('alertas', tipo);
        alerta.innerHTML = mensaje;
        
        referencia.parentElement.insertBefore(alerta, referencia);

        setTimeout(() => {
            alerta.remove();
        }, 1000);
    }

    // Consultar el Servidor para añadir una nueva tarea al proyecto actual
    async function agregarTarea(tarea) {
        // Construir la peticion
        const datos = new FormData();
        datos.append("nombre", tarea);
        datos.append("proyectoId", obtenerProyecto());

        try {
            const url = 'http://localhost:3001/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            
            const resultado = await respuesta.json();
            console.log(resultado);

            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.div-campo'));

            if(resultado.tipo === "exito") {
                const modal = document.querySelector(".modal");
                setTimeout(() => {
                    modal.remove();
                }, 1000);
            }
            
        } catch (error) {
            console.log(error);
        }
    }

    
    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);

        const proyecto = Object.fromEntries(proyectoParams.entries());

        return proyecto.id;
    }
})();