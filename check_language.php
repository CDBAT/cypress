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
?>
