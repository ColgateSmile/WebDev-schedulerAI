<?php
// MySQL database connection settings
$host_docker = 'db';
$host_xampp = 'localhost';
$username = 'root';
$password = '';

// Connect to MySQL server
$conn = @mysqli_connect($host_xampp, $username, $password);
$docker = false;

// Check connection with xampp
if (!$conn) {
  // check connection with docker otherwise
  $conn = @mysqli_connect($host_docker, $username, $password);
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }
}

$result = mysqli_query($conn, 'SELECT VERSION()');
if ($result) {
    $row = mysqli_fetch_array($result);
    $mysqlVersion = $row[0];
    // echo 'MySQL Server Version: ' . $mysqlVersion;
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
    // echo 'Database created successfully<br>';
} else {
    echo 'Error creating database: ' . mysqli_error($conn) . '<br>';
}

// Select the database
mysqli_select_db($conn, $dbName);

// Create the users table
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
    // echo 'Table "users" created successfully';
} else {
    echo 'Error creating table: ' . mysqli_error($conn);
}

// Insert three users with the same password '123test' if they don't already exist
$sql = "
INSERT IGNORE INTO `users` (`firstname`, `lastname`, `email`, `password`)
SELECT * FROM (
    SELECT 'User', '1', 'user1@test.test', 'test123'
    UNION ALL
    SELECT 'User', '2', 'user2@test.test', 'test123'
    UNION ALL
    SELECT 'User', '3', 'user3@test.test', 'test123'
) AS temp
WHERE NOT EXISTS (
    SELECT 1 FROM `users` WHERE `email` IN ('user1@test.test', 'user2@test.test', 'user3@test.test')
);
";

if (mysqli_query($conn, $sql)) {
    // echo 'Users inserted successfully';
} else {
    echo 'Error inserting users: ' . mysqli_error($conn);
}

// Create the lists table
$sql = '
CREATE TABLE IF NOT EXISTS `lists` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB;
';

if (mysqli_query($conn, $sql)) {
    // echo 'Table "lists" created successfully';
} else {
    echo 'Error creating table: ' . mysqli_error($conn);
}

// Insert three diferent lists if they don't already exist
$sql = "
INSERT INTO `lists` (`name`, `created_at`, `created_by`)
SELECT * FROM (
    SELECT 'List 1', '2023-04-01', 1
    UNION ALL
    SELECT 'List 2', '2023-05-01', 2
    UNION ALL
    SELECT 'List 3', '2023-06-01', 3
) AS temp
WHERE NOT EXISTS (
    SELECT 1 FROM `lists` WHERE `name` IN ('List 1', 'List 2', 'List 3')
);
";

if (mysqli_query($conn, $sql)) {
    // echo 'Users inserted successfully';
} else {
    echo 'Error inserting lists: ' . mysqli_error($conn);
}

// Create the participants table
$sql = '
CREATE TABLE IF NOT EXISTS `participants` (
  `list_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  PRIMARY KEY (`list_id`,`user_id`)
) ENGINE=InnoDB;
';

if (mysqli_query($conn, $sql)) {
    // echo 'Table "participants" created successfully';
} else {
    echo 'Error creating table: ' . mysqli_error($conn);
}

// Insert the participants if they don't already exist
$sql = "
INSERT INTO `participants` (`list_id`, `user_id`)
SELECT * FROM (
    SELECT 1 as list_id, 1 as user_id
    UNION ALL
    SELECT 1, 2
    UNION ALL
    SELECT 2, 2
    UNION ALL
    SELECT 2, 3
    UNION ALL
    SELECT 3, 1
    UNION ALL
    SELECT 3, 3
) AS temp
WHERE NOT EXISTS (
    SELECT 1 FROM `participants` WHERE (`list_id`, `user_id`) IN ((1, 1), (1, 2), (2, 2), (2, 3), (3, 1), (3, 3))
);
";

if (mysqli_query($conn, $sql)) {
    // echo 'Users inserted successfully';
} else {
    echo 'Error inserting participants: ' . mysqli_error($conn);
}

// Create the tasks table
$sql = '
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `list_id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `due_date` datetime NOT NULL,
  `user_in_charge` int UNSIGNED NOT NULL,
  `completed` boolean NOT NULL DEFAULT 0,
  FOREIGN KEY (`user_in_charge`) REFERENCES `users` (`id`),
  FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
';

if (mysqli_query($conn, $sql)) {
    // echo 'Table "tasks" created successfully';
} else {
    echo 'Error creating table: ' . mysqli_error($conn);
}

// Insert the tasks if they don't already exist
// $sql = "
// INSERT INTO `tasks` (`list_id`, `name`, `description`, `due_date`, `user_in_charge`, `completed`)
// SELECT list_id, name, description, due_date, user_in_charge, completed FROM (
//     SELECT 1 as list_id
//     UNION ALL
//     SELECT 1, 'Task 1', 'Task 1 description', '2023-04-05', 1, 0
//     UNION ALL
//     SELECT 1, 'Task 2', 'Task 2 description', '2023-04-10', 2, 0
//     UNION ALL
//     SELECT 2, 'Task 1', 'Task 1 description', '2023-05-05', 2, 0
//     UNION ALL
//     SELECT 2, 'Task 2', 'Task 2 description', '2023-05-10', 3, 0
//     UNION ALL
//     SELECT 3, 'Task 1', 'Task 1 description', '2023-06-05', 1, 0
//     UNION ALL
//     SELECT 3, 'Task 2', 'Task 2 description', '2023-06-10', 3, 0
// ) AS temp
// WHERE NOT EXISTS (
//     SELECT 1 FROM `tasks` WHERE (`list_id`, `name`, `description`, `due_date`, `user_in_charge`, `completed`) IN ((1, NULL, NULL, NULL, NULL, NULL), (1, 'Task 1', 'Task 1 description', '2023-04-05', 1, 0), (1, 'Task 2', 'Task 2 description', '2023-04-10', 2, 0), (2, 'Task 1', 'Task 1 description', '2023-05-05', 2, 0), (2, 'Task 2', 'Task 2 description', '2023-05-10', 3, 0), (3, 'Task 1', 'Task 1 description', '2023-06-05', 1, 0), (3, 'Task 2', 'Task 2 description', '2023-06-10', 3, 0))
// );
// ";

if (mysqli_query($conn, $sql)) {
    // echo 'Users inserted successfully';
} else {
    echo 'Error inserting tasks: ' . mysqli_error($conn);
}
