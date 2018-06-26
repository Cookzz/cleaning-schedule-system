<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modify_special_duty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/supervisorSpecifySpecialDutyStyle.css">

</head>
<body>  

<h2 class="pageTitle">Modify Special Duty</h2><hr>

<form id="<?= $special_duty["special_duty_id"]?>" class="specialDutyForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table id="special_duty_table">
		<tbody>
			<tr>
				<td><b>Duty Title:</b></td>
				<td><input type="text" id="special_duty_dutyTitle" value="<?= $special_duty["special_duty_title"]?>" required></td>
				<td id="special_duty_dutyTitle_error" style="color:red"></td>
			</tr>
			<tr>
			<tr>
				<td><b>Duty Detail:</b></td>
				<td><textarea type="text" id="special_duty_dutyDetail" required><?= $special_duty["special_duty_detail"]?></textarea></td>
				<td id="special_duty_dutyDetail_error" style="color:red"></td>
			</tr>
			<tr>
				<td><b>Date:</b></td>
				<td><input type="date" id="special_duty_date" value="<?= $special_duty["special_duty_date"]?>" required></td>
				<td id="special_duty_date_error" style="color:red"></td>
			</tr>
			<tr>
				<td><b>Time:</b></td>
				<td><input type="time" id="special_duty_time" value="<?= $special_duty["special_duty_time"]?>" required></td>
			</tr>
		</tbody>
		<tr>
			<td class="submitRow" colspan="2"><input id="<?= $special_duty["special_duty_id"]?>" type="submit" ></td>
		</tr>
	</table>
</form>

<h5 class="cleanerTitle">Original Cleaner</h5>
<table class="deleteCleanerTable" border="1">
	<tr class="tableTitle">
		<td class="noOfCleanerTitle"><center>No of Cleaner</center></td>
        <td><center>Cleaner</center></td>
        <td><center>Delete</center></td>
	</tr>
	<tbody id="original_cleaners_area">
		<?php $i=0; foreach($special_duty_cleaners as $special_duty_cleaner): $i++;?>
		<tr>
			<td><center><?= $i?></center></td>
			<td><input value='<?= $special_duty_cleaner["special_duty_cleaner"]?>' list='cleaners'></td>
			<td class="deleteBtnCol"><button type="button" id='<?= $special_duty_cleaner["special_duty_cleaner_id"]."_delete"?>' class="delete-cleaner">Delete</button></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<h5 class="cleanerTitle">New Cleaner</h5>
<table class="addCleanerTable" border="1">
	<tr class="tableTitle">
		<td class="noOfCleanerTitle"><center>Number of Cleaner</center></td>
        <td><center>Cleaner</center></td>
	</tr>
	<tbody id="new_cleaners_area">
		<!--Please the front ender go modify_special_duty.js insert_cleaner_dropdown function to design the tr td-->
	</tbody>
	<tr>
		<td colspan="3" class="addBtnCol"><button id="addCleaner">Add Cleaner</button></td>
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