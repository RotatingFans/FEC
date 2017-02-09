<?php
require_once 'Database.php';
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 11/29/16
 * Time: 7:35 PM
 */
class Packages
{
    public static function addSection($section)
    {
        $conn = Database::getCon();
        if ($conn) {
            $stmt = $conn->prepare("INSERT INTO Sections (name) VALUES (:name)");
            $stmt->bindParam(":name", $section);
            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;
    }

    public static function editSection($oldSection, $newSection)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("UPDATE Sections SET name=:newName WHERE name=:oldName");
            $stmt->bindParam(":newName", $newSection);
            $stmt->bindParam(":oldName", $oldSection);

            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;


    }

    public static function deleteSection($section)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("DELETE FROM Sections WHERE name=:secName");
            $stmt->bindParam(":secName", $section);
            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;

    }

    public static function getPackage($id)
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM Packages WHERE pID=:pID");
            $stmt->bindParam(':pID', $id);
            $stmt->execute();
            $items = $stmt->fetch();

            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $items;
    }
    public static function getPackages()
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM Packages ");
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