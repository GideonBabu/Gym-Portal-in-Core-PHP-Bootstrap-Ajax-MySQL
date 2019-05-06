<?php
require_once('../lib/dbconnect.php');

function getUserInfo($userId){
    $sql = "SELECT * FROM user WHERE id = $userId";
    $result = mysqli_query($GLOBALS['dbConnect'], $sql);
    if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    else
        return false;
}

function getPlanDayCount($planId){
    $sql = "SELECT id FROM plan_days WHERE id = $planId";
    $result = mysqli_query($GLOBALS['dbConnect'], $sql);
    return $result->num_rows;
}

function sendEmail($to_email, $subject, $message, $headers){
    if(!mail($to_email,$subject,$message,$headers)){
        print_r("Error while sending email, please check your SMTP connection and username/password");
    }
    else
        print_r("Email sent successfully");
    exit;
}

function getExerciseNameById($exerciseId){
    $sql = "SELECT exercise_name FROM exercise WHERE id = $exerciseId";
    $res = mysqli_query($GLOBALS['dbConnect'], $sql);
    if(mysqli_num_rows($res)){
        $row = mysqli_fetch_assoc($res);
        return $row['exercise_name'];
    }
    else
        return "";
}