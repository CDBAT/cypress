<?php
    session_start();

    $mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

    // check if database connected properly
    if (!$mysql_connect) {
        die(mysqli_connect_error());
    }
?>


<head>
    <title>Account Settings</title>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="">

</head>

<body>
    <?php
        include 'header.php';
    ?>

    <div style="width:50%; margin: auto;">
        <form method="POST" id="reset_password" name="reset_password" action="#">
            <table style="width:100%">
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td>
                    <td>
                        <input type='email' name='email' id='email'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password"><?php checkLanguage("Password:", "Le Mot de Passe:"); ?></label>
                    </td>
                    <td>
                        <input type='password' name='password' id='password' >
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password2"><?php checkLanguage("Confirm New Password::", "Confirmer le Nouveau Mot de Passe:"); ?></label>
                    </td>
                    <td>
                        <input type='password' name='password2' id='password2'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="security"><?php checkLanguage("Secret Question:", "Question Secrète:"); ?></label>
                    </td>
                    <td>
                        <input type='input' name='security' id='security'>
                    </td>
                </tr>
            <table>
            <button type="submit" id="reset_password" name="reset_password"><?php checkLanguage("Reset Password", "Réinitialiser le mot de passe"); ?></button>
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
        if (strcmp($password, $password2) !== 0) {
            $message = checkLanguage("New Password and Confirm New Password are not the same. Please try again.", "Le nouveau mot de passe et la confirmation du nouveau mot de passe ne sont pas les mêmes. Veuillez réessayer.");
            print($message);
        }
        // blank entry
        elseif ($email == "" ) {
            $message = checkLanguage("You must enter an email.", "Vous devez saisir un email.");
            print($message);
        }
        elseif ($password == "") {
            $message = checkLanguage("You must enter a password.", "Vous devez entrer un mot de passe.");
            print($message);
        }
        else {
            $sqlQuery = "UPDATE Accounts SET password = '$password' WHERE email ='$email' AND security ='$security'";
            // get query result
            $queryResult = $mysql_connect -> query($sqlQuery);
            // message
            $message = checkLanguage("Your new password is ", "Votre nouveau mot de passe est ");
            $msg = $message . $password;

            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);

            // send email (to, subject, message, from)
            mail($email,'Password Reset Cypress', $msg, 'cypress@email.com');
        }
        $message = checkLanguage("Password changed successfully.", "Le mot de passe a été changé avec succès");
        print($message);
        echo("<br>");
        $message = checkLanguage("Email has been sent.", "L'email a été envoyé.");
        print($message);
    }
    // no such account or security
    else {
        $message = checkLanguage("The email or secret question is incorrect please try again.", "L'email ou la question secrète est incorrecte, veuillez réessayer.");
        print($message);
    }
}
?>
