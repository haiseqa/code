var client = "";
var qos = 0;
var topic = {
    broker_version: "$SYS/broker/version",
    broker_uptime: "$SYS/broker/uptime",
    broker_byte_receive: "$SYS/broker/bytes/received",
    broker_byte_send: "$SYS/broker/bytes/sent",
    client_active: "$SYS/broker/clients/active",
    client_connected: "$SYS/broker/clients/connected",
    message_recived: "$SYS/broker/messages/received",
    message_send: "$SYS/broker/messages/sent"
}

$(document).ready(function () {
    conenctBroker();
});

function conenctBroker() {
    client = new Paho.MQTT.Client("mqtt.kos-dwipa.com", 8081, "superAdmin123qwez");
    client.onMessageArrived = messageRecived;
    client.connect({
        useSSL: false,
        onSuccess: onConnect,
        onFailure: onFailure,
        userName: "wayans26",
        password: "Satu2Tiga",
        keepAliveInterval: 60,
        mqttVersion: 3
    });
}

function onFailure(message) {
    alert(message.errorMessage);
}

function messageRecived(message) {
    if (message.destinationName === topic.broker_version) {
        $("#broker_version").html(message.payloadString);
    } else if (message.destinationName === topic.broker_uptime) {
        let uptime = message.payloadString.split(" ")[0];
        let second = ~~(uptime % 60);
        let minuts = ~~((uptime % 3600) / 60);
        let hour = ~~(uptime / 3600);
        let uptimeString = `${hour} jam ${minuts} menit ${second} detik`;
        $("#broker_uptime").html(uptimeString);
    } else if (message.destinationName === topic.broker_byte_receive) {
        $("#broker_byte_receive").html(`${message.payloadString} Bytes`);
    } else if (message.destinationName === topic.broker_byte_send) {
        $("#broker_byte_send").html(`${message.payloadString} Bytes`);
    } else if (message.destinationName === topic.client_active) {
        $("#client_active").html(message.payloadString);
    } else if (message.destinationName === topic.client_connected) {
        $("#client_connected").html(message.payloadString);
    } else if (message.destinationName === topic.message_recived) {
        $("#message_received").html(message.payloadString);
    } else if (message.destinationName === topic.message_send) {
        $("#message_send").html(message.payloadString);
    }
}

function subscribe() {
    client.subscribe(topic.broker_version, {
        qos: qos
    });
    client.subscribe(topic.broker_uptime, {
        qos: qos
    });
    client.subscribe(topic.broker_byte_receive, {
        qos: qos
    });
    client.subscribe(topic.broker_byte_send, {
        qos: qos
    });
    client.subscribe(topic.client_active, {
        qos: qos
    });
    client.subscribe(topic.client_connected, {
        qos: qos
    });
    client.subscribe(topic.message_recived, {
        qos: qos
    });
    client.subscribe(topic.message_send, {
        qos: qos
    });
}

function onConnect() {
    subscribe();
}
