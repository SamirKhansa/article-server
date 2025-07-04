<?php 
require("../connection/connection.php");


$query = "CREATE TABLE categories(
          id INT(11) AUTO_INCREMENT PRIMARY KEY, 
          name VARCHAR(255) NOT NULL, 
          description TEXT NOT NULL,
          created_at TIMESTAMP DEFAULT CURRENT_DATE(),
          updated_at TIMESTAMP DEFAULT CURRENT_DATE()
          )";

$execute = $mysqli->prepare($query);
$execute->execute();