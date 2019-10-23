<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>MQTT WebSocket</title>
<script src="jquery-1.11.3.min.js"></script>
<script src="mqttws31.js"></script>
<style>
body {
	font-family: Arial, Helvetica, sans-serif;
}

#status {
	background: #333;
	color: #FFF;
	border-radius: 3px;
	font-weight: bold;
	padding: 3px 6px;
}

#status.connect {
	background: #E18C1A;
	color: #FFF;
}

#status.connected {
	background: #00AE04;
	color: #FFF;
}

#status.error {
	background: #F00;
	color: #FFF;
}

button {
	font-size: 32px;
}
</style>
<script>
var config = {
	mqtt_server: "m11.cloudmqtt.com",
	mqtt_websockets_port: 36214,
	mqtt_user: "aambo55",
	mqtt_password: "rukyonaja13"
};

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
			mqttSend("/message", "GET");
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
	
	client.onMessageArrived = function(message) {
		// $("#status").text("onMessageArrived:" + message.payloadString).removeClass().addClass("error");
		console.log(message.payloadString);
		if (message.payloadString == "LEDON" || message.payloadString == "LEDOFF") {
			
			$("#led-on").attr("disabled", (message.payloadString == "LEDON" ? true : false));
			$("#led-off").attr("disabled", (message.payloadString == "LEDOFF" ? true : false)); 
			var $p = message.payloadString;

		}
	}

	$("#led-on").click(function(e) {
        mqttSend("/message", "LEDON");
    });
	
	$("#led-off").click(function(e) {
        mqttSend("/message", "LEDOFF");
    });
});

var mqttSend = function(topic, msg) {
	var message = new Paho.MQTT.Message(msg);
	message.destinationName = topic;
	client.send(message); 
}
</script>
</head>

<body>
<?php echo "<br>".$p."<br>"; ?>
<script> document.write(p); </script>

<h3>LED Control : <span id="status" class="connect">Connect...</span></h3>
<!-- <hr /> -->
<button id="led-on" disabled>ON</button>&nbsp;&nbsp;&nbsp;<button id="led-off" disabled>OFF</button>

</body>
</html>



