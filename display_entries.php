<?php
require('crypto.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tech_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="select * from user_steps";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "User ID: " . $row["user_id"]. " - Name: " . $row["user_name"]. " " . " - Steps: " . UnsafeCrypto::decrypt($row["user_steps"], $key) . " - Time: " . $row["entry_time"] . "<br>";
    }
  } else {
    echo "0 results";
  }
 
  
  
  $conn->close();
