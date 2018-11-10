<?php

require_once 'config.php';

class Mailer {

    public function SendFormEmail($postData) {
        if (isset($postData)) {
            if (!isset($postData['contact-name']) ||
                !isset($postData['contact-email']) ||
                !isset($postData['contact-message'])) {

                return "ERROR_BLANK_FIELDS";
            }

            $userName = $postData['contact-name'];
            $userEmail = $postData['contact-email'];
            $userWebsite = $postData['contact-website'];
            $userMessage = $postData['contact-message'];

            $emailRegex = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

            if (!preg_match($emailRegex, $userEmail)) {
                return "ERROR_EMAIL";
            }

            $stringRegex = "/^[A-Za-z .'-]+$/";

            if (!preg_match($stringRegex, $userName)) {
                return "ERROR_NAME";
            }

            if (strlen($userMessage) < 5) {
                return "ERROR_MESSAGE_LEN";
            }

            $emailMessage = "Form details below. \n\n";

            $emailMessage .= "Name: " . $this->CleanString($userName). "\n";
            $emailMessage .= "Email: " . $this->CleanString($userEmail) . "\n";
            $emailMessage .= "Website: " . $this->CleanString($userWebsite) . "\n";
            $emailMessage .= "Message: " .$this->CleanString($userMessage) . "\n";

            $emailHeaders = 'From: ' . from . "\r\n" .
                'Reply-To: ' . from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            if(!mail(to,subject, $emailMessage, $emailHeaders)) {
                return "GENERAL_ERROR";
            }

            return "SUCCESS";
        }

            return "NO_POST_DATA";
    }

    private function CleanString($string) {
        $badStrings = array("content-type","bcc:","to:","cc:", "href");

        return str_replace($badStrings,"", $string);
    }
}

?>