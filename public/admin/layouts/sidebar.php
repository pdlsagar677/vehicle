<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="#">
                <img class="logo-icon me-2" src="/admin/assets/images/app-logo.svg" alt="logo">
                <span class="logo-text">Vehicle Hub</span>
            </a>
        </div>
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    <a class="nav-link d-flex" style="align-items: center" href="/admin/index.php">
                        <div class="nav-icon"><i class="fa fa-dashboard fs-5"></i></div>
                        <div class="nav-link-text">Overview</div>
                    </a>
                </li>
                <?php
                if ($_SESSION['user']['role'] == 'admin'):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link d-flex" style="align-items: center" href="/admin/users/index.php">
                            <div class="nav-icon"><i class="fa fa-user fs-5"></i></div>
                            <div class="nav-link-text">Users</div>
                        </a>
                    </li>
                <?php
                elseif ($_SESSION['user']['role'] == 'vendor'):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link d-flex" style="align-items: center" href="/admin/vehicles/index.php">
                            <div class="nav-icon"><i class="fa fa-car fs-5"></i></div>
                            <div class="nav-link-text">Vehicles</div>
                        </a>
                    </li>
                <?php
                endif;
                ?>
                <li class="nav-item">
                    <a class="nav-link d-flex" style="align-items: center" href="/admin/bookings/index.php">
                        <div class="nav-icon"><i class="fa fa-book fs-5"></i></div>
                        <div class="nav-link-text">Bookings</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" style="align-items: center" href="/admin/payments/index.php">
                        <div class="nav-icon"><i class="fa fa-money-bill fs-5"></i></div>
                        <div class="nav-link-text">Payments</div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>