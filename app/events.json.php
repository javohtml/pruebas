<?php
session_start();
$nombre = base64_decode($_SESSION['norman']);
$id     = base64_decode($_SESSION['italia']);
$empresa= base64_decode($_SESSION['empera']);
include('../data/engine.php');
$operation  = new Favorito;
$row        = $operation->showFavorito($id);
$cont       = 0;
$match      = 0;
$res        = json_encode(array('success'=>0,'result'=>'None'));
$result     = '';
if($row!='none'){
  $estado = "";
  $contando = 0;
  for($o=0; $o<count($row); $o++){
    switch ($row[$o][3]) {
       case "5":
          $estado = "event-success";
          break;
        case "6":
          $estado = "event-important";
          break;
        case "7":
          $estado = "event-inverse";
          break;
        case "8":
          $estado = "event-warning";
          break;
        case "18":
          $estado = "event-warning";
          break;
        case "19":
          $estado = "event-warning";
          break;

      default:
        $estado = "Cerrada";
        break;
    }
    $result[] = array('id' => $row[$o][0], 'title' => base64_decode($row[$o][1]), 'url' => 'buscar.php?fttp='.$row[$o][0], 'class' => $estado, 'start' => (string)strtotime($row[$o][2]).'000', 'end' => (string)strtotime($row[$o][2]).'000');
    $contando++;
  }
  if($contando!=0)
    $res = json_encode(array('success'=>1,'result'=>$result));
  echo $res;
}
?>
