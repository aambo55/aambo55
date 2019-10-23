<script src="jquery-1.11.3.min.js"></script>
<script src="mqttws31.js"></script>
<script>
var config = {
	mqtt_server: "m11.cloudmqtt.com",
	mqtt_websockets_port: 36214,
	mqtt_user: "aambo55",
	mqtt_password: "rukyonaja13"
};

</script>
<script type="text/javascript">
  var xx = <?php echo "LEDOFF" ?>;
</script>
<script>
  $(document).ready(function(e) {
	// Create a client instance
	client = new Paho.MQTT.Client(config.mqtt_server, config.mqtt_websockets_port, "web_" + parseInt(Math.random() * 100, 10)); 
	//Example client = new Paho.MQTT.Client("m11.cloudmqtt.com", 32903, "web_" + parseInt(Math.random() * 100, 10));
	
	// connect the client
	client.connect({
		useSSL: true,
		userName: config.mqtt_user,
		password: config.mqtt_password,
		onSuccess: function() {
			// Once a connection has been made, make a subscription and send a message.
			// console.log("onConnect");
			$("#status").text("Connected").removeClass().addClass("connected");
			client.subscribe("/message");
			if(xx=="LEDOFF"){
			mqttSend("/message", "LEDOFF");
			}
		//	mqttSend("/message", "GET");
		},
		onFailure: function(e) {
			$("#status").text("Error : " + e).removeClass().addClass("error");
			// console.log(e);
		}
	});
	
	client.onConnectionLost = function(responseObject) {
		if (responseObject.errorCode !== 0) {
			$("#status").text("onConnectionLost:" + responseObject.errorMessage).removeClass().addClass("connect");
			setTimeout(function() { client.connect() }, 1000);
		}
	}
    

});

var mqttSend = function(topic, msg) {
	var message = new Paho.MQTT.Message(msg);
	message.destinationName = topic;
	client.send(message); 
}
             
</script>
