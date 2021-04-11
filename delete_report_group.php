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
    <title>Delete Report Tab</title>
    <link rel="stylesheet" href="stylesheets/edit_report.css"/>
</head>

<?php

$email = $_SESSION['email'];

$sqlQuery = "SELECT damage_type, city, street1, street2, damage_info FROM Forms where email = '$email'";
$queryResult = $mysql_connect->query($sqlQuery);

if ($queryResult) {

    include 'header.php';

    $queryRowCount = mysqli_num_rows($queryResult);

?>

<body>
    <div class='jumbotron' style="background-color:white">
        <div class='bg order-1 order-md-2'></div>
        <div class='contents order-2 order-md-1'>
            <div class='container'>
                <div class='row align-items-center justify-content-center'>
                    <div class='col-md-12 py-5'>
                        <h3>Delete Report Tab</h3>
                        <?php
                        if ($queryRowCount > 0) {
                            print("<p class='mb-4'>Choose a report to delete.");
                        } 
                        else {
                            print("<p class='mb-4'>You have no reports.");
                        }
                        ?>

                        <table class='table table-striped'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Damage Type</th>
                                    <th scope='col'>City</th>
                                    <th scope='col'>Street 1</th>
                                    <th scope='col'>Street 2</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            while ($row = $queryResult->fetch_assoc()) {
                                printf("<tr class='clickable' onclick='setFormID(\"%s\", \"%s\", \"%s\", \"%s\")'>\n", $row['damage_type'], $row['city'], $row['street1'], $row['street2']);
                                    printf("<td>%s</td>\n", $row['damage_type']);
                                    printf("<td>%s</td>\n", $row['city']);
                                    printf("<td>%s</td>\n", $row['street1']);
                                    printf("<td>%s</td>\n", $row['street2']);
                                print("</tr>");
                            }
                            ?>
                            </tbody>
                        </table>

                        <?php
                        if ($queryRowCount > 0) {
                            print("<p class='my-4' id='report_selected'></p>");
                            
                            print("<form onsubmit=\"return confirmDeleteReport()\" id='delete_report_form' action='' method='POST'>");
                                print("<input type='text' id='formID' name='formID' value=''/>");
                                print("<input type='submit' value='Confirm' id='submit_delete_report' name='submit_delete_report'/>");
                            print("</form>");
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

// User tried to delete the report
if (isset($_POST['submit_delete_report'])) {

    // Get info from form
    $email = $_SESSION['email'];
    $form_id = $email . $_POST['formID'];

    echo "<script type='text/javascript'>alert('$form_id');</script>";

    $sqlQuery = "DELETE FROM Forms WHERE form_id=\"$form_id\"";
    
    if ($mysql_connect->query($sqlQuery) === TRUE) {
        $message = "You successfully deleted the report.";
        echo "<script type='text/javascript'>alert('$message');</script>";

        echo'
        <script>
        window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
        </script>
        ';
    }
    else {
        echo "Error deleting record: " . $mysql_connect->error;
    }
}

$queryResult->free();
$mysql_connect->close();

?>

<script src="scripts/delete_report.js"></script>

</html>
