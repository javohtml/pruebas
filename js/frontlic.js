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
var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1; //hoy es 0!
var yyyy = hoy.getFullYear();
if(dd<10) {
    dd='0'+dd
} 
if(mm<10) {
    mm='0'+mm
} 
var fechahoy = dd+''+mm+''+yyyy;
var bigData = "";
getJSON('http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?estado=Publicada&ticket=F5B2C5D3-94A2-4343-8D26-5B92560984B7').then(function(data) {
    counta = Object.keys(data['Listado']).length;
    for(i=0; i<counta;i++){
        if(data['Listado']!=""){
            var estado          = "indefinido";
            var codigo          = data.Listado[i].CodigoExterno;
            var nombre          = data.Listado[i].Nombre;
            var codigoEstado    = data.Listado[i].CodigoEstado;
            var FechaCierre     = data.Listado[i].FechaCierre;
            //var res             = FechaCierre.slice(0,10)
            switch(codigoEstado){
                case 5: 
                    estado = "Publicada"
                    break;
                case 6: 
                    estado = "Cerrada"
                    break;
                case 7: 
                    estado = "Desierta"
                    break;
                case 8: 
                    estado = "Adjudicada"
                    break;
                case 18: 
                    estado = "Revocada"
                    break;
                case 19: 
                    estado = "Suspendida"
                    break;
                default:
                    estado = codigoEstado;
                    break;
            }
            bigData += '<tr><td>' + codigo + '</td><td>'+ nombre + '</td><td>' + estado + '</td><td>' + FechaCierre + '</td></tr>';   
        }
    }
//display the result in an HTML element
document.getElementById('results').innerHTML = bigData;
}, function(status) { //error detection....
    alert('Something went wrong.');
    });
//AQUI TERMINA