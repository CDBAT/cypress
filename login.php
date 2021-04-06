<?php

session_start();

$mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

// check if database connected properly
if(!$mysql_connect){
    die(mysqli_connect_error());
}
else{
    //  check if user tried to login
    if(isset($_POST['login'])){

        // get login info
        $username = strtolower($_POST['username']);
        $pass = $_POST['pass'];

        $sqlQuery = "SELECT * FROM Accounts WHERE username ='$username' AND password ='$pass'";

        // get query result
        $queryResult = $mysql_connect -> query($sqlquery);
        $queryRows = mysqli_num_rows($row);

        // account found
        if($queryRows == 1){
            // logs person in
            $_SESSION['username'] = $username;
            // redirect to home page
            header("Location: index.php");

        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<?php
include 'header.php';
?>
<!-- space so navbar doesn't get in the way -->
<br>
<br>
<br>
<br>
<br>

<head>
    <meta charset="UTF-8">
    <title>Cypress Login Page</title>
</head>
<body>
    <!-- form to send server username and password -->
    <form id = "login" name = "login" action = "" type = "POST">
        <label for ="username">Username:
        <input type = "username" id = "username" name = "username" >
        <label for ="pass">Password:
        <input type = "password" id = "pass" name = "pass" >

        <button type = "submit" id = "login" name = "login">Login</button>
        <button type = "submit" id = "signup" name = "signup">Signup</button>

    </form>
</body>
</html>