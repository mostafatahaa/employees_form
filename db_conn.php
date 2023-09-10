<?php

class Db
{
    public function connect_db()
    {
        $pdo = null;
        $dsn = "mysql://hostname=localhost;dbname=new_employees";
        try {
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }
        return $pdo;
    }
}

$connection = new Db();
$db_connection = $connection->connect_db();
