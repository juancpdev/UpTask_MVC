document.querySelector("#boton-tarea").addEventListener("click",(function(){const e=document.createElement("DIV");e.classList.add("modal"),e.innerHTML='\n            <form class=\'formulario nueva-tarea\'>\n                <legend>Añadir una nueva Tarea</legend>\n                <div class="campo">\n                    <label for="tarea" class="label-tarea">Tarea:</label>\n                    <input \n                        type="text" \n                        name="tarea" \n                        id="tarea"\n                        class="input-tarea" \n                        placeholder="Nueva Tarea"/>\n                </div>\n                <div class="opciones">\n                    <input type="submit" class="enviar-nueva-tarea" value="Añadir" />\n                    <button class="cerrar-modal" type="button">Cancelar</button>\n                </div>\n            </form>\n            ',document.querySelector("body").appendChild(e),setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),e.addEventListener("click",(function(a){a.preventDefault(),a.target.classList.contains("cerrar-modal")&&(document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{e.remove()},200))}))}));