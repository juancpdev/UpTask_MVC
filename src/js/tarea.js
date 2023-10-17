(function() {
    obtenerTareas();
    let tareas = [];

    const btnTarea = document.querySelector('#boton-tarea');
    btnTarea.addEventListener('click', function() {
        mostrarModal();
    });

    // OBTENER TAREAS
    async function obtenerTareas() {
        try {
            const idProyecto = obtenerProyecto();
            const url = `/api/tareas?id=${idProyecto}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            
            tareas = resultado.tareas;
            mostrarTareas();
            
        } catch (error) {
            console.log(error);
        }
    }

    const estado = {
        "0" : "Pendiente",
        "1" : "Completado"
    };

    // MOSTRAR TAREAS
    function mostrarTareas() {
        limpiarTareas();
        if(tareas.length === 0) {
            const contenedor = document.querySelector("#listado-tareas");
            const vacio = document.createElement("P");
            vacio.classList.add("vacio");
            vacio.innerHTML = "Aún no hay tareas";
            contenedor.appendChild(vacio);
            return;
        }
        
        tareas.forEach(tarea => {
            const listado = document.createElement("LI");
            const nombreTarea = document.createElement("P");

            listado.dataset.tareaId = tarea.id;
            listado.classList.add("tarea");
            nombreTarea.innerHTML = `${tarea.nombre}`;
            nombreTarea.onclick = function() {
                mostrarModal(editar = true, {...tarea});
            };
            
            const opciones = document.createElement("DIV");
            opciones.classList.add("opciones");
            
            const btnEstado = document.createElement("BUTTON");
            btnEstado.classList.add("btn-tarea", `${estado[tarea.estado]}`.toLowerCase());
            btnEstado.textContent = estado[tarea.estado];
            btnEstado.dataset.estadoTarea = tarea.estado;
            btnEstado.onclick = function() {
                if(btnEstado.classList.contains("pendiente")) {
                    tareaCompletado({...tarea});
                } else if(btnEstado.classList.contains("completado")) { 
                    tareaPendiente({...tarea});
                }
            };
            
            const btnEliminar = document.createElement("BUTTON");
            btnEliminar.classList.add("btn-tarea", "btn-eliminar");
            btnEliminar.textContent = "Eliminar";
            btnEliminar.dataset.idTarea = tarea.id;
            btnEliminar.onclick = function() { 
                confirmarEliminarTarea({...tarea});
            }
            
            opciones.appendChild(btnEstado);
            opciones.appendChild(btnEliminar);
            
            listado.appendChild(nombreTarea);
            listado.appendChild(opciones);
            
            const contenedor = document.querySelector("#listado-tareas");
            contenedor.appendChild(listado);

        });
    }

    // MOSTRAR MODAL
    function mostrarModal(editar = false, tarea = {}) {
        const contenedorModal = document.createElement('DIV');
        contenedorModal.classList.add("modal");
        contenedorModal.innerHTML = `
            <form class='formulario nueva-tarea'>
                <legend>${editar ? "Editar Tarea" : "Añade una nueva tarea"}</legend>
                
                <div class="campo div-campo">
                    <label for="tarea" class="label-tarea">Tarea:</label>
                    <input 
                        type="text" 
                        name="tarea" 
                        id="tarea"
                        class="input-tarea" 
                        placeholder="${editar ? 'Editar Tarea' : 'Nueva tarea'}"
                        value = "${tarea.nombre ? tarea.nombre : ''}"
                        />
                </div>
                <div class="opciones">
                    <input 
                        type="submit" 
                        class="enviar-nueva-tarea" 
                        value="${editar ? 'Guardar' : 'Añadir'}"
                        />
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
                const nombreTarea = document.querySelector('.input-tarea').value.trim();

                if(nombreTarea === '') {
                    mostrarAlerta('El nombre de la tarea es Obligatorio', 'error', document.querySelector('.div-campo'));
                    return;
                }

                if(editar) {
                    tarea.nombre = nombreTarea;
                    actualizarTarea(tarea);
                } else {
                    agregarTarea(nombreTarea);
                }
                
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
                modal.remove();
                tareaCreada();
                
                // Agregar el objeto de tarea al global de tareas
                const tareaObj = {
                    id: String(resultado.id),
                    nombre: tarea,
                    estado: '0',
                    proyectoId: resultado.proyectoId
                }

                tareas = [...tareas, tareaObj];
                mostrarTareas();
            }
            
        } catch (error) {
            console.log(error);
        }
    }

    // OBTENER PROYECTO
    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.id;
    }

    // LIMPIAR TAREAS
    function limpiarTareas() {
        const contenedor = document.querySelector("#listado-tareas");

        while(contenedor.firstChild) {
            contenedor.removeChild(contenedor.firstChild);
        }
    }

    // CAMBIAR ESTADO DE TAREA
    function cambiarEstadoTarea(tarea) {

        const nuevoEstado = tarea.estado === "1" ? "0" : "1";
        tarea.estado = nuevoEstado;
        actualizarTarea(tarea);
    }

    async function actualizarTarea(tarea) {
        const {id, nombre, estado, proyectoId} = tarea;

        // Construir la peticion
        const datos = new FormData();
        datos.append("id", id);
        datos.append("nombre", nombre);
        datos.append("estado", estado);
        datos.append("proyectoId", obtenerProyecto());

        try {
            const url = 'http://localhost:3001/api/tareas/actualizar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            
            const resultado = await respuesta.json();

            if(resultado.respuesta.tipo === "exito") {
                
                tareaActualizada();
                const modal = document.querySelector(".modal");
                if(modal) {
                    modal.remove();
                }
                
                tareas = tareas.map(tareaMemoria => {
                    if(tareaMemoria.id === id) {
                        tareaMemoria.estado = estado;
                        tareaMemoria.nombre = nombre;
                    }
                    return tareaMemoria;
                });
                mostrarTareas();
            }

            
        } catch (error) {
            console.log(error);
        }
    }

    async function EliminarTarea(tarea) {
        const {id, nombre, estado} = tarea;

        // Construir la peticion
        const datos = new FormData();
        datos.append("id", id);
        datos.append("nombre", nombre);
        datos.append("estado", estado);
        datos.append("proyectoId", obtenerProyecto());

        try {
            const url = 'http://localhost:3001/api/tareas/eliminar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            
            const resultado = await respuesta.json();

            if(resultado.resultado) {
                Swal.fire('Eliminado!', resultado.mensaje, 'success');

                tareas = tareas.filter( tareaMemoria => tareaMemoria.id !== tarea.id);
                mostrarTareas();
            }

            
        } catch (error) {
            console.log(error);
        }
    }

    // Exponer la función al objeto global
    window.cambiarEstadoTarea = cambiarEstadoTarea;
    window.EliminarTarea = EliminarTarea;
})();