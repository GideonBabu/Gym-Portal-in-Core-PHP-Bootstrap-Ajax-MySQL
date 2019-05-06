<?php require_once('header.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : "";
if (empty($action))
    die('Bad request - action not specified!');
if ($action == 'edit' && empty($_GET['id'])) {
    die("Bad Request | Plan ID not specified!");
}
if ($action == 'add') { // for add workout plans create dummy entry to redirect user to edit page
    $query = "INSERT INTO plan VALUES (NULL,'New Workout Plan','',1,0)";
    if (mysqli_query($conn, $query)) {
        $planID = mysqli_insert_id($conn);
        header("Location:".$_PHP_SELF."?action=edit&id=$planID");
    }
    else{
        print_r(mysqli_error($conn));
        exit;
    }
}
if ($action == "edit" && isset($_GET['id']) && $_GET['id'] !== "") { // gather data about the plan using id    
    $query = "SELECT * FROM plan WHERE id = ".$_GET['id'];
    if($result = mysqli_query($conn, $query)){
        $planDetail = mysqli_fetch_assoc($result);
        $userInfoResult = mysqli_query($conn, "SELECT * FROM user where id = ".$planDetail['user_id']);
        $userInfo = mysqli_fetch_assoc($userInfoResult);
    }
    else
        die("This workout plan has no information to proceed. Please create a new plan.");    
}

if ($action == 'delete' && isset($_GET['id']) && $_GET['id'] !== "") {
    $planID = $_GET['id'];
    $query = "DELETE FROM plan WHERE id = $planID; DELETE FROM exercise_instances WHERE day_id IN (SELECT id FROM plan_days WHERE plan_id=$planID); DELETE FROM plan_days where plan_id = $planID;";
    if (mysqli_multi_query($conn, $query) === TRUE) {
        header("Location: index.php?msg=PLAN_DEL");
    } else {
        echo "Could not delete data ". $conn->error;
        exit;
    }
}
?>
<h4>Workout Plan
    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#preview-modal"
        onclick="showPlan(<?php echo $planDetail['id']?>);">Preview & Email</button>&nbsp;
    <button type="submit" class="btn btn-primary btn-sm" onclick="showPlan(<?php echo $planDetail['id']?>, 'y');">Send
        Email to user</button>&nbsp;
    <a href="workout-plan.php?id=<?php echo $_GET['id']; ?>&action=delete" class="btn btn-primary btn-sm">Delete
        Plan</a></h4>
<form id="plan-workout" action="javascript:void(0)" method="post">
    <div class="form-group">
        <div class="form-control" onchange="updatePlanInfo(<?=$planDetail['id']?>);">
            <div class="form-group">
                <label for="userId">Select User By Email (Auto-complete)</label>
                <input type="text" required="required" id="user_email"
                    value="<?=$action == 'edit' ? $userInfo['email']:""?>" class="form-control" id="userId"
                    required="required" placeholder="Select User By Email">
            </div>
            <div class="form-group">
                <label for="plan_name">Plan Title</label>
                <input type="text" value="<?=$action == 'edit' ? $planDetail['plan_name']:""?>" class="form-control"
                    id="plan_name" required="required" placeholder="Plan Title">
            </div>
            <div class="form-group">
                <label for="plan_description">Plan Description</label>
                <textarea class="form-control" id="plan_description"
                    placeholder="Plan Description"><?= $action == 'edit' ? $planDetail['plan_description']:"";?></textarea>
            </div>
            <div class="form-group">
                <label for="plan_difficulty">Plan Difficulty</label>
                <select id="plan_difficulty" class="form-control">
                    <option value="1" <?=($action=='edit' && $planDetail['plan_difficulty'] == 1) ? 'selected':''?>>
                        Beginner</option>
                    <option value="2" <?=($action=='edit' && $planDetail['plan_difficulty'] == 2) ? 'selected':''?>>
                        Intermediate</option>
                    <option value="3" <?=($action=='edit' && $planDetail['plan_difficulty'] == 3) ? 'selected':''?>>
                        Expert</option>
                </select>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="border" id="plan-days">
                        <div class="plan-header">
                            <div class="col-md-9">Workout Plan Days</div>
                            <div class="col-md-3" id="add-more" onclick="addMore('add');">&#10133;Add Day</div>
                        </div>
                        <div id="plan-list"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border" id="plan-day-exercise">
                        <div class="plan-header">
                            Exercises
                        </div>
                        <div id="exercise-list"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    addMore();
    $('.plan-day-item')[0].click();
});

