<?php
require_once 'Database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 11/27/16
 * Time: 8:27 PM
 * ID
 * Name
 * ImgSrc
 * Description
 * Date
 * sTime
 * eTime
 * Cost
 * UnitItem
 * packageId
 */
class Events
{
    public static function addEvent($Event, $ImgSrc, $description, $date, $sTime, $eTime, $cost, $uItem, $pID, $availability)
    {
        $conn = Database::getCon();
        if ($conn) {
            $stmt = $conn->prepare("INSERT INTO Events (name, imgSrc, description, date, sTime, eTime, cost, uItem, pID, availability) VALUES (:name,:imgSrc, :description, :date, :sTime, :eTime, :cost, :uItem, :pID, :availability)");
            $stmt->bindParam(":name", $Event);
            $stmt->bindParam(":imgSrc", $ImgSrc);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":sTime", $sTime);
            $stmt->bindParam(":eTime", $eTime);
            $stmt->bindParam(":cost", $cost);
            $stmt->bindParam(":uItem", $uItem);
            $stmt->bindParam(":pID", $pID);
            $stmt->bindParam(":availability", $availability);


            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;
    }

    public static function editEvent($oldEvent, $newEvent, $ImgSrc, $description, $date, $sTime, $eTime, $cost, $uItem, $pID, $availability)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("UPDATE Events SET name=:newName,imgSrc=:imgSrc, description=:description, date=:date, sTime=:sTime, eTime=:eTime, cost=:cost, uItem=:uItem, pID=:pID, availability=:availability WHERE name=:oldName");
            $stmt->bindParam(":newName", $newEvent);
            $stmt->bindParam(":oldName", $oldEvent);
            $stmt->bindParam(":imgSrc", $ImgSrc);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":sTime", $sTime);
            $stmt->bindParam(":eTime", $eTime);
            $stmt->bindParam(":cost", $cost);
            $stmt->bindParam(":uItem", $uItem);
            $stmt->bindParam(":pID", $pID);
            $stmt->bindParam(":availability", $availability);

            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;


    }

    public static function deleteEvent($Event)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("DELETE FROM Events WHERE name=:event");
            $stmt->bindParam(":event", $Event);
            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;

    }

    public static function getEvents()
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM Events WHERE getutcdate() < date");
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $items;
    }

    public static function getEvent($eID = '*')
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM Events where eID=:eID");
            $stmt->bindParam(':eID', $eID);
            $stmt->execute();
            $items = $stmt->fetch();

            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $items;
    }
}