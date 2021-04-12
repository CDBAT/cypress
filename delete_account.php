<?php
session_start();

$mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

// check if database connected properly
if(!$mysql_connect){
    die(mysqli_connect_error());
}
include 'header.php';


// get user email
$email = $_SESSION['email'];



//user deleting account
if(isset($_POST['delete_account'])){

    $reason = $_POST['delete_reason'];
    $security = $_POST['security'];

    // select everything from the table Accounts where the column email = userEmail and column password = userpassword
    $sqlQuery = "SELECT * FROM Accounts WHERE email ='$email' AND security ='$security'";

    // get query result
    $queryResult = $mysql_connect -> query($sqlQuery);
    $queryRows = mysqli_num_rows($queryResult);

    // account found
    if($queryRows == 1){



        // add reason to database
        $sqlQuery = "INSERT INTO delete_reasons (reason) VALUES ('$reason')";
        $mysql_connect -> query($sqlQuery);

        // delete all forms made by user
        $sqlQuery = "DELETE FROM Forms WHERE email = '$email' AND ";
        $mysql_connect -> query($sqlQuery);

        // delete all suggestion from user
        $sqlQuery = "DELETE FROM chat_message WHERE to_user = '$email'";
        $mysql_connect -> query($sqlQuery);

        // delete user vote
        $sqlQuery = "DELETE FROM voting WHERE to_user = '$email'";
        $mysql_connect -> query($sqlQuery);
        // delete user account
        $sqlQuery = "DELETE FROM Accounts WHERE email = '$email'";

        // execute query result
        $queryResult = $mysql_connect -> query($sqlQuery);
        // log user out
        unset($_SESSION['email']);

        $message = checkLanguageAlert("You successfully deleted your account.","Vous avez supprimé votre compte avec succès.");
        echo "<script type='text/javascript'>alert('$message');</script>";
        // redirect
        echo'
        <script>
        window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
        </script>
        ';
    }else{
        $message = checkLanguageAlert("INCORRECT secret question. FAILED to DELETE ACCOUNT","INCORRECT secret question. FAILED to DELETE ACCOUNT");
        echo "<script type='text/javascript'>alert('$message');</script>";    }
}


?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account Settings</title>

</head>

<body style ="background-color:white;">
<?php
$sqlQuery = "SELECT * FROM Accounts WHERE email ='$email'";

// get query result
$queryResult = $mysql_connect -> query($sqlQuery);
foreach ($queryResult as $row){

?>
    <div class="jumbotron"  style ="background-color:white;">
        <div class="bg order-1 order-md-2"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 py-5">
                        <h3><?php checkLanguage("Delete Account","Supprimer le compte"); ?></h3>
                        </p>
                        <form  onsubmit = "return confirm_delete();" action="#" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group first">
                                    <label for="email"><?php checkLanguage("Email Address","Adresse e-mail");?></label>
                                    <input type="email" class="form-control" value="<?php print($row['email']) ;?>" id="email" disabled>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group first">
                                    <label for="address"><?php checkLanguage("Secret Question","Question secrète");?></label>
                                    <input type="input" class="form-control"  id="security" name = "security">
                                </div>
                            </div>
                          </div>
                          <input type="text" id="delete_reason" name="delete_reason" style = "display:none;"/>

                            <!-- change to button -->
                            <button type="submit"  class="btn px-5 btn-danger" id = "delete_account" name = "delete_account" ><?php checkLanguage("Delete Account","Supprimer le compte"); ?></button>
                            <br>
                            <br>
                            <br>
                            <br>


                        </form>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>


<script src="scripts/delete_account.js"></script>

</html>
