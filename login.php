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
        $email = strtolower($_POST['email']);
        $pass = $_POST['pass'];

        // select everything from the table Accounts where the column email = userEmail and column password = userpassword
        $sqlQuery = "SELECT * FROM Accounts WHERE email ='$email' AND password ='$pass'";

        // get query result
        $queryResult = $mysql_connect -> query($sqlQuery);
        $queryRows = mysqli_num_rows($queryResult);

        // account found
        if($queryRows == 1){
            // logs person in
            $_SESSION['email'] = $email;
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

<head>
    <meta charset="UTF-8">
    <title>Cypress Login Page</title>
</head>
<body>
<div  style = "width:50%; margin: 0 auto; ">

    <p><strong>You are currently at the Cypress login page. By Logging onto this sytem, you <br>
     will be able to report a variety of problems as you have witnessed on the streets of Toronto </strong></p>
     <br>
    <!-- form to send server email and password -->
    <form id = "login_form" name = "login_form" action = "#" method = "POST">
        <table style="width:100%">
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>
                <label for="email">Email:
            </td>
            <td>
                 <input type='email' name='email' id='email'>
            </td>
        </tr>
        <tr>
            <td>
                <label for="pass">Password:
            </td>
            <td>
                 <input type='password' name='pass' id='pass'>
            </td>
        </tr>
        <tr>
            <td>
            <button type = "submit" id = "login" name = "login">Login</button>
            <button  id = "signup" name = "signup" onclick = "sign_up()" type = "submit">Signup</button>
            </td>
            <td>
            <button  id = "forgot_pass" name = "forgot_pass" onclick = "reset_password()" type = "submit">Forgot Password</button>
            </td>
        </tr>
        <!-- <label for ="email">Username:
        <input type = "email" id = "email" name = "email" >
        <label for ="pass">Password:
        <input type = "password" id = "pass" name = "pass" > -->
        </table>



    </form>
    <br>
    <br>
    <button type="button"  id="cancel" name="cancel" onclick = "cancel()">Cancel</button>
    </div>
</body>

<script src="scripts/login_redirect.js"></script>
<script src="scripts/cancel.js"></script>

</html>