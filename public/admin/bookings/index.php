<!DOCTYPE html>
<html lang="en">
<head>
<title>Vehicle Hub</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <?php require __DIR__ . "/../layouts/header.php"; ?>
</head>

<body class="app">
<header class="app-header fixed-top">
    <?php require __DIR__ . "/../layouts/navbar.php"; ?>
    <?php require __DIR__ . "/../layouts/sidebar.php"; ?>
</header><!--//app-header-->

<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Manage Bookings</h1>
            <div class="mt-5">
                <table class="table">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Booked By</th>
                        <th>Vendor</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Payment Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if ($_SESSION['user']['role'] === 'admin') {
                        $payments = $connection->query("SELECT start_date,end_date, rv.id AS rent_vehicle_id, u_vendor.name AS vendor_name, u_renter.name AS buyer_name, v.name AS vehicle_name, v.registration_number, v.description, v.price_per_hour FROM rent_vehicles rv JOIN vehicles v ON rv.vehicle_id = v.id JOIN users u_vendor ON v.vendor_id = u_vendor.id JOIN users u_renter ON rv.user_id = u_renter.id;
");
                    } else {
                        $vendorId = $_SESSION['user']['id'];
                        $payments = $connection->query("SELECT start_date,end_date, rv.id AS rent_vehicle_id, u_vendor.name AS vendor_name, u_renter.name AS buyer_name, v.name AS vehicle_name, v.registration_number, v.description, v.price_per_hour FROM rent_vehicles rv JOIN vehicles v ON rv.vehicle_id = v.id JOIN users u_vendor ON v.vendor_id = u_vendor.id JOIN users u_renter ON rv.user_id = u_renter.id WHERE v.vendor_id=$vendorId");
                    }
                    $sn = 1;
                    $payments = mysqli_fetch_all($payments, MYSQLI_ASSOC);
                    foreach ($payments as $payment):
                        $p = $connection->query("SELECT * FROM payments WHERE rent_vehicle_id={$payment['rent_vehicle_id']}")->fetch_assoc();
                        ?>
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $payment['buyer_name'] ?></td>
                            <td><?= $payment['vendor_name'] ?></td>
                            <td><?= $payment['start_date'] ?></td>
                            <td><?= $payment['end_date'] ?></td>
                            <td><?= $p ? "Paid" : "Remaining" ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>SN</th>
                        <th>Booked By</th>
                        <th>Vendor</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Payment Status</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><!--//container-fluid-->
    </div><!--//app-content-->

   

</div><!--//app-wrapper-->
<?php require __DIR__ . "/../layouts/footer.php"; ?>

</body>
</html>

