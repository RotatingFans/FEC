<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 12/4/2016
 * Time: 10:02 PM
 */
include_once '../classes/Calandar.php';
require_once '../classes/Reservations.php';
require_once '../classes/Packages.php';
$time = strtotime($_GET['time']);
$cal = new Calandar($time);
$Reservations = Reservations::getReservations(false);
foreach ($Reservations as $Reservation) {
    $package = Packages::getPackage($Reservation['PackageID']);
    $date = strtotime($Reservation['rDate']) + 57600;
    $sTime = strtotime($Reservation['rStart'], 0) + $date;
    $eTime = strtotime($Reservation['rEnd'], 0) + $date;
    $cal->addReservation($Reservation['amtRes'] . ' ' . $package['itemRes'] . ' (s)' . $package['name'], $sTime, $eTime, '');
    // $cal->addReservation('2 Bowling Lanes reserved', 1480118400, 1480129200, 'Bowling');

}

// $cal->addReservation('2 Bowling Lanes reserved', 1480118400, 1480129200, 'Bowling');
echo $cal->draw();