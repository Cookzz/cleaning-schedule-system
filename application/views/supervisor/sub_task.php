<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sub_task.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/supervisorSubTaskStyle.css">

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>


</head>
<body>  

<h2>Sub Task</h2><hr/>

<!--This form got two table, one is to let user to insert new task, one is to display the subtask table-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<!--First table to display the form element like input box and button-->
	<table>
			<tr><td>New Sub Task:</td><td><input id="newSubTaskField" type="text" value="" name="newStaff" maxlength="30"></td></tr>
			<tr><td colspan="3"><input style="float:right"type="submit" value="Add"></td></tr>
	</table>
	<!--This is the end of first table-->
	<!--Second Table is to output the data which by controller and delete,update button-->
	<table id="sub_task_table" class="table table-striped table-bordered table-responsive" border="1">
		<thead>
			<tr class="tableTitle">
				<th class="titleLabel">No.</th><th class="secondaryTitleLabel">Sub Task</th><th>Update</th><th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1?><?php foreach($sub_tasks as $sub_task):?>
			<tr>
				<td><?php echo $i ?></td><td id="<?php echo($sub_task["sub_task_id"])?>_sub_task" contenteditable="true"><?php echo $sub_task["sub_task"]; ?></td>
				<td><center><button type="button" id="<?php echo $sub_task["sub_task_id"];?>_update" class="update">Update</button></center></td>
                <td><center><button style="width:80px;height:30px" type="button" id="<?php echo $sub_task["sub_task_id"];?>_delete" class="w3-text-red fa fa-trash delete"></button></center></td>
			</tr>
			<?php $i = $i+1?><?php endforeach; ?>	
		</tbody>
		<tfoot>
			<tr>
				<th>No.</th><th>Sub Task</th><th>Update</th><th>Delete</th>
			</tr>
		</tfoot>
	</table>
	<!--This is the end of second table-->
</form>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>