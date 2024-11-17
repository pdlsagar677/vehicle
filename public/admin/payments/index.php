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
            <h1 class="app-page-title">Manage Payments</h1>
            <div class="mt-5">
                <table class="table">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Car Name</th>
                        <th>Vendor</th>
                        <th>Renter</th>
                        <th>Amount</th>
                        <th>Transaction Code</th>
                        <th>Paid At</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if ($_SESSION['user']['role'] === 'admin') {
                        $payments = $connection->query("SELECT amount,transaction_code,paid_at, u_renter.name AS renter_name, u_vendor.name AS vendor_name, v.name AS car_name FROM payments p JOIN rent_vehicles rv ON p.rent_vehicle_id = rv.id JOIN vehicles v ON rv.vehicle_id = v.id JOIN users u_renter ON rv.user_id = u_renter.id JOIN users u_vendor ON v.vendor_id = u_vendor.id");
                    } else {
                        $vendorId = $_SESSION['user']['id'];
                        $payments = $connection->query("SELECT amount,transaction_code,paid_at, u_renter.name AS renter_name, u_vendor.name AS vendor_name, v.name AS car_name FROM payments p JOIN rent_vehicles rv ON p.rent_vehicle_id = rv.id JOIN vehicles v ON rv.vehicle_id = v.id JOIN users u_renter ON rv.user_id = u_renter.id JOIN users u_vendor ON v.vendor_id = u_vendor.id WHERE vendor_id=$vendorId");
                    }
                    $sn = 1;
                    $payments = mysqli_fetch_all($payments, MYSQLI_ASSOC);

                    foreach ($payments as $payment):
                        ?>
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $payment['car_name'] ?></td>
                            <td><?= $payment['vendor_name'] ?></td>
                            <td><?= $payment['renter_name'] ?></td>
                            <td>Rs. <?= $payment['amount'] ?></td>
                            <td><?= $payment['transaction_code'] ?></td>
                            <td><?= $payment['paid_at'] ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>SN</th>
                        <th>Car Name</th>
                        <th>Vendor</th>
                        <th>Renter</th>
                        <th>Amount</th>
                        <th>Transaction Code</th>
                        <th>Paid At</th>
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

