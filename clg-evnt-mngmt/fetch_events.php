<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "event";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM events";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $events[] = $row;
  }
}

$conn->close();
echo json_encode($events);
?>
