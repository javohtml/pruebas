<?php
if (isset($_POST["hdnOperation"])) {
  switch ($_POST["hdnOperation"]) {
    case 'hdnBusquedaAvanzada':
      $resultado = "";
      $estado = $_POST["estado"];
      $buscar = $_POST["buscar"];
      require("engine.php");
      $objLic   = new Licitacion;
      if($estado==0){
        $getData  = $objLic->buscarLicTodo($buscar);
      }else {
        $getData  = $objLic->buscarLicEstado($estado,$buscar);
      }
      if($getData!="none"){
        $resultado = json_encode(array('Mensaje'=>'success','Resultado'=>$getData));
      }else{
        $resultado = json_encode(array('Codigo'=>202,'Mensaje'=>'No existen dichos datos! '));
      }
      echo $resultado;
      break;
    case 'hdnAddFav':
      $resultado = "";
      $idUsuario = $_POST["id"];
      $licCode   = $_POST["licCode"];
      require("engine.php");
      $objFav    = new Favorito;
      $check     = $objFav->checkFav($idUsuario,$licCode);
      if($check==false){
        $setFav = $objFav->addFavorito($idUsuario,$licCode);
        if($setFav!=false){
          $resultado = json_encode(array('Codigo'=>777,'Mensaje'=>'success','Resultado'=>$setFav));
        }else{
          $resultado = json_encode(array('Codigo'=>202,'Mensaje'=>'Error en la operacion'));
        }
      }else{
        $resultado = json_encode(array('Codigo'=>202,'Mensaje'=>'Esta licitacion ya se encuentra en sus favoritos: '.$licCode.''));
      }

      echo $resultado;
      break;
    default:
      header("Location: index.php");
      break;
  }
}
?>
