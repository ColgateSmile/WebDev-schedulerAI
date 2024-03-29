<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: LogIn.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Scheduler</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
  <!-- Custom CSS -->
  <style type="text/css">
    .container {
      margin-top: 50px;
    }

    .add-task-section button {
      margin-right: 40px;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">SchedulerAI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">LogOut</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Content -->
  <div class="container">
    <h1 class="card-title text-center">Create Assignment list</h1>
    <div class="card mb-3">
      <div class="card-body">
        <h4 class="card-title text-center">Add Assignment To your List</h4>
        <div class="add-task-section">
          <form>
            <div class="form-group">
              <label for="assignment-name">Assignment Name:</label>
              <input type="text" class="form-control" id="assignment-name">
            </div>
            <div class="form-group">
              <label for="assignment-description">Description:</label>
              <textarea class="form-control" id="assignment-description"></textarea>
            </div>
            <div class="form-group">
              <label for="due-date">Due Date:</label>
              <input type="date" class="form-control" id="due-date">
            </div>
            <div class="form-group">
              <label for="user-in-charge">User in Charge:</label>
              <input type="text" class="form-control" id="user-in-charge">
            </div>
            <button type="submit" class="btn btn-primary">Add Assignment</button>
            <button type="button" class="btn btn-primary" id="minimize-btn">Minimize</button>
          </form>
        </div>
        <div class="toggle-section">
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Assignments List</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Assignment Name</th>
                <th scope="col">Description</th>
                <th scope="col">Due Date</th>
                <th scope="col">User in Charge</th>
                <th scope="col" class="text-left">Done</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Assignment 1</td>
                <td>Description 1</td>
                <td>2023-05-05</td>
                <td>User 1</td>
                <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></button></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Assignment 2</td>
                <td>Description 2</td>
                <td>2023-05-05</td>
                <td>User 2</td>
                <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></button></td>
              </tr>
              <!-- Add more assignment rows here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="container">
      <button type="button" class="btn btn-success" id="save-btn" data-toggle="modal" data-target="#assignmentListModal">Save Assignments</button>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>&copy; 2023 SchedulerAI</p>
    </div>
  </footer>


  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6h1ta5dn7yl/2+v0abTuDh0m0m6dHQFjC2zFg0Jq5Z5CmK7bc" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6Vo+D6clDnjf4M6Aj4gx5Pi+sf4+JbB" crossorigin="anonymous"></script>

  <script src="scripts/schedualing.js"></script>
</body>

</html>
