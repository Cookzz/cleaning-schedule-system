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
		</tbody>
		<tbody id="cleaners_area">	
		</tbody>
			<tr>
				<td colspan="2"><center><button width="100%" id="addCleaner">Add Cleaner</button><center></td>
			</tr>
	</table>
</form>
<button id="test" >test</button>
<datalist id='cleaners'>
	<?php foreach($cleaners as $cleaner): ?><option value="<?= $cleaner['user_id']."_".$cleaner['user_name'] ?>" ></option><?php endforeach; ?>					
</datalist>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>