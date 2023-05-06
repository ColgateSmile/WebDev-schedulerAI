// Get the current date and time
var now = new Date();
var date = now.toLocaleDateString();
var time = now.toLocaleTimeString();

// Set the text of the datetime element to the current date and time
document.getElementById("datetime").innerHTML = date;
