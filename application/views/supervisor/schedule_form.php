<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/schedule_form.js"></script>
</head>
<body>  

<h2>Set Schedule</h2><hr/>
<h3>Schedule</h3>

<form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table>
	<tr>
		<th>Stuff Location:</th>
		<td>
			<center>
				<input id="stuff" type="text" list="stuffs"> <!--Textfield/textbox -->
                <datalist id="stuffs"> <!--Lists/combobox of categories (autocompletes when typed) -->
                    <?php foreach($stuffs as $stuff):?><option value="<?= $stuff['stuff']?>"></option><?php endforeach?>
                </datalist>
			</center>
		</td>
	</tr>
	<tr>
		<th>Time:</th>
		<td>
			<center>
				<input id="Morning" type="radio" name="time" value="morning" checked>AM
				<input id="Afternoon" type="radio" name="time" value="afternoon">PM
			</center>
		</td>
	</tr>
	<tr>
		<th>Day:</th>
		<td>
			<center>
				<input id="thisWeek" type="radio" name="week" value="this" checked>This Week
				<input id="nextWeek" type="radio" name="week" value="next">Next Week
			</center>
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
			<center>
			<select id="remark">
				<option value="active">active</option>
				<option value="repair">repair</option>
				<option value="construction">construction</option>
			</select>
			</center>
		</td>
	</tr>
        <tr><td colspan="2"><center><button id="save_schedule">save</button><button id="delete_schedule">delete</button></center></td></tr>
    </tbody>
</table>
</form>

<!--boundary (below are hidden value to external js)-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
<textarea id="cleaners_string" style="display:none"><?= $cleaners_string?></textarea>

</body>
</html>