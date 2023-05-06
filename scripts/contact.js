function sendMessage() {
    var message = document.getElementById("message").value;

    // Check if the message field is empty
    if (message.trim() === "") {
        alert("Please enter a message.");
        return;
    }

    // Clear the message field
    document.getElementById("message").value = "";

    document.getElementById("successMessage").style.display = "block";
}
