var surveyButton = document.getElementById('survey');
var navigationOption = document.getElementById('navigation');
var experienceOption = document.getElementById('experience');
var usefulOption = document.getElementById('useful');
surveyButton.disabled=true;
function loadform(){

    if(navigationOption.selectedIndex!=0 && experienceOption.selectedIndex!=0 && usefulOption.selectedIndex!=0){
        document.survey_form.survey.disabled=false;

    }
}