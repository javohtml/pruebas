<?php
  $res = '';
  $página_inicio  = file_get_contents('http://www.ufhoy.cl/');
  $buscando       = explode('<a>', $página_inicio);
  $buscan2        = explode('</a>', $buscando[1]);
  $buscan3        = explode(',', $buscan2[0]);
  $buscan4        = explode('$', $buscan3[0]);
  $valorUf        = str_replace('.','',$buscan4[1]);
  require('../data/engine.php');
  $objUf  = new ValorUF;
  $setUf  = $objUf->valorUfActual($valorUf);
  if($setUf==true){
    $getUf = $objUf->obtenerValorUf();
    $res = json_encode(array('Codigo'=>403,'Mensaje'=>'success', 'Comentario'=>$setUf, 'ValorUF'=>$getUf));
  }else{
    $res = json_encode(array('Codigo'=>204,'Mensaje'=>'Something went wrong.', 'Comentario'=>$setUf));
  }
  echo $res;
?>
