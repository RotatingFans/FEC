
        <?php
        require '../sendGrid/sendgrid-php.php';
        require '../classes/config.php';
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/

        /**
         * Created by PhpStorm.
         * User: patrick
         * Date: 11/30/16
         * Time: 4:36 PM
         */

        $cName = $_POST["Name"];
        $cEmail = $_POST["Email"];
        $cPhone = $_POST['Phone'];
        $message = $_POST["message"];


        $from = new SendGrid\Email($cName, $cEmail);
        $subject = "New Support Message";
        $content = new SendGrid\Content("text/html", "");
        $mail = new SendGrid\Mail();
        $mail->setFrom($from);
        $mail->setSubject($subject);
        $pers = new SendGrid\Personalization();
        $to = new SendGrid\Email('Customer Support', supportEmail);

        $pers->addTo($to);
        $pers->addSubstitution('%cName%', $cName);
        $pers->addSubstitution('%cEmail%', $cEmail);
        $pers->addSubstitution('%message%', $message);
        $pers->addSubstitution('%phone%', $cPhone);

        $pers->addCustomArg('template_id', '9a802c24-f60a-4efc-a777-0bc2b21808a6');
        $sg = new \SendGrid(apiKey);
        $mail->addPersonalization($pers);
        $mail->setTemplateId('9a802c24-f60a-4efc-a777-0bc2b21808a6');
        $response = $sg->client->mail()->send()->post($mail);
        if ($response->statusCode() != 202) {
            http_response_code(200);
        } else {
            http_response_code(304);
        }
        ?>



