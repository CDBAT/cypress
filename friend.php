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
        $queryResult = $mysql_connect -> query($sqlQuery);

        // delete all forms made by user
        $sqlQuery = "DELETE FROM Forms WHERE email = '$email' AND ";
        $queryResult = $mysql_connect -> query($sqlQuery);

        // delete user account
        $sqlQuery = "DELETE FROM Accounts WHERE email = '$email'";

        // execute query result
        $queryResult = $mysql_connect -> query($sqlQuery);
        // log user out
        unset($_SESSION['email']);

        $message = "You successfully deleted your account.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        // redirect
        echo'
        <script>
        window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
        </script>
        ';
    }else{
        $message = "INCORRECT secret question. FAILED to DELETE ACCOUNT";
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
                        <h3><?php checkLanguage("Tell Your Friend About Us","Parlez de nous à votre ami");?></h3>
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
                                    <label for="friend_email"><?php checkLanguage("Friend Email Address","Adresse e-mail de l'ami");?></label>
                                    <input type="input" class="form-control" name = "friend_email" id="friend_email" oninput ="stoppedTyping();">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group first">
                                    <label for="damage-info"><b><?php checkLanguage("Email Message", "Message électronique"); ?></b>

                                    </label>
<textarea id="email_message" name="email_message" class="form-control" rows=5
><?php checkLanguage("Hi friend, I found this awesome website that lets me report city damages and
vote in the next municipal election in Toronto. I thought I should share this with you as well.
https://cypress-cdbat.000webhostapp.com
Sincerely,",
"Salut ami, j'ai trouvé ce site Web génial qui me permet de signaler les dommages causés par la ville et
voter aux prochaines élections municipales à Toronto. J'ai pensé que je devrais également partager cela avec vous.
https://cypress-cdbat.000webhostapp.com
Sincèrement,")?>

<?php print($row['first_name']." ".$row['last_name']);?>
</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- change to button -->
                        <button type="submit"  class="btn px-5 btn-primary" id = "send_email" name = "send_email" ><?php checkLanguage("Send Email","Envoyer un e-mail");?></button>
                        <br>
                        <br>
                        <br>
                        <br>


                    </form>

                        <?php
                        if(isset($_POST['send_email'])){
                            $friend_email = $_POST['friend_email'];
                            $message = $_POST['email_message'];
                            
                            // send email to friend
                            mail($friend_email,'Password Reset Cypress', $message, '$email');
                            
                            $message = checkLanguageAlert("Email has been sent", "L'email a été envoyé");
                            echo "<script type='text/javascript'>alert('$message');</script>";
                            
                            echo'
                            <script>
                            window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
                            </script>
                            ';
                        }
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>


<script src="scripts/friend.js"></script>
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
