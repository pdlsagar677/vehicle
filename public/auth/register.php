<?php

use Xentixar\XenPhp\Database;

require_once __DIR__ . "/../../vendor/autoload.php";
$connection = new mysqli("127.0.0.1","root","","vrs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register | Vehicle Hub</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="/admin/assets/plugins/fontawesome/js/all.min.js"></script>
    <link id="theme-style" rel="stylesheet" href="/admin/assets/css/portal.css">


</head>

<body class="app app-login p-0">
<div class="row g-0 app-auth-wrapper">
    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
        <div class="d-flex flex-column align-content-end">
            <div class="app-auth-body mx-auto">
                <div class="app-auth-branding mb-4"><a class="app-logo" href="/"><img class="logo-icon me-2"
                                                                                      src="/admin/assets/images/app-logo.svg"
                                                                                      alt="logo"></a></div>
                <h2 class="auth-heading text-center mb-5">Sign up to Vehicle Hub</h2>
                <div class="auth-form-container text-start">

                    <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Initialize error messages array
    $_SESSION['error'] = [];

    // Validate name
    if (empty($_POST['name'])) {
        $_SESSION['error']['name'] = 'Name is required';
    }

    // Validate username
    if (empty($_POST['username'])) {
        $_SESSION['error']['username'] = 'Username is required';
    } else {
        $username = $_POST['username'];
        $result = $connection->query("SELECT * FROM users WHERE username = '$username'");
        if ($result->num_rows > 0) {
            $_SESSION['error']['username'] = 'Username already exists';
        }
    }
    // Validate license number
    if (empty($_POST['license_number'])) {
        $_SESSION['error']['license_number'] = 'License number is required';
    } else {
        $license_number = $_POST['license_number'];
        $result = $connection->query("SELECT * FROM users WHERE license_number = '$license_number'");
        if ($result->num_rows > 0) {
            $_SESSION['error']['license_number'] = 'License number already exists';
        }
    }

    // Validate email
    if (empty($_POST['email'])) {
        $_SESSION['error']['email'] = 'Email is required';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error']['email'] = 'Invalid email format';
    } else {
        // Check if email already exists in database
        $email = $_POST['email'];
        $result = $connection->query("SELECT * FROM users WHERE email = '$email'");
        if ($result->num_rows > 0) {
            $_SESSION['error']['email'] = 'Email already exists';
        }
    }

    // Validate password
    if (empty($_POST['password'])) {
        $_SESSION['error']['password'] = 'Password is required';
    } elseif (strlen($_POST['password']) < 6) {
        $_SESSION['error']['password'] = 'Password must be at least 6 characters long';
            
    }

    // If there are no validation errors, proceed with registration
    if (empty($_SESSION['error'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $username = $_POST['username'];
        $license_number = $_POST['license_number'];

        // Insert user into database
        $connection->query("INSERT INTO users(name, email, password, username, license_number) VALUES('$name', '$email', '$password', '$username', '$license_number')");

        // Redirect to login page after successful registration
        header('Location: /auth/login/');
        exit;
    }
}

?>

                    

                    <form class="auth-form login-form" action="#" method="post">
                        <div class="mb-3">
                            <label class="sr-only" for="name">Name <b>*</b></label>
                            <input id="name" name="name" type="text" class="form-control name" placeholder="Your name"
                                   required="required">
                            <small class="text-danger"><?= $_SESSION['error']['name'] ?? '' ?></small>
                        </div><!--//form-group-->
                        <div class=" mb-3">
                            <label class="sr-only" for="username">Username <b>*</b></label>
                            <input id="username" name="username" type="text" class="form-control"
                                   placeholder="Your username" required="required">
                            <small class="text-danger"><?= $_SESSION['error']['username'] ?? '' ?></small>
                        </div><!--//form-group-->
                        <div class=" mb-3">
                            <label class="sr-only" for="license_number">License Number <b>*</b></label>
                            <input id="license_number" name="license_number" type="text" class="form-control"
                                   placeholder="Your license number" required="required">
                            <small class="text-danger"><?= $_SESSION['error']['license_number'] ?? '' ?></small>
                        </div><!--//form-group-->
                        <div class="email mb-3">
                            <label class="sr-only" for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control email"
                                   placeholder="Email address" required="required">
                            <small class="text-danger"><?= $_SESSION['error']['email'] ?? '' ?></small>
                        </div><!--//form-group-->
                        <div class="password mb-3">
                            <label class="sr-only" for="password">Password</label>
                            <input id="password" name="password" type="password" class="form-control password"
                                   placeholder="Password" required="required">
                            <small class="text-danger"><?= $_SESSION['error']['password'] ?? '' ?></small>
                        </div><!--//form-group-->
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log
                                In
                            </button>
                        </div>
                    </form>

                    <div class="auth-option text-center pt-5">Already have an account? Sign in <a class="text-link"
                                                                                                  href="index.php">here</a>.
                    </div>
                </div><!--//auth-form-container-->

            </div><!--//auth-body-->
        </div><!--//flex-column-->
    </div><!--//auth-main-col-->
    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
        <div class="auth-background-holder">
        </div>
        <div class="auth-background-mask"></div>
        <div class="auth-background-overlay p-3 p-lg-5">
            
        </div><!--//auth-background-overlay-->
    </div><!--//auth-background-col-->

</div><!--//row-->


</body>
</html>

<?php unset($_SESSION['error']) ?>





