<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

require __DIR__ . "/../../../middlewares/authenticated.php";
require __DIR__ . "/../../../middlewares/vendor.php";

$connection = new mysqli("127.0.0.1","root","","vrs");

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $userId = $_SESSION['user']['id'];
    $query = $connection->query("SELECT * FROM vehicles WHERE id=$id AND vendor_id=$userId");
    if ($query->num_rows === 1) {
        $connection->query("DELETE FROM vehicles WHERE id=$id");
        $vehicle = $query->fetch_assoc();
        unlink('../../uploads/' . $vehicle['image']);
        header("location: index.php");
    } else {
        header("location: index.php");
    }
}
?>