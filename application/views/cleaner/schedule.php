<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/cleanerScheduleStyle.css">
</head>
<body>  

<h2 class="scheduleTitle">Cleaner's Schedule</h2>
<hr class="titleHr">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="morning-tab" data-toggle="tab" href="#morningTab" role="tab" aria-controls="home" aria-selected="true">Morning Schedule</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="afternoon-tab" data-toggle="tab" href="#afternoonTab" role="tab" aria-controls="profile" aria-selected="false">Afternoon Schedule</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="morningTab" role="tabpanel" aria-labelledby="morning-tab">
      <h3 class="dayLabel">Morning</h3>
        <hr class="scheduleHr">
        <!--The table to show the schedule table, this table body consisder by 2 foreach loop-->
        <div class="morning">
        <table border="1" class="morningTable">
            <thead>
                <tr>
                    <th class="taskColumn">Task</th>	
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody>
                <!--Below foreach of task is to loop every task, $check is a variable to check the task is worked by any cleaner or not-->
                <?php $check="";foreach($tasks as $task):?>
                <!--The secoond foreach loop every morning_schedule data, the ifesle statement is to check the task is worked by any cleaner of not and asign the value to $check-->
                <?php foreach($morning_schedules as $morning_schedule): if($task['task'] == $morning_schedule['task']){$check = true;break;}else{$check = false;}endforeach;if($check == true) {?>
                <!--if $check equal to true-->
                <tr>
                    <td><?php echo $task['task'];?></td>
                    <!--This ifelse is to block the user only can see their own duty-->
                    <td><?php if($morning_schedule['monday'] == $cleaner){echo $morning_schedule['monday'];}?></td>
                    <td><?php if($morning_schedule['tuesday'] == $cleaner){echo $morning_schedule['tuesday'];}?></td>
                    <td><?php if($morning_schedule['wednesday'] == $cleaner){echo $morning_schedule['wednesday'];}?></td>
                    <td><?php if($morning_schedule['thursday'] == $cleaner){echo $morning_schedule['thursday'];}?></td>
                    <td><?php if($morning_schedule['friday'] == $cleaner){echo $morning_schedule['friday'];}?></td>
                    <td><?php if($morning_schedule['saturday'] == $cleaner){echo $morning_schedule['saturday'];}?></td>
                    <td><?php if($morning_schedule['sunday'] == $cleaner){echo $morning_schedule['sunday'];}?></td>
                </tr>
                <?php } else{?><!--The else statment will be active when $check is false-->
                <tr>
                    <!--When the task is not work by any cleaner the monday tuesday column will be empty -->
                    <td><?php echo $task['task'];?></td>
                    <?php for ($x = 1; $x <= 7; $x++) { ?><td></td><?php } ?>
                </tr>
                <?php }?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
  </div>
  <div class="tab-pane fade" id="afternoonTab" role="tabpanel" aria-labelledby="afternoon-tab">
      <h3 class="dayLabel">Afternoon</h3>
        <hr class="scheduleHr">
        <!--Now this the afternoon schecule table the concept is same with morning schedule-->
        <div class="afternoon">
        <table border="1" class="afternoonTable">
            <thead>
                <tr>
                    <th class="taskColumn">Task</th>	
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody>
                <?php $check="";foreach($tasks as $task):?>
                <?php foreach($afternoon_schedules as $afternoon_schedule): if($task['task'] == $afternoon_schedule['task']){$check = true;break;}else{$check = false;}endforeach;if($check == true) {?>
                <tr>
                    <td><?php echo $task['task'];?></td>
                    <td><?php if($afternoon_schedule['monday'] == $cleaner){echo $afternoon_schedule['monday'];}?></td>
                    <td><?php if($afternoon_schedule['tuesday'] == $cleaner){echo $afternoon_schedule['tuesday'];}?></td>
                    <td><?php if($afternoon_schedule['wednesday'] == $cleaner){echo $afternoon_schedule['wednesday'];}?></td>
                    <td><?php if($afternoon_schedule['thursday'] == $cleaner){echo $afternoon_schedule['thursday'];}?></td>
                    <td><?php if($afternoon_schedule['friday'] == $cleaner){echo $afternoon_schedule['friday'];}?></td>
                    <td><?php if($afternoon_schedule['saturday'] == $cleaner){echo $afternoon_schedule['saturday'];}?></td>
                    <td><?php if($afternoon_schedule['sunday'] == $cleaner){echo $afternoon_schedule['sunday'];}?></td>
                </tr>
                <?php } else{?>
                <tr>
                    <td><?php echo $task['task'];?></td>
                    <?php for ($x = 1; $x <= 7; $x++) { ?><td></td><?php } ?>
                </tr>
                <?php }?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
  </div>
</div>

</body>
</html>