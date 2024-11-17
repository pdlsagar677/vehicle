<?php require('includes/header.php') ?>
<?php require('includes/navbar.php') ?>
<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header('Location: /auth/edit-profile.php');
}
$user_id = $_SESSION['user']['id'];
$user = $connection->query("SELECT * FROM users WHERE id = '$user_id'")->fetch_assoc();
?>
    <div class="container py-5">
        <h2 class="mt-5 text-center">My Bookings</h2>
        <table class="table mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Vehicle</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $bookings = $connection->query("SELECT rv.start_date,rv.end_date,rv.status,rv.id,rv.vehicle_id,rv.user_id, v.name as vehicle_name,v.price_per_hour  FROM rent_vehicles AS rv JOIN vehicles AS v ON rv.vehicle_id=v.id WHERE rv.user_id = '$user_id' ORDER BY rv.id DESC ")->fetch_all(MYSQLI_ASSOC);
            foreach ($bookings as $key => $booking):
                $datetime1 = strtotime($booking['start_date']);
                $datetime2 = strtotime($booking['end_date']);

                $secs = $datetime2 - $datetime1;
                $cost_per_sec = $booking['price_per_hour'] / (60 * 60);

                $total_cost = $cost_per_sec * $secs;

                $booking_id = $booking['id'];
                $payment = $connection->query("SELECT * FROM payments WHERE rent_vehicle_id=$booking_id")->fetch_assoc();
                ?>
                <tr>
                    <th scope="row"><?php echo $key + 1; ?></th>
                    <td><?php echo $booking['vehicle_name']; ?></td>
                    <td><?php echo $booking['start_date']; ?></td>
                    <td><?php echo $booking['end_date']; ?></td>
                    <td>Rs. <?php echo $total_cost; ?></td>
                    <td><?php echo $payment ? "<span class='text-success'>Done</span>" : "<span class='text-danger'>Remaining</span>" ?></td>
                    <td>
                        <?php
                        if ($payment) {
                            ?>
                            <button onclick="alert('Contact to the admin to cancel the booking')"
                                    class="btn btn-sm btn-danger">Cancel
                            </button>
                            <?php
                        } else {
                            ?>
                            <form action="pay-via-esewa.php" method="post">
                                <input type="hidden" name="booking_id" value="<?php echo $booking['id'] ?>">
                                <button type="submit" name="pay-via-esewa"
                                        class="btn btn-sm btn-success">Pay Via Esewa
                                </button>
                            </form>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
<?php require('includes/footer.php') ?>