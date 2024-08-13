(function() {
    
    const grafica = document.querySelector('#grafica');
    
    if(grafica) {
        
        obtenerRegalos();
        
        async function obtenerRegalos() {
            
            const url = '/api/regalos';
            
            const respuesta = await fetch(url);
            
            const resultado =  await respuesta.json();
            
            const {regalos} = resultado;
            
            new Chart(grafica, {
                type: 'bar',
                data: {
                    labels: regalos.map( regalo => regalo.nombre ),
                    datasets: [{
                        label: '',
                        data: regalos.map( regalo => regalo.total ),
                        backgroundColor: [
                            '#ea580c',
                            '#84cc16',
                            '#22d3ee',
                            '#a855f7',
                            '#ef4444',
                            '#14b8a6',
                            '#db2777',
                            '#e11d48',
                            '#7e22ce'
                        ]
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

        }
        
    }
    
})();