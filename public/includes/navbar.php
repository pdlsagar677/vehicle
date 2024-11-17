<!-- header section start -->
<div class="sticky" style="position: sticky; top:0;z-index: 100000">
    <div class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php"> <h1>Vehicle Hub</h1></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vehicle.php">Vehicles</a>
                        </li>
                      
                        <?php
                        if (isset($_SESSION['user'])) {
                            ?>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="nav-link text-success" href="#" id="dropdownMenuButton"
                                       data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false"><?= $_SESSION['user']['name'] ?></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                                        <?php
                                        if ($_SESSION['user']['role'] === 'user'):
                                            ?>
                                            <a class="dropdown-item" href="my-bookings.php">My Bookings</a>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="./../auth/logout.php">Logout</a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link text-success" href="/auth/index.php">Login</a>
                            </li>
                            <?php
                        }

                        ?>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- header section end -->