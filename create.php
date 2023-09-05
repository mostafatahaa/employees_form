<?php
require "files.php";

if (isset($_POST["submit"])) {

    if (isset($_GET["action"]) && $_GET["action"] == "edit" && isset($_GET["id"])) {
        $sql = "UPDATE user SET name = :name, email = :email, age = :age, salary = :salary, address = :address WHERE id = :id";
        $params[":id"] = $id;
        header("Location: index.php");
    } else {
        $sql = "INSERT INTO user SET name = :name, email = :email, age = :age, salary = :salary, address = :address";
    }
    $stmt = $db_connection->prepare($sql);

    if (!empty($emil) || !empty($age) || !empty($salary) || !empty($address)) {
        if ($stmt->execute($params)) {
            $msg = true;
        }
    } else {
        $error = true;
    }
}
