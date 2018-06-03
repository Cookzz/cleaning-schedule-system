<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin_afternoon_schedule.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/adminAfternoonScheduleStyle.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/print.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>  

<h2>Afternoon Schedule Table</h2><hr/>

<!--This form got one table, one is to let user to insert new task, one is to display the task table-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="table-responsive">
		<table id="afternoon_schedule_table" class="table table-striped table-bordered" border="1">
			<thead>
				<tr>
					<th>No.</th>
					<th>Task Location</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
					<th>Sunday</th>
					<th>Remark</th>
					<th>Week Number</th>
					<th>Update</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1?><?php foreach($afternoon_schedules as $afternoon_schedule):?>
				<tr>
					<td><?php echo $i ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_task" contenteditable="true"><?php echo $afternoon_schedule["task"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_monday" contenteditable="true"><?php echo $afternoon_schedule["monday"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_tuesday" contenteditable="true"><?php echo $afternoon_schedule["tuesday"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_wednesday" contenteditable="true"><?php echo $afternoon_schedule["wednesday"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_thursday" contenteditable="true"><?php echo $afternoon_schedule["thursday"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_friday" contenteditable="true"><?php echo $afternoon_schedule["friday"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_saturday" contenteditable="true"><?php echo $afternoon_schedule["saturday"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_sunday" contenteditable="true"><?php echo $afternoon_schedule["sunday"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_remark" contenteditable="true"><?php echo $afternoon_schedule["remark"]; ?></td>
					<td id="<?php echo($afternoon_schedule["afternoon_schedule_id"])?>_week_number" contenteditable="true"><?php echo $afternoon_schedule["week_number"]; ?></td>
					<td><center><button type="button" id="<?php echo $afternoon_schedule["afternoon_schedule_id"];?>_update" class="update">Update</button></center></td>
					<td><center><button style="width:80px;height:30px" type="button" id="<?php echo $afternoon_schedule["afternoon_schedule_id"];?>_delete" class="w3-text-red fa fa-trash delete"></button></center></td>
				</tr>
				<?php $i = $i+1?><?php endforeach; ?>	
			</tbody>
			<tfoot>
				<tr>
					<th>No.</th>
					<th>Task Location</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
					<th>Sunday</th>
					<th>Remark</th>
					<th>Week Number</th>
					<th>Update</th>
					<th>Delete</th>
				</tr>
			</tfoot>
		</table>
	</div>
</form>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>