<p>Dear <?php echo $planInfo['user_name'] ?>,<br/><br/> Please find the workout plan for you from Virtuagym. Please write to us at info@virtuagym.com if you would like any changes to this plan.</p>
<b>Workout Plan For <?php echo $planInfo['user_name']?></b>
<table class="table">
    <tr>
        <td>Plan Name</td>
        <td><?php echo $planInfo['plan_name']?></td>
    </tr>
    <tr>
        <td>Plan Description</td>
        <td><?php echo $planInfo['plan_description']?></td>
    </tr>
    <tr>
        <td>Plan Difficulty</td>
        <td><?php echo $planInfo['plan_difficulty']?></td>
    </tr>
</table>
<b>Plan Days</b>
<table class="table">
    <thead>
        <th>Number</th>
        <th>Day Name</th>
        <th>Day Exercises</th>
    </thead>
    <?php foreach($planDays as $key=>$planDay){?>
    <tr>
        <td>Day <?php echo $key+1; ?></td>
        <td><?php echo $planDay['day_name']?></td>
        <td><?php echo implode($planDay['exercises'], '<br>')?></td>
    </tr>
    <?php }?>
</table>
<p>Be fit & healthy,<br/>Yours Virtuagym</p>
<?php if($sendMail == ''){?>
&nbsp;<button class="btn btn-primary" onclick="showPlan(<?=$planId?>,'y')">Send Email</button>
<?php }?>