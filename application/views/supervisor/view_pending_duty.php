<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pending_duty.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>  

<a href="<?php echo base_url().$link;?>"><?= $link_word;?></a>
<!--same concept with complete duty page, pls refer back it-->
<h2><?= $title?></h2><hr/>
<table id="pending_duty_table" class="table table-striped table-bordered" border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Cleaner</th>
			<th>Task Location</th>
			<th>Sub Task</th>
			<th>Comment</th>
			<th>Time</th>
			<th>Date</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody id="pending_table_body">
		<?php $i=1;?>
		<?php foreach($pending_duties as $pending_duty):?>
		<tr id="<?php echo $pending_duty["pending_duty_id"];?>">
			<td><?= $i?></td>
			<td id="<?php echo $pending_duty["pending_duty_id"];?>_pending_duty_cleaner"><?php echo $pending_duty["pending_duty_cleaner"];?></td>
			<td id="<?php echo $pending_duty["pending_duty_id"];?>_pending_duty_task"><?php echo $pending_duty["pending_duty_task"];?></td>
			<td id="<?php echo $pending_duty["pending_duty_id"];?>_pending_duty_subtask"><?php echo $pending_duty["pending_duty_subtask"];?></td>
			<td id="<?php echo $pending_duty["pending_duty_id"];?>_pending_duty_comment" contenteditable="true"><?php echo $pending_duty["pending_duty_comment"];?></td>
			<td id="<?php echo $pending_duty["pending_duty_id"];?>_pending_duty_schedule"><?php echo $pending_duty["pending_duty_schedule"];?></td>
			<td id="<?php echo $pending_duty["pending_duty_id"];?>_pending_duty_date"><?php echo $pending_duty["pending_duty_date"];?></td>
			<td><center><button id="<?php echo $pending_duty["pending_duty_id"];?>update" class="update btn btn-default" type="button">Update</button></center></td>
			<td><center><button style="width:80px;height:30px" id="<?php echo $pending_duty["pending_duty_id"];?>delete" class="w3-text-red fa fa-trash delete" type="button"></button></center></td>
		</tr>
		<?php $i++;?>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<th>No</th>
			<th>Cleaner</th>
			<th>Task Location</th>
			<th>Sub Task</th>
			<th>Comment</th>
			<th>Time</th>
			<th>Date</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
	</tfoot>
</table>

<!--Hidden value to external js file-->
<input id="baseURL" type=hidden value="<?=base_url()?>">

</body>
</html>