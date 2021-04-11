function loadReport(damage_type, city, street1, street2, damage_info) {
    var message = '?damageType=' + damage_type + '&cityName=' + city + '&streetOne=' + street1 + '&streetTwo=' + street2 + '&damageInfo=' + damage_info;
    window.location="https://cypress-cdbat.000webhostapp.com/edit_report.php" + message;
}
