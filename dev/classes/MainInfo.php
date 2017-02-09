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
 *
 * MainInfo:
 * ID
 * Key
 * Val
 *
 * Images:
 * ID
 * Src
 * Caption
 *
 */
class MainInfo
{
    public static function getHours()
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("SELECT * FROM normHrs");

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }

    public static function setHour($day, $sTime, $eTime)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("UPDATE normHrs SET sTime=:sTime, eTime=:eTime WHERE dWeek=:dWeek");

        $stmt->bindParam(':dWeek', $day);
        $stmt->bindParam(':sTime', $sTime);
        $stmt->bindParam(':eTime', $eTime);

        $stmt->execute();
    }

    public static function addSpecHour($date, $sTime, $eTime)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("INSERT INTO specialHrs(date, sTime, eTime) VALUES (:date, :sTime, :eTime)");

        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':sTime', $sTime);
        $stmt->bindParam(':eTime', $eTime);

        $stmt->execute();
    }

    public static function removeSpecHour($date)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("DELETE FROM specialHrs WHERE date=:date");
        $stmt->bindParam(":date", $date);
        $stmt->execute();

        $stmt->execute();
    }

    public static function addImage($src, $caption)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("INSERT INTO Images(src, caption) VALUES (:src, :caption)");

        $stmt->bindParam(':src', $src);
        $stmt->bindParam(':caption', $caption);

        $stmt->execute();
    }

    public static function removeImage($ID)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("DELETE FROM Images WHERE imgID=:imgId");
        $stmt->bindParam(":imgId", $ID);
        $stmt->execute();

        $stmt->execute();
    }

    public static function editImage($src, $caption, $id)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("UPDATE Images SET src=:src, caption=:caption WHERE imgID=:imgID");

        $stmt->bindParam(':src', $src);
        $stmt->bindParam(':caption', $caption);
        $stmt->bindParam(':imgID', $id);

        $stmt->execute();
    }

    public static function getImgs()
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("SELECT * FROM Images");

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }

    public static function getDescription()
    {
        return MainInfo::getInfo('Description');
    }

    public static function getInfo($key)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("SELECT val FROM MainInfo WHERE oKey=:key");

        $stmt->bindParam(':key', $key);
        $stmt->execute();
        $items = $stmt->fetch();
        return $items;
    }

    /*    public static function setRssURL($URL){
            $this->setInfo('rssUrl', $URL);
        }
        public static function getRss(){
            return $this->getInfo('rssUrl');
        }*/

    public static function setDescription($description)
    {
        MainInfo::setInfo('Description', $description);
    }

    public static function setInfo($key, $val)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("UPDATE Maininfo SET val=:val WHERE oKey=:key");
        $stmt->bindParam(':val', $val);

        $stmt->bindParam(':key', $key);
        $stmt->execute();
    }

    public static function addUpdate($sDate, $eDate, $Content, $title)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("INSERT INTO Updates(sDate, eDate, Content, Title) VALUES (:sDate, :eDate, :content, :title)");

        $stmt->bindParam(':sDate', $sDate);
        $stmt->bindParam(':eDate', $eDate);
        $stmt->bindParam(':content', $Content);
        $stmt->bindParam(':title', $title);

        $stmt->execute();
    }

    public static function editUpdate($id, $sDate, $eDate, $Content, $title)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("UPDATE Updates SET sDate=:sDate, eDate=:eDate, content=:content, title=:title WHERE uID=:uID");
        $stmt->bindParam(':sDate', $sDate);
        $stmt->bindParam(':eDate', $eDate);
        $stmt->bindParam(':content', $Content);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':uId', $id);

        $stmt->execute();
    }

    public static function deleteUpdate($id)
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("DELETE FROM Updates WHERE uID=:uID");
        $stmt->bindParam(":uID", $id);
        $stmt->execute();

        $stmt->execute();
    }

    public static function getUpdates()
    {
        $conn = Database::getCon();

        $stmt = $conn->prepare("SELECT * FROM Updates WHERE getutcdate() > sDate AND getutcdate() < eDate");

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }



}