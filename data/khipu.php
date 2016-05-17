<?php
if(isset($_POST["transaction_id"])){
  $cont    = 0;
  $notoken = '';
  foreach ($_POST as $key => $value) {
    if($cont==1){
      $notoken = $value;
    }
    $cont++;
  }
  $id       = $_POST["transaction_id"];
  require("engine.php");
  $objServicio = new Servicio;
  $getServicio = $objServicio->leerServicioPorId($id);
  $tipo        = $getServicio["TIPO_SERVICIO"];
  $num         = 0;
  switch ($tipo) {
    case '0':
      $num     = 3;
      break;
    case '1':
      $num     = 6;
      break;
    case '2':
      $num     = 12;
      break;
    default:
      # code...
      break;
  }
  $setServicio = $objServicio->activarUsuario($id,$notoken,$num);
}else{
  echo json_encode(array('Codigo'=>404,'Mensaje'=>'Esta pagina no existe', 'Comentario'=>'Registrando IP Cliente'));
}
?>
