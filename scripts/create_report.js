var form = document.getElementById('report');
var torontoMap = document.getElementById('toronto_map');
var district = document.getElementById('district');
var districtMap = document.getElementById('district_map');
var headerMessage = document.getElementById('header_message');
var city = document.getElementById('city');

function showDistrictMap(mapPath, cityName) {
    city.value = cityName;
    torontoMap.style.display = "none";
    districtMap.src = mapPath;
    headerMessage.textContent = "Please fill out the following information about the property damage below:"
    district.style.display = "block";
    form.style.display = "block";
}

function showTorontoMap() {
    district.style.display = "none";
    form.style.display = "none";
    headerMessage.textContent = "Click on the map to show where the property damage occurred:"
    torontoMap.style.display = "block";
}
