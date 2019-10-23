<?php
require("phpMQTT.php");

//config.php, you can all these on the details page for your instance
$server   = "m11.cloudmqtt.com"; 
$port     = 26214;
$username = "aambo55";
$password = "rukyonaja13";

$message = "LEDON";
//MQTT client id to use for the device. "" will generate a client id automatically
$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());

if ($mqtt->connect(true,NULL,$username,$password)) {
  $mqtt->publish("/message",$message, 0);
  $mqtt->close();
}else{
  echo "Fail or time out
";
}
?>



