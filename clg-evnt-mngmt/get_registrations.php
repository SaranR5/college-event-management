<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['event'])) {
    $eventName = $conn->real_escape_string($_GET['event']);

    $sql = "SELECT * FROM registrations WHERE event = '$eventName'";
    $result = $conn->query($sql);

    $registrations = array();
    while ($row = $result->fetch_assoc()) {
        $registrations[] = $row;
    }

    echo json_encode($registrations);
}

$conn->close();
?>
