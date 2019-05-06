<?php
require_once('config.php');
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$GLOBALS['dbConnect'] = $conn;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function secure($data) {
    return trim(mysqli_real_escape_string($GLOBALS['dbConnect'],$data));
}
?>