<?php
include 'db.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $result = $pdo->query('SELECT * FROM tasks');
        $tasks = [];

        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        echo json_encode($tasks);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $description = $_POST['description'];
        $stmt = $pdo->prepare('INSERT INTO tasks (description) VALUES (?)');
        $stmt->execute([$description]);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE['id'];
        $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO App</title>
    <!-- Bootstrap CSS via CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">
        <h1 class="text-center my-4">TODO App</h1>
        <div class="card shadow-sm">
            <div class="card-body">
                <form id="taskForm" class="mb-4">
                    <div class="input-group">
                        <input type="text" id="taskInput" class="form-control" placeholder="New task..." aria-label="New task">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </div>
                    </div>
                </form>
                <ul class="list-group" id="taskList"></ul>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS via CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
