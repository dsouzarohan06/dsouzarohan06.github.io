<?php

require_once 'Mailer.php';

if ($_POST) {
    $mailer = new Mailer();
    $result = $mailer->SendFormEmail($_POST);
    $message = "";

    switch ($result) {
        case "ERROR_BLANK_FIELDS":
            $message = "Error: Some Fields were left blank.";
            break;

        case "ERROR_EMAIL":
            $message = "Error: Please enter a valid email address.";
            break;

        case "ERROR_NAME":
            $message = "Error: Please enter a valid name";
            break;

        case "ERROR_MESSAGE_LEN":
            $message = "Error: Message must be at least five characters";
            break;

        case "GENERAL_ERROR":
            $message = "Error: An Unknown error occurred. Please try again.";
            break;

        case "NO_POST_DATA":
            $message = "Error: No valid post information was sent";
            break;

        case "SUCCESS":
            $message = "SUCCESS";
            break;
    }

    echo $message;
}

?>