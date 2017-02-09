<?php
require_once 'Database.php';
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 11/30/16
 * Time: 7:27 PM
 */
$date = strtotime($_POST["date"],0);
$fDateStr = strftime("%Y-%m-%d", $date);
if ($date == null) {
    $return['status'] = 'error';

} else {
    $conn = Database::getCon();
    $items = array();
    $return = array();
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM specialHrs WHERE date=:date");
        $stmt->bindParam(':date', $fDateStr);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);


    } else {
        $return['status'] = 'error';
    }
    if ($items == null) {
        $day_of_the_week = date('w', $date);
        $stmt = $conn->prepare("SELECT * FROM normHrs WHERE dWeek=:dWeek");

        $stmt->bindParam(':dWeek', $day_of_the_week);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    $conn = null;
    $begin = new DateTime($items[0]['oTime']);
    $end = new DateTime($items[0]['eTime']);

    $interval = new DateInterval('PT30M');
    $period = new DatePeriod($begin, $interval, $end);
    $timesV = array();
    $timesL = array();
    $times = 0;
    foreach ($period as $dt) {
        array_push($timesV, $dt->format("H:i"));
        array_push($timesL, $dt->format("g:i A"));
        $times++;
    }
    $return['Val'] = $timesV;
    $return['Loc'] = $timesL;
    $return['times'] = $times;
}
echo json_encode($return);