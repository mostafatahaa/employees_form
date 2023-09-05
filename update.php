<?php

if (isset($_GET["action"]) && $_GET["action"] == "edit" && isset($_GET["id"])) {
    // we use filter to return id int number so anyone can type in url id=<script>anything</script>
    if ($id > 0) {
        $sql = "SELECT * FROM user WHERE id = :id";
        $result = $db_connection->prepare($sql);
        $found_user = $result->execute([":id" => $id]);
        if ($found_user) {
            $user = $result->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User", ['name', 'email', 'age', 'salary', 'address']);
            $user = array_shift($user);
        }
    }
}
