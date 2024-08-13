(function() {
    
    if(document.querySelector('#mapa')) {
        
        var map = L.map('mapa').setView([19.04048806333775, -98.20607229420851], 20);
        
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        L.marker([19.04048806333775, -98.20607229420851]).addTo(map)
        .bindPopup('DevWebCamp')
        .openPopup();
        
    }
    
})();