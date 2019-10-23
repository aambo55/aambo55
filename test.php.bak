<?php
require 'phpMQTT.php';

$url = parse_url(getenv('m11.cloudmqtt.com'));
$topic = substr($url['/message'], 1);
$client_id = "phpMQTT-publisher";

$message = "LEDON";

$mqtt = new Bluerhinos\phpMQTT($url['m11.cloudmqtt.com'], $url['26214'], $client_id);
if ($mqtt->connect(true, NULL, $url['karaket'], $url['rukyonaja13'])) {
    $mqtt->publish($topic, $message, 0);
    echo "Published message: " . $message;
    $mqtt->close();
}else{
    echo "Fail or time out<br />";
}
?>



