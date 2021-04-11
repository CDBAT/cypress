
var delete_reason_item = document.getElementById('delete_reason');

// redirect to signup page
function confirm_delete() {
    var confirm_delete =  confirm("Do you want to delete your account?");
    if(confirm_delete != false){
        var reason = prompt("Why do you want to delete your account?");
        delete_reason_item.value = reason;
    }
    return confirm_delete;
}


