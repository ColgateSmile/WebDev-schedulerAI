// Get the current date and time
var now = new Date();
var date = now.toLocaleDateString();
var time = now.toLocaleTimeString();

// Set the text of the datetime element to the current date and time
document.getElementById("datetime").innerHTML = date;

function searchUsers() {
  const searchInput = document.getElementById("userSearch").value.toLowerCase();
  const userList = document.getElementById("userList");
  const users = userList.getElementsByClassName("form-check");

  for (const user of users) {
    const username = user.getElementsByTagName("label")[0].textContent.toLowerCase();
    if (username.includes(searchInput)) {
      user.classList.remove("d-none");
    } else {
      user.classList.add("d-none");
    }
  }
}

// Function to handle form submission when the "Create" button is clicked
function createList() {
  const listName = document.getElementById("listName").value;
  const selectedParticipants = Array.from(document.querySelectorAll("input[name='listUsers[]']:checked")).map(checkbox => checkbox.value);

  // Create a FormData object to store the form data
  const formData = new FormData();
  formData.append("listName", listName);
  selectedParticipants.forEach(participant => formData.append("listUsers[]", participant));

  // Send the form data to the server using Fetch API
  fetch("create_list.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Create a new row for the table
      const newRow = document.createElement("tr");
      newRow.innerHTML = `
        <td>${data.list_name}</td>
        <td>${data.created_at}</td>
        <td>${data.permitted_users}</td>
        <td><a href='SchdualingPage.php?listid=${data.list_id}' class='btn btn-primary btn-view-list'>View List</a></td>
      `;

      // Append the new row to the table body
      const assignmentListsTable = document.getElementById("assignmentListsTable");
      assignmentListsTable.appendChild(newRow);

      // Clear the form fields
      document.getElementById("listName").value = '';
      const checkboxes = document.querySelectorAll("input[name='listUsers[]']:checked");
      checkboxes.forEach(checkbox => checkbox.checked = false);
    } else {
      alert("Failed to create the list. Please try again.");
    }

    // Hide the modal after form submission
    $("#createListModal").modal("hide");
  })
  .catch(error => {
    console.error("Error:", error);
    alert("An error occurred while creating the list. Please try again.");
  });
}
