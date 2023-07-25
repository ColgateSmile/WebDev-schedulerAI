$(document).ready(function() {
    // Add assignment form submission
    $("form").submit(function(event) {
        event.preventDefault();

    //     // Get form values
    //     var assignmentName = $("#assignment-name").val();
    //     var assignmentDescription = $("#assignment-description").val();
    //     var dueDate = $("#due-date").val();
    //     var userInCharge = $("#user-in-charge").val();

    //     // Validate form inputs
    //     if (assignmentName === "" || assignmentDescription === "" || dueDate === "" || userInCharge === "") {
    //         alert("Please enter all the fields.");
    //         return;
    //     }

    //     // Add new row to the table
    //     var newRow = $("<tr>");
    //     newRow.append("<th scope='row'>" + ($("tbody tr").length + 1) + "</th>");
    //     newRow.append("<td>" + assignmentName + "</td>");
    //     newRow.append("<td>" + assignmentDescription + "</td>");
    //     newRow.append("<td>" + dueDate + "</td>");
    //     newRow.append("<td>" + userInCharge + "</td>");
    //     newRow.append("<td class='text-center'><input type='checkbox' class='form-check-input'></td>");
    //     newRow.append("<td><button type='button' class='btn btn-danger btn-sm delete-btn'><i class='fas fa-trash-alt'></i></button></td>");
    //     $("tbody").append(newRow);

    //     // Clear form inputs
    //     $("#assignment-name").val("");
    //     $("#assignment-description").val("");
    //     $("#due-date").val("");
    //     $("#user-in-charge").val("");
    });

    // Minimize button click event
    $("#minimize-btn").click(function() {
        $(".add-task-section").slideUp();
        $(".toggle-section").html("<button type='button' class='btn btn-primary' id='Add_Assignment-btn'>Add Assignment</button>");
    });

    // Revert button click event
    $(document).on("click", "#Add_Assignment-btn", function() {
        $(".add-task-section").slideDown();
        $(".toggle-section").empty(); // Remove existing buttons
    });

    // Delete button click event
    $(document).on("click", ".delete-btn", function() {
        $(this).closest("tr").remove();
        updateRowNumbers();
    });

    // Function to update row numbers
    function updateRowNumbers() {
        $("tbody tr").each(function(index) {
            $(this).find("th").text(index + 1);
        });
    }
});
