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
var bigData 	= "";
var encontradas = 0;
getJSON('http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?estado=Publicada&ticket=E624B927-9270-4979-A774-FC9937517DEA').then(function(data) {
    counta = Object.keys(data['Listado']).length;
    for(i=0; i<counta;i++){
        if(data['Listado']!=""){
            var estado          = "indefinido";
            var codigo          = data.Listado[i].CodigoExterno;
            var nombre          = data.Listado[i].Nombre;
            var codigoEstado    = data.Listado[i].CodigoEstado;
            var FechaCierres    = data.Listado[i].FechaCierre;
            if(FechaCierres!== null)
                var FechaCierre     = FechaCierres.substring(0, 10);
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
           	var preferencias 	= document.getElementById('KeyWords').value;
			var KeyWord 		= preferencias.split(",");
			for(h=0;h<KeyWord.length;h++){
				if(nombre.indexOf(KeyWord[h]) >=0){
					encontradas ++;
				  	bigData += "<tr><td>" + codigo + "</td><td><a data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"modaldata('" + codigo + "')\">" + nombre + '</a></td><td>' + estado + '</td><td>' + FechaCierre + '</td></tr>';
				}
			}            
        }
    }
//display the result in an HTML element
console.log(bigData);
if(bigData===""){
	document.getElementById('results').innerHTML ='<tr><td colspan="4" class="alert alert-danger">Sin Resultados</td></tr>';
}else{
	document.getElementById('results').innerHTML = bigData;
}
if(encontradas===0){
	document.getElementById('encontradas').innerHTML = '0';
}else{
	document.getElementById('encontradas').innerHTML = encontradas;
}
}, function(status) { //error detection....
    alert('Something went wrong.');
    });
//AQUI TERMINA
