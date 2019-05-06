<?php
require_once('../lib/dbconnect.php');
// fetch the available records for a Plan using ID and store data in array and variables
$planDayID = $_GET['plan_day_id'];
$query = "SELECT * FROM exercise_instances WHERE day_id = $planDayID";
$res = mysqli_query($conn, $query);
$selectedExerciseID = array(); 
$exerciseDuration = array();
if(mysqli_num_rows($res)){
    while($row = mysqli_fetch_assoc($res)){
        $exerciseID = $row['exercise_id'];
        $selectedExerciseID[] = $exerciseID;
        $exerciseDuration[$exerciseID] = $row['exercise_duration'];
    }
}

// Fetch a list of all exercises from exercise table
$query = "SELECT * FROM exercise";
$result = mysqli_query($conn, $query);
$output = "<div id='exercise-list' class='checkbox'>";
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $checkedStatus = "";
        if(in_array($row['id'], $selectedExerciseID))
            $checkedStatus = "checked='checked'";
            $duration = isset($exerciseDuration[$row['id']]) ? $exerciseDuration[$row['id']] : '';
            $output .= "<div class='checkbox exercise-list' onchange=updatePlanExerciseInfo(".$planDayID.")>"
                        ."<div class='col-md-8'>"
                            ."<input id='exer_".$row['id']."' type='checkbox' value='".$row['id']."' $checkedStatus >&nbsp;&nbsp;&nbsp;"
                            ."<label for='exer_".$row['id']."'>".$row['exercise_name']."</label>"
                        ."</div>"
                        ."<div class='col-md-4'> <input type='number' value='".$duration."' id='dur_".$row['id']."' style='width:150px;' placeholder='Duration (minutes)' >"."</div>"
                    . "</div>";
    }
}
$output .= "</select>";
echo json_encode(['error'=>false,'data'=>$output]);exit;