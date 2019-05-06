<?php
require_once('../lib/dbconnect.php');
$postData = $_POST;
if (isset($postData) && count($postData)) {
    switch($postData['type']){
        case 'planInfo':
            $userId = getUserIdByEmail(secure($postData['user_email']));
            $sql = "UPDATE plan SET `user_id` = $userId, plan_name = '".secure($postData['plan_name'])."', plan_description = '".secure($postData['plan_description'])."', plan_difficulty = ".$postData['plan_difficulty']."  WHERE id = ".$postData['plan_id'];
            break;
        case 'planDayInfo':
            $planDayId = $postData['plan_day_id'];
            $sql = "UPDATE plan_days SET day_name = '".secure($postData['day_name'])."' WHERE id = $planDayId";
            break;
        case 'planDayExerciseInfo':
            // First delete all exercise instances from table for this plan_day_id
            $dayId = $postData['plan_day_id'];
            $sql = "DELETE FROM exercise_instances WHERE day_id = $dayId; ";
            foreach($postData['checked_ex_id'] as $exercise){
                if ($exercise['exercise_duration'] == '')
                    $exercise['exercise_duration'] = 0;
                $sql .= "INSERT INTO exercise_instances VALUES(NULL,".$exercise['exercise_id'].",$dayId,'".$exercise['exercise_duration']."',0);";
            }
            break;
        default:
            break;

    }
    if (mysqli_multi_query($conn, $sql)) {
        echo json_encode(['error'=>false,'message'=>'Data Updated']);
        exit;
    }
    else{
        print_r(mysqli_error($conn));
    }
}

function getUserIdByEmail($email){
    $query = "SELECT id FROM user WHERE email = '$email'";
    $result = mysqli_query($GLOBALS['dbConnect'], $query);
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    }
    return;
}