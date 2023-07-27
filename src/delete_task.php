<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["taskId"])) {
    require_once "./db.php"; // Include your database connection file

    $taskId = $_POST["taskId"];

    // Perform the delete action
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $stmt->close();
}