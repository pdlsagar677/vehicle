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
    <?php require __DIR__ . "/../../../middlewares/vendor.php"; ?>
</head>

<body class="app">
<header class="app-header fixed-top">
    <?php require __DIR__ . "/../layouts/navbar.php"; ?>
    <?php require __DIR__ . "/../layouts/sidebar.php"; ?>
</header><!--//app-header-->

<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Manage vehicles</h1>
            <div class="mt-5">
                <a href="create.php" class="btn btn-primary d-block mb-3 float-end">Add vehicle</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Registration Number</th>
                        <th>Image</th>
                        <th>Price Per Hour</th>
                        <th>Is Available</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $userId = $_SESSION['user']['id'];
                    $vehicles = $connection->query("SELECT * FROM vehicles WHERE vendor_id=$userId");
                    $sn = 1;
                    $vehicles = mysqli_fetch_all($vehicles, MYSQLI_ASSOC);

                    foreach ($vehicles as $vehicle):
                        ?>
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $vehicle['name'] ?></td>
                            <td><?= $vehicle['registration_number'] ?></td>
                            <td>
                                <a target="_blank" href="/uploads/<?= $vehicle['image'] ?>">
                                    <img width="50" height="50" src="/uploads/<?= $vehicle['image'] ?>"
                                         alt="<?= $vehicle['name'] ?>">
                                </a>
                            </td>
                            <td><?= $vehicle['price_per_hour'] ?></td>
                            <td><?= $vehicle['is_available'] ? "Yes" : "No" ?></td>
                            <td>
                                <a onclick="return confirm('Are you sure?')" href="change-availability.php?id=<?= $vehicle['id'] ?>"
                                   class="btn btn-info">Set
                                    as <?= $vehicle['is_available'] ? 'unavailable' : 'available' ?></a>
                                <a href="edit.php?id=<?= $vehicle['id'] ?>" class="btn btn-primary">Edit</a>
                                <a onclick="return confirm('Are you sure?')" href="delete.php?id=<?= $vehicle['id'] ?>"
                                   class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Registration Number</th>
                        <th>Image</th>
                        <th>Price Per Hour</th>
                        <th>Is Available</th>
                        <th>Actions</th>
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

