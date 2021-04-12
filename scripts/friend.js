var friendEmail = document.getElementById('friend_email');
var sendEmailButton = document.getElementById('send_email');
sendEmailButton.disabled = true;

function stoppedTyping() {
    if (friendEmail.value != "") {
        sendEmailButton.disabled = false;
    }
    else {
        sendEmailButton.disabled = true;
    }
}
