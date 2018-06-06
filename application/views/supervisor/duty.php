<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/duty.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/supervisorDutyStyle.css">

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>  

<h2>Duty</h2><hr/>

<!--This form got two table, one is to let user to insert new duty, one is to display the duty table-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<!--First table to display the form element like input box and button-->
	<table class="newDutyTable">
        <tr><td><b class="newDutyLabel">New Duty:</b></td></tr>
		<tr><td class="newDutySelect"><select id="newDuty_task"><?php foreach($tasks as $task):?><option value="<?php echo $task["task"]?>"><?php echo $task["task"]?></option><?php endforeach?></select></td>
		<td class="newDutySelect"><select id="newDuty_sub_task"><?php foreach($sub_tasks as $sub_task):?><option value="<?php echo $sub_task["sub_task"]?>"><?php echo $sub_task["sub_task"]?></option><?php endforeach?></select></td>
		</tr>
		<tr><td colspan="3"><input class="newDutyBtn" type="submit" value="Add"></td></tr>
	</table>
	<!--This is the end of first table-->
	<!--Second Table is to output the data which by controller and delete,update button-->
	<div class="table-responsive">
		<table id="duty_table" class="table table-striped table-bordered table-responsive" border="1">
			<thead>
				<tr class="tableTitle">
					<th class="titleLabel">No.</th><th>Duty Task</th><th>Duty Sub Task</th><th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1?><?php foreach($duties as $duty):?>
				<tr>
					<td><?php echo $i ?></td>
					<td id="<?php echo($duty["duty_id"])?>_task"><?php echo $duty["duty_task"]; ?></td>
					<td id="<?php echo($duty["duty_id"])?>_sub_task"><?php echo $duty["duty_sub_task"]; ?></td>
					<td><center><button style="width:80px;height:30px" type="button" id="<?php echo $duty["duty_id"];?>_delete" class="w3-text-red fa fa-trash delete"></button></center></td>
				</tr>
				<?php $i = $i+1?><?php endforeach; ?>	
			</tbody>
			<tfoot>
				<tr>
					<th>No.</th><th>Duty Task</th><th>Duty Sub Task</th><th>Delete</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!--This is the end of second table-->
</form>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>