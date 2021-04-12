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
    <title>Vote</title>
    <link rel="stylesheet" href="stylesheets/edit_report.css"/>
</head>

<?php

$email = $_SESSION['email'];
$sqlQuery = "SELECT * FROM Votes ";
$queryResult = $mysql_connect->query($sqlQuery);

if ($queryResult) {
    $queryRowCount = mysqli_num_rows($queryResult);
?>

<body>
    <?php
        include 'header.php';
    ?>

    <div class='jumbotron' style="background-color:white">
        <div class='bg order-1 order-md-2'></div>
        <div class='contents order-2 order-md-1'>
            <div class='container'>
                <div class='row align-items-center justify-content-center'>
                    <div class='col-md-12 py-5'>
                        <form onsubmit = "return empty()" method="POST" id = "suggest" name = "suggest" action="#" >
                        <h3>Vote</h3>

                        <p class='mb-4'>
                        <?php
                        if ($queryRowCount > 0) {
                            checkLanguage("Vote for the next mayor of Toronto.", "Votez pour le prochain maire de Toronto.");
                        }
                        ?>
                        </p>

                        <table class='table table-striped'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'><?php checkLanguage("Candidate", "Candidat"); ?></th>
                                    <th scope='col'><?php checkLanguage("Party", "Parti"); ?></th>
                                    <th scope='col'>Vote</th>
                                    <th scope='col'><?php checkLanguage("Total Vote", "Vote Total"); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            foreach ($queryResult as $row) {
                                ?>
                                <tr>
                                    <th scope='col'><?php print($row['candidate']);?></th>
                                    <th scope='col'><?php print($row['party']);?></th>
                                    <th scope='col'><input type = "radio" name ="user_vote" id = "user_vote" value ="<?php print($row['candidate']);?>" onchange='stoppedTyping();'></th>
                                    <th scope='col'><?php print($row['votes']);?></th>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        <?php
                        if ($queryRowCount > 0) {
                            print("<p class='my-4' id='report_selected'></p>");
                                // send form id

                                print("<input type='submit' id='voted' name='voted' value = 'Vote'/>");
                        }
                        ?>
                        </form>
                        <!-- check if user voted -->
                        <?php
                        if(isset($_POST['voted'])){
                            // use to change votes in database later
                            $all_candidates = array("John Tory"=>0,"Doug Ford"=>0,"Christine Elliott"=>0,"Barack Obama"=>0,"Olivia Chow"=>0);

                            // get user new vote
                            $user_vote = $_POST['user_vote'];

                            // see if user already voted for this person
                            $sqlQuery = "SELECT * FROM voting  where candidate = '$user_vote' AND electorate = '$email'";
                            $queryResult = $mysql_connect->query($sqlQuery);
                            $queryRowSameVote = mysqli_num_rows($queryResult);

                            // check if user voted before
                            $sqlQuery = "SELECT * FROM voting  where electorate = '$email'";
                            $queryResult = $mysql_connect->query($sqlQuery);
                            $queryRowVoted = mysqli_num_rows($queryResult);

                            if ($queryRowSameVote == 1){
                                $message = checkLanguageAlert("You already voted for this person.", "Vous avez déjà voté pour cette personne.");
                                echo "<script type='text/javascript'>alert('$message');</script>";
                            }
                            elseif ($queryRowVoted !=0 ) {
                                $message = checkLanguageAlert("Your vote has successfully been changed.", "Votre vote a été modifié avec succès.");
                                echo "<script type='text/javascript'>alert('$message');</script>";

                                // remove old candidate vote replace with new one
                                $sqlQuery = "UPDATE voting SET candidate = '$user_vote' WHERE electorate = '$email'";
                                $mysql_connect->query($sqlQuery);
                            }
                            else {
                                // insert vote
                                $sqlQuery = "INSERT INTO voting (candidate, electorate) VALUES  ('$user_vote','$email')";
                                $mysql_connect -> query($sqlQuery);

                                $message = checkLanguageAlert("Congratulations! You just voted.", "Toutes nos félicitations! Vous venez de voter.");
                                echo "<script type='text/javascript'>alert('$message');</script>";
                            }

                            // update votes
                            foreach ($all_candidates as $candidate => $value){

                                // select everything from the table Accounts where the column email = userEmail and column password = userpassword
                            $sqlQuery = "SELECT * FROM voting WHERE candidate ='$candidate'";

                            // get query result
                            $queryResult = $mysql_connect -> query($sqlQuery);
                            $queryRows = mysqli_num_rows($queryResult);
                            // update database
                            $sqlQuery = "UPDATE Votes SET votes = $queryRows WHERE candidate ='$candidate'";
                            $mysql_connect -> query($sqlQuery);
                            }
                            // reload to update screen
                            echo "<script type='text/javascript'>window.location.replace(\"https://cypress-cdbat.000webhostapp.com/vote.php\");;</script>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
}
?>

<script src="scripts/vote.js"></script>

</html>
