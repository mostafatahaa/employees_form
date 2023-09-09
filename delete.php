<?php

if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    // we use filter to return id int number so anyone can type in url id=<script>anything</script>

    if ($id > 0) {
        $sql = "DELETE  FROM user WHERE id = :id";
        $result = $db_connection->prepare($sql);
        $delete_user = $result->execute([":id" => $id]);

        if ($delete_user) {
            header("Location: index.php");
        }
    }
}
