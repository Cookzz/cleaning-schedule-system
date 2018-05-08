<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/set_special_duty.js"></script>

</head>
<body>  

<h2><?= $special_duties["special_duty_title"]?></h2><hr/>

<form id="newSpecialDutyForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table id="special_duty_table">
		<tbody>
			<tr>
				<td>Duty Detail:</td>
				<td><textarea type="text" id="special_duty_dutyDetail" required><?= $special_duties["special_duty_detail"]?></textarea></td>
				<td id="special_duty_dutyDetail_error" style="color:red"></td>
			</tr>
			<tr>
				<td>Date:</td>
				<td><input type="date" id="special_duty_date" required></td>
				<td id="special_duty_date_error" style="color:red"></td>
			</tr>
			<tr>
				<td>Time:</td>
				<td><input type="time" id="special_duty_time" required></td>
			</tr>
		</tbody>
		<tr>
			<td colspan="2"><input type="submit" width="100%"></td>
		</tr>
	</table>
</form>
<table border="1">
	<tr>
		<td><center>Number of Cleaner</center></td>
		<td><center>Cleaner<center></td>
	</tr>
	<tbody id="cleaners_area">
		<!--Please the front ender go set_special_duty.js insert_cleaner_dropdown function to design the tr td-->
	</tbody>
	<tr>
		<td></td>
		<td colspan="2"><button width="100%" id="addCleaner">Add Cleaner</button></td>
	</tr>		
</table>
<datalist id='cleaners'>
	<?php foreach($cleaners as $cleaner): ?><option value="<?= $cleaner['user_id']."_".$cleaner['user_name'] ?>" ></option><?php endforeach; ?>					
</datalist>

<!--hidden value for external js file-->
<textarea id="cleaners_string" style="display:none"><?= $cleaners_string?></textarea>
<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>