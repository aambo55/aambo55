<?php
require("phpMQTT.php");
 
$mqtt = new phpMQTT("m11.cloudmqtt.com", 36214, "phpMQTT Pub Example"); //เปลี่ยน www.yourmqttserver.com ไปที่ mqtt server ที่เราสมัครไว้นะครับ
 

if ($mqtt->connect(true, NULL,"aambo55","rukyonaja13")) {
$mqtt->publish("/message","LEDON"); // ตัวอย่างคำสั่งเปิดทีวีที่จะส่งไปยัง mqtt server
$mqtt->close();
}
else{
    echo "Fail or time out<br />";
}
?>



