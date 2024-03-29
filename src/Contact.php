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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style>
    .btn-send {
      margin-left: 10px;
      /* Adjust the margin as desired */
    }
  </style>

</head>

<body>
  <!-- Header -->

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
          <a class="nav-link"  href="logout.php">LogOut</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h1>Contact Us</h1>
        <form>
          <div class="form-group">
            <label for="messageType">Message Type</label>
            <select class="form-control" id="messageType">
              <option>Complain</option>
              <option>Feedback</option>
              <option>Business Inquiry</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" rows="5" required></textarea>
          </div>
          <div class="d-flex justify-content-center"> <!-- Center aligns the button -->
            <button type="button" class="btn btn-success btn-send" onclick="sendMessage()">Send</button>
          </div>
        </form>
        <div id="successMessage" style="display: none;" class="mt-3 alert alert-success" role="alert">
          Thanks! Your message has been received and will be handled by our team.
        </div>
      </div>
    </div>
  </div>
  <!-- </div> -->

  <!-- Footer -->
  <footer>
    <div class="container py-3">
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

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGi/7SfCypdtkWr+0nx384Zk+5T0Ukre/WRS" crossorigin="anonymous"></script>

  <script src="scripts/contact.js"></script>

</body>

</html>
