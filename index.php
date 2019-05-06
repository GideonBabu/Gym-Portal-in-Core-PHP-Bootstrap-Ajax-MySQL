<?php require_once('header.php'); ?>

<h3>Workout Plans Overview</h3>
<?php 
$query = "SELECT * FROM plan";
$result = mysqli_query($conn, $query);
// $rows = mysqli_fetch_row($result);
// Fetch one and one row
if (isset($_GET['msg'])): ?>
<div class="alert alert-success" role="alert"><?php echo constant($_GET['msg']); ?> </div>
<?php endif;
while($workoutPlan = mysqli_fetch_array($result)) { ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo $workoutPlan['plan_name'] ?></h5>
        <p class="card-text"><?php echo $workoutPlan['plan_description']; ?></p>
        <a href="workout-plan.php?id=<?php echo $workoutPlan['id']; ?>&action=edit" class="btn btn-primary">View Plan in
            Detail</a>
        <a href="workout-plan.php?id=<?php echo $workoutPlan['id']; ?>&action=delete" class="btn btn-primary">Delete
            Workout Plan</a>
    </div>
</div>
<?php } ?>
<?php require_once('footer.php'); ?>