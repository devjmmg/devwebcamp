(function(){
    
    const ponentesInput = document.querySelector("#ponentes");
    
    if(ponentesInput) {
        
        let ponentes = [];
        let ponentesFiltrados = [];
        
        const listadoPonentes = document.querySelector("#listado-ponentes");
        const inputHiddenPonente = document.querySelector('[name="ponente_id"]');
        
        obtenerPonentes();
        
        if(inputHiddenPonente.value) {
            
            (async ()=> {
                
                await obtenerPonentes();
                
                const ponente = ponentes.find(ponente => ponente.id === inputHiddenPonente.value);
                
                const ponenteHTML = document.createElement("LI");
                ponenteHTML.classList.add('listado-ponentes__ponente','listado-ponentes__ponente--seleccionado');
                ponenteHTML.textContent = ponente.nombre;
                
                //Añadir al DOM
                listadoPonentes.appendChild(ponenteHTML);
                
            })();
            
        }
        
        //keyup
        ponentesInput.addEventListener('input', buscarPonentes);
        
        async function obtenerPonentes() {
            
            const url = '/api/ponentes';
            
            const respuesta = await fetch(url);
            
            const resultado = await(respuesta.json());
            
            formatearPonentes(resultado);
            
        }
        
        function formatearPonentes(arrayPonentes = []) {
            
            ponentes = arrayPonentes.map(ponente => {
                
                const {id, nombre, apellido} = ponente;
                
                return {
                    
                    id: id,
                    nombre: `${nombre.trim()} ${apellido.trim()}`
                    
                }
                
            });
            
        }
        
        function buscarPonentes(e) {
            
            const busqueda = e.target.value;
            
            if(busqueda.length > 3) {
                
                const expresion = new RegExp(busqueda,'i');
                
                ponentesFiltrados = ponentes.filter(ponente => {
                    
                    if(ponente.nombre.toLowerCase().search(expresion) !== -1){
                        
                        return ponente;
                        
                    }
                    
                });
                
            }else{
                
                ponentesFiltrados = [];
                
            }
            
            mostrarPonentes();
            
        }
        
        function mostrarPonentes() {
            
            while(listadoPonentes.firstChild){
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }
            
            if(ponentesFiltrados.length > 0) {
                
                ponentesFiltrados.forEach( ponente => {
                    
                    const ponenteHTML = document.createElement("LI");
                    ponenteHTML.classList.add('listado-ponentes__ponente');
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.ponenteId = ponente.id;
                    ponenteHTML.onclick = seleccionarPonente;
                    
                    //Añadir al DOM
                    listadoPonentes.appendChild(ponenteHTML);
                    
                });
                
            }else{
                
                const noResultado = document.createElement("P");
                noResultado.classList.add('listado-ponentes__no-resultado');
                noResultado.textContent = "No se encontraron coincidencias con la búsqueda";
                listadoPonentes.appendChild(noResultado);
                
            }
            
        }
        
        function seleccionarPonente(e) {
            
            const ponente = e.target;
            
            const ponentePrevio = document.querySelector('.listado-ponentes__ponente--seleccionado');
            if(ponentePrevio){
                ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado');
            }
            
            ponente.classList.add('listado-ponentes__ponente--seleccionado');
            
            inputHiddenPonente.value = ponente.dataset.ponenteId;
            
            ponentesInput.value = ponente.textContent;
            
        }
        
    }
    
})();