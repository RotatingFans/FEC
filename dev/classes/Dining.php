<?php
require_once 'Database.php';
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 11/27/16
 * Time: 8:27 PM
 */
class Dining
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

    public static function addMenuItem($item, $cost, $section, $available, $pSec, $package, $pDiscount)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("INSERT INTO menuItems (name, cost, availability, section, pSection, package, pDiscount) VALUES (:Name,:cost,:availability,:sec, :pSec, :pack, :pDis)");
            $stmt->bindParam(":Name", $item);
            $stmt->bindParam(":cost", $cost);
            $stmt->bindParam(":availability", $available);
            $stmt->bindParam(":sec", $section);
            $stmt->bindParam(":pSec", $pSec);
            $stmt->bindParam(":pack", $package);
            $stmt->bindParam(":pDis", $pDiscount);

            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;

    }

    public static function UpdateMenuItem($olditem, $newItem, $cost, $section, $available, $pSec, $package, $pDiscount)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("UPDATE menuItems SET name=:newName, cost=:cost, availability=:availability, section=:sec, pSection=:pSec, package=:pack, pDiscount=:pDis WHERE name=:oldName");
            $stmt->bindParam(":newName", $newItem);
            $stmt->bindParam(":cost", $cost);
            $stmt->bindParam(":availability", $available);
            $stmt->bindParam(":sec", $section);
            $stmt->bindParam(":oldName", $olditem);
            $stmt->bindParam(":pSec", $pSec);
            $stmt->bindParam(":pack", $package);
            $stmt->bindParam(":pDis", $pDiscount);
            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;

    }

    public static function removeMenuItem($item)
    {
        $conn = Database::getCon();

        if ($conn) {
            $stmt = $conn->prepare("DELETE FROM menuItems WHERE name=:name");
            $stmt->bindParam(":name", $item);
            $stmt->execute();


        } else {
            echo 'error. Please contact support';
        }
        $conn = null;

    }

    public static function getMenuItem($id)
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM menuItems where ID=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $items = $stmt->fetch();

            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $items;
    }
    public static function getMenuItems($sections = '*')
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM menuItems where section=:secId");
            $stmt->bindParam(':secId', $sections);
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $items;
    }

    public static function getPackageMenuItems($pSection)
    {
        $conn = Database::getCon();
        $items = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM menuItems where pSection=:secId AND package=1");
            $stmt->bindParam(':secId', $pSection);
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $items;
    }
    public static function getSections()
    {
        $conn = Database::getCon();
        $sections = array();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM Sections");
            $stmt->execute();
// set the resulting array to associative
            $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
        } else {
            echo 'error. Please contact support';
        }

        $conn = null;

        return $sections;
    }

    public static function getSectionID($section)
    {
        $conn = Database::getCon();
        $secId = 0;
        if ($conn) {
            $stmt = $conn->prepare("SELECT ID FROM Sections WHERE name=:name");
            $stmt->bindParam(":name", $section);
            $stmt->execute();
            $secId = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } else {
            echo 'error. Please contact support';
        }
        $conn = null;

        return $secId;


    }
}