<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: LogIn.php");
    exit();
}
if(isset($_GET['listid'])){
  $_SESSION['listid'] = $_GET['listid'];
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
    input:date:before {
      content: attr(data-date);
      display: inline-block;
      color: #fff;
      background: #337ab7;
      border-radius: 3px;
      padding: 0 5px;
    }
    table {
      border-collapse: collapse;
    }

    td {
      position: relative;
      padding: 5px 10px;
    }
    tr.strikeout td:before {
      content: " ";
      position: absolute;
      top: 50%;
      left: 0;
      border-bottom: 3px solid #007bff;
      width: 100%;
    }
  </style>
</head>

<body>

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
      <li>
        </li>
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
          <form class="container" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="assignment-name">Assignment Name:</label>
                <input type="text" class="form-control" id="assignment-name" name="assignment-name" required>
            </div>
            <div class="form-group">
                <label for="assignment-description">Description:</label>
                <textarea class="form-control" id="assignment-description" name="assignment-description" required></textarea>
            </div>
            <div class="form-group">
                <label for="due-date">Due Date:</label>
                <input type="date" class="form-control" id="due-date" name="due-date"
                       data-date="" data-date-format="DD.MM.YYYY" value="2015-08-09" required>
            </div>
            <div class="form-group">
                <label for="user-in-charge">User in Charge: (email)</label>
                <input type="text" class="form-control" id="user-in-charge" name="user-in-charge" required>
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
              <?php
              if (isset($_GET['listid'])) {
                  $listid = $_GET['listid'];
                  require_once "./db.php"; // Include your database connection file

                  $sql = "
                      SELECT t.id, t.name ,t.description, t.due_date, u.firstname, u.lastname, t.completed
                      FROM tasks t
                      JOIN lists l ON t.list_id = l.id
                      JOIN users u ON u.id = t.user_in_charge
                      WHERE l.id = ?
                  ";
                  $stmt1 = $conn->prepare($sql);
                  $stmt1->bind_param('i', $listid);
                  $stmt1->execute();
                  $result = $stmt1->get_result();

                  foreach ($result as $row) {
                    $class = $row['completed'] ? 'class=strikeout ' : '';
                    $tr = "<tr " . $class . "id='task-". $row['id'] . "' data-task-id='" . $row['id'] . "'>";
                    echo  $tr .
                          "<td>" . $row['id'] . "</td>" .
                          "<td>" . $row['name'] . "</td>" .
                          "<td>" . $row['description'] . "</td>" .
                          "<td>" . date("M jS, Y", strtotime($row['due_date'])) . "</td>" .
                          "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>" .
                          "<td class='text-center'>
                          <input type='checkbox' class='form-check-input' data-task-completed='" . $row['completed'] . "' " . ($row['completed'] ? 'checked' : '') . ">
                          </td>" . 
                          "<td><button type='button' class='btn btn-danger btn-sm delete-btn'><i class='fas fa-trash-alt'></i></button></td>" .
                          "</tr>";
                  }
              }
              ?>
              <?php
              if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Get form values
                include_once "./db.php";
                $assignmentName = $_POST["assignment-name"];
                $assignmentDescription = $_POST["assignment-description"];
                $dueDate = $_POST["due-date"];
                $userInCharge = $_POST["user-in-charge"];
            
                // Validate form inputs
                if (empty($assignmentName) || empty($assignmentDescription) || empty($dueDate) || empty($userInCharge)) {
                    $error = "Please enter all the fields.";
                } else {
                  $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                  $stmt->bind_param("s", $userInCharge);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $user = $result->fetch_assoc();
                  $stmt->close();
          
                  if (!$user) {
                      $error = "User with email '$userEmail' not found.";
                      echo $error;
                  } else {
                      // User found, insert the assignment into the tasks table
                      $listId = $_SESSION['listid'];
                      echo $listId;
                      $userId = $user['id'];
                      $stmt = $conn->prepare("INSERT INTO tasks (list_id, name, description, due_date, user_in_charge) VALUES (?, ?, ?, ?, ?)");
                      $stmt->bind_param("isssi", $listId, $assignmentName, $assignmentDescription, $dueDate, $userId);
                      $stmt->execute();
          
                      // Redirect back to the same page to refresh the list
                      echo "<script>window.location.href = 'SchdualingPage.php?listid=$listId';</script>";
                      exit();
                  }
                }
              }
              ?>
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
    <!-- Add this script block at the bottom of your HTML, before the closing </body> tag -->
<script>
  $("#minimize-btn").click(function() {
    $(".add-task-section").slideUp();
    $(".toggle-section").html("<button type='button' class='btn btn-primary' id='Add_Assignment-btn'>Add Assignment</button>");
  });

  // Revert button click event
  $(document).on("click", "#Add_Assignment-btn", function() {
      $(".add-task-section").slideDown();
      $(".toggle-section").empty(); // Remove existing buttons
  });
  // Function to handle delete button click
  function handleDeleteButtonClick(taskId) {
    // Show a confirmation dialog before deleting the task
    if (confirm("Are you sure you want to delete this task?")) {
      // Remove the corresponding row from the table
      $("#task-" + taskId).remove();
      
      // Send an AJAX request to delete the task (optional)
      $.ajax({
        url: "delete_task.php",
        method: "POST",
        data: { taskId: taskId },
        success: function() {
          // Optional success handling (you can remove this part if not needed)
          alert("Task deleted successfully.");
        },
        error: function() {
          // Optional error handling (you can remove this part if not needed)
          alert("An error occurred while deleting the task.");
        }
      });
    }
  }

  // Function to handle complete checkbox change
  function handleCompleteCheckboxChange(taskId, isChecked) {
    // Send an AJAX request to update the completed status of the task
    $.ajax({
      url: "update_completed.php", // Replace this with the URL of the PHP script to handle the update action
      method: "POST",
      data: { taskId: taskId, completed: isChecked },
      success: function() {
        // If the request is successful, update the table row class based on the completed status
        if (isChecked) {
          $("#task-" + taskId).addClass("strikeout");
        } else {
          $("#task-" + taskId).removeClass("strikeout");
        }
      },
      error: function() {
        alert("An error occurred while updating the task status.");
      }
    });
  }

  // Add event listener for delete buttons
  $(document).on("click", ".delete-btn", function() {
    var taskId = $(this).closest("tr").data("task-id");
    handleDeleteButtonClick(taskId);
  });

  // Add event listener for complete checkboxes
  $(document).on("change", ".form-check-input", function() {
    var taskId = $(this).closest("tr").data("task-id");
    var isChecked = $(this).prop("checked");
    handleCompleteCheckboxChange(taskId, isChecked);
  });
  $("input").on("change", function() {
    this.setAttribute(
        "data-date",
        moment(this.value, "YYYY-MM-DD")
        .format( this.getAttribute("data-date-format") )
    )
}).trigger("change")
</script>

</body>

</html>
