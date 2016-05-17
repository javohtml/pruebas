//AQUI EMPIEZA
var urls    = new Array();
function getURL(codLic){
	var getJSON = function(url) {
	    return new Promise(function(resolve, reject) {
	        var xhr = new XMLHttpRequest();
	        xhr.open('get', url, true);
	        xhr.responseType = 'json';
	        xhr.onload = function() {
	            var statu = xhr.statu;
	            if (statu == 200) {
	                resolve(xhr.response);
	            } else {
	                reject(statu);
	            }
	        };
	        xhr.send();
	    });
	};
	function getThoseURL(codLic){
		getJSON('http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?codigo='+codLic+'&ticket=C9BFC511-8821-4FA9-B56E-C7BBE8A0149C').then(function(data) {
		    counta = Object.keys(data['Listado']).length;
		    for(i=0; i<counta;i++){
		        if(data['Listado']!=""){
		            var urlActa          = data.Listado[i].Adjudicacion['UrlActa'];
		            return urlActa;
		        }
		    }
		//display the result in an HTML element
		console.log(urlData);
		}, function(statu) { //error detection....
		    console.log('Something went wrong.');
		    });
	}
	//AQUI TERMINA
}