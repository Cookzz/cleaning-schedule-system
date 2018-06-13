<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/schedule_form.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/supervisorScheduleFormStyle.css">
</head>
<body>  

<a class="previousBtn" href="<?php echo base_url();?>HomeController/viewSchedulePage">◄ Go Back to Schedule</a>
<h2>Set Schedule</h2><hr/>
<h3>Schedule</h3>

<form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table class="scheduleForm">
	<tr>
		<th>Task Location:</th>
		<td>
			<center>
				<input id="task" type="text" list="tasks"> <!--Textfield/textbox -->
                <datalist id="tasks"> <!--Lists/combobox of categories (autocompletes when typed) -->
                    <?php foreach($tasks as $task):?><option value="<?= $task['task']?>"></option><?php endforeach?>
                </datalist>
			</center>
		</td>
	</tr>
	<tr>
		<th>Time:</th>
		<td>
            <input id="Morning" type="radio" name="time" value="morning" checked>AM&emsp;
            <input id="Afternoon" type="radio" name="time" value="afternoon">PM
		</td>
	</tr>
	<tr>
		<th>Day:</th>
		<td>
			
				<input id="thisWeek" type="radio" name="week" value="this" checked>This Week&emsp;
				<input id="nextWeek" type="radio" name="week" value="next">Next Week
			
		</td>
	</tr>
	<tbody id="data_area">
	<tr>
		<th>Monday:</th>
		<td>
			<center>
				<input id="monday" class="schedule_data" type="text" list="cleaners"> <!--Textfield/textbox -->
                <datalist id="cleaners"> <!--Lists/combobox of categories (autocompletes when typed) -->
					<option value="NA">NA</option><?php foreach($cleaners as $cleaner): ?><option value="<?=$cleaner['user_id']."_".$cleaner['user_name']?>"><?=$cleaner['user_id']."_".$cleaner['user_name']?></option><?php endforeach; ?>
				</datalist>
			</center>
		</td>
	</tr>
	<tr>
		<th>Tueasday:</th>
		<td>
			<center>
				<input id="tuesday" class="schedule_data" type="text" list="cleaners"> <!--Textfield/textbox -->
			</center>
		</td>
	</tr>
	<tr>
		<th>Wednesday:</th>
		<td>
			<center>
				<input id="wednesday" class="schedule_data" type="text" list="cleaners"> <!--Textfield/textbox -->
			</center>
		</td>
	</tr>
	<tr>
		<th>Thursday:</th>
		<td>
			<center>
				<input id="thursday" class="schedule_data" type="text" list="cleaners"> <!--Textfield/textbox -->
			</center>
		</td>
	</tr>
	<tr>
		<th>Friday:</th>
		<td>
			<center>
				<input id="friday" class="schedule_data" type="text" list="cleaners"> <!--Textfield/textbox -->
			</center>
		</td>
	</tr>
	<tr>
		<th>Saturday:</th>
		<td>
			<center>
				<input id="saturday" class="schedule_data" type="text" list="cleaners"> <!--Textfield/textbox -->
			</center>
		</td>
	</tr>
	<tr>
		<th>Sunday:</th>
		<td>
			<center>
				<input id="sunday" class="schedule_data" type="text" list="cleaners"> <!--Textfield/textbox -->
			</center>
		</td>
	</tr>
	<tr>
		<th>Remark:</th>
		<td>
			
			<select id="remark">
				<option value="active">active</option>
				<option value="repair">repair</option>
				<option value="construction">construction</option>
			</select>
			
		</td>
	</tr>
        <tr><td colspan="2"><button id="save_schedule">Save</button>
        <button id="delete_schedule">Delete</button></td></tr>
    </tbody>
</table>
</form>

<!--boundary (below are hidden value to external js)-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
<textarea id="cleaners_string" style="display:none"><?= $cleaners_string?></textarea>

</body>
</html>