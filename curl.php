<?php
include_once("pass.php");
$proxy = PasswordSingleton::getInstance()->getProxy();
$id = htmlspecialchars($_GET["id"]);
$token = htmlspecialchars($_GET["token"]);
$ch = curl_init();
$headers = array(
	"Authorization: Bearer " . $token
);
curl_setopt($ch, CURLOPT_URL, "https://api.box.com/2.0/files/" . $id . "/content");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
$output = curl_exec($ch);
curl_close($ch);
echo $output;
?>