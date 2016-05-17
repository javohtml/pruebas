<?php
Class Usuario
{
	private $id;
	private $nombre;
	private $apellido;
	private $empresa;
	private $sector;
	private $cargo;
	private $rut;
	private $pass;
	private $correo;
	private $go;
	private $query;
	private $results;

	function nuevoUsuario($nom,$ape,$emp,$sec,$car,$rut,$pas,$cor){
		$this->nombre 	= $nom;
		$this->apellido = $ape;
		$this->empresa 	= $emp;
		$this->sector 	= $sec;
		$this->cargo 		= $car;
		$this->rut 			= $rut;
		$this->pass 		= md5($pas);
		$this->correo 	= $cor;
		$this->query 		= 'INSERT INTO `USUARIO`(`USUARIO_NOMBRE`, `USUARIO_APELLIDO`, `USUARIO_EMPRESA`, `USUARIO_SECTOR`, `USUARIO_CARGO`, `USUARIO_RUT`, `USUARIO_CORREO`, `USUARIO_PASS`) VALUES ("'.$this->nombre.'","'.$this->apellido.'","'.$this->empresa.'","'.$this->sector.'","'.$this->cargo.'","'.$this->rut.'","'.$this->correo.'","'.$this->pass.'")';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if($this->go)
			$this->results = mysqli_insert_id($connection);
		else
			$this->results = false;
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function actualizarUsuario($id,$nom,$ape,$emp,$sec,$car,$rut,$cor){
		$this->id 			= $id;
		$this->nombre 	= $nom;
		$this->apellido = $ape;
		$this->empresa 	= $emp;
		$this->sector 	= $sec;
		$this->cargo 		= $car;
		$this->rut 			= $rut;
		$this->correo 	= $cor;
		$this->query 		= 'UPDATE `USUARIO` SET `USUARIO_NOMBRE`="'.$this->nombre.'",`USUARIO_APELLIDO`="'.$this->apellido.'",`USUARIO_EMPRESA`="'.$this->empresa.'",`USUARIO_SECTOR`="'.$this->sector.'",`USUARIO_CARGO`="'.$this->cargo.'",`USUARIO_RUT`="'.$this->rut.'",`USUARIO_CORREO`="'.$this->correo.'" WHERE `USUARIO_ID`= "'.$this->id.'"';
		require "connection/sqli.php";
		$this->go 			= mysqli_query($connection,$this->query);
		if(mysqli_affected_rows($connection)>0)
			$this->results = true;
		else
			$this->results = false;
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function usuarioPorCorreo($cor){
		$this->correo = $cor;
		$this->query 	= 'SELECT `USUARIO_ID`,`USUARIO_CORREO` FROM `USUARIO` WHERE `USUARIO_CORREO`="'.$this->correo.'"';
		require "connection/sqli.php";
		$this->go = mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
		}else{
			$this->results = false;
		}
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function usuarioPorId($id){
		$this->id = $id;
		$this->query 	= 'SELECT `USUARIO_ID`, `USUARIO_NOMBRE`, `USUARIO_APELLIDO`, `USUARIO_EMPRESA`, `USUARIO_SECTOR`, `USUARIO_CARGO`, `USUARIO_RUT`, `USUARIO_CORREO`, `USUARIO_PASS` FROM `USUARIO` WHERE `USUARIO_ID`="'.$this->id.'"';
		require "connection/sqli.php";
		$this->go = mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
		}else{
			$this->results = false;
		}
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function usuarioLog($_id){
		$this->id 		= $_id;
		$this->query 	= 'SELECT `USUARIO_ID`, `USUARIO_NOMBRE`, `USUARIO_APELLIDO`, `USUARIO_EMPRESA`, `USUARIO_SECTOR`, `USUARIO_CARGO`, `USUARIO_RUT`, `USUARIO_CORREO` FROM `USUARIO` WHERE `USUARIO_ID`="'.$this->id.'"';
		require "connection/sqli.php";
		$this->go = mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
		}else{
			$this->results = false;
		}
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function LogIn($correo,$pass){
		$this->pass 	= md5($pass);
		$this->correo 	= $correo;
		$this->query 	= 'SELECT `USUARIO_ID`,`USUARIO_NOMBRE`,`USUARIO_APELLIDO`,`USUARIO_EMPRESA` FROM `USUARIO` WHERE `USUARIO_CORREO`="'.$this->correo.'" AND `USUARIO_PASS`="'.$this->pass.'"';
		require "connection/sqli.php";
		$this->go = mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
		}
		else
			$this->results = false;
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function delUsuario($uid){
		$this->id 	= $uid;
		$this->query= 'DELETE FROM `USUARIO` WHERE `USUARIO_ID`="'.$this->id.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if(mysqli_affected_rows($connection)>0)
			$this->results = true;
		else
			$this->results = false;
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}
}
Class Preferencia
{
	var $id;
	var $usuario;
	var $titulo;
	var $keyWord;

	function newData($usuario,$titulo,$keyWord){
		$this->usuario 	= $usuario;
		$this->titulo 	= base64_encode($titulo);
		$this->keyWord 	= base64_encode($keyWord);
		$this->query 	= 'INSERT INTO `PREFERENCIAS`(`USUARIO_ID`, `PREF_TITULO`, `PREF_KEYWORD`) VALUES ("'.$this->usuario.'","'.$this->titulo.'","'.$this->keyWord.'")';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if($this->go)
			$this->results = true;
		else
			$this->results = false;

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}
	function modData($id,$titulo,$keyWord){
		$this->id 		= $id;
		$this->titulo 	= base64_encode($titulo);
		$this->keyWord 	= base64_encode($keyWord);
		$this->query 	= 'UPDATE `PREFERENCIAS` SET `PREF_TITULO`="'.$this->titulo.'",`PREF_KEYWORD`="'.$this->keyWord.'" WHERE `PREF_ID`="'.$this->id.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if(mysqli_affected_rows($connection)>0)
			$this->results = true;
		else
			$this->results = false;

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function loadData($id){
		$this->usuario 	= $id;
		$this->query 	= 'SELECT `PREF_ID`, `PREF_TITULO`, `PREF_KEYWORD` FROM `PREFERENCIAS` WHERE `USUARIO_ID`="'.$this->usuario.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
		}
		else
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

}
Class Favorito
{
	var $cont;
	var $codigo;
	var $fecha;
	var $nombre;
	var $licitacion;
	var $query;
	var $go;
	var $results;
	var $usuario;

	function addFavorito($usuario,$licitacion){
		$this->usuario 		= $usuario;
		$this->licitacion 	= $licitacion;
		$this->query 		= 'INSERT INTO `FAVORITO`(`USUARIO_ID`, `LIC_CODIGO`) VALUES ("'.$this->usuario.'","'.$this->licitacion.'")';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if($this->go)
			$this->results = true;
		else
			$this->results = false;

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function checkFav($idUsuario,$licCode){
		$this->usuario = $idUsuario;
		$this->codigo  = $licCode;
		$this->query 	 = 'SELECT `USUARIO_ID`, `LIC_CODIGO` FROM `FAVORITO` WHERE `USUARIO_ID`="'.$this->usuario.'" AND `LIC_CODIGO`="'.$this->codigo.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = true;
		}
		else
			$this->results = false;

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function deleteFavorito($usuario,$codigo){
		$this->usuario 		= $usuario;
		$this->codigo 		= $codigo;
		$this->query 		= 'DELETE FROM `FAVORITO` WHERE `LIC_CODIGO`="'.$this->codigo.'" AND `USUARIO_ID`="'.$this->usuario.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if(mysqli_affected_rows($connection)>0)
			$this->results = true;
		else
			$this->results = false;

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function showFavorito($usuario){
		$this->cont 		= 0;
		$this->usuario 		= $usuario;
		$this->query 		= 'SELECT `LIC_CODIGO` FROM `FAVORITO` WHERE `USUARIO_ID`="'.$this->usuario.'" ORDER BY  `FAVORITO`.`FAVORITO_TIME` DESC';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		while($row=mysqli_fetch_array($this->go)){
			$codigo = $row['LIC_CODIGO'];
			$consulta = 'SELECT `LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO` FROM `LICITACION` WHERE `LIC_CODIGO`="'.$codigo .'"';
			$realizar = mysqli_query($connection,$consulta);
			while($fila = mysqli_fetch_array($realizar)){
				$this->results[] = $fila;
				$this->cont ++;
			}
		}
		if($this->cont==0)
			$this->results = "none";

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}
	function numberFav($user){
		$this->usuario  = $user;
		$this->query 	= 'SELECT COUNT(`LIC_CODIGO`) FROM `FAVORITO` WHERE `USUARIO_ID`="'.$this->usuario.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go))
			$this->results = $row;
		else
			$this->results = "0";

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}
}
Class Operatorias
{
	var $arreglo;
	var $arBack;
	var $aux;
	var $categoria;
	var $codigo;
	var $codigoEstado;
	var $contador;
	var $date;
	var $estado;
	var $fechaCierre;
	var $go;
	var $query;
	var $moodle;
	var $noodle;
	var $nombre;
	var $number;
	var $palabras;
	var $result;
	var $resultado;
	var $resu;
	var $ticket;
	var $usuario;

	function curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	function getDatos($words){
		$this->palabras 	= $words;
		if($this->palabras!=""){
			$this->arreglo 		= explode(",", $this->palabras);
			$this->contador		= 0;
			$this->moodle 		= "http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?estado=Publicada&ticket=0C0C340A-7E53-4471-A97D-D7A91BB98FBC";
			$this->result 		= Operatorias::curl($this->moodle);
			$this->result 		= json_decode($this->result, true);
			try {
				foreach($this->result['Listado'] as $key => $values) {
			        $this->codigo          = $values['CodigoExterno'];
			        $this->nombre          = strtolower($values['Nombre']);
			        $this->codigoEstado    = $values['CodigoEstado'];
			        $this->fechaCierre     = $values['FechaCierre'];
					for($f=0;$f<count($this->arreglo);$f++){
						if(strpos($this->nombre, strtolower($this->arreglo[$f])) !== false) {
					        $this->arBack[] = $values;
							$this->contador++;
						}
					}
			    }
		    } catch (Exception $e) {
		    	return "none";
		    }
		    if($this->contador!=0){
		        return $this->arBack;
		    }else{
		       	return "none";
		    }
		}else{
			return "none";
		}

	}
	function getDatosDate(){
		date_default_timezone_set("America/Santiago");
		$this->contador		= 0;
		$this->moodle 		= "http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?fecha=".date('dmY')."&ticket=C4F649B1-8DED-4429-A9D3-30AFB63D7AF5";
		$this->result 		= Operatorias::curl($this->moodle);
		$this->result 		= json_decode($this->result, true);
		if($this->result['Listado'] && $this->result['Listado']!==''){
			for($h=0; $h<count($this->result['Listado']);$h++){
				$codigo = $this->result['Listado'][$h]['CodigoExterno'];
				$nombre = base64_encode($this->result['Listado'][$h]['Nombre']);
				$estado = $this->result['Listado'][$h]['CodigoEstado'];
				$fecha  = $this->result['Listado'][$h]['FechaCierre'];
				$this->query = 'INSERT INTO `LICITACION`(`LIC_CODIGO`, `LIC_NOMBRE`, `LIC_ESTADO`, `LIC_FECHA`) VALUES ("'.$codigo.'","'.$nombre.'","'.$estado.'","'.$fecha.'")';
				require "connection/sqli.php";
				$this->go 		= mysqli_query($connection,$this->query);
				if($this->go)
					echo '|';
				else{
					$consulta = 'UPDATE `LICITACION` SET `LIC_ESTADO`="'.$estado.'" WHERE `LIC_CODIGO`="'.$codigo.'"';
					$realizar = mysqli_query($connection,$consulta);
					if(mysqli_affected_rows($connection)>0)
						echo '|';
					else
						echo '| Estado:'.$estado.' & Codigo'.$codigo;
				}
			}
			if (gettype($this->go)==="object") mysqli_free_result($this->go);
				mysqli_close($connection);
		}
	}
	function getDatosDateALL(){
		date_default_timezone_set("America/Santiago");
		$this->contador		= 0;
		$fechaFinal = "";
		for($mes=1;$mes<=12;$mes++){
			for($dia=1;$dia<=31;$dia++){
				if ($dia <= 9){
                   	if ($mes <= 9){
	                    $fechaFinal = "0".$dia."0".$mes."2016";
                    }else{
	                    $fechaFinal = '0'.$dia."".$mes."2016";
                    }
               	}else{
                    if ($mes <= 9){
	                    $fechaFinal = "".$dia."0".$mes."2016";
                   	}else{
	                    $fechaFinal = "".$dia."".$mes."2016";
                    }
                }
				if(checkdate($mes,$dia,2016)){
					$this->moodle 		= "http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?fecha=".$fechaFinal."&ticket=4BC77BEC-AEDB-4DBB-B3C2-07478CF39195";
					$this->result 		= Operatorias::curl($this->moodle);
					$this->result 		= json_decode($this->result, true);
					for($h=0; $h<count($this->result['Listado']);$h++){
						$codigo = $this->result['Listado'][$h]['CodigoExterno'];
						$nombre = base64_encode($this->result['Listado'][$h]['Nombre']);
						$estado = $this->result['Listado'][$h]['CodigoEstado'];
						$fecha  = $this->result['Listado'][$h]['FechaCierre'];
						$this->query = 'INSERT INTO `LICITACION`(`LIC_CODIGO`, `LIC_NOMBRE`, `LIC_ESTADO`, `LIC_FECHA`) VALUES ("'.$codigo.'","'.$nombre.'","'.$estado.'","'.$fecha.'")';
						require "connection/sqli.php";
						$this->go 		= mysqli_query($connection,$this->query);
						if($this->go)
							echo '|';
						else{
							$consulta = 'UPDATE `LICITACION` SET `LIC_ESTADO`="'.$estado.'" WHERE `LIC_CODIGO`="'.$codigo.'"';
							$realizar = mysqli_query($connection,$consulta);
							if(mysqli_affected_rows($connection)>0)
								echo '|';
							else
								echo '| Estado:'.$estado.' & Codigo'.$codigo;
						}
					}

				}
			}
		}
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
	}

	function checkCode($code,$user){
		$this->codigo 	= $code;
		$this->usuario  = $user;
		$this->query 	= 'SELECT * FROM `FAVORITO` WHERE `LIC_CODIGO`="'.$this->codigo.'" AND `USUARIO_ID`="'.$this->usuario.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go))
			$this->results = $row;
		else
			$this->results = "none";

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}
}
Class Licitacion
{
	var $arreglo;
	var $buscar;
	var $codigo;
	var $contador;
	var $contadorDos;
	var $contadorTres;
	var $nombre;
	var $fecha;
	var $estado;
	var $query;
	var $go;
	var $aux;
	var $xua;
	var $result;
	var $total;
	var $variable;

	public static function nuevaLicitacion($codigo,$nombre,$estado,$fecha){
		$nombre 	= base64_encode($nombre);
		$query 		= 'INSERT INTO `LICITACION`(`LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO`) VALUES ("'.$codigo.'","'.$nombre.'","'.$fecha.'","'.$estado.'")';
		require "connection/sqli.php";
		$go 		= mysqli_query($connection,$query) or die(mysqli_error($connection));
		if($go)
			$results = true;
		else
			$results = false;

		if (gettype($go)==="object") mysqli_free_result($go);
		mysqli_close($connection);
		return $results;
	}

	function modificarLicitacion($codigo,$nombre,$estado,$fecha){
		$this->codigo 	= $codigo;
		$this->nombre 	= base64_encode($nombre);
		$this->estado 	= $estado;
		$this->fecha 	= $fecha;
		$this->query 	= 'UPDATE `LICITACION` SET ,`LIC_NOMBRE`="'.$this->nombre.'",`LIC_FECHA`="'.$this->fecha.'",`LIC_ESTADO`="'.$this->estado.'" WHERE `LIC_CODIGO`="'.$this->codigo.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if(mysqli_affected_rows($connection)>0)
			$this->results = true;
		else
			$this->results = false;

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function mostrarLicitacion($codigo){
		$this->codigo 	= $codigo;
		$this->contador = 0;
		$this->query 	= 'SELECT * FROM `LICITACION` WHERE  `LIC_CODIGO`="'.$this->codigo.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		while($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
			$this->contador++;
		}
		if($this->contador==0)
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	public static function comprobarCodigo($codigo){
		$codigo 	= $codigo;
		$contador = 0;
		$query 	= 'SELECT LIC_CODIGO FROM `LICITACION` WHERE  `LIC_CODIGO`="'.$codigo.'"';
		require "connection/sqli.php";
		$go 		= mysqli_query($connection,$query) or die(mysqli_error($connection));
		while($row = mysqli_fetch_array($go)){
			$results = $row;
			$contador++;
		}
		if($contador==0)
			$results = 'none';
		else
			$results = 'found';

		if (gettype($go)==="object") mysqli_free_result($go);
		mysqli_close($connection);
		return $results;
	}

	function showDetail($nombre){
		$this->nombre  = explode(',', $nombre);
		$this->contador = 0;
		$this->query  = 'SELECT `LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO` FROM `LICITACION` WHERE `LIC_ESTADO`="8"';
		require "connection/sqli.php";
		$this->go 	= mysqli_query($connection,$this->query) or die(mysqli_error($connection));
		while($row  = mysqli_fetch_array($this->go)){
			$this->aux = explode(',', (base64_decode($row['LIC_NOMBRE'])));
			for($x=0;$x<count($this->nombre);$x++){
				for($y=0;$y<count($this->aux);$y++){
					if(strpos(strtolower($this->aux[$y]), strtolower($this->nombre[$x])) !== false) {
						$this->results[] = $row;
						$this->contador++;
					}
				}
			}
		}
		if($this->contador==0)
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function showLicitaciones(){
		$this->nombre  = explode(',', $nombre);
		$this->contador = 0;
		$this->query  = 'SELECT `LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO` FROM `LICITACION` WHERE `LIC_ESTADO`="5" ORDER BY `LICITACION`.`LIC_FECHA` DESC';
		require "connection/sqli.php";
		$this->go 	= mysqli_query($connection,$this->query) or die(mysqli_error($connection));
		while($row  = mysqli_fetch_array($this->go)){
			$this->aux = explode(',', (base64_decode($row['LIC_NOMBRE'])));
			for($x=0;$x<count($this->nombre);$x++){
				for($y=0;$y<count($this->aux);$y++){
					if(strpos(strtolower($this->aux[$y]), strtolower($this->nombre[$x])) !== false) {
						$this->results[] = $row;
						$this->contador++;
					}
				}
			}
		}
		if($this->contador==0)
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function takingOff($oracion){
		$this->nombre 		= $oracion;
		$this->nombre 		= str_replace(',', '', $this->nombre );
		$this->nombre 		= preg_replace('/\bel\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\bla\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\blas\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\blos\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\buna\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\bun\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\bunas\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\bunos\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\bde\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\by\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\ba\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\ben\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\bpara\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\bpor\b/', '', $this->nombre);
		$this->nombre 		= preg_replace('/\bso\b/', '', $this->nombre);
		$this->nombre 		= str_replace('  ', ' ', $this->nombre );
		return $this->nombre;
	}

	function stripAccents($string){
		$this->nombre  = str_replace('á', 'a', $string);
		$this->nombre  = str_replace('Á', 'A', $this->nombre );
		$this->nombre  = str_replace('é', 'e', $this->nombre );
		$this->nombre  = str_replace('É', 'E', $this->nombre );
		$this->nombre  = str_replace('í', 'i', $this->nombre );
		$this->nombre  = str_replace('Í', 'I', $this->nombre );
		$this->nombre  = str_replace('ó', 'o', $this->nombre );
		$this->nombre  = str_replace('Ó', 'O', $this->nombre );
		$this->nombre  = str_replace('ú', 'u', $this->nombre );
		$this->nombre  = str_replace('Ú', 'U', $this->nombre );
		return $this->nombre;
	}

	function matchImprove($nombre){
		$nombre 					= $nombre;
		$this->nombre 		= Licitacion::stripAccents($nombre);
		$this->nombre 		= strtolower($this->nombre);
		$this->nombre 		= Licitacion::takingOff($this->nombre);
		$this->nombre  		= str_replace(" ", "|", $this->nombre);
		$this->contadorDos 	= str_word_count($this->nombre);
		$this->contador 	= 0;
		$this->total 		= 0;
		$this->query  = 'SELECT `LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO` FROM `LICITACION` WHERE `LIC_ESTADO`="8"';
		require "connection/sqli.php";
		$this->go 	= mysqli_query($connection,$this->query) or die(mysqli_error($connection));
		while($row  = mysqli_fetch_array($this->go)){
			$this->aux = base64_decode($row['LIC_NOMBRE']);
			$this->xua = $this->aux;
			$this->aux = mb_strtolower($this->aux, 'UTF-8');
			$this->aux = str_replace('?', '', $this->aux);
			$dummy = array();
			$matches = (preg_match_all('#\b('.$this->nombre.')\b#', $this->aux,$dummy));
			if($matches>=$this->contadorDos || $matches>=($this->contadorDos-($matches/2))) {
				$this->results[] = $row;
				$this->contador++;
			}
		}
		if($this->contador==0)
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function buscarLic($item){
		$this->variable = $item;
		$this->contador = 0;
		$this->query  = 'SELECT `LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO` FROM `LICITACION` ORDER BY `LICITACION`.`LIC_FECHA` DESC';
		require "connection/sqli.php";
		$this->go 	= mysqli_query($connection,$this->query) or die(mysqli_error($connection));
		while($row  = mysqli_fetch_array($this->go)){
			$this->aux 		= explode(',', (base64_decode($row['LIC_NOMBRE'])));
			$this->codigo 	= $row['LIC_CODIGO'];
			for($y=0;$y<count($this->aux);$y++){
				if(strpos(strtolower($this->aux[$y]), strtolower($this->variable)) !== false) {
					$this->results[] = $row;
					$this->contador++;
				}
			}
			if ($this->contador==0) {
				# code...
				if(strpos(strtolower($this->codigo), strtolower($this->variable)) !== false) {
					$this->results[] = $row;
					$this->contador++;
				}
			}
		}
		if($this->contador==0)
			$this->results = 'none';
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function buscarLicEstado($estado,$buscar){
		$this->contador =0;
		$this->estado = $estado;
		$this->buscar = $buscar;
		$this->query 	= 'SELECT `LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO` FROM `LICITACION` WHERE `LIC_ESTADO`="'.$this->estado.'" ORDER BY  `LICITACION`.`LIC_FECHA` DESC';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		while($row 		= mysqli_fetch_array($this->go)){
			if(strpos(strtolower(base64_decode($row["LIC_NOMBRE"])),strtolower($this->buscar)) !== false || strpos($row["LIC_CODIGO"],$this->buscar) !== false){
				$this->results[] = $row["LIC_CODIGO"];
				$this->results[] = base64_decode($row["LIC_NOMBRE"]);
				$this->results[] = $row["LIC_FECHA"];
				$this->results[] = $row["LIC_ESTADO"];
				$this->contador++;
			}
		}
		if($this->contador==0)
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function buscarLicTodo($buscar){
		$this->contador =0;
		$this->buscar = $buscar;
		$this->query 	= 'SELECT `LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO` FROM `LICITACION` ORDER BY  `LICITACION`.`LIC_FECHA` DESC LIMIT 0 , 100000';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		while($row 		= mysqli_fetch_array($this->go)){
			if(strpos(strtolower(base64_decode($row["LIC_NOMBRE"])),strtolower($this->buscar)) !== false || strpos($row["LIC_CODIGO"],$this->buscar) !== false){
				$this->results[] = $row["LIC_CODIGO"];
				$this->results[] = base64_decode($row["LIC_NOMBRE"]);
				$this->results[] = $row["LIC_FECHA"];
				$this->results[] = $row["LIC_ESTADO"];
				$this->contador++;
			}
		}
		if($this->contador==0)
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function listarLicEstado($estado){
		$this->contador =0;
		$this->estado = $estado;
		$this->query 	= 'SELECT `LIC_CODIGO`, `LIC_NOMBRE`, `LIC_FECHA`, `LIC_ESTADO` FROM `LICITACION` WHERE `LIC_ESTADO`="'.$this->estado.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		while($row = mysqli_fetch_array($this->go)){
			$this->results[] = $row["LIC_CODIGO"];
			$this->results[] = base64_decode($row["LIC_NOMBRE"]);
			$this->results[] = $row["LIC_FECHA"];
			$this->results[] = $row["LIC_ESTADO"];
			$this->contador++;
		}
		if($this->contador==0)
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}
}
Class ValorUF
{
	private $valor;
	private $query;
	private $go;
	private $results;
	private $count;

	function valorUfActual($val){
		$this->valor = $val;
		$this->query = 'UPDATE `VALORUF` SET `valorUf`= "'.$this->valor.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if(mysqli_affected_rows($connection)>0)
			$this->results = true;
		else
			$this->results = false;

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function obtenerValorUf(){
		$this->query = 'SELECT `valorUf` FROM `VALORUF`';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go))
			$this->results = $row;
		else
			$this->results = 'none';

		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}
}

Class Servicio
{
	private $id;
	private $usuarioId;
	private $fechaInicio;
	private $fechaFin;
	private $tipo;
	private $estado;
	private $codigo;
	private $monto;
	private $meses;
	private $query;
	private $go;
	private $results;

	function nuevoServicio($uid, $tip, $mon){
		$this->usuarioId 	= $uid;
		$this->tipo 			= $tip;
		$this->monto 			= $mon;
		$this->query		 	= 'INSERT INTO `SERVICIO`(`USUARIO_ID`,`FINI_SERVICIO`, `FFIN_SERVICIO`, `TIPO_SERVICIO`, `MONTO_SERVICIO`) VALUES ("'.$this->usuarioId.'", NOW(), NOW(), "'.$this->tipo.'", "'.$this->monto.'")';
		require "connection/sqli.php";
		$this->go 				= mysqli_query($connection, $this->query);
		if($this->go)
			$this->results = mysqli_insert_id($connection);
		else
			$this->results = false;
		return $this->results;
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
	}

	function nuevoServicioPromo($uid, $fini, $ffin){
		$this->usuarioId 	= $uid;
		$this->fechaInicio= $fini;
		$this->fechaFin 	= $ffin;
		$this->tipo 			= "7";
		$this->estado 		= "1";
		$this->codigo 		= "Promo";
		$this->monto 			= "0";
		$this->query		 	= 'INSERT INTO `SERVICIO`(`USUARIO_ID`, `FINI_SERVICIO`, `FFIN_SERVICIO`, `TIPO_SERVICIO`, `ESTADO_SERVICIO`, `CODIGO_SERVICIO`, `MONTO_SERVICIO`) VALUES ("'.$this->usuarioId.'","'.$this->fechaInicio.'","'.$this->fechaFin.'","'.$this->tipo.'","'.$this->estado.'","'.$this->codigo.'","'.$this->monto.'")';
		require "connection/sqli.php";
		$this->go 				= mysqli_query($connection, $this->query);
		if($this->go)
			$this->results = mysqli_insert_id($connection);
		else
			$this->results = false;
		return $this->results;
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
	}

	function leerServicio($uid){
		$this->usuarioId 	= $uid;
		$this->query 			= 'SELECT `ID_SERVICIO`, `USUARIO_ID`, `FINI_SERVICIO`, `FFIN_SERVICIO`, `TIPO_SERVICIO` FROM `SERVICIO` WHERE `USUARIO_ID`="'.$this->usuarioId.'"';
		require "connection/sqli.php";
		$this->go = mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = true;
		}else{
			$this->results = false;
		}
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function checkServicio($uid){
		$this->usuarioId 	= $uid;
		$this->query 			= 'SELECT `ID_SERVICIO`, `USUARIO_ID`, `FFIN_SERVICIO`, `FFIN_SERVICIO`, `MONTO_SERVICIO`, `TIPO_SERVICIO`, `ESTADO_SERVICIO` FROM `SERVICIO` WHERE `USUARIO_ID`="'.$this->usuarioId.'" ORDER BY `ID_SERVICIO` DESC LIMIT 1';
		require "connection/sqli.php";
		$this->go = mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
		}else{
			$this->results = false;
		}
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function checkServicioFecha($uid){
		$this->usuarioId 	= $uid;
		$this->query 			= 'SELECT `ID_SERVICIO`, `USUARIO_ID`, `FFIN_SERVICIO`, `FFIN_SERVICIO`, `MONTO_SERVICIO`, `TIPO_SERVICIO`, `ESTADO_SERVICIO` FROM `SERVICIO` WHERE `USUARIO_ID`="'.$this->usuarioId.'" AND `FFIN_SERVICIO`>CURDATE() ORDER BY `ID_SERVICIO` DESC LIMIT 1';
		require "connection/sqli.php";
		$this->go = mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
		}else{
			$this->results = false;
		}
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function leerServicioPorId($id){
		$this->id 				= $id;
		$this->query 			= 'SELECT `ID_SERVICIO`, `USUARIO_ID`, `FINI_SERVICIO`, `FFIN_SERVICIO`, `TIPO_SERVICIO`, `MONTO_SERVICIO` FROM `SERVICIO` WHERE `ID_SERVICIO`="'.$this->id.'"';
		require "connection/sqli.php";
		$this->go = mysqli_query($connection,$this->query);
		if($row = mysqli_fetch_array($this->go)){
			$this->results = $row;
		}else{
			$this->results = 'none';
		}
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}

	function activarUsuario($id,$cod,$num){
		date_default_timezone_set("America/Santiago");
		$this->id 				= $id;
		$this->codigo 		= $cod;
		$this->meses 			= $num;
		$this->query 			= 'UPDATE `SERVICIO` SET `FINI_SERVICIO`=NOW(),`FFIN_SERVICIO`= NOW() + INTERVAL '.$this->meses.' MONTH,`ESTADO_SERVICIO`="1",`CODIGO_SERVICIO`="'.$this->codigo.'" WHERE `ID_SERVICIO`="'.$this->id.'"';
		require "connection/sqli.php";
		$this->go 		= mysqli_query($connection,$this->query);
		if(mysqli_affected_rows($connection)>0)
			$this->results = true;
		else
			$this->results = false;
		if (gettype($this->go)==="object") mysqli_free_result($this->go);
		mysqli_close($connection);
		return $this->results;
	}
}
?>
