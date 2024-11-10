<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: tasks.php");
            exit;
        } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid credentials!</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>User not found!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Task Management System</title>
    <style>
        body {
            background: url('img/wave.svg') no-repeat center bottom; /* Set the image */
            background-size: cover; /* Cover the entire background */
            min-height: 100vh; /* Ensure it spans the full viewport height */
            margin: 0;
        }

    </style>
</head>
<body class="login-page">
    <div class="container mt-5 mx-auto">
        <h2 class="text-center animate__animated animate__pulse">Login</h2>
        <form method="POST" class="p-4 border rounded shadow-sm mx-auto" style="max-width: 400px;">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="d-flex flex-column align-items-center mt-5">
            <button type="submit" class="btn btn-primary btn-lg" style="width: 200px;" onclick="window.location.href='registration.php';">Register</button>
        </div>
    </div>
</body>
</html>
