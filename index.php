<?php
session_start();

$mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

// check if database connected properly
if(!$mysql_connect){
    die(mysqli_connect_error());
}
// else{
//     print("connected");
// }
?>

<!DOCTYPE html>
<html lang="en">
<?php
include 'header.php';
?>
<head>
    <meta charset="UTF-8">
    <title>CPS406 Cypress</title>
</head>
    <body>
    <h1>Cypress index page for now</h1>
</body>
</html>
