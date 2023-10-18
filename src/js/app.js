const menu = document.getElementById("menu");
const cerrar = document.querySelector(".menu-cerrar");
const sidebar = document.querySelector(".sidebar");

if(menu) {
    menu.addEventListener('click', function() {
        sidebar.classList.toggle("mostrar");
        document.body.classList.add('no-scroll');
    });
}

if(cerrar) {
    cerrar.addEventListener('click', function() {
        sidebar.classList.toggle("ocultar");
        document.body.classList.remove('no-scroll');
        setTimeout(() => {
            sidebar.classList.remove("mostrar");
            sidebar.classList.remove("ocultar");
        }, 500);
    });
}

// Eliminar la clase de mostrar en tamaños tablet y >

window.addEventListener('resize', function() {
    const anchoPantalla = document.body.clientWidth;
    if(anchoPantalla >= 768) {
        sidebar.classList.remove("mostrar");
        document.body.classList.remove('no-scroll');
    }
})