<?php
session_start();

$mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

// check if database connected properly
if(!$mysql_connect){
    die(mysqli_connect_error());
}
// else{
//     print("connected");
// }
?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Report</title>
    <link rel="stylesheet" href="stylesheets/create_report.css"/>
</head>

<body>
    <?php
    include 'header.php';
    ?>

    <div class="jumbotron" style="background-color:white">
        <div class="bg order-1 order-md-2"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-10 py-5">
                        <h3>Create Report</h3>
                        <p class="mb-4" id="header_message">Click on the map to show where the property damage occurred:</p>

                        <div class="img-wrapper" id="toronto_map">
                            <img class="img-responsive" src="./images/city-of-toronto.png">
                            <div class="img-overlay btn-etobicoke">
                                <button class="btn btn-md btn-primary" onclick="showDistrictMap('images/etobicoke.PNG', 'Etobicoke')">Etobicoke</button>
                            </div>
                            <div class="img-overlay btn-downtown-toronto">
                                <button class="btn btn-md btn-primary" onclick="showDistrictMap('images/downtown-toronto.PNG', 'Downtown Toronto')">Downtown Toronto</button>
                            </div>
                            <div class="img-overlay btn-yorks">
                                <button class="btn btn-md btn-primary" onclick="showDistrictMap('images/york.PNG', 'York')">York</button>
                                <button class="btn btn-md btn-primary btn-east-york" onclick="showDistrictMap('./images/east-york.PNG', 'East York')">East York</button>
                            </div>
                            <div class="img-overlay btn-north-york">
                                <button class="btn btn-md btn-primary" onclick="showDistrictMap('images/north-york.PNG', 'North York')">North York</button>
                            </div>
                            <div class="img-overlay btn-scarborough">
                                <button class="btn btn-md btn-primary" onclick="showDistrictMap('images/scarborough.PNG', 'Scarborough')">Scarborough</button>
                            </div>
                        </div>

                        <div class="img-wrapper" id="district">
                            <img class="img-responsive" src="" alt="District Image" id="district_map"/>
                            <div class="img-overlay btn-back">
                                <button class="btn btn-md btn-dark" onclick="showTorontoMap()">Back</button>
                            </div>
                        </div>

                        <br>

                        <form id="report" action="" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="damage_type"><b>Property Damage Type</b></label><br>
                                        <select class="form-control" name="damage_type" id="damage_type">
                                            <option value="">--- Please select one ---</option>
                                            <option value="Pothole">Pothole</option>
                                            <option value="Utility Failure">Utility Failure</option>
                                            <option value="Tree Collapse">Tree Collapse</option>
                                            <option value="Flooded Street">Flooded Street</option>
                                            <option value="Vandalism">Vandalism</option>
                                            <option value="Mould and Spore">Mould and Spore Growth</option>
                                            <option value="Eroded Streets">Eroded Streets</option>
                                            <option value="Garbage Obstruction">Garbage Obstruction</option>
                                            <option value="Road Obstruction">Road Obstruction</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <p><b>Street Intersection Info</b></p>
                                        <p>Provide the closest intersection to the damage.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group first">
                                        <label for="street_one">Street 1</label>
                                        <input type="text" class="form-control" placeholder="e.g. Queen St W"
                                            id="street_one" name="street_one">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group first">
                                        <label for="street_two">Street 2</label>
                                        <input type="text" class="form-control" placeholder="e.g. Yonge St" id="street_two" name="street_two">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="damage_info"><b>(OPTIONAL)</b> Please provide some more information
                                            about the damage:</label>
                                        <textarea class="form-control" rows=5 id="damage_info" name="damage_info"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>
                            <div class="d-flex mb-5 mt-4 align-items-center">
                                <div class="d-flex align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">
                                            Submitting this report will allow the City of Toronto to rapidly respond to
                                            property damage.
                                    </label>
                                </div>
                            </div>
                            <input type="submit" id="create_report" name="create_report" value="Create Report" class="btn px-5 btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

<script src="scripts/create_report.js"></script>

<?php

// User tried to create a new report
if(isset($_POST['create_report'])) {
    
    // Get form info
    $city = $_POST['city'];
    $street1 = $_POST['street_one'];
    $street2 = $_POST['street_two'];
    $damage_type = $_POST['damage_type'];
    $damage_info = $_POST['damage_info'];

    $email = $_SESSION['email'];

    $form_id = $email . $city . $street1 . $street2 . $damage_type;

    $sqlQuery = "SELECT * FROM Forms where form_id = '$form_id'";

    $queryResult = $mysql_connect -> query($sqlQuery);
    // Check if form id already exists
    $queryRow = mysqli_num_rows($queryResult);

    // Blank entries
    if ($queryRow != 0) {
        $message = "A similar report has already been created by you.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ($damage_type == "") {
        $message = "You must select a type of property damage.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ($street1 == "") {
        $message = "You must enter a street name.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    elseif ($street2 == "" || $street1 == $street2) {
        $message = "You must enter another street name.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else {
        // Add to database
        $sqlQuery = "INSERT INTO Forms (form_id, email, city, street1, street2, damage_type, damage_info) VALUES ('$form_id', '$email', '$city', '$street1', '$street2', '$damage_type', '$damage_info')";
        
        if ($mysql_connect->query($sqlQuery) === TRUE) {
            $message = "You successfully submitted a report.";
            echo "<script type='text/javascript'>alert('$message');</script>";
    
            echo'
            <script>
            window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
            </script>
            ';
        }
        else {
            echo "Error updating record: " . $mysql_connect->error;
        }  
    }
}

?>

</html>
