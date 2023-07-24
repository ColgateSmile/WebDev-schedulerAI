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
  <title>Homepage</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">SchedulerAI</a>
    <span class="navbar-text ml-auto">
      Welcome, <?php echo $_SESSION['username'] ?> <!-- Display the user's name -->
    </span>
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
          <?php 
          require_once "./db.php";
          $sql = "
            SELECT l.id, l.name AS list_name, l.created_at
            FROM lists l
            JOIN users u ON l.created_by = u.id
            WHERE u.email = ?
            UNION
            SELECT l.id, l.name AS list_name, l.created_at
            FROM lists l
            JOIN participants p ON l.id = p.list_id
            JOIN users u ON p.user_id = u.id
            WHERE u.email = ?;
          ";
          $stmt1 = $conn->prepare($sql);
          $stmt1->bind_param('ss', $_SESSION['email'], $_SESSION['email']);
          $stmt1->execute();
          $result = $stmt1->get_result();

          foreach($result as $row){
            echo "<tr><td>" . $row['list_name'] . "</td>" .
                 "<td>" . $row['created_at'] . "</td>";
          
            $sql = "
              SELECT u.firstname, u.lastname
              FROM participants p
              JOIN users u ON p.user_id = u.id
              WHERE p.list_id = ?;
            ";
            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param('i', $row['id']);
            $stmt2->execute();
            $result = $stmt2->get_result();
            echo '<td>';
            $isFirst = true;
            foreach ($result as $row1) {
                if (!$isFirst) {
                    echo ", ";
                } else {
                    $isFirst = false;
                }
                echo $row1['firstname'] . " " . $row1['lastname'];
            }
            echo '</td>';
            echo "<td><a href='SchdualingPage.php?listid=" . $row['id'] . "' class='btn btn-primary btn-view-list'>View List</a></td></tr>";
          }
          ?>
      </tbody>
    </table>
    <div class="text-center">
      <button type="button" class="btn btn-primary btn-create-list" data-toggle="modal" data-target="#createListModal">Create New List</button>
    </div>
  </div>

  <!-- Create List Modal -->
  <div class="modal fade" id="createListModal" tabindex="-1" role="dialog" aria-labelledby="createListModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createListModalLabel">Create New List</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Add form elements for creating a new list -->
          <form>
            <div class="form-group">
              <label for="listName">List Name:</label>
              <input type="text" class="form-control" id="listName">
            </div>
            <div class="form-group">
              <label for="listUsers">Permitted Users:</label>
              <input type="text" class="form-control" id="listUsers">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Create</button>
        </div>
      </div>
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

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-7jZacXBD4/QMz8cQ4m6Wpl7gvp/1O/Bd++BvTwG/CSLAoWTXTf7kH3RswS8avhSo" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="scripts/index.js"></script>
</body>

</html>
