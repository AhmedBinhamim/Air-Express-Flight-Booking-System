<?php
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
if (isset($_POST['add-airplane'])) {
    $airplane_type = $_POST['airplane-type'];
    $airplane_seats = $_POST['airplane-seats'];
    $sql = "SELECT * FROM Airplane WHERE Airplane_Type = '$airplane_type'";
    $results = $dbconn->query($sql);
    $rows = mysqli_num_rows($results);
    echo "<script>window.alert('$rows');</script>";
    if ($rows == 0) {
        $sql = "INSERT INTO `Airplane` (`Airplane_Type`, `Airplane_Seats`) 
                VALUES ('$airplane_type', $airplane_seats)";
        echo "<script>window.alert('test3');</script>";
        $dbconn->query($sql);
        $url = "http://localhost/airexpress/admin/add-airplane.php";
        header("Location: $url");
    } else {
        echo "<script>window.alert('test2.3');</script>";
        $url = "http://localhost/airexpress/admin/add-airplane.php?airplane=alreadyAdded";
        header("Location: $url");
    } 
} elseif (isset($_POST['ar-type'])) {
    $airplane_type = $_POST['ar-type'];
    $sql = "DELETE FROM Airplane WHERE Airplane_Type = '$airplane_type'";
    $dbconn->query($sql);
    $url = "http://localhost/airexpress/admin/add-airplane.php";
    header("Location: $url");
}
?>