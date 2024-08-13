import Swiper from "swiper";
import { Autoplay, Navigation } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';

document.addEventListener('DOMContentLoaded', function () {
    // Verifica si existe el elemento con la clase 'slider' en el DOM
    if (document.querySelector('.slider')) {
        // Define las opciones para la configuración de Swiper
        const opciones = {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,          // Número de slides visibles por vista
            spaceBetween: 15,          // Espacio entre slides en píxeles
            freeMode: true,            // Permite el desplazamiento libre sin ajuste automático al slide más cercano
            breakpoints: {             // Configuración de la vista basada en el ancho de la pantalla
                768: {
                    slidesPerView: 2   // 2 slides visibles a partir de 768px de ancho de pantalla
                },
                1024: {
                    slidesPerView: 3   // 3 slides visibles a partir de 1024px de ancho de pantalla
                },
                1200: {
                    slidesPerView: 4   // 4 slides visibles a partir de 1200px de ancho de pantalla
                }
            },
            navigation: {              // Configuración de los botones de navegación
                prevEl: '.swiper-button-prev',  // Selector del botón para ir al slide anterior
                nextEl: '.swiper-button-next'   // Selector del botón para ir al siguiente slide
            },
            loop: true,
        };
        
        // Crea una nueva instancia de Swiper con el selector y las opciones definidas
        new Swiper('.swiper', {
            modules: [Navigation, Autoplay],  // Incluye el módulo de navegación en la configuración
            ...opciones             // Expande el objeto de opciones dentro de la configuración de Swiper
        });
    }
});
