//AQUI EMPIEZA
var codigos     = "";
var vivaldi     = "";
function amon(tube){
    vivaldi = tube;
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
    var fechahoy   = dd+''+mm+''+yyyy;
                    
    function getThoseNumbers(huxon){
        getJSON('http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?fecha='+huxon+'&estado=Adjudicada&ticket=C9BFC511-8821-4FA9-B56E-C7BBE8A0149C').then(function(data) {
            counta = Object.keys(data).length;

            if(data.Cantidad){
                counter = Object.keys(data['Listado']).length;
                for(i=0; i<counter;i++){
                    if(data['Listado']!=""){
                        var codigo      = data.Listado[i].CodigoExterno;
                        var nombre      = data.Listado[i].Nombre;
                        var descripcion = data.Listado[i].Descripcion;
                        var cadenaSTR   = '<tr><td>' + codigo + '</td><td>' + nombre + '</td><td>' + descripcion + '</td><td>';
                            cadenaSTR   += "<td><a data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"modaldata('" + codigo + "')\"><button class=\"btn btn-info btn-circle\"><i class=\"fa fa-search\"></i></button></a></td></tr>";
                        return cadenaSTR;
                    }
                }
            }

        }, function(status) { //error detection....
            console.log('borrar esto');
            });
    }
                    
    var hud = '';
    for(var hux = 1; hux<=12;hux++){
        for(var hub = 1; hub<=31; hub++){
            if(hub<=9){
                if(hux<=9){
                    hud = '0'+hub+'0'+hux+'2015';
                }else{
                    hud = '0'+hub+''+hux+'2015';
                }
            }else{
                if(hux<=9){
                    hud = ''+hub+'0'+hux+'2015';
                }else{
                    hud = ''+hub+''+hux+'2015';
                }
            }
            codigos += getThoseNumbers(hud);
        }
    }
    if(codigos!==''){
        document.getElementById('resultados').innerHTML = codigos;
    }else{
        document.getElementById('resultados').innerHTML = '<tr><td colspan="4">Lo sentimos, no hemos podido encontrar licitaciones parecidas a la que has seleccionado</td></tr>';
    }
    //AQUI TERMINA     
}