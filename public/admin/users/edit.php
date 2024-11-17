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
    use Xentixar\XenPhp\Validation;
    require __DIR__ . "/../layouts/header.php";
    require __DIR__ . "/../../../middlewares/admin.php";
    ?>
</head>

<?php
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = $connection->query("SELECT * FROM users WHERE id=$id");
    if ($query->num_rows === 1) {
        $user = $query->fetch_assoc();
    } else {
        header("location: edit-profile.php");
    }
}
?>

<body class="app">
<header class="app-header fixed-top">
    <?php require __DIR__ . "/../layouts/navbar.php"; ?>
    <?php require __DIR__ . "/../layouts/sidebar.php"; ?>
</header><!--//app-header-->

<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Edit user</h1>
            <div class="mt-5">
                <div class="text-end">
                    <a href="index.php" class="btn btn-primary mb-3 ">Manage Users</a>
                </div>
                <form action="#" method="post">
                    <?php
                    if (isset($_POST['add'])) {
                        $validated = true;
// Validate password length
if (strlen($_POST['password']) < 6) {
    $validated = false;
    $_SESSION['error']['password'] = "Password must be at least 6 characters long";
}

// Check if username already exists
$username = $_POST['username'];
$query = $connection->query("SELECT * FROM users WHERE username='$username'");
if ($query->num_rows > 0) {
    $validated = false;
    $_SESSION['error']['username'] = "Username already exists";
}

// Check if email already exists
$email = $_POST['email'];
$query = $connection->query("SELECT * FROM users WHERE email='$email'");
if ($query->num_rows > 0) {
    $validated = false;
    $_SESSION['error']['email'] = "Email address already exists";
}

// Check if license number already exists
$license_number = $_POST['license_number'];
$query = $connection->query("SELECT * FROM users WHERE license_number='$license_number'");
if ($query->num_rows > 0) {
    $validated = false;
    $_SESSION['error']['license_number'] = "License number already exists";
}

// Check if phone number already exists (assuming phone number is unique)
$phone = $_POST['phone'] ?? '';
if (!empty($phone)) {
    $query = $connection->query("SELECT * FROM users WHERE phone='$phone'");
    if ($query->num_rows > 0) {
        $validated = false;
        $_SESSION['error']['phone'] = "Phone number already exists";
    }
}






                        if ($validated) {
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $username = $_POST['username'];
                            $license_number = $_POST['license_number'];
                            $role = $_POST['role'];
                            $phone = $_POST['phone'] ?? '';

                            if (strlen($phone) > 20) {
                                $_SESSION['error']['phone'] = "The phone field must be less than 20 characters";
                            }
                            $connection->query("UPDATE users SET name='$name',email='$email',username='$username',license_number='$license_number',role='$role',phone='$phone' WHERE id=$id");
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
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?? '' ?>"
                               required/>
                        <small class="text-danger"><?= $_SESSION['error']['name'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email <b>*</b></label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?= $user['email'] ?? '' ?>" required/>
                        <small class="text-danger"><?= $_SESSION['error']['email'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="username">Username <b>*</b></label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?= $user['username'] ?? '' ?>" required/>
                        <small class="text-danger"><?= $_SESSION['error']['username'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="license_number">License Number <b>*</b> </label>
                        <input type="text" class="form-control" id="license_number" name="license_number"
                               value="<?= $user['license_number'] ?? '' ?>" required/>
                        <small class="text-danger"><?= $_SESSION['error']['license_number'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone </label>
                        <input type="tel" class="form-control" id="phone" name="phone"
                               value="<?= $user['phone'] ?? '' ?>"/>
                        <small class="text-danger"><?= $_SESSION['error']['phone'] ?? '' ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="role">Role <b>*</b> </label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="vendor">Vendor</option>
                            <option value="admin">Admin</option>
                        </select>
                        <small class="text-danger"><?= $_SESSION['error']['role'] ?? '' ?></small>
                        <script>
                            document.getElementById('role').value = "<?= $user['role'] ?? 'user' ?>";
                        </script>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Edit user</button>
                </form>
            </div>
        </div><!--//container-fluid-->
    </div><!--//app-content-->

   
</div><!--//app-wrapper-->
<?php require __DIR__ . "/../layouts/footer.php"; ?>

</body>
</html>

