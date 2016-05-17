//AQUI EMPIEZA
var getJSON = function(url) {
    return new Promise(function(resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.open('get', url, true);
        xhr.responseType = 'json';
        xhr.onload = function() {
            var status = xhr.status;
            if (status == 200) {
                resolve(xhr.response);
            } else {
                reject(status);
            }
        };
        xhr.send();
    });
};
getJSON('http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?estado=Publicada&ticket=E624B927-9270-4979-A774-FC9937517DEA').then(function(data) {
        counta              = Object.keys(data['Listado']).length;
        var cantidad        = data.Cantidad;
        document.getElementById('totalN').innerHTML += cantidad;
    
//display the result in an HTML element
}, function(status) { //error detection....
    alert('Something went wrong.');
    });
//AQUI TERMINA