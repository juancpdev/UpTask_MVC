(function() {
    const btnTarea = document.querySelector('#boton-tarea');
    btnTarea.addEventListener('click', mostrarModal);

    function mostrarModal() {
        const contenedorModal = document.createElement('DIV');
        contenedorModal.classList.add("modal");
        contenedorModal.innerHTML = `
            <form class='formulario nueva-tarea'>
                <legend>Añadir una nueva Tarea</legend>
                <div class="contenedor-alertas"></div>
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
                    mostrarAlerta('El nombre de la tarea es Obligatorio', 'error');
                    return;
                }
            }

            function mostrarAlerta(mensaje, tipo) {
                const alertaPrevia = document.querySelector('.alertas');
                if(alertaPrevia) {
                    alertaPrevia.remove();
                }
                const alerta = document.createElement('DIV');
                alerta.classList.add('alertas', tipo);
                alerta.innerHTML = mensaje;
                const alertaDiv = document.querySelector('.contenedor-alertas');

                alertaDiv.appendChild(alerta);

                setTimeout(() => {
                    alerta.remove();
                }, 3000);
            }
        });
    }
}())