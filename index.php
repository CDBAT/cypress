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

<!DOCTYPE html>

<html lang="en">

<?php
include 'header.php';
?>

<head>
    <meta charset="UTF-8">
    <title>CPS406 Cypress</title>
    <link rel="stylesheet" href="stylesheets/index.css"/>
</head>

<body class="text-center">

    <main id="front_page">
        <div id="page-wrap">
            <img src="/images/city-of-toronto-logo.jpg" class="img-fluid" alt="City of Toronto Logo"/>
        </div>
        
        <div>
            <form id="language_form" name="language_form" method='POST' action=''>
                <input type='text' value='' id='language' name='language' style='display:none'>
                <button type='submit' id='set_language' name='set_language' class='btn btn-lg btn-primary mx-5' onclick="setLanguage('English')">English</button>
                <button type='submit' id='set_language' name='set_language' class='btn btn-lg btn-primary mx-5' onclick="setLanguage('French')">Fran&ccedil;ais</button>
            </form>
        </div>
    </main>

</body>

<script src="scripts/index.js"></script>

<?php

if (isset($_POST['set_language'])) {
    $_SESSION['language_setting'] = $_POST['language'];

    $message = "Changed language to: " . $_SESSION['language_setting'];
    echo "<script type='text/javascript'>alert('$message');</script>";
}

?>

</html>
