<?php
date_default_timezone_set("America/Santiago");
$objServicio = new Servicio;
$getServicio = $objServicio->checkServicio(base64_decode($_SESSION['italia']));
$now = time(); // or your date as well
$your_date = strtotime($getServicio["FFIN_SERVICIO"]);
$datediff = $now - $your_date;
$dates = abs(floor($datediff/(60*60*24)));
?>
