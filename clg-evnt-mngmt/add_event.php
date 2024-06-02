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
  $name = $_POST['name'];
  $slots = $_POST['slots'];
  $description = $_POST['description'];
  $imageUrl = $_POST['imageUrl'];

  $sql = "INSERT INTO events (name, slots, description, imageUrl) VALUES ('$name', '$slots', '$description', '$imageUrl')";

  if ($conn->query($sql) === TRUE) {
    echo "New event added successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
