<?php
require "db_conn.php";

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_NUMBER_INT);
$salary = filter_input(INPUT_POST, "salary", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$address = filter_input(INPUT_POST, "address");
$name = filter_input(INPUT_POST, "name");
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$counter = 0;

$params = [
    ":email" => $email,
    ":age" => $age,
    ":salary" => $salary,
    ":address" => $address,
    ":name" => $name
];

$user_info = new User($name, $email, $age, $salary, $address);
$connection = new Db();
$db_connection = $connection->connect_db();
