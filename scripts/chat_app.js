var chat_button = document.getElementById("chat__send-button");
var messages_container = document.getElementById("chat__messages");
var message_input = document.getElementById("chat__message-input")
const ws = new WebSocket('ws://127.0.0.1:8080');

function getCookie(name) {
  const value = "; " + document.cookie;
  const parts = value.split("; " + name + "=");
  if (parts.length === 2) {
    return parts.pop().split(";").shift();
  }
}

function sendMessage(message_text) {
    if(message_text != null && message_text != "")
    {
        var curTime = new Date();
        var message = {
            type: "message",
            user: null,
            text: message_text,
            time: curTime.getHours() + ":" + curTime.getMinutes() + ":" + curTime.getSeconds()
        }
        ws.send(JSON.stringify(message));
    }
}

function sendPrivateMessage(message_text, receiver) {
    if(message_text != null && message_text != "" && receiver != null & receiver != "")
    {
        var curTime = new Date();
        var message = {
            type: "private_message",
            user: null,
            receiver: receiver,
            text: message_text,
            time: curTime.getHours() + ":" + curTime.getMinutes() + ":" + curTime.getSeconds(),
            status: null
        }
        ws.send(JSON.stringify(message));
    }
}

chat_button.onclick = function(e) {
    var message_text = message_input.value;
    if(message_text.substring(0, 2) == "/w" && message_text[2] == " ")
    {
        var message_and_receiver = message_text.substring(3);
        var startIndex = 0;
        while(message_and_receiver[startIndex] == " ")
            startIndex++;
        message_and_receiver = message_and_receiver.substring(startIndex);
        var endIndex = message_and_receiver.indexOf(" ");
        var receiver = message_and_receiver.substring(0, endIndex);
        var message = message_and_receiver.substring(endIndex + 1);
        sendPrivateMessage(message, receiver);
    }
    else
    {
        sendMessage(message_text);
    }
}

ws.onmessage = function(response) {
    var message = JSON.parse(response.data);

    if(message.type == "login")
    {
        var data = {
            type: "login_session",
            session: getCookie("PHPSESSID")
        }
        ws.send(JSON.stringify(data));
    }
    else if(message.type == "message")
    {
        var message_output = 
        `
            <div class=\"chat__message\">
                [${message.time}] <b>${message.user}:</b> ${message.text}
            </div>
        `;
            messages_container.innerHTML += message_output;
    }
    else if(message.type == "private_message")
    {
        if(message.status == "Success")
        {
            var message_output = 
            `
                <div class=\"chat__message chat__message_private\">
                    [${message.time}] |Private| <b>${message.user} -> ${message.receiver}:</b> ${message.text}
                </div>
            `;
            messages_container.innerHTML += message_output;
        }
        else if (message.status == "Failed")
        {
            var message_output = 
            `
                <div class=\"chat__message chat__message_failed\">
                    [${message.time}] |Private| <b>${message.user} -> ${message.receiver}:</b> User not found / not active"
                </div>
            `;
            messages_container.innerHTML += message_output;
        }
    }
}