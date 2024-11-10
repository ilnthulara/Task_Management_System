<?php
    session_start();
    require 'db.php';

    // Ensure user is authenticated
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';

    // Fetch tasks with search functionality
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ? AND title LIKE ? ORDER BY created_at DESC");
    $stmt->bind_param("is", $user_id, $search);
    $stmt->execute();
    $tasks = $stmt->get_result();
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
        .btn-primary:hover {
            background-color: #0056b3; /* Slightly darker blue */
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333; /* Slightly darker red */
            color: white;
        }

        .btn-primary {
            background: linear-gradient(to right, #007bff, #0056b3);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(to right, #dc3545, #c82333);
            border: none;
        }
    </style>
</head>
<body class="default-page">
    <div class="container mt-5">
        <h1 class="text-center animate__animated animate__pulse">Task Dashboard</h1>
        
        <div class="container mt-5">
            <h1 class="text-center animate__animated animate__pulse">Your Tasks</h1>
            <ul class="list-group">
                <?php while ($task = $tasks->fetch_assoc()): ?>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong><?= htmlspecialchars($task['title']) ?></strong>
                                <p class="mb-0"><?= htmlspecialchars($task['description']) ?></p>
                                <p class="mb-0"><strong>Priority:</strong> <?= ucfirst($task['priority']) ?> | <strong>Category:</strong> <?= $task['category'] ?></p>
                                <p class="mb-0"><strong>Due Date:</strong> <?= $task['due_date'] ?></p>
                                <p class="mb-0"><strong>Status:</strong> <?= $task['status'] ?></p>
                            </div>
                            <div>
                                <a href="edit_task.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                                <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
    <div class="d-flex flex-column align-items-center mt-4">
        <div class="btn-group w-50 mb-3">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill" onclick="window.location.href='add_task.php';">
                <i class="bi bi-plus-circle"></i> Add Task
            </button>
        </div>

        <div class="btn-group w-50">
            <button type="submit" class="btn btn-danger btn-lg rounded-pill" onclick="window.location.href='logout.php';">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </div>
        <br>
    </div>
</body>
</html>