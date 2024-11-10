<?php
    session_start();
    require 'db.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_GET['id'])) {
        $task_id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $_SESSION['user_id']);

        if ($stmt->execute()) {
            header("Location: tasks.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
?>
