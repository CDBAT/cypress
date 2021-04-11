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
    <title>Notifications</title>

</head>

<body>
<?php
include 'header.php';

?>
    <div class="jumbotron">


        <div class="bg order-1 order-md-2"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 py-5">
                        <h3>Fill in Survey</h3>
                        <p class="mb-4">Fill in your survey for the City of Toronto
                        </p>
                        <form action="#" method="post">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="property-damage">How easy is it to navigate around the website?</label><br>
                                        <select class="form-control" name="navigation" id = "navigation">
                                            <option value="">--- Please select one ---</option>
                                            <option value="amazing">Amazing</option>
                                            <option value="great">Great</option>
                                            <option value="good">Good</option>
                                            <option value="okay">Okay</option>
                                            <option value="bad">Bad</option>
                                            <option value="horrible">Horrible</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="property-damage">Was this website useful?</label><br>
                                        <select class="form-control" name="useful" id = "useful">
                                            <option value="">--- Please select one ---</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="property-damage">Were you satisfy with your experience?</label><br>
                                        <select class="form-control" name="experience" id = "experience">
                                            <option value="">--- Please select one ---</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="damage-info"><b>(OPTIONAL)</b> Are there any features you like us to add in the future?</label>
                                        <textarea id = "features" name = "features"class="form-control" rows=5 id="damage-info"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mb-5 mt-4 align-items-center">
                                <div class="d-flex align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">
                                        Submitting this survey will allow the City of Toronto to improve their website.
                                    </label>
                                </div>
                            </div>
                            <!-- change to button -->
                            <button type="submit" name ="survey" id = "survey" class="btn px-5 btn-primary">Submit Survey</button>
                        </form>
                        <?php
                        // survey submitted
                        if(isset($_POST['survey'])){
                            $navigation = $_POST['navigation'];
                            $useful = $_POST['useful'];
                            $experience = $_POST['experience'];
                            $features = $_POST['features'];
                            // blank entry
                            if($navigation == ""){
                                print("Let us know how easy it is to navigate our website");
                            }
                            elseif($useful == ""){
                                print("Let us know how useful our website it");
                            }
                            elseif($experience == ""){
                                print("Let us know about your expereience with our website");
                            }
                            else{
                            // add to datebase
                            $sqlQuery = "INSERT INTO notify_survey (navigation, useful, experience, features) VALUES ('$navigation','$useful','$experience','$features')";
                            $mysql_connect -> query($sqlQuery);
                            $message = "Your survey was successfully submitted.";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
