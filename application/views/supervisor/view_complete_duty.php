<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/complete_duty.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/supervisorCompleteDutyStyle.css">

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>  

<a class="viewCompletedDutiesBtn" href="<?php echo base_url().$link;?>"><?= $link_word;?></a>
<h2 class="pageTitle"><?= $title?></h2><hr/>
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
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_cleaner"><?php echo $complete_duty["complete_duty_cleaner"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_task"><?php echo $complete_duty["complete_duty_task"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_subtask"><?php echo $complete_duty["complete_duty_subtask"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_time"><?php echo $complete_duty["complete_duty_time"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_comment" contenteditable="true"><?php echo $complete_duty["complete_duty_comment"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_schedule"><?php echo $complete_duty["complete_duty_schedule"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_date"><?php echo $complete_duty["complete_duty_date"];?></td>
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