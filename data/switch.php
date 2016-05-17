<?php
if(isset($_POST["hdnOperation"]) || isset($_GET["getOperation"])){
	if(isset($_GET["getOperation"]))
		$i = $_GET["getOperation"];
	else
		$i = $_POST["hdnOperation"];
	switch ($i) {

		case 'hdnLog':
			$res			= "";
			$correo 	= $_POST['email'];
			$pass 		= $_POST['pass'];
			include_once('engine.php');
			$operation 	= new Usuario;
			$getIdUsuario = $operation->usuarioPorCorreo($correo);
			if($getIdUsuario!=false){
				$objServicio = new Servicio;
				$getServicio = $objServicio->checkServicio($getIdUsuario["USUARIO_ID"]);
				if($getServicio!=false) {
					if($getServicio["ESTADO_SERVICIO"]==1 && $getServicio["FFIN_SERVICIO"] > date("Y-m-d")){
						$action 	= $operation->LogIn($correo,$pass);
					  if($action!=false){
							session_start();
							$_SESSION['italia'] = base64_encode($action['USUARIO_ID']);
							$_SESSION['norman'] = base64_encode($action['USUARIO_NOMBRE']);
							$_SESSION['apedir'] = base64_encode($action['USUARIO_APELLIDO']);
							$_SESSION['empera'] = base64_encode($action['USUARIO_EMPRESA']);
							$res = json_encode(array('Codigo'=>104,'Mensaje'=>'success', 'Comentario'=>'Ingreso Exitoso', 'Data'=>$action['USUARIO_ID']));
						}else{
							$res = json_encode(array('Codigo'=>104,'Mensaje'=>'Error', 'Comentario'=>"Nombre de Usuario o Cotraseña", 'Data'=>$action));
						}
					}else{
						$getUsuario = $operation->usuarioLog($getIdUsuario["USUARIO_ID"]);
						$tipoPlan = '';
						switch ($getServicio["TIPO_SERVICIO"]) {
							case '0':
								$tipoPlan = 'Trimestral';
								break;
							case '1':
								$tipoPlan = 'Semestral';
								break;
							case '2':
								$tipoPlan = 'Anual';
								break;
							default:
								# code...
								break;
						}
						$res = json_encode(array('Codigo'=>104,'Mensaje'=>'pending','Comentario'=>"Proceso a Pago", 'Data'=>$getServicio, 'Tipo'=>$tipoPlan, 'Cliente'=>$getUsuario));
					}
				}else{
					$delUsuario = $operation->delUsuario($getIdUsuario["USUARIO_ID"]);
					if($delUsuario==true){
						$res = json_encode(array('Codigo'=>104,'Mensaje'=>'deletiado', 'Comentario'=>"sin comentarios"));
					}
				}
			}else{
				$res = json_encode(array('Codigo'=>104,'Mensaje'=>'Error', 'Comentario'=>"Nombre de Usuario o Cotraseña", 'Data'=>$getIdUsuario));
			}
			echo $res;
			break;

		case 'regist7':
			$res 				= '';
			$nombre 		= $_POST["nombre"];
			$apellido 	= $_POST["apellido"];
			$empresa 		= $_POST["empresa"];
			$sector 		= $_POST["sector"];
			$cargo 			= $_POST["cargo"];
			$rut 				= $_POST["rut"];
			$email 			= $_POST["email"];
			$password 	= $_POST["password"];
			require("engine.php");
			$objUsuario = new Usuario;
			$checkUsuario = $objUsuario->usuarioPorCorreo($email);
			if($checkUsuario==false){
				$setUsuario = $objUsuario->nuevoUsuario($nombre,$apellido,$empresa,$sector,$cargo,$rut,$password,$email);
				if($setUsuario!=false){
					$objServicio 		= new Servicio;
					$transaction_id = '0';
					$fini = date("Y-m-d");
					$ffin = date("Y-m-d",strtotime( date("Y-m-d") . "+7 days"));
					$newServicio 		= $objServicio->nuevoServicioPromo($setUsuario, $fini, $ffin);
					if($newServicio!=false){
							$transaction_id =  $newServicio;
							$res = json_encode(array('Codigo'=>403,'Mensaje'=>'success', 'Comentario'=>$transaction_id));
					}else {
						$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Something went wrong.', 'Comentario'=>$setUsuario.' | '.$tipo.' | '.$amount));
					}
				}else{
					$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Something went wrong.', 'Comentario'=>$setUsuario));
				}
			}else{
				$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Este correo ya se encuentra registrado', 'Comentario'=>$checkUsuario["USUARIO_CORREO"]));
			}
			echo $res;
			break;
		case 'hdnNewPref':
			session_start();
			$id     	= base64_decode($_SESSION['italia']);
			$titulo 	= $_POST['title'];
			$keyword 	= $_POST['keywords'];
			include_once('engine.php');
			$operation 	= new Preferencia;
			$action 	= $operation->newData($id,$titulo,$keyword);
			if($action==true)
				echo "<script type='text/javascript'>window.location = '../app/dashboard.php'</script>";
			else
				echo "<script type='text/javascript'>alert('Error 400');window.history.back();</script>";
			break;
		case 'hdnMODPref':
			$titulo 	= $_POST['title'];
			$keyword 	= $_POST['keywords'];
			$idPre 		= base64_decode($_POST['alacazam']);
			include_once('engine.php');
			$operation 	= new Preferencia;
			$action 	= $operation->modData($idPre,$titulo,$keyword);
			if($action==true)
				echo "<script type='text/javascript'>window.location = '../app/dashboard.php'</script>";
			else
				echo "<script type='text/javascript'>alert('Error 400');window.history.back();</script>";
			break;
		case 'hdnAddFav':
			session_start();
			$id     	= base64_decode($_SESSION['italia']);
			$codigo 	= $_POST['code'];
			include_once('engine.php');
			$operation 	= new Favorito;
			$action 	= $operation->addFavorito($id,$codigo);
			if($action==true)
				echo "<script type='text/javascript'>window.location = '../app/dashboard.php'</script>";
			else
				echo "<script type='text/javascript'>alert('Error 400');window.history.back();</script>";
			break;
		case 'hdnDelFav':
			session_start();
			$id     	= base64_decode($_SESSION['italia']);
			$codigo 	= $_POST['code'];
			include_once('engine.php');
			$operation 	= new Favorito;
			$action 	= $operation->deleteFavorito($id,$codigo);
			if($action==true)
				echo "<script type='text/javascript'>window.location = '../app/favoritos.php'</script>";
			else
				echo "<script type='text/javascript'>alert('Error 400');window.history.back();</script>";

			break;

		case 'regUsuario':
			$res 				= '';
			$nombre 		= $_POST["nombre"];
			$apellido 	= $_POST["apellido"];
			$empresa 		= $_POST["empresa"];
			$sector 		= $_POST["sector"];
			$cargo 			= $_POST["cargo"];
			$rut 				= $_POST["rut"];
			$email 			= $_POST["email"];
			$password 	= $_POST["password"];
			$password 	= $_POST["password"];
			$plan 			= $_POST["tipo"];
			$tipo 			= '';
			$amount		 	= 56920; //Valor
			require("engine.php");
			$objUf  		= new ValorUF;
			$getUf = $objUf->obtenerValorUf();
			switch ($plan) {
				case 'Anual':
					$amount = ($getUf[0])*10;
					$tipo 	= 2;
					break;

				case 'Semestral':
					$amount = ($getUf[0])*6;
					$tipo 	= 1;
					break;
				case 'Trimestral':
					$amount = ($getUf[0])*4;
					$tipo 	= 0;
					break;

				default:
					$amount = 56920;
					break;
			}

			$objUsuario = new Usuario;
			$checkUsuario = $objUsuario->usuarioPorCorreo($email);
			if($checkUsuario==false){
				$setUsuario = $objUsuario->nuevoUsuario($nombre,$apellido,$empresa,$sector,$cargo,$rut,$password,$email);
				if($setUsuario!=false){
					$objServicio 		= new Servicio;
					$transaction_id = '0';
					$newServicio 		= $objServicio->nuevoServicio($setUsuario, $tipo, $amount);
					if($newServicio!=false){
						 	$transaction_id =  $newServicio;
							$res = json_encode(array('Codigo'=>403,'Mensaje'=>'success', 'Comentario'=>$transaction_id));
					}else {
						$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Something went wrong.', 'Comentario'=>$setUsuario.' | '.$tipo.' | '.$amount));
					}
				}else{
					$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Something went wrong.', 'Comentario'=>$setUsuario));
				}
			}else{
				$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Este correo ya se encuentra registrado', 'Comentario'=>$checkUsuario["USUARIO_CORREO"]));
			}
			echo $res;
			break;

		case 'actualizarUsuario':
			$res 				= '';
			$id 		 		= base64_decode($_POST["_id"]);
			$nombre 		= $_POST["nombre"];
			$apellido 	= $_POST["apellido"];
			$empresa 		= $_POST["empresa"];
			$sector 		= $_POST["sector"];
			$cargo 			= $_POST["cargo"];
			$rut 				= $_POST["rut"];
			$email 			= $_POST["email"];
			require("engine.php");
			$objUsuario = new Usuario;
			$checkUsuario = $objUsuario->usuarioPorCorreo($email);
			if($checkUsuario==false || $checkUsuario["USUARIO_CORREO"]==$email){
				$setUsuario = $objUsuario->actualizarUsuario($id,$nombre,$apellido,$empresa,$sector,$cargo,$rut,$email);
				if($setUsuario!=false){
					$res = json_encode(array('Codigo'=>403,'Mensaje'=>'success', 'Comentario'=>$setUsuario));
				}else{
					$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Algo no va bien.', 'Comentario'=>$setUsuario));
				}
			}else{
				$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Este correo ya se encuentra registrado', 'Comentario'=>$checkUsuario["USUARIO_CORREO"]));
			}
			echo $res;
			break;

		case 'boleta':
			$res 						= '';
			$transaction_id = $_POST["_id"];
			$payer_email		= $_POST["email"];
			require("engine.php");
			$objServicio 		= new Servicio;
			$getServicio 		= $objServicio->leerServicioPorId($transaction_id);
			if($getServicio!='none'){
				$plan 					= $getServicio['TIPO_SERVICIO'];
				$amount 				= $getServicio["MONTO_SERVICIO"];
				$receiver_id 		= 57912; //	AXEON 58274;
				$secret 				= '1c3d7eafa69be5e6c86f591200a40e0fd692b255';//AXEON 'eb57f4edb3d11f29512e1bbb4d2047d48bf49b35';
				$subject 				= 'Plan Plataforma Axeon'; //Titulo-Tipo
				$body 					= 'Pago de uso de plataforma en formato: '.$plan.'.'; //Descripcion
				$notify_url 		= "http://axeon.cl/data/khipu.php";
				$return_url 		= "http://axeon.cl/result.html?sort=".$getServicio["USUARIO_ID"];
				$cancel_url 		= "http://axeon.cl";
				$agent 					= 'lib-php-1.1';
				$picture_url		= 'https://s3.amazonaws.com/static.khipu.com/buttons/100x50.png';
				$custom 				= $getServicio["USUARIO_ID"]; // Direccion
				$uid 						= base64_decode($custom);
				$khipu_url 			= 'https://khipu.com/api/1.1/createPaymentPage';
				$concatenated = "receiver_id=$receiver_id&subject=$subject&body=$body&amount=$amount&payer_email=$payer_email&transaction_id=$transaction_id&custom=$custom&notify_url=$notify_url&return_url=$return_url&cancel_url=$cancel_url&picture_url=$picture_url&secret=$secret";
				$hash = sha1($concatenated);
				$res = json_encode(array('Codigo'=>304,'Mensaje'=>'success', 'Comentario'=>array($receiver_id,$subject,$body,$amount,$payer_email,$transaction_id,$custom,$notify_url,$return_url,$cancel_url,$picture_url,$secret), 'Data'=>$hash));
			}else {
				$res = json_encode(array('Codigo'=>204,'Mensaje'=>'Something went wrong.', 'Comentario'=>$getServicio));
			}
			echo $res;
			break;
		default:
			echo "<script type='text/javascript'>alert('Error 300');window.history.back();</script>";
			break;
	}
}else
	echo "<script type='text/javascript'>alert('Error 200');window.history.back();</script>";
?>
