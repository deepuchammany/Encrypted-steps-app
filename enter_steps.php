<?php
require('crypto.php');
$id = $_POST['user_id'];
$name = $_POST['user_name'];
$time = $_POST['entry_time'];
$steps = $_POST['user_steps'];

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

$encrypted = UnsafeCrypto::encrypt($steps, $key);

$sql = "INSERT INTO user_steps (user_id, user_name, entry_time, user_steps) VALUES ('$id', '$name', '$time', '$encrypted')";
// Perform query
if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location:display_entries.php");
