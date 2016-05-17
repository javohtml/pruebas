<?php
if(isset($_POST["enviar"])){
  $para      = 'contacto@axeon.cl';
  $titulo    = 'Mensaje de Cliente';
  $mensaje   = "Nombre Cliente: ".$_POST["nombre"]. "\r\n\r\nEmail Cliente: " .$_POST["email"]. "\r\n\r\nMensaje Cliente: " .$_POST["mensaje"];
  $cabeceras = 'From: contacto@axeon.cl' . "\r\n" .
    'Reply-To: contacto@axeon.cl' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  $enviar = mail($para, $titulo, $mensaje, $cabeceras);
  echo json_encode(array('Status'=>$enviar));
}else {
  echo json_encode(array('Status'=>false));
}
?>
