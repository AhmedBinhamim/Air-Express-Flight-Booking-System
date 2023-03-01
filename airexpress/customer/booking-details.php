<?php
session_start();
require('../dbm.php');
include('header.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
$cs_email = $_SESSION['user-email'];
if (isset($_POST['bk-manage'])) {
    $bk_number = $_POST['bk-manage'];
} elseif (isset($_POST['bk-change'])) {
    $bk_number = $_POST['bk-change'];
} elseif (isset($_POST['bk-cancel'])) {
    $bk_number = $_POST['bk-cancel'];
}
function getPassengerDetails($cs_email, $ticket_number, $dbconn) {
    $sql = "SELECT * FROM Passenger WHERE Customer_Email = '$cs_email' AND Ticket_Number = '$ticket_number'";
    $result = $dbconn->query($sql);
    return $result->fetch_row();
}
function getFlightDetails($flight_number, $dbconn) {
    $sql = "SELECT * FROM Flight WHERE Flight_Number = '$flight_number'";
    $result = $dbconn->query($sql);
    return $result->fetch_row();
}
function getTicketDetails($bk_number, $dbconn) {
    $sql = "SELECT * FROM Ticket WHERE Booking_Number = '$bk_number'";
    $result = $dbconn->query($sql);
    $tickets = [];
    while ($ticket = $result->fetch_row()) {
        array_push($tickets, $ticket);
    }
    return $tickets;
}

$tickets = getTicketDetails($bk_number, $dbconn);

?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>My Bookings</title>
  <link rel="stylesheet" href="../stylesheet.css">
</head>
<body class="tickets-body">
    <?php 
    if (isset($_POST['bk-manage'])) {
        $bk_number = $_POST['bk-manage'];
        foreach ($tickets as $ticket) {
            $flight_number = $ticket[1];
            $flight_details = getFlightDetails($flight_number, $dbconn);
            $passenger_details = getPassengerDetails($cs_email, $ticket[0], $dbconn);
            ?>
        <div class="flight-ticket">
            <div class="flight-info">
                <h2 style="margin-top: 0; background-color: inherit;">Flight <?php echo $flight_number; ?></h2>
                <div class="route">
                    <div class="departure">
                        <p>From: <?php echo $flight_details[1]; ?></p>
                        <p>Departing: <?php echo $flight_details[3]; ?></p>
                        <p>Time: <?php echo $flight_details[4]; ?></p>
                    </div>
                    <div class="arrival">
                        <p>To: <?php echo $flight_details[2]; ?></p>
                        <p>Arriving: <?php echo $flight_details[5]; ?></p>
                        <p>Time: <?php echo $flight_details[6]; ?></p>
                    </div>
                </div>
            </div>
            <div class="passenger-info">
                <p>Passenger Name: <?php echo $passenger_details[1]; ?></p>
                <p>Passenger Travel Document: <?php echo $passenger_details[2]; ?></p>
                <p>Seat Number: <?php echo $ticket[3] ?></p>
                <p>Ticket Class: <?php echo $ticket[2]; ?></p>
            </div>
            <div class="booking-info">
                <p>Price: <?php echo $flight_details[9]; ?></p>
                <p>Booking Reference: <?php echo $ticket[4] ?></p>
            </div>
        </div>
    <?php }
    } elseif (isset($_POST['bk-change'])) {
        $bk_number = $_POST['bk-change'];
        foreach ($tickets as $ticket) {
            $flight_number = $ticket[1];
            $flight_details = getFlightDetails($flight_number, $dbconn);
            $passenger_details = getPassengerDetails($cs_email, $ticket[0], $dbconn);
            ?>
        <div class="flight-ticket">
            <div class="flight-info">
                <h2 style="margin-top: 0; background-color: inherit;">Flight <?php echo $flight_number; ?></h2>
                <div class="route">
                    <div class="departure">
                        <p>From: <?php echo $flight_details[1]; ?></p>
                        <p>Departing: <?php echo $flight_details[3]; ?></p>
                        <p>Time: <?php echo $flight_details[4]; ?></p>
                    </div>
                    <div class="arrival">
                        <p>To: <?php echo $flight_details[2]; ?></p>
                        <p>Arriving: <?php echo $flight_details[5]; ?></p>
                        <p>Time: <?php echo $flight_details[6]; ?></p>
                    </div>
                </div>
            </div>
            <div class="passenger-info">
                <p>Passenger Name: <?php echo $passenger_details[1]; ?></p>
                <p>Passenger Travel Document: <?php echo $passenger_details[2]; ?></p>
                <p>Seat Number: <?php echo $ticket[3] ?></p>
                <p>Ticket Class: <?php echo $ticket[2]; ?></p>
            </div>
            <div class="booking-info">
                <p>Price: <?php echo $flight_details[9]; ?></p>
                <p>Booking Reference: <?php echo $ticket[4] ?></p>
            </div>
            <div>
                <button class="flightDetailButton">Change</button>
            </div>
        </div>
    <?php }} elseif (isset($_POST['bk-cancel'])) {
        $bk_number = $_POST['bk-cancel'];
        foreach ($tickets as $ticket) {
            $flight_number = $ticket[1];
            $flight_details = getFlightDetails($flight_number, $dbconn);
            $passenger_details = getPassengerDetails($cs_email, $ticket[0], $dbconn);
            ?>
        <div class="flight-ticket">
            <div class="flight-info">
                <h2 style="margin-top: 0; background-color: inherit;">Flight <?php echo $flight_number; ?></h2>
                <div class="route">
                    <div class="departure">
                        <p>From: <?php echo $flight_details[1]; ?></p>
                        <p>Departing: <?php echo $flight_details[3]; ?></p>
                        <p>Time: <?php echo $flight_details[4]; ?></p>
                    </div>
                    <div class="arrival">
                        <p>To: <?php echo $flight_details[2]; ?></p>
                        <p>Arriving: <?php echo $flight_details[5]; ?></p>
                        <p>Time: <?php echo $flight_details[6]; ?></p>
                    </div>
                </div>
            </div>
            <div class="passenger-info">
                <p>Passenger Name: <?php echo $passenger_details[1]; ?></p>
                <p>Passenger Travel Document: <?php echo $passenger_details[2]; ?></p>
                <p>Seat Number: <?php echo $ticket[3] ?></p>
                <p>Ticket Class: <?php echo $ticket[2]; ?></p>
            </div>
            <div class="booking-info">
                <p>Price: <?php echo $flight_details[9]; ?></p>
                <p>Booking Reference: <?php echo $ticket[4] ?></p>
            </div>
            <div>
                <button class="flightDetailButton">Cancel</button>
            </div>
        </div>
    <?php }
    }?>

    <script>
</body>
<?php include('customer-footer.php') ?>
</html>