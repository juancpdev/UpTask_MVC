!function(){!async function(){try{const t="/api/tareas?id="+o(),n=await fetch(t),r=await n.json();e=r.tareas,a()}catch(e){console.log(e)}}();let e=[];document.querySelector("#boton-tarea").addEventListener("click",(function(){const t=document.createElement("DIV");t.classList.add("modal"),t.innerHTML='\n            <form class=\'formulario nueva-tarea\'>\n                <legend>Añadir una nueva Tarea</legend>\n                \n                <div class="campo div-campo">\n                    <label for="tarea" class="label-tarea">Tarea:</label>\n                    <input \n                        type="text" \n                        name="tarea" \n                        id="tarea"\n                        class="input-tarea" \n                        placeholder="Nueva Tarea"/>\n                </div>\n                <div class="opciones">\n                    <input type="submit" class="enviar-nueva-tarea" value="Añadir" />\n                    <button class="cerrar-modal" type="button">Cancelar</button>\n                </div>\n            </form>\n            ',document.querySelector(".dashboard").appendChild(t),setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),t.addEventListener("click",(function(r){if(r.preventDefault(),r.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{t.remove()},200)}if(r.target.classList.contains("enviar-nueva-tarea")){const t=document.querySelector(".input-tarea").value.trim();if(""===t)return void n("El nombre de la tarea es Obligatorio","error",document.querySelector(".div-campo"));!async function(t){const r=new FormData;r.append("nombre",t),r.append("proyectoId",o());try{const o="http://localhost:3001/api/tarea",c=await fetch(o,{method:"POST",body:r}),s=await c.json();if(console.log(s),n(s.mensaje,s.tipo,document.querySelector(".div-campo")),"exito"===s.tipo){const n=document.querySelector(".modal");setTimeout(()=>{n.remove()},1e3);const o={id:String(s.id),nombre:t,estado:"0",proyectoId:s.proyectoId};e=[...e,o],a(),console.log(o)}}catch(e){console.log(e)}}(t)}}))}));const t={0:"Pendiente",1:"Completado"};function a(){if(function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),0===e.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("P");return t.classList.add("vacio"),t.innerHTML="Aún no hay tareas",void e.appendChild(t)}e.forEach(e=>{const a=document.createElement("LI"),n=document.createElement("P");a.dataset.tareaId=e.id,a.classList.add("tarea"),n.innerHTML=""+e.nombre;const o=document.createElement("DIV");o.classList.add("opciones");const r=document.createElement("BUTTON");r.classList.add("btn-tarea",(""+t[e.estado]).toLowerCase()),r.textContent=t[e.estado],r.dataset.estadoTarea=e.estado;const c=document.createElement("BUTTON");c.classList.add("btn-tarea","btn-eliminar"),c.textContent="Eliminar",c.dataset.idTarea=e.id,o.appendChild(r),o.appendChild(c),a.appendChild(n),a.appendChild(o);document.querySelector("#listado-tareas").appendChild(a)})}function n(e,t,a){const n=document.querySelector(".alertas");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alertas",t),o.innerHTML=e,a.parentElement.insertBefore(o,a),setTimeout(()=>{o.remove()},1e3)}function o(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}}();