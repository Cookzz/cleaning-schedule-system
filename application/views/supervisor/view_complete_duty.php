<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/complete_duty.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

</head>
<body>  

<a href="<?php echo base_url().$link;?>"><?= $link_word;?></a>
<h2><?= $title?></h2><hr/>
<!--Table to show complete duty table-->
<table id="complete_duty_table" border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Cleaner</th>
			<th>Stuff Location</th>
			<th>Sub Stuff</th>
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
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_stuff"><?php echo $complete_duty["complete_duty_stuff"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_substuff"><?php echo $complete_duty["complete_duty_substuff"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_time"><?php echo $complete_duty["complete_duty_time"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_comment" contenteditable="true"><?php echo $complete_duty["complete_duty_comment"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_schedule"><?php echo $complete_duty["complete_duty_schedule"];?></td>
			<td id="<?php echo $complete_duty["complete_duty_id"];?>_complete_duty_date"><?php echo $complete_duty["complete_duty_date"];?></td>
			<td><button id="<?php echo $complete_duty["complete_duty_id"];?>update" class="update btn btn-default" type="button">Update</button></td>
			<td><button id="<?php echo $complete_duty["complete_duty_id"];?>delete" class="delete btn btn-default" type="button">Delete</button></td>
		</tr>
		<?php $i++;?>
		<?php endforeach; ?>
		<!--end of the foreach loop-->
	</tbody>
	<!--end of the tbody-->
</table>

<!--Hidden value for external js file-->
<input id="baseURL" type=hidden value="<?=base_url()?>">

</body>
</html>