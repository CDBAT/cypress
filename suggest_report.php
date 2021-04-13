<?php
session_start();

$mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

// Check if database connected properly
if (!$mysql_connect) {
    die(mysqli_connect_error());
}

?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Suggestion Report Tab</title>
    <link rel="stylesheet" href="stylesheets/edit_report.css"/>
</head>

<?php
include 'header.php';

// user trying to make suggestion
if(isset($_POST['suggest_report']) || isset($_POST['make_suggestion'])  ){
    // get form ID
    $form_id = $_POST['form_id'];

    // email of user making suggestion
    $email = $_SESSION['email'];

    $sqlQuery = "SELECT * FROM Forms WHERE form_id = '$form_id' ";
    $queryResult = $mysql_connect->query($sqlQuery);
    // get form table result to display form
    $formTableReslt = $queryResult->fetch_assoc();

?>

<body>
    <div class='jumbotron' style="background-color:white">
        <div class='bg order-1 order-md-2'></div>
        <div class='contents order-2 order-md-1'>
            <div class='container'>
                <div class='row align-items-center justify-content-center'>
                    <div class='col-md-12 py-5'>

                    <h3><?php checkLanguage("Suggestion Report", "Rapport de Suggestion"); ?></h3>

                        <table class='table table-striped'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'><?php checkLanguage("Damage Type", "Type de Dommage"); ?></th>
                                    <th scope='col'><?php checkLanguage("City", "Ville"); ?></th>
                                    <th scope='col'><?php checkLanguage("Street 1", "Rue 1"); ?></th>
                                    <th scope='col'><?php checkLanguage("Street 2", "Rue 2"); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                            <!-- display form table result -->
                            <?php
                                printf("<tr class='clickable' >");
                                    printf("<td>%s</td>\n", $formTableReslt['damage_type']);
                                    printf("<td>%s</td>\n", $formTableReslt['city']);
                                    printf("<td>%s</td>\n", $formTableReslt['street1']);
                                    printf("<td>%s</td>\n", $formTableReslt['street2']);
                                print("</tr>");

                            ?>
                            </tbody>
                        </table>

                        <?php
                            // display response table
                        ?>

                        <form method="POST" id = "suggest" name = "suggest" action="#" >
                            <!-- allow user to make suggestion -->
                            <div class="form-group first">
                                <label for="user_suggestion">
                                    <?php checkLanguage("Write your suggestion below:", "Écrivez votre suggestion ci-dessous:"); ?>
                                </label>
                                <textarea id="user_suggestion" name="user_suggestion"class="form-control" onkeyup="stoppedTyping()" rows=5></textarea>
                            </div>
                           <?php print("<input type='text' id='form_id' name='form_id' value='$form_id'/>");?>
                            <button type='submit' class='btn btn-md btn-primary' id='make_suggestion' name='make_suggestion' oninput ="stoppedTyping()">
                                <?php checkLanguage("Submit Suggestion", "Soumettre une Suggestion"); ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
    if(isset($_POST['make_suggestion'])){

        $sqlQuery = "SELECT * FROM Forms WHERE form_id = '$form_id' ";
        $queryResult = $mysql_connect->query($sqlQuery);
        // get form table result to display form
        $formTableReslt = $queryResult->fetch_assoc();
        $chat_id = $form_id;
        $to_user = $formTableReslt['email'];
        $from_user = $email;
        $message = $_POST['user_suggestion'];

        if ($message == "") {
            $error = checkLanguageAlert("You can not submit an EMPTY suggestion.", "Vous ne pouvez pas soumettre de suggestion VIDE.");
            echo "<script type='text/javascript'>alert('$error');</script>";
        }
        else {
            // query to add to databse
            $sqlQuery = "INSERT INTO chat_message (chat_id, to_user,from_user,message) VALUES ('$chat_id','$to_user','$from_user','$message')";
            // add to chat history
            $mysql_connect->query($sqlQuery);
            $message = checkLanguageAlert("Your suggestion was successfully sent.", "Votre suggestion a été envoyée avec succès.");
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo'
            <script>
            window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
            </script>
            ';
        }
    }
}


?>



<script src="scripts/suggest_report.js"></script>

</html>
