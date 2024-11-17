<?php require('includes/header.php') ?>
<?php require('includes/navbar.php') ?>

<?php
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $userId = $_SESSION['user']['id'] ?? null;
    $query = $connection->query("SELECT * FROM vehicles WHERE id=$id");
    if ($query->num_rows === 1) {
        $_SESSION['current_active_vehicle_id'] = $id;
        ?>
        <script>
            window.location.href = "vehicle-detail.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            window.location.href = "vehicle.php";
        </script>
        <?php
    }
} elseif (isset($_SESSION['current_active_vehicle_id'])) {
    $id = $_SESSION['current_active_vehicle_id'];
    $userId = $_SESSION['user']['id'] ?? null;
    $query = $connection->query("SELECT * FROM vehicles WHERE id=$id");
    if ($query->num_rows === 1) {
        $vehicle = $query->fetch_assoc();
    } else {
        ?>
        <script>
            window.location.href = "vehicle.php";
        </script>
        <?php
    }
} else {
    ?>
    <script>
        window.location.href = "vehicle.php";
    </script>
    <?php
}
?>

    </div>
    <!-- gallery section start -->
    <div class="gallery_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="uploads/<?= $vehicle['image'] ?>" alt="">
                </div>
                <div class="col-md-7">
                    <h3 class="gallery_taital"><?= $vehicle['name'] ?></h3>
                    <div class="description py-5">
                        <p><?= $vehicle['description'] ?></p>
                        <p>Rs. <?= $vehicle['price_per_hour'] ?> per hour</p>

                        <div class="form">

                            <?php

                            if (isset($_POST['book'])) {
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $vehicleId = $vehicle['id'];

                                if ($vehicle['is_available']) {
                                    $data = $connection->query("INSERT INTO rent_vehicles(user_id,vehicle_id,start_date,end_date) VALUES($userId,$vehicleId,'$start_date','$end_date')");
                                    ?>
                                    <script>
                                        window.location.href = "my-bookings.php";
                                    </script>
                                    <?php
                                } else {
                                    echo "Already rented by someone else...";
                                }

                            }

                            ?>

                            <form action="#" method="post">
                                <label for="" class="form-label">From</label>
                                <input type="datetime-local" class="from-control" name="start_date" required>
                                <label for="" class="form-label">To</label>
                                <input type="datetime-local" class="from-control" name="end_date" required>
                                <?php
                                if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'user') {
                                    ?>
                                    <button type="submit" name="book" class="btn btn-sm btn-outline-dark ms-5">Book Now
                                    </button>
                                    <?php
                                } else {
                                    ?>
                                    <a href="/auth" class="btn btn-sm btn-outline-dark ms-5">Book Now
                                    </a>
                                    <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- gallery section end -->

<?php require('includes/footer.php') ?>