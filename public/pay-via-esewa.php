<?php

use Xentixar\XenPhp\Database;

require '../vendor/autoload.php';

$connection = new mysqli("127.0.0.1","root","","vrs");

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /auth/edit-profile.php');
}
$user_id = $_SESSION['user']['id'];
$user = $connection->query("SELECT * FROM users WHERE id = '$user_id'")->fetch_assoc();
$esewa = new \Xentixar\EsewaSdk\Esewa();
if (isset($_POST['pay-via-esewa'])) {
    $booking_id = $_POST['booking_id'] ?? "";
    if (!$booking_id || !is_numeric($booking_id)) {
        ?>
        <script>
            window.location.href = "my-bookings.php";
        </script>
        <?php
    } else {
        $booking = $connection->query("SELECT rv.start_date,rv.end_date,rv.status,rv.id,rv.vehicle_id,rv.user_id, v.name as vehicle_name,v.price_per_hour  FROM rent_vehicles AS rv JOIN vehicles AS v ON rv.vehicle_id=v.id WHERE rv.user_id = '$user_id' AND rv.id=$booking_id")->fetch_assoc();
        if (!$booking) {
            ?>
            <script>
                window.location.href = "my-bookings.php";
            </script>
            <?php
        } else {
            $payment = $connection->query("SELECT * FROM payments WHERE rent_vehicle_id={$booking['id']}")->fetch_assoc();
            if ($payment) {
                ?>
                <script>
                    window.location.href = "my-bookings.php";
                </script>
                <?php
            } else {
                $datetime1 = strtotime($booking['start_date']);
                $datetime2 = strtotime($booking['end_date']);

                $secs = $datetime2 - $datetime1;
                $cost_per_sec = $booking['price_per_hour'] / (60 * 60);

                $total_cost = $cost_per_sec * $secs;

                $_SESSION['booking_id'] = $booking_id;
                $_SESSION['booking_price'] = $total_cost;

                $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $esewa->config($actual_link, $actual_link, $total_cost);
                $esewa->init();
            }
        }

    }
} elseif ($_SESSION['booking_id'] && $_GET['data']) {
    $data = $esewa->decode();

    $booking_id = $_SESSION['booking_id'];

    $booking = $connection->query("SELECT rv.start_date,rv.end_date,rv.status,rv.id,rv.vehicle_id,rv.user_id, v.name as vehicle_name,v.price_per_hour,v.id as vehicle_id  FROM rent_vehicles AS rv JOIN vehicles AS v ON rv.vehicle_id=v.id WHERE rv.user_id = '$user_id' AND rv.id=$booking_id")->fetch_assoc();

    $rent_vehicle_id = $_SESSION['booking_id'];
    $amount = $_SESSION['booking_price'];
    $transaction_code = $data['transaction_code'];
    $current_time = date('Y-m-d H:i:s');
    $connection->query("INSERT INTO payments(rent_vehicle_id,amount,payment_method,transaction_code,paid_at) VALUES($rent_vehicle_id,$amount,'Esewa','$transaction_code','$current_time')");

    $connection->query("UPDATE vehicles SET is_available=0 WHERE id={$booking['vehicle_id']}");
    ?>
    <script>
        window.location.href = "my-bookings.php";
    </script>
    <?php
} else {
    ?>
    <script>
        window.location.href = "my-bookings.php";
    </script>
    <?php
}

?>