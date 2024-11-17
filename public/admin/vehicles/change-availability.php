<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

require __DIR__ . "/../../../middlewares/authenticated.php";
require __DIR__ . "/../../../middlewares/vendor.php";

$connection = new mysqli('127.0.0.1','root','','vrs');

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $vendor_id = $_SESSION['user']['id'];
    $query = $connection->query("SELECT * FROM vehicles WHERE id=$id AND vendor_id=$vendor_id");
    if ($query->num_rows === 1) {
        $availabilty = !$query->fetch_assoc()['is_available'];
        $connection->query("UPDATE vehicles SET is_available='$availabilty' WHERE id=$id AND vendor_id=$vendor_id");
        header("location: index.php");
    } else {
        header("location: index.php");
    }
}
?>