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
      const username = user.textContent.toLowerCase();
      if (username.includes(searchInput)) {
        user.style.display = "block";
      } else {
        user.style.display = "none";
      }
    }
}

// JavaScript function to handle list creation
function createList() {
    const listName = document.getElementById("listName").value;
    const selectedParticipants = Array.from(document.querySelectorAll("input[name='listUsers[]']:checked")).map(checkbox => checkbox.value);

    // Add your logic to handle list creation with the selected participants
    // You can use the 'listName' and 'selectedParticipants' variables to send data to your server using AJAX, for example.
    // For simplicity, I'm not including the AJAX part here.
    console.log("List Name:", listName);
    console.log("Selected Participants:", selectedParticipants);
    // Add logic here to create the list and add the selected participants to it.
}