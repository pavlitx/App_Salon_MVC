let paso=1;const pasoInicial=1,pasoFinal=3,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t="#paso-"+paso;document.querySelector(t).classList.add("mostrar");document.querySelector(".actual").classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()})})}function botonesPaginador(e){const t=document.querySelector("#siguiente"),o=document.querySelector("#anterior");1===paso?(o.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(o.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(o.classList.remove("ocultar"),t.classList.remove("ocultar"))}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador(),mostrarSeccion())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador(),mostrarSeccion())}))}async function consultarAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:a}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=a+" €";const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(n),r.appendChild(c),document.querySelector("#servicios").appendChild(r)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita;document.querySelector(`[data-id-servicio="${t}"]`).classList.toggle("seleccionado"),cita.servicios=[...o,e]}function idCliente(){cita.id=document.querySelector("#id").value}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function seleccionarFecha(){const e=document.querySelector("#fecha");e.addEventListener("input",t=>{const o=new Date(t.target.value).getUTCDay();[6,0].includes(o)?(t.target.value=[],mostrarAlerta("Fines de semana no permitidos","error",".formulario")):cita.fecha=t.target.value,cita.fecha=e.value})}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",e=>{const t=e.target.value.split(":")[0];t<10||t>=21?(e.target.value=[],mostrarAlerta("Hora no válida","error",".formulario")):cita.hora=e.target.value})}function mostrarAlerta(e,t,o,a=!0){const n=document.querySelector(".alerta");n&&n.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add("alerta","error");document.querySelector(o).appendChild(c),a&&setTimeout(()=>{c.remove()},3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de Servicios, Fecha u Hora","error",".contenido-resumen",!1);const t=document.createElement("H3");t.textContent="Resumen de Cita",e.appendChild(t);const{nombre:o,fecha:a,hora:n,servicios:c}=cita,r=document.createElement("P");r.innerHTML="<span>Nombre: </span> "+o;const i=new Date(a),s=i.getMonth(),d=i.getDate(),l=i.getFullYear(),u=new Date(Date.UTC(l,s,d)).toLocaleDateString("es-ES",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),m=document.createElement("P");m.innerHTML="<span>Fecha: </span> "+u;const p=document.createElement("P");p.innerHTML="<span>Hora: </span> "+n,e.appendChild(r),e.appendChild(m),e.appendChild(p);const v=document.createElement("BUTTON");v.classList.add("boton"),v.textContent="Reservar Cita",v.onclick=reservarCita,e.appendChild(v);const h=document.createElement("H3");h.textContent="Resumen de Servicios",e.appendChild(h),c.forEach(t=>{const{id:o,precio:a,nombre:n}=t,c=document.createElement("DIV");c.classList.add("contenedor-servicio");const r=document.createElement("P");r.textContent=n;const i=document.createElement("P");i.innerHTML=`<span>Precio: </span> ${a}€`,c.appendChild(r),c.appendChild(i),e.appendChild(c)})}async function reservarCita(e){const{nombre:t,fecha:o,hora:a,servicios:n,id:c}=cita,r=n.map(e=>e.id),i=new FormData;i.append("usuarioId",c),i.append("fecha",o),i.append("hora",a),i.append("servicios",r),console.log([...i]);try{const e="http://localhost:3000/api/citas",t=await fetch(e,{method:"POST",body:i}),o=await t.json();console.log(o),o.resultado&&Swal.fire({icon:"success",title:"Cita Creada",text:"Tu cita fue creada correctamente",button:"OK"}).then(()=>{setTimeout(()=>{window.location.reload()},3e3)})}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita"})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));