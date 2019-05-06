<?php
require_once('../lib/dbconnect.php');
// set/insert workout plan days for a plan using id
$planID = $_POST['plan_id'];
$order = $_POST['order'];
if (isset($planID) && $planID !== '') {
    $query = "INSERT INTO plan_days VALUES(NULL,$planID,'',$order)";
    if (mysqli_query($conn, $query)) {
        $planDayId = mysqli_insert_id($conn);
        echo json_encode(['error' => false, 'planDayId'=>$planDayId]);
        exit;
    }
    else
        echo json_encode(['error'=>true,'message'=> mysqli_error($conn)]);
}
else
    echo json_encode(['error'=>true,'message'=>'Plan ID NOT Set']);
exit;
?>