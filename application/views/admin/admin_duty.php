<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin_duty.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/print.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/adminDutyStyle.css">
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
<h2>Duty</h2><hr/>

<!--This form got one table, one is to let user to insert new duty, one is to display the duty table-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<!--Table is to output the data which by controller and delete,update button-->
	<div class="table-responsive">
		<table id="admin_duty_table" class="table table-striped table-bordered" border="1">
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
	<!--This is the end of second table-->
	</div>
</form>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>