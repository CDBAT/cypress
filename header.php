<head>
    <!-- bootstrap files  -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/stylesheets/header.css"/>
</head>

<?php
    function checkLanguage($englishWord, $frenchWord) {
        if (isset($_SESSION['language_setting'])) {
            if ($_SESSION['language_setting'] == 'English') {
                print($englishWord);
            }
            elseif ($_SESSION['language_setting'] == 'French') {
                print($frenchWord);
            }
        }
        else { print($englishWord); }
    }
    function checkLanguageAlert($englishWord, $frenchWord) {
        if (isset($_SESSION['language_setting'])) {
            if ($_SESSION['language_setting'] == 'English') {
                return($englishWord);
            }
            elseif ($_SESSION['language_setting'] == 'French') {
                return($frenchWord);
            }
        }
        else { return($englishWord); }
    }
?>

<!-- bootstrap nav bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="https://cypress-cdbat.000webhostapp.com/index.php">CYPRESS</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/index.php"><?php checkLanguage("Home", "Domicile"); ?><span class="sr-only">(current)</span></a>
            </li>

            <!-- check if user needs to login -->
            <?php
                if (!isset($_SESSION['email'])) {
            ?>

            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/login.php"><?php checkLanguage("Login", "Connexion"); ?></a>
            </li>

            <?php
                }
                // user login
                if (isset($_SESSION['email'])) {
            ?>

            <!-- drop downs -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php checkLanguage("Reports", "Rapports"); ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="https://cypress-cdbat.000webhostapp.com/create_report.php"><?php checkLanguage("Create Report", "Creer un Rapport"); ?></a>
                    <a class="dropdown-item" href="https://cypress-cdbat.000webhostapp.com/edit_report_group.php"><?php checkLanguage("Edit Report", "Modifier le Rapport"); ?></a>
                    <a class="dropdown-item" href="https://cypress-cdbat.000webhostapp.com/delete_report_group.php"><?php checkLanguage("Delete Report", "Supprimer le Rapport"); ?></a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/rankings.php"><?php checkLanguage("Rankings", "Classements"); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/suggest.php"><?php checkLanguage("Suggest", "Suggèrer"); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/notify_survey.php"><?php checkLanguage("Notify Survey", "Notifier l'Enquête"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/vote.php"><?php checkLanguage("Vote", "Vote"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/friend.php"><?php checkLanguage("Friend", "amie"); ?></a>
            </li>
            <!-- end php -->
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/faq.php">FAQ</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/contact.php"><?php checkLanguage("Contact", "Contacter"); ?></a>
            </li>

        </ul>

        <?php
            // user login
            if (isset($_SESSION['email'])) {
        ?>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/account_settings.php"><?php checkLanguage("Account Settings", "Paramètres du Compte"); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/delete_account.php"><?php checkLanguage("Delete Profile", "Supprimer le Profil"); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/logout.php"><?php checkLanguage("Logout", "Se Déconnecter"); ?></a>
            </li>
        </ul>

        <?php } ?>
    </div>
</nav>
