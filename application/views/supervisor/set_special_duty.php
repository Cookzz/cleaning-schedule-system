<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/set_special_duty.js"></script>

</head>
<body>  

<h2>Create New Special Duty</h2><hr/>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table id="special_duty_table">
		<tbody>
			<tr>
				<td>Location:</td>
				<td><input type="text" id="special_duty_location"></td>
			</tr>
			<tr>
				<td>Date:</td>
				<td><input type="date" id="special_duty_date"></td>
			</tr>
			<tr>
				<td>Time:</td>
				<td><input type="time" id="special_duty_time"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><button width="100%" id="addCleaner">Add Cleaner</button></td>
			</tr>
		</tbody>
		<!--Please the front ender go set_special_duty.js insert_cleaner_dropdown function to design the tr td-->
		<tbody id="cleaners_area">	
		</tbody>
			<tr>
				<td></td>
				<td colspan="2"><button width="100%" id="addSpecialDuty">Add New Special Duty</button></td>
			</tr>
	</table>
</form>
<datalist id='cleaners'>
	<?php foreach($cleaners as $cleaner): ?><option value="<?= $cleaner['user_id']."_".$cleaner['user_name'] ?>" ></option><?php endforeach; ?>					
</datalist>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>