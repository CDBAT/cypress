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
    $sqlQuery = "SELECT * FROM Forms ";
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

                        <h3><?php checkLanguage("Suggestion Report", "Rapport de Suggestion"); ?></h3>
                        <p class='mb-4'>
                        <?php
                        if ($queryRowCount > 0) {
                            checkLanguage("Choose a report to make a suggestion.", "Choisissez un rapport pour faire une suggestion.");
                        } 
                        else {
                            checkLanguage("You have no reports.", "Vous n'avez aucun rapport."); 
                        }
                        ?>
                        </p>

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
                            <?php
                            while ($row = $queryResult->fetch_assoc()) {
                                printf("<tr class='clickable' onclick='setFormID(\"%s\",\"%s\", \"%s\", \"%s\", \"%s\")'>\n", $row['form_id'], $row['damage_type'], $row['city'], $row['street1'], $row['street2']);
                                    printf("<td>%s</td>\n", $row['damage_type']);
                                    printf("<td>%s</td>\n", $row['city']);
                                    printf("<td>%s</td>\n", $row['street1']);
                                    printf("<td>%s</td>\n", $row['street2']);
                                print("</tr>");
                            }
                            ?>
                            </tbody>
                        </table>

                        <p class='my-4' id='report_selected'></p>

                        <form method="POST" id = "suggest" name = "suggest" action="suggest_report.php" >
                            <input type='text' id='form_id' name='form_id' value=''/>
                            <button class='btn btn-md btn-primary' type='submit' id='suggest_report' name='suggest_report'><?php checkLanguage("Make a Suggestion", "Faire une Suggestion"); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
}

?>

<script src="scripts/suggest.js"></script>

</html>
