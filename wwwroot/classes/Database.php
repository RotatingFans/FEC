<?php
require_once 'Database.php';

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 11/27/16
 * Time: 8:26 PM
 */
include_once 'config.php';
class Database
{

    public static function getCon()
    {

        $conn = self::connect(host, username, password, dbName, port, socket);
        if ($conn) {
            return $conn;
        }
    }

    /**
     * @param string $host
     * @param $username
     * @param $password
     * @param $database
     * @param $port
     * @param $socket
     * @return connection
     * @internal param null $conn
     */

    private static function connect($host = 'localhost', $username, $password, $database, $port, $socket)
    {
// PHP Data Objects(PDO) Sample Code:
        try {
            $conn = new PDO($socket . ":server = " . $host . ',' . $port . "; Database = " . $database, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $conn = 0;
        }

        return $conn;
    }
}