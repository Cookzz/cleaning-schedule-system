<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin_complete_duty.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/print.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/adminCompleteDutyStyle.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>  
<div class="navbar-header">
<!--This this sidebar button-->
	<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
		<span class="togglespan">Open/Close Admin Panel</span>
	</button>
</div>
<h2>Complete Duty Table</h2><hr/>
<!--Table to show complete duty table-->
	<table id="complete_duty_table" class="table table-striped table-bordered table-responsive" border="1">
		<thead class="tableTitle">
			<tr>
				<th>No</th>
				<th>Cleaner</th>
				<th>Task Location</th>
				<th>Sub Task</th>
				<th>Complete In</th>
				<th>Comment</th>
				<th>Time</th>
				<th>Date</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
		</thead>
		
		<!--Foreach the data of complete duty, $i is the count of the record, it increase every time follow the time of loop-->
		<tbody id="complete_table_body">
			<?php $i=1;?>
			<?php foreach($complete_duties as $complete_duty):?>
			<tr id="<?php echo $complete_duty["complete_duty_id"];?>">
				<td><?= $i?></td>
				<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_cleaner" contenteditable="true"><?php echo $complete_duty["complete_duty_cleaner"];?></td>
				<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_task" contenteditable="true"><?php echo $complete_duty["complete_duty_task"];?></td>
				<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_subtask" contenteditable="true"><?php echo $complete_duty["complete_duty_subtask"];?></td>
				<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_time" contenteditable="true"><?php echo $complete_duty["complete_duty_time"];?></td>
				<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_comment" contenteditable="true"><?php echo $complete_duty["complete_duty_comment"];?></td>
				<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_schedule" contenteditable="true"><?php echo $complete_duty["complete_duty_schedule"];?></td>
				<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_date" contenteditable="true"><?php echo $complete_duty["complete_duty_date"];?></td>
				<td><center><button id="<?php echo $complete_duty["complete_duty_id"];?>update" class="update btn btn-default" type="button">Update</button></center></td>
				<td><center><button style="width:80px;height:30px" id="<?php echo $complete_duty["complete_duty_id"];?>delete" class="w3-text-red fa fa-trash delete" type="button"></button></center></td>
			</tr>
			<?php $i++;?>
			<?php endforeach; ?>
			<!--end of the foreach loop-->
		</tbody>
		<!--end of the tbody-->
		<tfoot>
			<tr>
				<th>No</th>
				<th>Cleaner</th>
				<th>Task Location</th>
				<th>Sub Task</th>
				<th>Complete In</th>
				<th>Comment</th>
				<th>Time</th>
				<th>Date</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
		</tfoot>
	</table>

<!--Hidden value for external js file-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>