(function(){
    
    const tags_input = document.querySelector("#tags_input");

    if(tags_input){

        let tags = [];

        const tagsDiv = document.querySelector("#tags");
        const tagsInputHidden = document.querySelector("[name=tags]");

        tags_input.addEventListener('keypress',guardarTag);

        //Recuperar el input oculto
        if(tagsInputHidden.value !== '') {
            tags = tagsInputHidden.value.split(',');
            mostrarTags();
        }

        function guardarTag(e) {

            if(e.key === ",") {

                e.preventDefault();

                if(e.target.value.trim === '' || e.target.value < 1) {
                    return;
                }

                tags = [...tags,e.target.value.trim()];

                console.log(tags);

                tags_input.value = '';

                mostrarTags();

            }
    
        }

        function mostrarTags() {

            // while(tagsDiv.firstChild){
            //     tagsDiv.removeChild(tagsDiv.firstChild);
            // }

            tagsDiv.textContent = '';

            tags.forEach( tag => {

                const etiqueta = document.createElement('LI');
                etiqueta.classList.add("formulario__tag");
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);

            });

            actualizarInputHidden();

        }

        function actualizarInputHidden() {

            tagsInputHidden.value = tags.toString();

        }

        function eliminarTag(e) {

            //console.log(e.target.textContent);
            //console.log(e.target);

            e.target.remove();
            tags = tags.filter( tag => tag !== e.target.textContent);
            actualizarInputHidden();

            console.log(tags);

        }

    }

    
    
})();