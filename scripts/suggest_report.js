var userSuggest = document.getElementById('user_suggestion');
var makeSuggestButton = document.getElementById('make_suggestion');
makeSuggestButton.disabled = true;
var formID = document.getElementById('form_id');

formID.style.display = "none";

function setFormID(form_id, damage_type, city, street1, street2) {
    formID.value = form_id;
    reportSelected.textContent = "You have selected: " + damage_type + " in " + city + " at intersection of " + street1 + " & " + street2 ;

}

function stoppedTyping() {
    if (userSuggest.value != "") {
        makeSuggestButton.disabled = false;
    }
    else {
        makeSuggestButton.disabled = true;
    }
}
