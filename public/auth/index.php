<?php

require_once __DIR__ . "/../../vendor/autoload.php";
$connection = new mysqli("127.0.0.1","root","","vrs");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | Vehicle Hub</title>

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
                <h2 class="auth-heading text-center mb-5">Log in to Vehicle Hub</h2>
                <div class="auth-form-container text-start">
                    <?php

                    if (isset($_POST['submit'])) {
                        $validated = true;

                        if ($validated) {
                            $user = $connection->query("SELECT * FROM users WHERE email = '{$_POST['email']}'");
                            $user = mysqli_fetch_assoc($user);
                            if ($user && password_verify($_POST['password'], $user['password'])) {
                                session_start();
                                $_SESSION['user']['id'] = $user['id'];
                                $_SESSION['user']['email'] = $user['email'];
                                $_SESSION['user']['name'] = $user['name'];
                                $_SESSION['user']['role'] = $user['role'];
                                if ($user['role'] === 'user') {
                                    header('Location: /');
                                } else {
                                    header('Location: /admin/');
                                }
                            } else {
                                $_SESSION['error']['email'] = 'The account does not exist.';
                            }
                        }
                    }

                    ?>
                    <form class="auth-form login-form" action="#" method="post">
                        <div class="email mb-3">
                            <label class="sr-only" for="signin-email">Email</label>
                            <input id="signin-email" name="email" type="email" class="form-control signin-email"
                                   placeholder="Email address" required="required">
                            <small class="text-danger"><?= $_SESSION['error']['email'] ?? '' ?></small>

                        </div><!--//form-group-->
                        <div class="password mb-3">
                            <label class="sr-only" for="signin-password">Password</label>
                            <input id="signin-password" name="password" type="password"
                                   class="form-control signin-password" placeholder="Password" required="required">
                            <small class="text-danger"><?= $_SESSION['error']['password'] ?? '' ?></small>

                        </div><!--//form-group-->
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log
                                In
                            </button>
                        </div>
                    </form>

                    <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link"
                                                                                     href="register.php">here</a>.
                    </div>
                </div><!--//auth-form-container-->

            </div><!--//auth-body-->

        </div><!--//flex-column-->
    </div><!--//auth-main-col-->
    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
        <div class="auth-background-holder">
        </div>
       
    </div><!--//auth-background-col-->

</div><!--//row-->


</body>
</html>

<?php unset($_SESSION['error']) ?>
