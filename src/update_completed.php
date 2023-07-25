<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the task ID and completed status from the AJAX request
    $taskId = $_POST["taskId"];
    $completed = $_POST["completed"] === "true" ? 1 : 0; // Convert "true" to 1, "false" to 0

    // Update the task's completed status in the database
    require_once "./db.php"; // Include your database connection file
    $stmt = $conn->prepare("UPDATE tasks SET completed = ? WHERE id = ?");
    $stmt->bind_param("ii", $completed, $taskId);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Send a response back to the AJAX request
    echo "success";
}
?>
