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

// Stores contact info in arrays
$position = array("Office of Mayor", "Accounting Services", "City Planning", "Court Services", "Engineering & Construction Services", "Fire Services", "Indigenous Affairs Office", "Legal Services", "Ombudsman Toronto", "Parks, Forestry & Recreation");
$name = array("Mayor John Tory", "Lor Nikolajsen", "Daichi Sawamura", "Caterina Krall", "Emanuel Del Rio", "Aadan Quinlan", "Alda Magro", "Kristeen Bengtsson", "Susan Waltz", "Connor Hayes");
$telephone = array("416-111-1111", "416-111-1111", "416-111-1111", "416-111-1111", "416-111-1111", "416-111-1111", "416-111-1111", "416-111-1111", "416-111-1111", "416-111-1111");
$email = array("mayor@toronto.ca", "accounting@toronto.ca", "cityplanning@toronto.ca", "courtservices@toronto.ca", "engineering@toronto.ca", "fire@toronto.ca", "indigenousaffairs@toronto.ca", "legal@toronto.ca", "ombudsman@toronto.ca", "Parks, Forestry & Recreation");

?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact Us</title>
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
                        <h3><?php checkLanguage("Contact Us", "Nous Contacter"); ?></h3>
                        <img src="/images/contact.PNG" alt="Contact Image"/>
                    </div>

                    <div class="col-md-10 py-3">
                        <p class='mb-2'><u><b><?php checkLanguage("Address", "Adresse"); ?></b></u></p>
                        <p><b>Toronto City Hall</b></p>
                        <p>100 Queen St. W</p>
                        <p>Toronto, ON</p>
                        <p>M5H 2N2</p>
                    </div>

                    <div class="col-md-10 py-3">
                        <p class='mb-2'><u><b><?php checkLanguage("General Contact Information", "Coordonnées Générales"); ?></b></u></p>
                        <p><b><?php checkLanguage("Telephone: ", "Téléphone: "); ?></b>311</p>
                        <p><b>TTY: </b>416-444-4TTY (4889)</p>
                        <p><b>Fax: </b>416-555-555</p>
                        <p><b>Email: </b>city@toronto.ca</p>
                    </div>

                    <div class="col-md-10 py-3">
                        <p class='mb-2'><u><b><?php checkLanguage("Hours of Operation", "Heures d'Ouverture"); ?></b></u></p>
                        <p><b><?php checkLanguage("Weekdays: ", "Jours de la Semaine: "); ?></b>8:30 a.m. to 4:30 p.m.</p>
                        <p><b><?php checkLanguage("Weekends & Holidays: ", "Week-ends et Jours Fériés:"); ?></b>8 a.m. to 6 p.m.</p>
                    </div>

                    <?php
                    for ($index = 0; $index < count($position); $index++) {
                        print("<div class='col-md-10 py-3'>");
                            printf("<p class='mb-2'><b>%s</b></p>\n", $position[$index]);
                            printf("<p>%s</p>\n", $name[$index]);
                            printf("<p'><b>T: </b>%s</p>\n", $telephone[$index]);
                            printf("<p'><b>E: </b>%s</p>\n", $email[$index]);
                        print("</div>");
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>