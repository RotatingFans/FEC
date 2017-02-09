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
 * Image src
 * description
 *
 */
class Activities
{
    public static function addactivity($activity, $img, $description)
    {
        $conn = Database::getCon();
        $stmt = $conn->prepare("INSERT INTO activities (name, imgSrc, description) VALUES (:name, :imgSrc, :description)");
        $stmt->bindParam(":name", $activity);
        $stmt->bindParam(":imgSrc", $img);
        $stmt->bindParam(":description", $description);

            $stmt->execute();


        $conn = null;
    }

    public static function editactivity($oldactivity, $newactivity, $img, $description)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("UPDATE activities SET name=:newName, imgSrc=:imgSrc, description=:description WHERE name=:oldName");
            $stmt->bindParam(":newName", $newactivity);
            $stmt->bindParam(":oldName", $oldactivity);
            $stmt->bindParam(":imgSrc", $img);
            $stmt->bindParam(":description", $description);
            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;


    }

    public static function deleteactivity($activity)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("DELETE FROM activities WHERE name=:activity");
            $stmt->bindParam(":activity", $activity);
            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;

    }

    public static function getActivities()
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM activities");
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