<?php 
require_once('../lib/dbconnect.php');
if (isset($_GET['term']) && $_GET['term'] != '') {
    $term = $_GET['term'];
    $query = "SELECT email FROM user WHERE email like '%$term%'";
    $result = mysqli_query($conn, $query);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row['email'];
    }
    echo json_encode($data);
    exit;
}
else
    echo json_encode([]);
exit;
?>