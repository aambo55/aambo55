<?php
require("../phpMQTT.php");
$server = "m11.cloudmqtt.com";     // change if necessary
$port = 16214;                     // change if necessary
$username = "aambo55";                   // set your username
$password = "rukyonaja13";                   // set your password
$client_id = "ClientID".rand(); // make sure this is unique for connecting to sever - you could use uniqid()
$mqtt = new phpMQTT($server, $port, $client_id);
if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish("/message", "LEDON", 0);
	$mqtt->close();
} else {
    echo "Time out!\n";
}