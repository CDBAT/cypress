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
    <title>Rankings</title>
    <link rel="stylesheet" href="stylesheets/edit_report.css"/>
</head>

<?php
    include 'header.php';

    // associated array of all cities and damage type (send number of reports to 0)
    $all_cities_report = array("Etobicoke"=>0,"Downtown Toronto"=>0,"York"=>0,"Scarborough"=>0,"North York"=>0,"East York"=>0);
    $all_damage_report = array("Pothole"=>0,"Utility Failure"=>0,"Tree Collapse"=>0,"Flooded Street"=>0,"Vandalism"=>0,
    "Mould and Spore Growth"=>0, "Eroded Streets"=>0,"Garbage Obstruction"=>0,"Road Obstruction"=>0,"Other"=>0);

    // get the total report from each city
    foreach ($all_cities_report as $city => $value){

            // select everything from the table Accounts where the column email = userEmail and column password = userpassword
        $sqlQuery = "SELECT * FROM Forms WHERE city ='$city'";

        // get query result
        $queryResult = $mysql_connect -> query($sqlQuery);
        $queryRows = mysqli_num_rows($queryResult);
        $all_cities_report[$city] = $queryRows;
    }
    // get the total report from each city
    foreach ($all_damage_report as $damage => $value){

                // select everything from the table Accounts where the column email = userEmail and column password = userpassword
        $sqlQuery = "SELECT * FROM Forms WHERE damage_type ='$damage'";

        // get query result
        $queryResult = $mysql_connect -> query($sqlQuery);
        $queryRows = mysqli_num_rows($queryResult);
        $all_damage_report[$damage] = $queryRows;
    }
    // sort in descending order by number of report each city have
    arsort($all_cities_report);
    arsort($all_damage_report);
?>

<body>
    <div class='jumbotron' style="background-color:white">
        <div class='bg order-1 order-md-2'></div>
        <div class='contents order-2 order-md-1'>
            <div class='container'>
                <div class='row'>
                    <h1>Rankings</h1>
                </div>
                <div class='row'>
                    <p class='mb-4'>The ranking of cities with the most reports and the ranking of property damage with the most reports are found below:</p>
                </div>
                <div class='row align-items-top'>
                    <div class='col-md-6 py-5'>
                        <h2 style="text-align: center;">City of Toronto Locations</h2>

                        <table class='table table-striped'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Rank</th>
                                    <th scope='col'>Locations</th>
                                    <th scope='col'>Number of Reports</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            // go through each
                            $count = 1;
                            foreach ($all_cities_report as $city => $value) {
                                printf("<tr'>");
                                printf("<td>%s</td>", $count);

                                printf("<td>%s</td>", $city);
                                printf("<td>%s</td>", $value);

                                print("</tr>");
                                $count +=1;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                        
                    <div class='col-md-6 py-5'>
                        <h2 style = "text-align: center;">Property Damage</h2>
                        <table class='table table-striped'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Rank</th>
                                    <th scope='col'>Damage Type</th>
                                    <th scope='col'>Number of Reports</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            $count = 1;
                            foreach ($all_damage_report as $damage => $value) {
                                printf("<tr'>");
                                printf("<td>%s</td>", $count);

                                printf("<td>%s</td>", $damage);
                                printf("<td>%s</td>", $value);

                                print("</tr>");
                                $count +=1;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script src="scripts/load_report.js"></script>

</html>
