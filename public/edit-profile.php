<?php require('includes/header.php') ?>
<?php require('includes/navbar.php') ?>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: /auth/edit-profile.php');
}
$user_id = $_SESSION['user']['id'];
$user = $connection->query("SELECT * FROM users WHERE id = '$user_id'")->fetch_assoc();
?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <h2 class="text-center mb-4">Edit Personal Information</h2>
                <?php
                if (isset($_POST['edit-profile'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $license_number = $_POST['license_number'];

                    if (empty($name) || empty($email) || empty($phone) || empty($license_number)) {
                        echo "All fields are required";
                    } else {
                        $old_license_number = $connection->query("SELECT * FROM users WHERE license_number = '{$license_number}' AND id!=$user_id")->fetch_assoc();
                        if ($old_license_number) {
                            echo "License number already exists.";
                        }

                        $old_email = $connection->query("SELECT * FROM users WHERE email = '{$email}' AND id!=$user_id")->fetch_assoc();
                        if ($old_email) {
                            echo "Email already exists.";
                        }

                        $connection->query("UPDATE users SET name='$name', email='$email', phone='$phone', license_number='$license_number' WHERE id=$user_id");
                        $_SESSION['user']['id'] = $user_id;
                        $_SESSION['user']['name'] = $name;
                        $_SESSION['user']['email'] = $email;
                        echo "Your profile has been updated.";
                        ?>
                        <script>
                            window.location.href = "edit-profile.php";
                        </script>
                        <?php
                    }
                }

                ?>
                <form method="post" action="#">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name"
                               value="<?php echo $user['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email"
                               value="<?php echo $user['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="license_number" class="form-label">License Number</label>
                        <input type="text" class="form-control" name="license_number" id="license_number"
                               placeholder="Enter your license number" value="<?php echo $user['license_number'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                               placeholder="Enter your phone number" value="<?php echo $user['phone'] ?>">
                    </div>
                    <button type="submit" name="edit-profile" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <h2 class="text-center mb-4">Edit Password</h2>
                <?php
                if (isset($_POST['edit-password'])) {
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];

                    if (empty($password) || empty($confirm_password)) {
                        echo "All fields are required";
                    } else {
                        if ($password != $confirm_password) {
                            echo "Passwords do not match.";
                        }
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $connection->query("UPDATE users SET password='$password' WHERE id=$user_id");
                        echo "Your password has been updated.";
                        ?>
                        <script>
                            window.location.href = "edit-profile.php";
                        </script>
                        <?php
                    }
                }
                ?>

                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Enter your password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                               placeholder="Confirm your password">
                    </div>
                    <button type="submit" name="edit-password" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
<?php require('includes/footer.php') ?>