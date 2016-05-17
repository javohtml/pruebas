<?php
$superArreglo;
$contador 	= 0;
$moodle 	= "";
function curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
	$superArreglo = explode(",", $keyWord);
	$moodle = "http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?estado=Publicada&ticket=E624B927-9270-4979-A774-FC9937517DEA";
	$result = curl($moodle);
	$result = json_decode($result, true);
	foreach($result['Listado'] as $key => $values) {
		$estado          = "indefinido";
        $codigo          = $values['CodigoExterno'];
        $nombre          = $values['Nombre'];
        $codigoEstado    = $values['CodigoEstado'];
        $FechaCierres    = $values['FechaCierre'];
        if(!(is_null($FechaCierres)))
            $FechaCierre     = $FechaCierres;
        for($f=0;$f<count($superArreglo);$f++){
        	if (strpos($nombre, $superArreglo[$f]) !== false) {
			    echo "<tr><td>" . $codigo . "</td><td><a data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"modaldata('" . $codigo . "')\">" . $nombre . '</a></td><td>' . $FechaCierre . '</td><td style="text-align:center;"><i class="fa fa-star"></i></td></tr>';
			    $contador++;
			}
        }
        echo "<script>document.getElementById('encontradas').innerHTML = '".$contador."';</script>";
	}
	if($contador==0)
        echo '<td colspan="4" class="alert alert-danger">Sin Resultados</td>';
?>