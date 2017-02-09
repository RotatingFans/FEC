<?php
require_once '../classes/Reservations.php';
require_once '../classes/Packages.php';
require_once '../classes/Dining.php';
require_once '../classes/Events.php';

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
$action = $_POST["action"];
$cName = $_POST["cName"];
$cEmail = $_POST["cEmail"];
$cPhone = $_POST["cPhone"];
$rDate = $_POST["rDate"];
$rStart = $_POST["rStart"];
$rEnd = $_POST["rEnd"];
$guests = $_POST["guests"];
if ($action != 'eventAdd') {

    $foodID = $_POST['foodChoice'];
    $foodAmt = $_POST['numberFood'];
    $drinkID = $_POST['drinkChoice'];
    if ($foodID != 0) {
        $foodCost = Dining::getMenuItem($foodID)['cost'] * $foodAmt;
        $drink = Dining::getMenuItem($drinkID);
        $drinkCost = $drink['cost'] - $drink['pDiscount'];
    }
    else {
        $foodCost = 0;
        $drinkCost = 0;
    }

    $PackageID = $_POST["pID"];

    $rID = $_POST["rID"];
    $oEmail = $_POST["oEmail"];
    $package = Packages::getPackage($PackageID);

    $pCost = 0;
    $hours = (strtotime($rEnd) - strtotime($rStart)) / 3600;
    $amtRes = ($guests - ($guests % $package['perRes'])) / $package['perRes'];
    if ($guests < $package['perRes']) $amtRes = 1;
    switch ($package['unitItem']) {
        case "Hour":
            $pCost = $hours * $package['cost'];
            break;
        case "Person":
            $pCost = $guests * $package['cost'];
            break;
        case "Hour/Person":
            $pCost = $hours * $guests * $package['cost'];

            break;
    }
    $rTotal = $pCost + $foodCost + $drinkCost;
    switch ($action) {
        case "add":
            $id = Reservations::addReservation($cName, $cEmail, $cPhone, $PackageID, $rDate, $rStart, $rEnd, $guests, $rTotal, $foodID, $foodAmt, $drinkID, null, $amtRes);
            $from = new SendGrid\Email('FEC', 'patmagauran.j@gmail.com');
            $subject = "Your Reservation has been confirmed!";
            $content = new SendGrid\Content("text/html", "</b");
            $mail = new SendGrid\Mail();
            $mail->setFrom($from);
            $mail->setSubject($subject);
            $pers = new SendGrid\Personalization();
            $to = new SendGrid\Email($cName, $cEmail);

            $pers->addTo($to);
            $pers->addSubstitution('%event%', $package['name']);

            $pers->addSubstitution('%date%', $rDate);
            $pers->addSubstitution('%timeS%', $rStart);
            $pers->addSubstitution('%timeE%', $rEnd);

            $pers->addSubstitution('%ID%', $id);
            $pers->addSubstitution('%cost%', "$rTotal");

            $pers->addCustomArg('template_id', '6cc777df-03ee-47bc-8f09-29a2a071e59b');
            $sg = new \SendGrid(apiKey);
            $mail->addPersonalization($pers);
            $mail->setTemplateId('6cc777df-03ee-47bc-8f09-29a2a071e59b');
            $response = $sg->client->mail()->send()->post($mail);
            if ($response->statusCode() != 202) {
                print_r($response);
                echo $response->statusCode();
                echo $response->headers();
                echo $response->body();
            }

            break;
        case "edit":
            Reservations::editReservation($cName, $cEmail, $cPhone, $PackageID, $rDate, $rStart, $rEnd, $guests, $rTotal, $rID, $oEmail);

            break;
        case "delete":
            Reservations::deleteReservation($cEmail, $rID);

            break;
        case "get":
            Reservations::getReservations($cName = '*', $rID);
            break;
    }
} else {
    $eventID = $_POST['eID'];
    $event = Events::getEvent($eventID);
    $uCost = $event['cost'];
    $rTotal = $uCost * $guests;
    $id = Reservations::addReservation($cName, $cEmail, $cPhone, null, $rDate, $rStart, $rEnd, $guests, $rTotal, null, null, null, $eventID);
    $from = new SendGrid\Email('FEC', 'patmagauran.j@gmail.com');
    $subject = "Your Reservation has been confirmed!";
    $content = new SendGrid\Content("text/html", "</b");
    $mail = new SendGrid\Mail();
    $mail->setFrom($from);
    $mail->setSubject($subject);
    $pers = new SendGrid\Personalization();
    $to = new SendGrid\Email($cName, $cEmail);

    $pers->addTo($to);
    $pers->addSubstitution('%event%', $event['name']);
    $pers->addSubstitution('%date%', $rDate);
    $pers->addSubstitution('%timeS%', $rStart);
    $pers->addSubstitution('%timeE%', $rEnd);

    $pers->addSubstitution('%ID%', $id);
    $pers->addSubstitution('%cost%', "$rTotal");

    $pers->addCustomArg('template_id', '6cc777df-03ee-47bc-8f09-29a2a071e59b');
    $sg = new \SendGrid(apiKey);
    $mail->addPersonalization($pers);
    $mail->setTemplateId('6cc777df-03ee-47bc-8f09-29a2a071e59b');
    $response = $sg->client->mail()->send()->post($mail);
    if ($response->statusCode() != 202) {
        print_r($response);
        echo $response->statusCode();
        echo $response->headers();
        echo $response->body();
    }
}
