<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["taskId"]) && isset($_POST["completed"])) {
    require_once "./db.php"; // Include your database connection file

    $taskId = $_POST["taskId"];
    $completed = $_POST["completed"];

    // Perform the update action
    $stmt = $conn->prepare("UPDATE tasks SET completed = ? WHERE id = ?");
    $stmt->bind_param("ii", $completed, $taskId);
    $stmt->execute();
    $stmt->close();
}