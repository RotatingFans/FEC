<?php
require_once 'Database.php';

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 11/27/16
 * Time: 8:26 PM
 *  cName VARCHAR(255) NOT NULL,
 * cEmail VARCHAR(255) NOT NULL,
 * cPhone VARCHAR(32) NOT NULL,
 * PackageID INT NOT NULL,
 * rDate DATE NOT NULL,
 * rStart TIME NOT NULL,
 * rEnd TIME NOT NULL,
 * guests INT NOT NULL,
 * rTotal
 *  cName ,cEmail,cPhone ,PackageID ,rDate,rStart ,rEnd ,guests ,rTotal
 * $cName ,$cEmail, $cPhone, $PackageID, $rDate , $rStart, $rEnd,  $guests ,  $rTotal
 */
class Reservations
{

    public static function addReservation($cName, $cEmail, $cPhone, $PackageID, $rDate, $rStart, $rEnd, $guests, $rTotal, $foodID, $foodAmt, $drinkID, $eventID = null, $amtRes = null)
    {
        $id = 0;
        $conn = Database::getCon();
        if ($conn) {
            $stmt = $conn->prepare("INSERT INTO Reservations (cName ,cEmail,cPhone ,PackageID , amtRes, rDate,rStart ,rEnd ,guests ,rTotal, foodID, foodAmt, drinkID, eventID) 
VALUES (:cName ,:cEmail, :cPhone, :PackageID, :amtRes, :rDate , :rStart, :rEnd,  :guests , :rTotal,:foodID,:foodAmt,:drinkID, :eventID)");
            $stmt->bindParam(":cName", $cName);
            $stmt->bindParam(":cEmail", $cEmail);
            $stmt->bindParam(":cPhone", $cPhone);
            $stmt->bindParam(":PackageID", $PackageID);
            $stmt->bindParam(":amtRes", $amtRes);

            $stmt->bindParam(":rDate", $rDate);
            $stmt->bindParam(":rStart", $rStart);
            $stmt->bindParam(":rEnd", $rEnd);
            $stmt->bindParam(":guests", $guests);
            $stmt->bindParam(":foodID", $foodID);
            $stmt->bindParam(":foodAmt", $foodAmt);
            $stmt->bindParam(":drinkID", $drinkID);
            $stmt->bindParam(":eventID", $eventID);

            $stmt->bindParam(":rTotal", $rTotal);

            $stmt->execute();
            $id = $conn->lastInsertId();

        } else {
            echo 'error. Please contact support';
        }
        $conn = null;
        return $id;
    }

    public static function editReservation($cName, $cEmail, $cPhone, $PackageID, $rDate, $rStart, $rEnd, $guests, $rTotal, $oldId, $oEmail, $foodID, $foodAmt, $drinkID, $eventID = null, $amtRes)
    {
        $conn = Database::getCon();

        if ($conn) {

            $stmt = $conn->prepare("UPDATE Reservations SET cName=:cName, cEmail=:cEmail, cPhone=:cPhone, PackageID=:PackageID, amtRes=:amtRes, rDate=:rDate, rStart=:rStart, rEnd=:rEnd, guests=:guests, rTotal=:rTotal, foodID=:foodID, foodAmt=:foodAmt, drinkID=:drinkID, eventID=:eventID WHERE ReservationID=:oldID AND cEmail=:oEmail");
            $stmt->bindParam(":cName", $cName);
            $stmt->bindParam(":cEmail", $cEmail);
            $stmt->bindParam(":cPhone", $cPhone);
            $stmt->bindParam(":PackageID", $PackageID);
            $stmt->bindParam(":amtRes", $amtRes);

            $stmt->bindParam(":rDate", $rDate);
            $stmt->bindParam(":rStart", $rStart);
            $stmt->bindParam(":rEnd", $rEnd);
            $stmt->bindParam(":guests", $guests);
            $stmt->bindParam(":foodID", $foodID);
            $stmt->bindParam(":foodAmt", $foodAmt);
            $stmt->bindParam(":drinkID", $drinkID);
            $stmt->bindParam(":eventID", $eventID);

            $stmt->bindParam(":rTotal", $rTotal);
            $stmt->bindParam(":oldID", $oldId);
            $stmt->bindParam(":oEmail", $oEmail);

            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;


    }

    public static function deleteReservation($cEmail, $rID)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("DELETE FROM Reservations WHERE cEmail=:cEmail AND ReservationID=:rID");
            $stmt->bindParam(":cEmail", $cEmail);
            $stmt->bindParam(":rID", $rID);

            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;

    }

    public static function getReservation($cName, $rID)
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM Reservations where cName=:cName AND ReservationID=:rID");
            $stmt->bindParam(":cName", $cName);
            $stmt->bindParam(":rID", $rID);
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $items;
    }

    public static function getReservations($includeEvents)
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            if ($includeEvents) {
                $stmt = $conn->prepare("SELECT PackageID, rDate, rStart, rEnd,amtRes FROM Reservations");

            } else {
                $stmt = $conn->prepare("SELECT PackageID, rDate, rStart, rEnd, amtRes FROM Reservations WHERE eventID IS NULL");

            }
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $items;
    }
}