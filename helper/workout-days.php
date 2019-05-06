<?php
require_once('../lib/dbconnect.php');
// fetch workout plan days data if exists
$plan_id = $_GET['plan_id'];
    
if(isset($plan_id) && $plan_id !== ''){
    $query = "SELECT * FROM plan_days WHERE plan_id = $plan_id ORDER BY `order` ASC";
    $result = mysqli_query($conn, $query);
    $data = [];
    if(mysqli_num_rows($result) > 0){ // if number of fetch rows greater than 0, then we have data
        while($row = mysqli_fetch_assoc($result)){
            $arr = [];
            $arr['id'] = $row['id'];
            $arr['day_name'] = $row['day_name'];
            $arr['order'] = $row['order'];
            $data[] = $arr;
        }
        echo json_encode(['data'=>$data]);
    }
    else
        echo json_encode(['data'=>[]]);
}
else
    echo json_encode(['data'=>[]]);
exit;    
?>