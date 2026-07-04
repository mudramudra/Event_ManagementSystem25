<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $prn = $_POST['prn'];
    $year = $_POST['year'];
    $department = $_POST['department'];
    $event = $_POST['event'];
    $email = $_POST['email'];

    
    $stmt = $conn->prepare("INSERT INTO newregist (full_name, prn, year_of_study, department, event, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $prn, $year, $department, $event, $email);

    if ($stmt->execute()) {
        echo "<h2>Registration Successful!</h2>";
        echo "<p>Thank you, <b>$full_name</b>, for registering for <b>$event</b>.</p>";
        echo '<a href="techregist.html">← Back to Registration Page</a>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
   
    header("Location: techregist.html");
    exit();
}
?>