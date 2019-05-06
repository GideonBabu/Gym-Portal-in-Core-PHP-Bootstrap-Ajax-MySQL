<?php 
require_once('header.php');
// Get id from URL to delete that user
$id = $_GET['id'];

$query = "DELETE FROM user WHERE id=$id";
// Delete user row from table based on given id
$result = mysqli_query($conn, $query);
 
if (!$result) {
    die('Could not delete data: ' . mysqli_error($conn));
}

// redirect to users page
header("Location:users.php?msg=USER_DEL");
?>