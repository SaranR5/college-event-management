<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST['name'];
    $sql = "DELETE FROM registrations WHERE event='$eventName'";

    if ($conn->query($sql) === TRUE) {
        $sql = "DELETE FROM events WHERE name='$eventName'";

        if ($conn->query($sql) === TRUE) {
            echo "Event and related registrations deleted successfully";
        } else {
            echo "Error deleting event: " . $conn->error;
        }
    } else {
        echo "Error deleting registrations: " . $conn->error;
    }
}

$conn->close();
?>
