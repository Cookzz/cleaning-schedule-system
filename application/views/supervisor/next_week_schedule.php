<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/next_week_schedule.js"></script>
</head>
<body>  

<h2>Next Week Schedule</h2><hr/>

<!--The area of morning schedule , too complicated i will explain face to face-->
<!--Front ender just put the class name to every td or tr-->
<h3>Morning <button id="copyMorningSchedule">Copy This Week Morning Schedule testing</button> </h3>
<form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table border="1" style="width:90%" >
		<thead>
			<tr><th>Stuff</th>	
			<th>Monday</th>
			<th>Tueasday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
			<th>Sunday</th>
			<th>Remark</th></tr>
		</thead>
		<tbody>
			<?php $check="";foreach($stuffs as $stuff):?>
			<?php foreach($morning_schedules as $morning_schedule): if($stuff['stuff'] == $morning_schedule['stuff']){$check = true;break;}else{$check = false;}endforeach;if($check == true) {?>
			<tr>
				<td><?php echo $stuff['stuff'];?></td>
				<td><select style="width:100%" id="<?=$stuff['stuff_id']."_1_morning";?>" ><option value="<?=$morning_schedule['monday']?>"><?=$morning_schedule['monday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$stuff['stuff_id']."_2_morning";?>" ><option value="<?=$morning_schedule['tuesday']?>"><?=$morning_schedule['tuesday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$stuff['stuff_id']."_3_morning";?>" ><option value="<?=$morning_schedule['wednesday']?>"><?=$morning_schedule['wednesday']?></option><option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$stuff['stuff_id']."_4_morning";?>" ><option value="<?=$morning_schedule['thursday']?>"><?=$morning_schedule['thursday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$stuff['stuff_id']."_5_morning";?>" ><option value="<?=$morning_schedule['friday']?>"><?=$morning_schedule['friday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$stuff['stuff_id']."_6_morning";?>" ><option value="<?=$morning_schedule['saturday']?>"><?=$morning_schedule['saturday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td><select style="width:100%" id="<?=$stuff['stuff_id']."_7_morning";?>" ><option value="<?=$morning_schedule['sunday']?>"><?=$morning_schedule['sunday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
				<td>
					<select style="width:100%" id="<?=$stuff['stuff_id']."_remark_morning";?>">
						<option value="<?=$morning_schedule['remark']?>"><?=$morning_schedule['remark']?></option>
						<option value="active">active</option>
						<option value="repair">repair</option>
						<option value="construction">construction</option>
					</select>
				</td>
			</tr>
			<?php } else{?>
			<tr>
			<td><?php echo $stuff['stuff'];?></td>
			<?php for ($x = 1; $x <= 7; $x++) { ?><td><select style="width:100%" id="<?=$stuff['stuff_id']."_".$x."_morning"; ?>" ><option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td><?php } ?>
			<td>
				<select style="width:100%" id="<?=$stuff['stuff_id']."_remark_morning";?>">
					<option value="active">active</option>
					<option value="repair">repair</option>
					<option value="construction">construction</option>
				</select>
			</td>
			</tr>
			<?php }?>
			<?php endforeach; ?>
			<tr><td colspan="9"><button id="updateMorningSchedule" style="float:right" type="button">Update Schedule</button><button id="deleteMorningSchedule" style="float:right" type="button">Delete Schedule</button></td></tr>
		</tbody>
	</table>
</form>

<!--The area of afternoon schedule , too complicated i will explain face to face-->
<!--Front ender just put the class name to every td or tr-->
<h3>Afternoon <button id="copyAfternoonSchedule">Copy Last Week Afternoon Schedule</button></h3>
<form id="form2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table border="1" style="width:90%">
		<thead>
			<tr><th>Stuff</th>	
			<th>Monday</th>
			<th>Tueasday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<td>Saturday</th>
			<th>Sunday</th>
			<th>Remark</th></tr>
		</thead>
		<tbody>
			<?php $check="";foreach($stuffs as $stuff):?>
			<?php foreach($afternoon_schedules as $afternoon_schedule): if($stuff['stuff'] == $afternoon_schedule['stuff']){$check = true;break;}else{$check = false;}endforeach;if($check == true) {?>
			<tr>
			<td><?php echo $stuff['stuff'];?></td>
			<td><select style="width:100%" id="<?=$stuff['stuff_id']."_1_afternoon";?>" ><option value="<?=$afternoon_schedule['monday']?>"><?=$afternoon_schedule['monday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$stuff['stuff_id']."_2_afternoon";?>" ><option value="<?=$afternoon_schedule['tuesday']?>"><?=$afternoon_schedule['tuesday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$stuff['stuff_id']."_3_afternoon";?>" ><option value="<?=$afternoon_schedule['wednesday']?>"><?=$afternoon_schedule['wednesday']?></option><option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$stuff['stuff_id']."_4_afternoon";?>" ><option value="<?=$afternoon_schedule['thursday']?>"><?=$afternoon_schedule['thursday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$stuff['stuff_id']."_5_afternoon";?>" ><option value="<?=$afternoon_schedule['friday']?>"><?=$afternoon_schedule['friday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$stuff['stuff_id']."_6_afternoon";?>" ><option value="<?=$afternoon_schedule['saturday']?>"><?=$afternoon_schedule['saturday']?></option>	<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td><select style="width:100%" id="<?=$stuff['stuff_id']."_7_afternoon";?>" ><option value="<?=$afternoon_schedule['sunday']?>"><?=$afternoon_schedule['sunday']?></option>		<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td>
			<td>
				<select style="width:100%" id="<?=$stuff['stuff_id']."_remark_afternoon";?>">
					<option value="<?=$afternoon_schedule['remark']?>"><?=$afternoon_schedule['remark']?></option>
					<option value="active">active</option>
					<option value="repair">repair</option>
					<option value="construction">construction</option>
				</select>
			</td>
			</tr>
			<?php } else{?>
			<tr>
			<td><?php echo $stuff['stuff'];?></td>
			<?php for ($x = 1; $x <= 7; $x++) { ?><td><select style="width:100%" id="<?=$stuff['stuff_id']."_".$x."_afternoon"; ?>" ><option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?></select></td><?php } ?>
			<td>
				<select style="width:100%" id="<?=$stuff['stuff_id']."_remark_afternoon";?>">
					<option value="active">active</option>
					<option value="repair">repair</option>
					<option value="construction">construction</option>
				</select>
			</td>
			</tr>
			<?php }?>
			<?php endforeach; ?>
			<tr><td colspan="9"><button id="updateAfternoonSchedule" style="float:right" type="button">Update Schedule</button><button id="deleteAfternoonSchedule" style="float:right" type="button">Delete Schedule</button></td></tr>
		</tbody>
	</table>
</form>
<a href="<?php echo base_url();?>HomeController/viewScheduleFormPage">Schedule Form</a>

<!--boundary (below are hidden value to external js)-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
<input id="numberOfStuff" type=hidden value="<?php echo(sizeof($stuffs))?>">
<?php for ($i = 0; $i <= (sizeof($stuffs)-1); $i++) { ?>
<input id="stuff_id<?php echo($i+1)?>" type=hidden value="<?php echo($stuffs[$i]['stuff_id'])?>">
<input id="stuff<?php echo($i+1)?>" type=hidden value="<?php echo($stuffs[$i]['stuff'])?>">
<?php } ?>

</body>
</html>