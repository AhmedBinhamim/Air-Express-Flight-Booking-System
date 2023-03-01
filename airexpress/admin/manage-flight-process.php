<?php
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
if (isset($_POST['fl-edit'])) {
    $flight_number = $_POST['fl-edit'];
    $sql = "SELECT Flight_Status From Flight WHERE Flight_Number = $flight_number";
    $result = $dbconn->query($sql);
    $flight_status = $result->fetch_row()[0];
    if ($flight_status == "Arrived") {
        $url = "http://localhost/airexpress/admin/manage-flight.php?flight_status=arrived";
        header("Location: $url");
    } else {
        $url = "http://localhost/airexpress/admin/edit-flight.php?flight=$flight_number";
        header("Location: $url");
    }
} elseif (isset($_POST['fl-delete'])) {
    $flight_number = $_POST['fl-delete'];
    echo "<script>alert('$flight_number');</script>";
    $sql = "DELETE FROM Flight WHERE Flight_Number = '$flight_number'";
    $dbconn->query($sql);
    $url = "http://localhost/airexpress/admin/manage-flight.php";
    header("Location: $url");
}
?>