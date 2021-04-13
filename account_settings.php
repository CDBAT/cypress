<?php
session_start();

$mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

// check if database connected properly
if(!$mysql_connect){
    die(mysqli_connect_error());
}

// get user email
$email = $_SESSION['email'];

?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account Settings</title>

</head>

<body>

    <?php
        include 'header.php';
        $sqlQuery = "SELECT * FROM Accounts WHERE email ='$email'";

        // get query result
        $queryResult = $mysql_connect -> query($sqlQuery);
        foreach ($queryResult as $row) {
    ?>

    <div class="jumbotron" style="background-color:white">
        <div class="bg order-1 order-md-2"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 py-5">
                        <h3><?php checkLanguage("Account Settings", "Paramètres du Compte"); ?></h3>
                        <p class="mb-4"><?php checkLanguage("Edit Account Information", "Modifier les Informations du Compte"); ?></p>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" value="<?php print($row['email']) ;?>" id="email" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="password"><?php checkLanguage("Password", "Le Mot de Passe"); ?></label>
                                        <input type="password" class="form-control" value="<?php print($row['password']) ;?>" id="password" name = "password">
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group first">
                                            <label for="first_name"><?php checkLanguage("First Name", "Prénom"); ?></label>
                                            <input type="text" class="form-control" value="<?php print($row['first_name']) ;?>" id="first_name" name = "first_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group first">
                                            <label for="last_name"><?php checkLanguage("Last Name", "Nom de Famille"); ?></label>
                                            <input type="text" class="form-control" value="<?php print($row['last_name']) ;?>" id="last_name" name = "last_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="address"><?php checkLanguage("Address", "Addresse"); ?></label>
                                        <input type="input" class="form-control" value="<?php print($row['address']) ;?>" id="address" name = "address">
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group first">
                                            <label for="number"><?php checkLanguage("Phone Number", "Numéro de Téléphone"); ?></label>
                                            <input type="tel" class="form-control" value="<?php print($row['number']) ;?>"id="number" name ="number"
                                            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="address"><?php checkLanguage("Secret Question", "Question secrète"); ?></label>
                                        <input type="password" class="form-control" value="<?php print($row['security']) ;?>" id="security" name = "security">
                                    </div>
                                </div>
                            </div>
                            <!-- change to button -->
                            <button type="submit" value="Edit Report" class="btn px-5 btn-primary" id = "change" name = "change"><?php checkLanguage("Save Changes", "Sauvegarder les Modifications"); ?></button>
                            <br>
                            <br>
                            <br>
                            <br>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php

// user tries to change info
if(isset($_POST['change'])){

    $sqlQuery = "SELECT * FROM Accounts WHERE email ='$email'";
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $security = $_POST['security'];

    // check for blanks
    if ($first_name == "") {
        $message = checkLanguageAlert("You must enter a first name.", "Vous devez entrer un prénom.");
        print($message);
    }
    elseif ($last_name == "") {
        $message = checkLanguageAlert("You must enter a last name.", "Vous devez entrer un nom de famille.");
        print($message);
    }
    elseif ($address == "") {
        $message = checkLanguageAlert("You must enter an address.", "Vous devez entrer une adresse.");
        print($message);
    }
    elseif ($number == "") {
        $message = checkLanguageAlert("You must enter your phone number.", "Vous devez entrer votre numéro de téléphone.");
        print($message);
    }
    elseif ($security == "") {
        $message = checkLanguageAlert("You must a security word.", "Vous devez un mot de sécurité.");
        print($message);
    }
    elseif ($password == "") {
        $message = checkLanguageAlert("You must enter a password.", "Vous devez entrer un mot de passe.");
        print($message);
    }
    else {
        $sqlQuery = "UPDATE Accounts SET first_name = '$first_name',
                    last_name = '$last_name', password = '$password',
                    address = '$address', number = '$number',
                    security = '$security'
                    WHERE email ='$email' ";

        // execute query result
        $queryResult = $mysql_connect -> query($sqlQuery);


        $message = checkLanguageAlert("Your changes were successful.", "Vos modifications ont réussi.");
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script type='text/javascript'>window.location.replace(\"https://cypress-cdbat.000webhostapp.com/account_settings.php\");</script>";

    }
}

?>
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
