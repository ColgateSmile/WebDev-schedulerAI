// Add Schedule function
function addSchedule() {
  const scheduleName = document.getElementById("scheduleName").value;
  const permittedUsers = document.getElementById("permittedUsers").value;
  
  // Create a new row for the schedule table
  const scheduleTable = document.getElementById("schedule-table").getElementsByTagName('tbody')[0];
  const newRow = scheduleTable.insertRow();
  
  // Add the schedule name, creation date, and permitted users to the new row
  const nameCell = newRow.insertCell(0);
  const dateCell = newRow.insertCell(1);
  const usersCell = newRow.insertCell(2);
  
  const currentDate = new Date().toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'});
  
  nameCell.innerHTML = scheduleName;
  dateCell.innerHTML = currentDate;
  usersCell.innerHTML = permittedUsers;
  
  // Add the delete button to the new row
  const deleteCell = newRow.insertCell(3);
  const deleteButton = document.createElement("button");
  deleteButton.setAttribute("type", "button");
  deleteButton.setAttribute("class", "btn btn-danger");
  deleteButton.innerHTML = "Delete";
  deleteButton.addEventListener("click", deleteSchedule);
  deleteCell.appendChild(deleteButton);
  
  // Close the modal
  $('#addScheduleModal').modal('hide');
}

// Delete Schedule function
function deleteSchedule(event) {
  const row = event.target.parentNode.parentNode;
  row.parentNode.removeChild(row);
}
