$(function() {
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
    }).trigger("change");
  });
  