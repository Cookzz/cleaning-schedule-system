<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/special_duty.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

</head>
<body>  

<h2>All Special Duties</h2><hr/>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<!--This Table is to output the data which by controller and delete,update button-->
	<table id="special_duty_table" style="width:40%" border="1">
		<thead>
			<tr>
				<th>No.</th>
				<th>Special Duty Detail</th>
				<th>Special Duty Time</th>
				<th>Special Duty Date</th
				><th>Modify</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 2?><?php foreach($special_duties as $special_duty):?>
			<tr>
				<td><?php echo $i ?></td>
				<td id="<?php echo($special_duty["special_duty_id"])?>_special_duty_detail"><?php echo $special_duty["special_duty_detail"]; ?></td>
				<td id="<?php echo($special_duty["special_duty_id"])?>_special_duty_time"><?php echo $special_duty["special_duty_time"]; ?></td>
				<td id="<?php echo($special_duty["special_duty_id"])?>_special_duty_date"><?php echo $special_duty["special_duty_date"]; ?></td>
				<td><button type="button" onclick="window.location.href='<?php echo base_url(); ?>HomeController/viewSpecifySpecialDutyPage/<?php echo $special_duty["special_duty_id"];?>'" class="update">Modify</button></td>
				<td><button type="button" id="<?php echo $special_duty["special_duty_id"];?>_delete" class="delete">Delete</button></td>
			</tr>
			<?php $i = $i+1?><?php endforeach; ?>	
		</tbody>
	</table>
</form>

<!--hidden value for external js file-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>