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
    <?php
    require __DIR__ . "/../layouts/header.php";
    require __DIR__ . "/../../../middlewares/vendor.php";
    ?>
</head>

<body class="app">
<header class="app-header fixed-top">
    <?php require __DIR__ . "/../layouts/navbar.php"; ?>
    <?php require __DIR__ . "/../layouts/sidebar.php"; ?>
</header><!--//app-header-->

<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Add vehicle</h1>
            <div class="mt-5">
                <div class="text-end">
                    <a href="index.php" class="btn btn-primary mb-3 ">Manage vehicles</a>
                </div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($_POST['add'])) {
                        $name = $_POST['name'];
                        $registration_number = $_POST['registration_number'];
                        $image = $_FILES['image'] ?? [];
                        $description = $_POST['description'];
                        $price_per_hour = $_POST['price_per_hour'];

                        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                        $filename = $registration_number . "-" . time() . "." . $extension;
                        $userId = $_SESSION['user']['id'];
                        if (move_uploaded_file($_FILES['image']['tmp_name'], "../../uploads/" . $filename)) {
                            $connection->query("INSERT INTO vehicles(name,registration_number,image,description,price_per_hour,vendor_id) VALUES('$name','$registration_number','$filename','$description','$price_per_hour',$userId)");
                            ?>
                            <script>
                                window.location.href = "index.php";
                            </script>
                            <?php
                        }
                    }
                    ?>
                    <div class="mb-3">
                        <label for="name">Name <b>*</b></label>
                        <input type="text" class="form-control" id="name" name="name" required/>
                        <small class="text-danger"><?= $_SESSION['error']['name'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="registration_number">Registration Number <b>*</b></label>
                        <input type="text" class="form-control" id="registration_number" name="registration_number"
                               required/>
                        <small class="text-danger"><?= $_SESSION['error']['registration_number'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="image">Image <b>*</b></label>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="image"
                               name="image" required/>
                        <small class="text-danger"><?= $_SESSION['error']['image'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description"/>
                        <small class="text-danger"><?= $_SESSION['error']['description'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="price_per_hour">Price Per Hour <b>*</b></label>
                        <input type="text" class="form-control" id="price_per_hour" name="price_per_hour" required/>
                        <small class="text-danger"><?= $_SESSION['error']['price_per_hour'] ?? '' ?></small>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Add vehicle</button>
                </form>
            </div>
        </div><!--//container-fluid-->
    </div><!--//app-content-->

</div><!--//app-wrapper-->
<?php require __DIR__ . "/../layouts/footer.php"; ?>

</body>
</html>

