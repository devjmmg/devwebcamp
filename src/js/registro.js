import Swal from 'sweetalert2'

(function() {
    
    let eventos = [];
    
    const btnsAgregar = document.querySelectorAll('.evento__agregar');
    
    
    if(btnsAgregar) {
        
        const resumen = document.querySelector('#registro-resumen');
        const formulario = document.querySelector('#registro');
        if(formulario){
            formulario.addEventListener('submit',submitFormulario);
        }

        btnsAgregar.forEach( boton => boton.addEventListener('click',seleccionarEvento) );

        mostrarEventos();
        
        function seleccionarEvento(e) {
            
            if(eventos.length < 5) {
                
                eventos = [...eventos, {
                    id: e.target.dataset.id,
                    nombre: e.target.parentElement.querySelector('.evento__nombre').textContent.trim()
                }];
                
                e.target.disabled = true;
                
                mostrarEventos();
                
            }else{
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Solo se permite un maximo de 5 eventos por registro',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                
            }
            
        }
        
        function mostrarEventos() {
            
            if(resumen) {
                while(resumen.firstChild){
                    resumen.removeChild(resumen.firstChild);
                }
            }

            if(eventos.length > 0) {
                
                eventos.forEach( evento => {
                    
                    const {id, nombre} = evento;
                    
                    const eventoDom = document.createElement('DIV');
                    eventoDom.classList.add('registro__evento');
                    
                    const nombreDom = document.createElement('H3');
                    nombreDom.textContent = nombre;
                    nombreDom.classList.add('registro__nombre');
                    
                    const btnEliminar = document.createElement('BUTTON');
                    btnEliminar.classList.add('registro__eliminar');
                    btnEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                    btnEliminar.onclick = function() {
                        eliminarEvento(id);
                    }
                    
                    eventoDom.appendChild(nombreDom);
                    eventoDom.appendChild(btnEliminar);
                    resumen.appendChild(eventoDom);
                    
                } );
                
            }else{

                const noRegistro = document.createElement('P');
                noRegistro.classList.add('registro__texto');
                noRegistro.textContent = 'No hay eventos, agrega hasta 5 del lado izquierdo';
                if(resumen) {
                    resumen.appendChild(noRegistro);
                }

            }
            
        }
        
        function eliminarEvento(id) {
            
            eventos = eventos.filter( evento => evento.id !== id);
            
            const btnAgregar = document.querySelector(`[data-id="${id}"]`);
            btnAgregar.disabled = false;
            
            mostrarEventos();
            
        }

        async function submitFormulario(e) {
            
            e.preventDefault();
            
            const regaloId = document.querySelector('#regalo').value;
            const eventosId = eventos.map( evento => evento.id);
            
            if(regaloId === '' || eventosId.length === 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Elige al menos un evento y un regalo',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const data = new FormData();
            data.append('regaloId',regaloId);
            data.append('eventosId',eventosId)
            
            const url = '/finalizar-registro/conferencias';

            const respuesta = await fetch(url,{
                method: 'POST',
                body: data
            });

            const resultado = await respuesta.json();

            if(resultado.resultado) {
                Swal.fire({
                    title: 'Registro exitoso!',
                    text: 'Registro completado correctamente, Te esperamos en DevWebCamp',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
                .then( () => {
                    location.href = `/boleto?id=${resultado.token}`;
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo algún error',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                .then( () => {
                    location.reload();
                });
            }
            
        }
        
    }
    
    
})();