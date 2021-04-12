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
    <title>Cypress Survey</title>

</head>

<body >
<?php
include 'header.php';

?>
    <div class="jumbotron" style="background-color:white">


        <div class="bg order-1 order-md-2"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 py-5">
                        <h3><?php checkLanguage("Fill in Survey", "Remplissez le Sondage"); ?></h3>

                        <p class="mb-4">
                            <?php checkLanguage("Fill in your survey about Cypress", "Répondez à votre enquête sur Cypress"); ?>
                        </p>

                        <form name = "survey_form" id = "survey_form"action="#" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="property-damage">
                                            <?php checkLanguage("How easy is it to navigate around the website?", "
                                            Est-il facile de naviguer sur le site Web?"); ?>
                                        </label><br>
                                        <select class="form-control" name="navigation" id="navigation" onchange="loadform();">
                                            <option value=""><?php checkLanguage("--- Please select one ---", "--- S'il vous plait sélectionner en un ---"); ?></option>
                                            <option value="amazing"><?php checkLanguage("Amazing", "Étonnant"); ?></option>
                                            <option value="great"><?php checkLanguage("Great", "Génial"); ?></option>
                                            <option value="good"><?php checkLanguage("Good", "Bien"); ?></option>
                                            <option value="okay"><?php checkLanguage("Okay", "D'accord"); ?></option>
                                            <option value="bad"><?php checkLanguage("Bad", "Mal"); ?></option>
                                            <option value="horrible">Horrible</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="property-damage">
                                            <?php checkLanguage("Was this website useful?", "Ce site Web était-il utile?"); ?>
                                        </label><br>
                                        <select class="form-control" name="useful" id ="useful" onchange="loadform();">
                                            <option value=""><?php checkLanguage("--- Please select one ---", "--- S'il vous plait sélectionner en un ---"); ?></option>
                                            <option value="yes"><?php checkLanguage("Yes", "Oui"); ?></option>
                                            <option value="no"><?php checkLanguage("No", "Non"); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="property-damage"><?php checkLanguage("Were you satisfied with your experience?", "Avez-vous été satisfait de votre expérience?"); ?></label><br>
                                        <select class="form-control" name="experience" id="experience" onchange="loadform();">
                                            <option value=""><?php checkLanguage("--- Please select one ---", "--- S'il vous plait sélectionner en un ---"); ?></option>
                                            <option value="yes"><?php checkLanguage("Yes", "Oui"); ?></option>
                                            <option value="no"><?php checkLanguage("No", "Non"); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="damage-info"><b><?php checkLanguage("(OPTIONAL)", "(OPTIONNEL)"); ?></b>
                                            <?php checkLanguage("Are there any features you like us to add in the future?",
                                            "Y a-t-il des fonctionnalités que vous aimeriez que nous ajoutions à l'avenir?"); ?>
                                        </label>
                                        <textarea id="features" name="features" class="form-control" rows=5></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mb-5 mt-4 align-items-center">
                                <div class="d-flex align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">
                                        <?php checkLanguage("Submitting this survey will allow the City of Toronto to improve their website.",
                                        "La soumission de ce sondage permettra à la ville de Toronto d'améliorer son site Web."); ?>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" name="survey" id="survey" class="btn px-5 btn-primary"><?php checkLanguage("Submit Survey", "Soumettez l'Enquête"); ?></button>
                        </form>
                        <?php
                        // survey submitted
                        if (isset($_POST['survey'])) {

                            $navigation = $_POST['navigation'];
                            $useful = $_POST['useful'];
                            $experience = $_POST['experience'];
                            $features = $_POST['features'];

                            // blank entry
                            if ($navigation == "") {
                                $message = checkLanguage("Let us know how easy it is to navigate our website.", "Faites-nous savoir à quel point il est facile de naviguer sur notre site Web.");
                                print("$message");
                            }
                            elseif ($useful == "") {
                                $message = checkLanguage("Let us know how useful our website it.", "Faites-nous savoir à quel point notre site Web est utile.");
                                print($message);
                            }
                            elseif ($experience == "") {
                                $message = checkLanguage("Let us know about your experience with our website.", "Faites-nous part de votre expérience avec notre site Web.");
                                print($message);
                            }
                            else {
                                // add to datebase
                                $sqlQuery = "INSERT INTO notify_survey (navigation, useful, experience, features) VALUES ('$navigation', '$useful', '$experience', '$features')";
                                $mysql_connect -> query($sqlQuery);
                                $message = checkLanguageAlert("Your survey was successfully submitted.", "Votre enquête a été envoyée avec succès.");
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
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
<script src="scripts/notify_survey.js"></script>

</html>
