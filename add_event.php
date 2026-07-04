<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ems";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];

    $sql = "INSERT INTO events (event_name, event_description, event_date, event_time)
            VALUES ('$event_name', '$event_description', '$event_date', '$event_time')";

    if ($conn->query($sql) === TRUE) {
        header("Location: faculty.php"); // redirect back to faculty page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>