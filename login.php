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
        $queryResult = $mysql_connect -> query($sqlQuery);
        $queryRows = mysqli_num_rows($queryRows);

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

<head>
    <meta charset="UTF-8">
    <title>Cypress Login Page</title>
</head>
<body>
<div  style = "width:50%; margin: 0 auto; ">

    <!-- form to send server username and password -->
    <form id = "login" name = "login" action = "" type = "POST">
    <table style="width:100%">
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>
                <label for="username">username:
            </td>
            <td>
                 <input type='text' name='username' id='username'>
            </td>
        </tr>
        <tr>
            <td>
                <label for="userName">Password:
            </td>
            <td>
                 <input type='password' name='pass' id='pass'>
            </td>
        </tr>
        <!-- <label for ="username">Username:
        <input type = "username" id = "username" name = "username" >
        <label for ="pass">Password:
        <input type = "password" id = "pass" name = "pass" > -->
        </table>

        <button type = "submit" id = "login" name = "login">Login</button>
        <button  id = "signup" name = "signup" onclick = "sign_up()" type = "submit">Signup</button>

    </form>
    </div>
</body>

<script src="signup_redirect.js"></script>

</html>
