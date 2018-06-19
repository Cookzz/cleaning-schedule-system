<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/next_week_schedule.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/supervisorNextWeekStyle.css">
</head>
<body>  

<a class="previousWeekBtn" href="<?php echo base_url();?>HomeController/viewSchedulePage">◀ Go back to this week's schedule</a>
<h2 class="scheduleTitle">Next Week's Schedule</h2>
<hr class="titleHr">

<!--The area of morning schedule , too complicated i will explain face to face-->
<!--Front ender just put the class name to every td or tr-->
<h3 class="dayLabel">Morning</h3>
<hr class="scheduleHr">
<form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="table-responsive">
	<table border="1" class="nextWeekMorningTable">
		<thead>
			<tr><th class="taskCol">Task</th>	
			<th>Monday</th>
			<th>Tueasday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
			<th>Sunday</th>
			<th class="remarkCol">Remark</th></tr>
		</thead>
		<tbody>
			<?php $check="";foreach($tasks as $task):?>
			<?php foreach($morning_schedules as $morning_schedule): if($task['task'] == $morning_schedule['task']){$check = true;break;}else{$check = false;}endforeach;if($check == true) {?>
			<tr>
				<td class="taskColumn"><?php echo $task['task'];?></td>
				<td><select style="width:100%" id="<?=$task['task_id']."_1_morning";?>" ><option value="<?=$morning_schedule['monday']?>"><?=$morning_schedule['monday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$task['task_id']."_2_morning";?>" ><option value="<?=$morning_schedule['tuesday']?>"><?=$morning_schedule['tuesday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$task['task_id']."_3_morning";?>" ><option value="<?=$morning_schedule['wednesday']?>"><?=$morning_schedule['wednesday']?></option><option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$task['task_id']."_4_morning";?>" ><option value="<?=$morning_schedule['thursday']?>"><?=$morning_schedule['thursday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$task['task_id']."_5_morning";?>" ><option value="<?=$morning_schedule['friday']?>"><?=$morning_schedule['friday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$task['task_id']."_6_morning";?>" ><option value="<?=$morning_schedule['saturday']?>"><?=$morning_schedule['saturday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$task['task_id']."_7_morning";?>" ><option value="<?=$morning_schedule['sunday']?>"><?=$morning_schedule['sunday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td>
					<select id="<?=$task['task_id']."_remark_morning";?>">
						<option value="<?=$morning_schedule['remark']?>"><?=$morning_schedule['remark']?></option>
						<option value="active">active</option>
						<option value="repair">repair</option>
						<option value="construction">construction</option>
					</select>
				</td>
			</tr>
			<?php } else{?>
			<tr>
			<td><?php echo $task['task'];?></td>
			<?php for ($x = 1; $x <= 7; $x++) { ?><td><select style="width:100%" id="<?=$task['task_id']."_".$x."_morning"; ?>" ><option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td><?php } ?>
			<td>
				<select id="<?=$task['task_id']."_remark_morning";?>">
					<option value="active">active</option>
					<option value="repair">repair</option>
					<option value="construction">construction</option>
				</select>
			</td>
			</tr>
			<?php }?>
			<?php endforeach; ?>
			<tr class="morningBtnRow"><td colspan="9" class="morningBtnRow"><button class="morningButtons" id="updateMorningSchedule" type="button">Update Schedule</button><button class="morningButtons" id="deleteMorningSchedule" type="button">Delete Schedule</button><button id="copyMorningSchedule">Copy Last Week's Morning Schedule</button></td></tr>
		</tbody>
	</table>
	</div>
</form>

<!--The area of afternoon schedule , too complicated i will explain face to face-->
<!--Front ender just put the class name to every td or tr-->
<h3 class="dayLabel">Afternoon</h3>
<hr class="scheduleHr">
<form id="form2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="table-responsive">
	<table border="1" class="nextWeekAfternoonTable">
		<thead>
			<tr><th class="taskCol">Task</th>	
			<th>Monday</th>
			<th>Tueasday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
			<th>Sunday</th>
			<th class="remarkCol">Remark</th></tr>
		</thead>
		<tbody>
			<?php $check="";foreach($tasks as $task):?>
			<?php foreach($afternoon_schedules as $afternoon_schedule): if($task['task'] == $afternoon_schedule['task']){$check = true;break;}else{$check = false;}endforeach;if($check == true) {?>
			<tr>
			<td><?php echo $task['task'];?></td>
			<td><select style="width:100%" id="<?=$task['task_id']."_1_afternoon";?>" ><option value="<?=$afternoon_schedule['monday']?>"><?=$afternoon_schedule['monday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$task['task_id']."_2_afternoon";?>" ><option value="<?=$afternoon_schedule['tuesday']?>"><?=$afternoon_schedule['tuesday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$task['task_id']."_3_afternoon";?>" ><option value="<?=$afternoon_schedule['wednesday']?>"><?=$afternoon_schedule['wednesday']?></option><option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$task['task_id']."_4_afternoon";?>" ><option value="<?=$afternoon_schedule['thursday']?>"><?=$afternoon_schedule['thursday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$task['task_id']."_5_afternoon";?>" ><option value="<?=$afternoon_schedule['friday']?>"><?=$afternoon_schedule['friday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$task['task_id']."_6_afternoon";?>" ><option value="<?=$afternoon_schedule['saturday']?>"><?=$afternoon_schedule['saturday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$task['task_id']."_7_afternoon";?>" ><option value="<?=$afternoon_schedule['sunday']?>"><?=$afternoon_schedule['sunday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td>
				<select id="<?=$task['task_id']."_remark_afternoon";?>">
					<option value="<?=$afternoon_schedule['remark']?>"><?=$afternoon_schedule['remark']?></option>
					<option value="active">active</option>
					<option value="repair">repair</option>
					<option value="construction">construction</option>
				</select>
			</td>
			</tr>
			<?php } else{?>
			<tr>
			<td><?php echo $task['task'];?></td>
			<?php for ($x = 1; $x <= 7; $x++) { ?><td><select style="width:100%" id="<?=$task['task_id']."_".$x."_afternoon"; ?>" ><option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td><?php } ?>
			<td>
				<select id="<?=$task['task_id']."_remark_afternoon";?>">
					<option value="active">active</option>
					<option value="repair">repair</option>
					<option value="construction">construction</option>
				</select>
			</td>
			</tr>
			<?php }?>
			<?php endforeach; ?>
			<tr class="afternoonBtnRow"><td colspan="9"><button id="copyAfternoonSchedule">Copy Last Week's Afternoon Schedule</button><button id="updateAfternoonSchedule" class="afternoonButtons" type="button">Update Schedule</button><button id="deleteAfternoonSchedule" class="afternoonButtons" type="button">Delete Schedule</button></td></tr>
		</tbody>
	</table>
	</div>
</form>
<a href="<?php echo base_url();?>HomeController/viewScheduleFormPage">Schedule Form</a>

<!--boundary (below are hidden value to external js)-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
<input id="numberOfTask" type=hidden value="<?php echo(sizeof($tasks))?>">
<?php for ($i = 0; $i <= (sizeof($tasks)-1); $i++) { ?>
<input id="task_id<?php echo($i+1)?>" type=hidden value="<?php echo($tasks[$i]['task_id'])?>">
<input id="task<?php echo($i+1)?>" type=hidden value="<?php echo($tasks[$i]['task'])?>">
<?php } ?>

</body>
</html>