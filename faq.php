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
    <title>Frequently Asked Questions</title>
</head>

<body>
    <?php
    include 'header.php';
    ?>

    <div class="jumbotron" style="background-color:white">
        <div class="bg order-1 order-md-2"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-left justify-content-left">
                    <div class="col-md-10 py-5">
                        <h3><?php checkLanguage("Frequently Asked Questions", "Questions Fréquemment Posées"); ?></h3>
                    </div>

                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <?php checkLanguage("What is Cypress?", "Qu'est-ce que Cypress?"); ?>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                <div class="card-body">
                                    <?php checkLanguage("The Cypress scheme is built to encourage Torontonians to report issues they see on the streets that worry them about their neighborhood. They will also be able to monitor the progress of their dilemma from the time it is first identified before a solution is sought.", 
                                    "Le programme Cypress est conçu pour encourager les Torontois à signaler les problèmes qu'ils voient dans les rues et qui les inquiètent pour leur quartier. Ils pourront également suivre la progression de leur dilemme à partir du moment où il est identifié pour la première fois avant de rechercher une solution."); ?>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <?php checkLanguage("How do I register an account with Cypress?", "Comment créer un compte chez Cypress?"); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                                <div class="card-body">
                                    <ol>
                                        <li>
                                            <?php checkLanguage("Click on ‘Login’ at the top left corner of the navigation bar.", 
                                            "Cliquez sur «Connexion» dans le coin supérieur gauche de la barre de navigation."); ?>
                                        </li>
                                        <li>
                                            <?php checkLanguage("Click on the ‘Signup’ button located next to the ‘Login’ button.", 
                                            "Cliquez sur le bouton «Inscription» situé à côté du bouton «Connexion»."); ?>
                                        </li>
                                        <li>
                                            <?php checkLanguage("Enter ALL required information listed on the signup page.", 
                                            "Entrez TOUTES les informations requises répertoriées sur la page d'inscription."); ?>
                                        </li>
                                        <ol type = "A">
                                            <li>
                                                <?php checkLanguage("You must agree to the Cypress Terms of Service and Privacy Agreement to create an account.", 
                                                "Entrez TOUTES les informations requises répertoriées sur la page d'inscription."); ?>
                                            </li>
                                        </ol>
                                        <li>
                                            <?php checkLanguage("Click on ‘Create Account’.", "Cliquez sur «Créer un compte»."); ?>
                                            <ol type = "A">
                                                <li>
                                                    <?php checkLanguage("You will see a message prompt saying that 'Your account was successfully created.'", "
                                                    Vous verrez un message indiquant que 'Votre compte a été créé avec succès.'"); ?>
                                                </li>
                                                <li>
                                                    <?php checkLanguage("You will return back to the homepage automatically.", "
                                                    Vous reviendrez automatiquement à la page d'accueil.'"); ?>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <?php checkLanguage("How do I login to Cypress?", "Comment puis-je me connecter à Cypress?"); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" >
                                <div class="card-body">
                                    <ol>
                                        <li>
                                            <?php checkLanguage("Click on ‘Login’ at the top left corner of the navigation bar.", 
                                            "Cliquez sur «Connexion» dans le coin supérieur gauche de la barre de navigation."); ?>
                                        </li>
                                        <li>
                                            <?php checkLanguage("Enter the email and password credentials for the account you registered during signup.", 
                                            "Saisissez l'adresse e-mail et le mot de passe du compte que vous avez enregistré lors de votre inscription."); ?>
                                        </li>
                                        <li>
                                            <?php checkLanguage("Click on the ‘Login’ button located below the password, next to the ‘Signup’ button.", 
                                            "Cliquez sur le bouton «Connexion» situé sous le mot de passe, à côté du bouton «Inscription»."); ?>
                                        </li>
                                        <ol type = "A">
                                            <li>
                                                <?php checkLanguage("You will be redirected back to the main homepage.", 
                                                "Vous serez redirigé vers la page d'accueil principale."); ?>
                                            </li>
                                        </ol>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <?php checkLanguage("How do I create a city report on Cypress?", "Comment créer un rapport de ville sur Cypress?"); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" >
                                <div class="card-body">
                                    <ol>
                                        <?php checkLanguage("You can create a city report by logging into your account and following the instructions below:", 
                                        "Vous pouvez créer un rapport de ville en vous connectant à votre compte et en suivant les instructions ci-dessous:"); ?>
                                        <br>
                                        <li>
                                            <?php checkLanguage("Click on ‘Create Report’ under the ‘Reports’ tab on the top left navigation bar.", 
                                            "Cliquez sur 'Créer un rapport' sous l'onglet 'Rapports' dans la barre de navigation en haut à gauche."); ?>
                                        </li>
                                        <li>
                                            <?php checkLanguage("Click on the region where your report falls under geographically.", 
                                            "Cliquez sur la région géographique de votre rapport."); ?>
                                        </li>
                                        <li>
                                            <?php checkLanguage("Fill out the report with the required information regarding the city issue.", 
                                            "Remplissez le rapport avec les informations requises concernant le problème de la ville."); ?>
                                        </li>
                                            <ol type = "A">
                                                <li>
                                                    <?php checkLanguage("It is recommended to provide more information about the issue.", 
                                                    "Il est recommandé de fournir plus d'informations sur le problème."); ?>
                                                </li>
                                            </ol>
                                        </li>
                                        <li>
                                            <?php checkLanguage("Click on the blue button, ‘Create Report’ located at the bottom of the page.", 
                                            "Cliquez sur le bouton bleu 'Créer un rapport' situé en bas de la page."); ?>
                                         </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFive">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <?php checkLanguage("I have more questions, where do I go to contact for more information?", 
                                        "J'ai d'autres questions, où dois-je contacter pour plus d'informations?"); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" >
                                <div class="card-body">
                                <ol>
                                    <?php checkLanguage("For a list of city official’s contact information, or to get in touch for technical support, visit our ", 
                                    "Pour obtenir la liste des coordonnées des responsables de la ville ou pour contacter l'assistance technique, visitez notre "); ?>
                                    <a href="https://cypress-cdbat.000webhostapp.com/contact.php"><?php checkLanguage("Contact Us", "Nous Contacter"); ?></a> page.
                                </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

