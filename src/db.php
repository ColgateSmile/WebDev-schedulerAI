<?php
// MySQL database connection settings
$host_docker = 'db';
$host_xampp = 'localhost';
$username = 'root';
$password = '';

// Connect to MySQL server
$conn = mysqli_connect($host_xampp, $username, $password);
$docker = false;
// Check connection with xampp
if (!$conn) {
  // check connection with docker otherwise
  $conn = mysqli_connect($host_docker, $username, $password);
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }
}

$result = mysqli_query($conn, 'SELECT VERSION()');
if ($result) {
    $row = mysqli_fetch_array($result);
    $mysqlVersion = $row[0];
    echo 'MySQL Server Version: ' . $mysqlVersion;
} else {
    echo 'Error retrieving MySQL server version: ' . mysqli_error($conn);
}
// Create the database name
$id1 = '312148489'; // Replace with your desired ID1
$id2 = '207037227'; // Replace with your desired ID2
$dbName = $id1 . '_' . $id2;

// Create the database
$sql = 'CREATE DATABASE IF NOT EXISTS ' . $dbName;
if (mysqli_query($conn, $sql)) {
    echo 'Database created successfully<br>';
} else {
    echo 'Error creating database: ' . mysqli_error($conn) . '<br>';
}

// Select the database
mysqli_select_db($conn, $dbName);

// Create the users table
$sql = file_get_contents('db.sql');
$sql = '
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
';

if (mysqli_query($conn, $sql)) {
    echo 'Table "users" created successfully';
} else {
    echo 'Error creating table: ' . mysqli_error($conn);
}
