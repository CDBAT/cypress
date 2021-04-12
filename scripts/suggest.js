var reportSelected = document.getElementById('report_selected');
var formID = document.getElementById('form_id');
var suggestReport = document.getElementById('suggest_report');

suggestReport.disabled = true;
formID.style.display = "none";

function setFormID(form_id, damage_type, city, street1, street2) {
    formID.value = form_id;
    reportSelected.textContent = "You have selected: " + damage_type + " in " + city + " at intersection of " + street1 + " & " + street2 ;
    suggestReport.disabled = false;
}
