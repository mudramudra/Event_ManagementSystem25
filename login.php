<?php
session_start();

// Connect to DB
$conn = new mysqli("localhost", "root", "", "ems");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Fetch user by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role=?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            if ($role == "admin") {
                header("Location: admin.html"); // Admin dashboard
            } elseif ($role == "faculty") {
                header("Location: faculty.php"); // Faculty dashboard
            } else {
                header("Location: signin.html"); // Student dashboard
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('Email not registered or role mismatch!'); window.location='login.html';</script>";
    }

} else {
    header("Location: login.html");
}

$conn->close();
?>