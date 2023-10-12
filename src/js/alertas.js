// ALERTAS
function tareaCreada() {
    Swal.fire({
        icon: 'success',
        title: 'Tarea Creada',
        text: 'La tarea fue creada correctamente!',
        confirmButtonText: 'OK'
    })
}

function tareaCompletado(tarea) {
    Swal.fire({
        icon: 'question',
        title: '¿Completaste la tarea?',
        showCancelButton: true,
        confirmButtonText: 'Sí, completado',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, envía el formulario.
            cambiarEstadoTarea(tarea);
        }
    });
}

function tareaPendiente(tarea) {
    Swal.fire({
        icon: 'question',
        title: '¿Deseas marcar la tarea como pendiente?',
        showCancelButton: true,
        confirmButtonText: 'Sí, tarea pendiente',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, envía el formulario.
            cambiarEstadoTarea(tarea);
        }
    });
}


function proyectoCreado(e) {
    e.preventDefault(); // Detiene la acción por defecto del formulario
    
    Swal.fire({
        icon: 'success',
        title: 'Tarea Creada',
        text: 'La tarea fue creada correctamente!',
        confirmButtonText: 'OK'
    }).then(result => {
        // Si el usuario pulsa OK, enviar el formulario
        if (result.isConfirmed) {
            e.target.form.submit(); // Envía el formulario
        }
    });
}