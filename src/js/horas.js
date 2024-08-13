(function(){
    
    const horas = document.querySelector('#horas');
    
    if(horas) {
        
        const categoria = document.querySelector('[name="categoria_id"]');
        
        categoria.addEventListener('change',terminoBusqueda);
        
        const dias = document.querySelectorAll("[name='dia']");
        
        const inputHiddenDia = document.querySelector("[name='dia_id']");
        const inputHiddenHora = document.querySelector("[name='hora_id']");
        
        dias.forEach(dia => dia.addEventListener('change',terminoBusqueda));
        
        const evento = {
            
            categoria_id: +categoria.value || '',
            dia: +inputHiddenDia.value || ''
            
        }
        
        if(!Object.values(evento).includes('')) {
            
            ( async () => {
                
                await buscarEvento(); //busacar es una función asincrona y no se espera sino que pasa inmediatamente por ello debemos esperar a que termine y despues seguir con el codigo restante que uita la clase
                
                const id = inputHiddenHora.value;
                
                //Resaltar la hora actual mediante el dataset
                const horaSeleccionada = document.querySelector(`[data-hora-id="${id}"]`);
                horaSeleccionada.classList.remove('horas__hora--inactivo');
                horaSeleccionada.classList.add('horas__hora--activo');

                //Como el li tenia la clase de hora inactiva no le asocio el evento de seleccionar hora para ello debemos agregarlo
                horaSeleccionada.onclick = seleccionarHora;
                
            })();
            
        }
        
        function terminoBusqueda(e) {
            
            evento[e.target.name] = e.target.value;
            
            inputHiddenDia.value = '';
            inputHiddenHora.value = '';
            const horaPrevia = document.querySelector('.horas__hora--activo');
            if(horaPrevia) {
                horaPrevia.classList.remove('horas__hora--activo');
            }
            
            if(Object.values(evento).includes('')) {
                return;
            }
            
            buscarEvento();
            
        }
        
        async function buscarEvento() {
            
            const {categoria_id, dia} = evento;
            
            const url = `/api/eventos-horario?categoria_id=${categoria_id}&dia_id=${dia}`;
            
            const respuesta = await fetch(url);
            
            const resultado = await respuesta.json();
            
            obtenerHorasDisponibles(resultado);
            
        }
        
        function obtenerHorasDisponibles(resultado) {
            
            //Reiniciar horas
            const listadoHoras = document.querySelectorAll("#horas li");
            listadoHoras.forEach(li => li.classList.add('horas__hora--inactivo'));
            
            const horasTomadas = resultado.map(evento => evento.hora_id);
            
            const listadoHorasArray = Array.from(listadoHoras);
            
            const r = listadoHorasArray.filter(li => !horasTomadas.includes(li.dataset.horaId));
            r.forEach(li => {
                li.classList.remove('horas__hora--inactivo');
            });
            
            const horasDisponibles = document.querySelectorAll("#horas li:not(.horas__hora--inactivo)");
            horasDisponibles.forEach( hora =>  hora.addEventListener('click',seleccionarHora));
            
        }
        
        function seleccionarHora(e) {
            
            if(e.target.classList.contains('horas__hora--inactivo')){
                
                return;
            }
            
            //Desabilitar hora previa
            const horaPrevia = document.querySelector('.horas__hora--activo');
            if(horaPrevia) {
                horaPrevia.classList.remove('horas__hora--activo');
            }
            
            e.target.classList.add("horas__hora--activo");
            
            inputHiddenHora.value = e.target.dataset.horaId;
            
            inputHiddenDia.value = evento.dia;
            
        }
    }
    
})();