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
    $email = $_POST['email'];
    $rollNo = $_POST['rollNo'];
    $contactNo = $_POST['contactNo'];
    $event = $_POST['event'];
    $branch = $_POST['branch'];
    $yearOfStudy = $_POST['year'];
    if (empty($name) || empty($email) || empty($rollNo) || empty($contactNo) || empty($event) || empty($branch) || empty($yearOfStudy)) {
        echo "Please fill in all fields";
    } else {
        $check_query = "SELECT * FROM registrations WHERE event = '$event' AND rollNo = '$rollNo'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            echo "You have already registered for this event.";
        } else {
            $slots_available_query = "SELECT slots FROM events WHERE name = '$event'";
            $slots_available_result = $conn->query($slots_available_query);

            if ($slots_available_result && $slots_available_result->num_rows > 0) {
                $row = $slots_available_result->fetch_assoc();
                $slots = $row["slots"];

                if ($slots > 0) {
                    $update_slots_query = "UPDATE events SET slots = slots - 1 WHERE name = '$event'";
                    if ($conn->query($update_slots_query) === TRUE) {
                        $insert_registration_query = "INSERT INTO registrations (event, name, email, rollNo, contactNo, branch, yearOfStudy) VALUES ('$event', '$name', '$email', '$rollNo', '$contactNo', '$branch', '$yearOfStudy')";
                        if ($conn->query($insert_registration_query) === TRUE) {
                            echo "Form submitted successfully";
                        } else {
                            echo "Error: " . $insert_registration_query . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error: " . $update_slots_query . "<br>" . $conn->error;
                    }
                } else {
                    echo "No slots available for the event";
                }
            } else {
                echo "Event not found";
            }
        }
    }
}

$conn->close();
?>
