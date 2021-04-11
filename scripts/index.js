var languageChosen = document.getElementById('language');
var languageForm = document.getElementById('language_form');

function setLanguage(language_parameter) {
    languageChosen.value = language_parameter;
    languageForm.submit();
}
