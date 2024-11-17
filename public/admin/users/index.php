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
    <?php require __DIR__ . "/../../../middlewares/admin.php"; ?>
</head>

<body class="app">
<header class="app-header fixed-top">
    <?php require __DIR__ . "/../layouts/navbar.php"; ?>
    <?php require __DIR__ . "/../layouts/sidebar.php"; ?>
</header><!--//app-header-->

<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Manage Users</h1>
            <div class="mt-5">
                <a href="create.php" class="btn btn-primary d-block mb-3 float-end">Add User</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $users = $connection->query("SELECT * FROM users");
                    $sn = 1;
                    $users = mysqli_fetch_all($users, MYSQLI_ASSOC);

                    foreach ($users as $user):
                        ?>
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['phone'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <?php
                                if ($user['role'] == 'user'):
                                    ?>
                                    <a onclick="return confirm('Are you sure?')"
                                       href="approve.php?id=<?= $user['id'] ?>" class="btn btn-info">Change to Vendor</a>
                                <?php
                                endif;
                                ?>
                                <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-primary">Edit</a>
                                <?php
                                if ($user['role'] !== 'admin'):
                                    ?>
                                    <a onclick="return confirm('Are you sure?')" href="delete.php?id=<?= $user['id'] ?>"
                                       class="btn btn-danger">Delete</a>
                                <?php
                                endif;
                                ?>
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
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

