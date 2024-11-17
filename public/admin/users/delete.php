<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

require __DIR__ . "/../../../middlewares/authenticated.php";
require __DIR__ . "/../../../middlewares/admin.php";

$connection = new mysqli("127.0.0.1","root","","vrs");

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = $connection->query("SELECT * FROM users WHERE id=$id AND role!='admin'");
    if ($query->num_rows === 1) {
        $connection->query("DELETE FROM users WHERE id=$id");
        header("location: index.php");
    } else {
        header("location: index.php");
    }
}
?>