$(function() {
    $("#user_email").autocomplete({
        source: 'helper/user-email.php'
    });
});

function addMore(param) {
    var param = param || '';
    if (param == 'add' || getPlanDayID() == false) {
        var ctr = $('#plan-days').find('#plan-list').find('.plan-day-item').length;
        var delStr = "";
        if (ctr != 0) {
            delStr = "<span id='delDay' onclick='deleteDay(" + ctr + ")'>✖</span>"
        }
        var data = '\
                    <div class="plan-day-item" id=' + ctr + '>\
                        <div class="col-md-3">Day <span class="day-no"></span></div>\
                        <div class="col-md-6"><input id="day_name" placeholder="Enter day name"></div>\
                        <div id="actionBtn" class="col-md-3">' + delStr + '</div>\
                    </div>';
        $('#plan-days').find('#plan-list').append(data);
        setDays(); // Set Days counter
        // Also hit ajax to create a plan day and get it's server id, it will be used for ref
        setPlanDayId(ctr);
    } else if (res = getPlanDayID()) {
        $.each(res, function(key, val) {
            var delStr = "";
            if (key != 0) {
                delStr = "<span id='delDay' onclick='deleteDay(" + key + "," + val.id + ")'>✖</span>"
            }
            var data = '\
                        <div class="plan-day-item" id=' + key + ' onclick="getExercises(' + val.id + ')">\
                            <div class="col-md-3">Day <span class="day-no"></span></div>\
                            <div class="col-md-6"><input onchange="updatePlanDayInfo(' + val.id +
                ',$(this).val())" placeholder="Enter day name" value="' + val.day_name + '"></div>\
                            <div id="actionBtn" class="col-md-3">' + delStr + '</div>\
                        </div>';
            $('#plan-days').find('#plan-list').append(data);
            setDays(); // Set Days counter
        });
    }
    $('.plan-day-item').click(function() {
        $('.plan-day-item').removeClass('selected');
        $(this).addClass('selected');
    });
}

function getPlanDayID() {
    $.ajax({
        url: 'helper/workout-days.php',
        method: 'GET',
        dataType: 'json',
        data: {
            plan_id: <?php echo isset($planDetail['id']) ? $planDetail['id'] : $planId?>
        },
        async: false,
        success: function(response) {
            result = response.data;
        }
    });
    if (result.length) {
        return result;
    } else
        return false;
}

function setPlanDayId(order) {
    $.ajax({
        url: 'helper/set-workout-day.php',
        method: 'POST',
        dataType: 'json',
        data: {
            plan_id: <?php echo isset($planDetail['id']) ? $planDetail['id']: $planId ?>,
            order: order + 1
        },
        success: function(response) {
            if (!response.error) {
                $('#plan-days').find('#' + (order)).attr('onclick', 'getExercises(' + response.planDayId +
                    ');');
                $('#plan-days').find('#' + (order)).find('#delDay').attr('onclick', 'deleteDay(' + order +
                    ',' + response.planDayId + ')');
                $('#plan-days').find('#' + (order)).find('#day_name').attr('onchange',
                    'updatePlanDayInfo(' + response.planDayId + ',$(this).val())');
            } else
                alert(response.message);
        }
    });
}

function getExercises(planDayId) {
    $.ajax({
        url: 'helper/exercises.php',
        method: 'GET',
        dataType: 'json',
        data: {
            plan_day_id: planDayId
        },
        success: function(response) {
            if (!response.error) {
                $('#exercise-list').html(response.data);
            } else
                alert(response.message);
        }
    });
}
</script>
<?php require_once('footer.php'); ?>