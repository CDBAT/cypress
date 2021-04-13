<?php
    session_start();

    $mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

    // check if database connected properly
    if(!$mysql_connect){
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

    <div  style = "width:50%; margin: auto; ">
        <form  method="POST" id = "sign_up" name = "sign_up" action="#" >
        <table style="width:100%">
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <label for="first_name"><?php checkLanguage("First Name:", "Prénom:"); ?></label>
                </td>
                <td>
                    <input type='input' name='first_name' id='first_name'>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="last_name"><?php checkLanguage("Last Name:", "Nom de Famille:"); ?></label>
                </td>
                <td>
                    <input type='input' name='last_name' id='last_name'>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="address"><?php checkLanguage("Address:", "Adresse:"); ?></label>
                </td>
                <td>
                    <input type='input' name='address' id='address'>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="number"><?php checkLanguage("Phone ", "Téléphone "); ?>(416-000-0000):</label>
                </td>
                <td>
                    <input type="tel" id="number" name="number"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" >
                </td>
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
                    <label for="security"><?php checkLanguage("Secret Answer:", "Réponse Secrète:"); ?></label>
                </td>
                <td>
                    <input type='input' name='security' id='security'>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="agreement">
                        <?php checkLanguage("I agree to Cypress Terms of Service and Privacy Agreement",
                        "J'accepte les conditions d'utilisation et l'accord de confidentialité de Cypress"); ?>
                    </label>
                </td>
                <td>
                    <input type='checkbox' name='agreement' id='agreement'>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <button type="submit"  id="create_account" name="create_account"><?php checkLanguage("Create Account", "Créer un Compte"); ?></button>
        </form>
        <br>
        <br>
        <button type="button"  id="cancel" name="cancel" onclick = "cancel()"><?php checkLanguage("Cancel", "Annuler"); ?></button>
    </div>
</body>

<div style = "width:50%; margin: auto; ">
<?php

// user tried to create new acount
if(isset($_POST['create_account'])){

    // get form info
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $security = $_POST['security'];



    $sqlQuery = "SELECT * FROM Accounts where email = '$email'";

    $queryResult = $mysql_connect -> query($sqlQuery);
    // check if email taken
    $queryRow = mysqli_num_rows($queryResult);

    // password not matching
    if (strcmp($password, $password2) !== 0) {
        $message = checkLanguageAlert("Password and Confirm Password are not the same. Please try again.", "Le mot de passe et la confirmation du mot de passe ne sont pas les mêmes. Veuillez réessayer.");
        print($message);
    }
    // blank entry
    elseif ($fname == "") {
        $message = checkLanguageAlert("You must enter a first name.", "Vous devez entrer un prénom.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ($lname == "") {
        $message = checkLanguageAlert("You must enter a last name.", "Vous devez entrer un nom de famille.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ($address == "") {
        $message = checkLanguageAlert("You must enter an address.", "Vous devez entrer une adresse.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ($number == "") {
        $message = checkLanguageAlert("You must enter your phone number.", "Vous devez entrer votre numéro de téléphone.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ($security == "") {
        $message = checkLanguageAlert("You must a security word.", "Vous devez un mot de sécurité.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ($email == "" ) {
        $message = checkLanguageAlert("You must enter an email.", "Vous devez saisir un email.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ( $password == "") {
        $message = checkLanguageAlert("You must enter a password.", "Vous devez entrer un mot de passe.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    // email taken
    elseif ($queryRow != 0) {
        $message = checkLanguageAlert("An account already exists with this email.", "Un compte existe déjà avec cette adresse e-mail.");
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo("<br>");
        $message = checkLanguageAlert("Please pick another email.", "Veuillez choisir un autre e-mail.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif (!isset($_POST['agreement'])) {
        $message = checkLanguageAlert("Please accept the terms and agreement.", "Veuillez accepter les termes et l'accord.");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else {
        // add to datebase
        $sqlQuery = "INSERT INTO Accounts (email, password,first_name,last_name,address,number,security) VALUES ('$email','$password','$fname','$lname','$address','$number','$security')";
        $mysql_connect -> query($sqlQuery);

        $message = checkLanguageAlert("Your account was successfully created.", "Votre compte a été créé avec succès.");

        echo "<script type='text/javascript'>alert('$message');</script>";
        // redirect user to index or login page
        echo'
        <script>
        window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
        </script>
        ';
    }
}

?>
</div>


<script src="scripts/cancel.js"></script>

