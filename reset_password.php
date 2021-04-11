<?php

    session_start();

    $mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

    // check if database connected properly
    if(!$mysql_connect){
        die(mysqli_connect_error());
    }

    include 'header.php';

?>


<head>
    <title>Account Settings</title>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="">

</head>

<body>
  <div  style = "width:50%; margin: auto; ">
    <form  method="POST" id = "reset_password" name = "reset_password" action="#" >
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
                <label for="password">Password:

                </td>
                <td>
                <input type='password' name='password' id='password' >

                </td>
            </tr>
            <tr>
                <td>
                <label for="password2">Confirm New Password:

                </td>
                <td>
                <input type='password' name='password2' id='password2'>

                </td>
            </tr>
            <tr>
                <td>
                <label for="security">Secret Question:
                </td>
                <td>
                <input type='input' name='security' id='security'>
                </td>
            </tr>
        <table>
        <button type="submit"  id="reset_password" name="reset_password">Reset Password</button>

    <form>
  <div>
</body>

<?php

// user tried to create new acount
if(isset($_POST['reset_password'])){
     // get login info
     $email = strtolower($_POST['email']);
     $password = $_POST['password'];
     $password2 = $_POST['password2'];
     $security = $_POST['security'];
    // select everything from the table Accounts where the column email = user email and security question is user answer
    $sqlQuery = "SELECT * FROM Accounts WHERE email ='$email' AND security ='$security'";

    // get query result
    $queryResult = $mysql_connect -> query($sqlQuery);
    $queryRows = mysqli_num_rows($queryResult);

    // account found
    if($queryRows == 1){
        // password not matching
        if(strcmp($password, $password2) !== 0){
            print("New Password and confirm new password are not the same. Please try again");
        }
        // blank entry
        elseif($email == "" ){
            print("You must enter an email");
        }
        elseif( $password == ""){
            print("You must enter a password");
        }
        else{
            $sqlQuery = "UPDATE Accounts SET password = '$password' WHERE email ='$email' AND security ='$security'";
            // get query result
            $queryResult = $mysql_connect -> query($sqlQuery);
            // message
            $msg = "your new password is $password";

            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);

            // send email (to, subject, message, from)
            mail($email,"Password Reset Cypress",$msg, "cypress@email.com ");
        }
     print("password change successfully");
     echo("<br>");
     print("Email has been sent");
    }
    // no such account or security
    else{

        print("The email or secret question is incorrect please try again");
    }


    }
    ?>