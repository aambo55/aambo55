<?php
require("phpMQTT.php");
 
$mqtt = new phpMQTT("m11.cloudmqtt.com", 36214, "phpMQTT Pub Example"); //����¹ www.yourmqttserver.com 价�� mqtt server ��������Ѥ����Ф�Ѻ
 

if ($mqtt->connect(true, NULL,"aambo55","rukyonaja13")) {
$mqtt->publish("/message","LEDON"); // ������ҧ������Դ���շ�������ѧ mqtt server
$mqtt->close();
}
else{
    echo "Fail or time out<br />";
}
?>



