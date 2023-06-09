<?php
mysqli_report(MYSQLI_REPORT_OFF);
$servername = "db";
$username = "root";
$password = "root"; // change this to empty string if you are using xampp and not mamp
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  echo "<h2>error connecting to db</h2>";
  die();
}
$dbName = "tirugl_9";

if (!$conn->select_db($dbName)) {
  echo "<p>creating new database</p>";
  $sql = "CREATE DATABASE $dbName";
  if ($conn->query($sql)) {
    $conn->select_db($dbName);
    echo "<p>database $dbName created</p>";
    echo "<p>creating customers table</p>";
    $sql = 'CREATE TABLE `tirugl_9`.`customers` ( `id` INT(255) NOT NULL AUTO_INCREMENT , `firstname` VARCHAR(999) NOT NULL , `lastname` VARCHAR(999) NOT NULL , `phone` VARCHAR(999) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    if ($conn->query($sql)) {
      echo "customers tables created";
    } else {
      echo "<p> error creating customers table error: $conn->error </p>";
    }
  };
}
