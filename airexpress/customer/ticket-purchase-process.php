<?php
session_start();
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
function getLastSeatOnFlight($fl_num, $dbconn) {
    $sql = "SELECT Last_Seat FROM Flight WHERE Flight_Number = '$fl_num'";
    $result = $dbconn->query($sql);
    $result_row = $result->fetch_row();
    return $result_row[0];
}
function getTicketSeat($last_seat) {
    if ($last_seat === "0") {
        $seat = "01A";
    } else {
        if (strlen($last_seat) != 3) {
            $last_seat = "0" . $last_seat;
        }
        $letter = substr($last_seat, 2, 3);
        $num = substr($last_seat, 0, 2);
        $num = (int) $num;
        if ($letter === "I") {
            $num = $num + 1;
            $letter = "A";
        } else {
            $letter = ord($letter);
            $letter = $letter + 1;
            $letter = chr($letter);
        }
        $seat = $num . $letter;
        if (strlen($seat) != 3) {
            $seat = "0" . $seat;
        }
    }
    return $seat;
}

function getLastTicketNumber($dbconn) {
    $sql = "SELECT Ticket_Number FROM Ticket";
    $result = $dbconn->query($sql);
    $n = $result->num_rows;
    $last_ticket_number = 1000 + $n;

    return $last_ticket_number;
}

if (isset($_POST['proceed'])) {
    if ($_POST['proceed'] === "Proceed To Return Flight" && $_SESSION['return-ticket'] === "Not Selected") {
        $url = "http://localhost:8080/airexpress/customer/flight-booking-process.php?customer=true";
        header("Location: $url");
    } else {
        $flight_number = $_POST['fl-num'];
        $ticket_class = $_SESSION['selected-class'];
        $sql = "INSERT INTO Booking (`Flight_Number`, `Customer_Email`, `Booking_Status`) 
                VALUES ('$flight_number', '{$_SESSION['user-email']}', 'Successful')";
        $dbconn->query($sql);
        $sql = "SELECT Booking_Number FROM Booking WHERE Flight_Number='$flight_number' AND Customer_Email='{$_SESSION['user-email']}'";
        $result = $dbconn->query($sql);
        $result_row = $result->fetch_row();
        $booking_number = $result_row[0];
        for ($i = 0; $i < $_SESSION['no-of-passengers']; $i++) {
            $ticket_seat = getTicketSeat(getLastSeatOnFlight($flight_number, $dbconn));
            $ticket_number = getLastTicketNumber($dbconn);
            $sql = "INSERT INTO `ticket` (`Ticket_Number`, `Flight_Number`, `Ticket_Class`, `Ticket_Seat`, `Booking_Number`) 
                    VALUES ('$ticket_number', '$flight_number', '$ticket_class', '$ticket_seat', '$booking_number');";
            $dbconn->query($sql);
            $sql = "INSERT INTO Passenger (`Passenger_Name`, `Passenger_Travel_Document`, `Passenger_Email`, `Customer_Email`, `Flight_Number`, `Ticket_Number`)
                    VALUES ('{$_POST['passenger-'.($i+1).'-name']}', '{$_POST['passenger-'.($i+1).'-document']}', '{$_POST['passenger-'.($i+1).'-email']}', '{$_SESSION['user-email']}', '$flight_number', '$ticket_number')";
            $dbconn->query($sql);
            $sql = "UPDATE Flight SET Last_Seat = '$ticket_seat' WHERE Flight_Number = '$flight_number'";
            $dbconn->query($sql);
        }

        $purchase_date = date('Y-m-d');
        $sql = "INSERT INTO `purchase`(`Customer_Email`, `Purchase_Amount`, `Purchase_Status`, `Purchase_Date`) 
                VALUES ('{$_SESSION['user-email']}', '{$_POST['total-price']}', 'Successful', '$purchase_date')";
        $dbconn->query($sql);

        $url = "http://localhost:8080/airexpress/login.php?booking_session=ended";
        header("Location: $url");
    }
}
?>