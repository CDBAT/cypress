var damageType = document.getElementById('damage_type');
var cityName = document.getElementById('city');
var streetOne = document.getElementById('street_one');
var streetTwo = document.getElementById('street_two');
var damageInfo = document.getElementById('damage_info');
var oldFormID = document.getElementById('old_form_id');

window.onload = function() {
    var url = document.location.href;
    var params = url.split('?')[1].split('&');
    var data = [], tmp;

    for (var i = 0; i < params.length; i++) {
        tmp = params[i].split('=');
        data.push(tmp[1].replaceAll("%20", " "));
    }

    setReport(data);
}

function setReport(data) {
    var damage_type = data[0];

    var damageIndex = 0;
    for (var i = 0; i < damageType.length; i++) {
        if (damageType.options[i].value == damage_type) {
            damageIndex = i;
        }
    }

    damageType.selectedIndex = damageIndex;
    cityName.value = data[1];
    streetOne.value = data[2];
    streetTwo.value = data[3];
    damageInfo.value = data[4];

    oldFormID.style.display = "none";
    oldFormID.value = cityName.value + streetOne.value + streetTwo.value + damageType.value;
}
