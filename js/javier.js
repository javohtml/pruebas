//AQUI EMPIEZA
function modaldataJAV(codLic){
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
	var detailData 	= "";
	var encontradas = 0;
	var countGround = 0;
	getJSON('http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?codigo=' + codLic +'&ticket=DC01A80F-DE71-47C9-AB95-79E67CF87262').then(function(data) {
	    counta = Object.keys(data['Listado']).length;
	    for(i=0; i<counta;i++){
	        if(data['Listado']!=""){
	            var estado          = "indefinido";
	            var nombre          = data.Listado[i].Nombre;
	            var descripcion    	= data.Listado[i].Descripcion;
	            var codigoEstado    = data.Listado[i].CodigoEstado;
	            var GetTipo		    = data.Listado[i].Tipo;
	            var subcontra			= data.Listado[i].ProhibicionContratacion;
	            var c_reclamos		= data.Listado[i].CantidadReclamos;
							var urlActa 			= "";
							if(codigoEstado=="8")
								var urlActa  			= data.Listado[i].Adjudicacion['UrlActa'];
	            var detalleCat		= "";
	            var detalleNom		= "";
	            var detalleDes  	= "";
	            var tipo 			= "";
	            var subcontratacion = "";
	            var reclamos 		= "";

	            var fechaCreacions  = data.FechaCreacion;
	            if(fechaCreacions!== null)
	            	var fechaCreacion 	= fechaCreacions.substring(0, 10);
	       		if(fechaCreacion===null){
	       			fechaCreacion = 'Cerrada';
	       		}
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
	            switch(GetTipo){
	            	case 'L1':
	            		tipo = 'Licitación Pública Menor a 100 UTM (L1)';
	            	break;

	            	case 'LE':
	            		tipo = 'Licitación Pública igual o superior a 100 UTM e inferior a 1.000 UTM (LE)';
	            	break;

	            	case 'LP':
	            		tipo = 'Licitación Pública igual o superior a 1.000 UTM e inferior a 2.000 UTM (LP)';
	            	break;

	            	case 'LQ':
	            		tipo = 'Licitación Pública igual o superior a 2.000 UTM e inferior a 5.000 UTM (LQ)';
	            	break;

	            	case 'LR':
	            		tipo = 'Licitación Pública igual o superior a 5.000 UTM (LR)';
	            	break;

	            	case 'LS':
	            		tipo = 'Licitación Pública Servicios personales especializados (LS)';
	            	break;

	            	case 'E2':
	            		tipo = 'Licitación Privada Inferior a 100 UTM (E2)';
	            	break;

	            	case 'CO':
	            		tipo = 'Licitación Privada igual o superior a 100 UTM e inferior a 1000 UTM (CO)';
	            	break;

	            	case 'B2':
	            		tipo = 'Licitación Privada igual o superior a 1000 UTM e inferior a 2000 UTM (B2)';
	            	break;

	            	case 'H2':
	            		tipo = 'Licitación Privada igual o superior a 2000 UTM e inferior a 5000 UTM (H2)';
	            	break;

	            	case 'I2':
	            		tipo = 'Licitación Privada Mayor a 5000 UTM (I2)';
	            	break;
	            }
	            if(subcontra!=""){
	            	subcontratacion = 'Se prohibe Subcontratación, ' + subcontra;
	            }else{
	            	subcontratacion = "Se permite subcontratación";
	            }
	            c_reclamos = parseInt(c_reclamos);

	            if (c_reclamos<=100)
	            	reclamos = '<b style="color:#228A1F">' + c_reclamos + '</b>';

	            if(c_reclamos>100 && c_reclamos<=500)
	            	reclamos = '<b style="color:#D0AC0E">' + c_reclamos + '</b>';

	            if(c_reclamos>500 && c_reclamos<=1000)
	            	reclamos = '<b style="color:#FA9C2E">' + c_reclamos + '</b>';

	            if(c_reclamos>1000)
	            	reclamos = '<b style="color:#EF4144">' + c_reclamos + '</b>';

	            detailData += '<h2>' + nombre + '</h2>';
	            detailData += '<h3>Estado: ' + estado + '</h3>';
							if(urlActa !== "")
								detailData += '<h3><a href=\"' + urlActa + '\" target=\"a_blank\">Clic Aquí para Analizar la Adjudicación</a></h3>';
	            detailData += '<h3 style="color: goldenrod;">' + tipo + '</h3>';
	            detailData += '<h5><b>Subcontratación</b>: ' + subcontratacion + '</h5>';
	            detailData += '<h5><b>reclamos recibidos por esta institución</b>: ' + reclamos + '</h5>';
	            detailData += '<h5><b>Descripción</b>: ' + descripcion + '<br>Fecha de Creacion: ' + fechaCreacion + '</h5>';
	            detailData += '<h3 style="text-align:center;"><u>Detalle</u></h3>'
	            for(k=0; k<data.Listado[i].Items.Listado.length; k++){
	            	detalleCat 		= data.Listado[i].Items.Listado[k].Categoria;
		            detalleNom 		= data.Listado[i].Items.Listado[k].NombreProducto;
		            detalleDes 		= data.Listado[i].Items.Listado[k].Descripcion;
		            detalleCan 		= data.Listado[i].Items.Listado[k].Cantidad;
		            if(countGround == 1){
		            	detailData += '<div class="panel panel-default">';
		            	detailData += '<div class="panel-body">';
		            	detailData += '<h5>Nombre Item: ' + detalleNom + '</h5>';
			            detailData += '<h5>Categoria Item: ' + detalleCat + '</h5>';
			            detailData += '<h5>Detella Item: ' + detalleDes + '</h5>';
			            detailData += '<h5>Cantidad Item: ' + detalleCan + '</h5>';
			            detailData +='</div></div>';
			            countGround = 0;
		            }else{
		            	detailData += '<div class="panel panel-info">';
		            	detailData += '<div class="panel-body">';
		            	detailData += '<h5 back>Nombre Item: ' + detalleNom + '</h5>';
			            detailData += '<h5>Categoria Item: ' + detalleCat + '</h5>';
			            detailData += '<h5>Detella Item: ' + detalleDes + '</h5>';
			            detailData += '<h5>Cantidad Item: ' + detalleCan + '</h5>';
			            detailData +='</div></div>';
			            countGround ++;
		            }

	            }


	        }
	    }
	//display the result in an HTML element
	document.getElementById('modalData').innerHTML = detailData;
	}, function(status) { //error detection....
	    alert('Something went wrong.');
	    });
	//AQUI TERMINA
}
