<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>  

<h2>Set Schedule</h2><hr/>
<h3>Morning</h3>

<!--The table to show the schedule table, this table body consisder by 2 foreach loop-->
<table border="1">
	<thead>
		<tr>
			<th>Stuff</th>	
			<th>Monday</th>
			<th>Tueasday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
			<th>Sunday</th>
		</tr>
	</thead>
	<tbody>
		<!--Below foreach of stuff is to loop every stuff, $check is a variable to check the stuff is worked by any cleaner or not-->
		<?php $check="";foreach($stuffs as $stuff):?>
		<!--The secoond foreach loop every morning_schedule data, the ifesle statement is to check the stuff is worked by any cleaner of not and asign the value to $check-->
		<?php foreach($morning_schedules as $morning_schedule): if($stuff['stuff'] == $morning_schedule['stuff']){$check = true;break;}else{$check = false;}endforeach;if($check == true) {?>
		<!--if $check equal to true-->
		<tr>
			<td><?php echo $stuff['stuff'];?></td>
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
			<!--When the stuff is not work by any cleaner the monday tuesday column will be empty -->
			<td><?php echo $stuff['stuff'];?></td>
			<?php for ($x = 1; $x <= 7; $x++) { ?><td></td><?php } ?>
		</tr>
		<?php }?>
		<?php endforeach; ?>
	</tbody>
</table>
<!--The end of morning schedule table-->

<!--Now this the afternoon schecule table the concept is same with morning schedule-->
<table border="1">
	<thead>
		<tr>
			<th>Stuff</th>	
			<th>Monday</th>
			<th>Tueasday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
			<th>Sunday</th>
		</tr>
	</thead>
	<tbody>
		<?php $check="";foreach($stuffs as $stuff):?>
		<?php foreach($afternoon_schedules as $afternoon_schedule): if($stuff['stuff'] == $afternoon_schedule['stuff']){$check = true;break;}else{$check = false;}endforeach;if($check == true) {?>
		<tr>
			<td><?php echo $stuff['stuff'];?></td>
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
			<td><?php echo $stuff['stuff'];?></td>
			<?php for ($x = 1; $x <= 7; $x++) { ?><td></td><?php } ?>
		</tr>
		<?php }?>
		<?php endforeach; ?>
	</tbody>
</table>

</body>
</html>