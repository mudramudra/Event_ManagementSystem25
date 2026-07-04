<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "ems");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $role = $conn->real_escape_string($_POST['role']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered. Please login.'); window.location='login.html';</script>";
        exit();
    }

    
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
       
        echo "<script>alert('Registration successful! Please login.'); window.location='login.html';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>