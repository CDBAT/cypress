var formID = document.getElementById('formID');
var form = document.getElementById('delete_report_form');
var reportSelected = document.getElementById('report_selected');
var confirmDeleteButton = document.getElementById('submit_delete_report');

confirmDeleteButton.disabled = true;
formID.style.display = "none";

function setFormID(damage_type, city, street1, street2) {
    formID.value = city + street1 + street2 + damage_type;
    reportSelected.textContent = "You have selected: " + damage_type + " in " + city + " at intersection of " + street1 + " & " + street2 + ".";
    confirmDeleteButton.disabled = false;
}

function confirmDeleteReport() {
    return confirm('Are you sure you want to delete this report?');
}
