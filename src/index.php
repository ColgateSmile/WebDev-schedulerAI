<?php

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
  <!-- Navbar -->
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
          <a class="nav-link" href="LogIn.php">LogOut</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Jumbotron -->
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Welcome to SchedulerAI!</h1>
      <p class="lead">Simplify your scheduling with our easy-to-use platform.</p>
      <a class="btn btn-primary btn-lg" href="SchdualingPage.php" role="button">Get Started</a>
    </div>
  </div>


  <h1 class="text-center stylish-header">Assignment Lists</h1>

  <div class="assignment-lists">
    <table class="table table-bordered bg-light">
      <thead>
        <tr>
          <th>List Name</th>
          <th>Creation Date</th>
          <th>Permitted Users</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>kids Schedule</td>
          <td>May 6, 2023</td>
          <td>user 1, User 2</td>
          <td><a href="SchdualingPage.php" class="btn btn-primary btn-view-list">View List</a></td>

        </tr>
        <tr>
          <td>fixing around the house</td>
          <td>May 6, 2023</td>
          <td>User 3, User 4</td>
          <td><a href="SchdualingPage.php" class="btn btn-primary btn-view-list">View List</a></td>

        </tr>

        <tr>
          <td>Workout</td>
          <td>May 6, 2023</td>
          <td>User 5, User 6</td>
          <td><a href="SchdualingPage.php" class="btn btn-primary btn-view-list">View List</a></td>

        </tr>

      </tbody>
    </table>
    <div class="text-center">
      <button type="button" class="btn btn-primary btn-create-list">Create New List</button>
    </div>
  </div>




  <!-- Features section -->
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h2>Easy scheduling</h2>
        <p>SchedulerAI makes scheduling appointments and meetings a breeze. Our intuitive interface and powerful features allow you to streamline your scheduling process and save time.</p>
      </div>
      <div class="col-md-8">
        <h2>Customizable</h2>
        <p>With SchedulerAI, you can tailor your scheduling settings to meet your unique needs. Whether you need to block off certain times, require certain information from your clients, or have special availability requirements, we've got you covered.</p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p>&copy; 2023 SchedulerAI</p>
        </div>
        <div class="col-md-6 text-bottom">
          <p id="datetime"></p>
        </div>
      </div>
    </div>
  </footer>

  <script src="../scripts/index.js"></script>
</body>

</html>
