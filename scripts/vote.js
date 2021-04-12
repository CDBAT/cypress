var userVote = document.getElementById('user_vote');
var voteButton = document.getElementById('voted');
voteButton.disabled = true;

function stoppedTyping() {
    if (userVote.value != "") {
        voteButton.disabled = false;
    }
    else {
        voteButton.disabled = true;
    }
}
