<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_duty.js"></script>
</head>
<body>  

<h2>Today Duty</h2><h5><?= $date?></h4>
<!--This is the body of own duty page, It allow cleaner to see pending duty and coomplete duty-->
<p>
<!--This is the start to show the pending duty-->
<h3>Pending Duty</h3>
<!--Check the pending duty is 0 or more than 0-->
<?php if($pending_duty_count > 0) {?>
<?php foreach($pending_duties as $pending_duty => $rows):?>
<hr />
<h4><?= $pending_duty?></h4>
<hr />
<ul>
	<!--This is the table to show out the pending duty data, it using php if-else to dicide which data need to out put-->
	<table>
		<tr><th>Sub Stuff</th><th>Comment From Supervisor</th><th>State</th></tr>
	<!--This foreach loop will foreach loop the data which passed by the controller and decide the output-->
	<?php foreach($rows as $row) {?>		
		<tr>
			<td><?= $row["pending_duty_substuff"]?></td>
			<td><?php if(empty($row["pending_duty_comment"])){echo ("No Any Comment");}else{echo($row["pending_duty_comment"]);}?></td>
			<td><input id="<?= $row["pending_duty_id"]?>" class="complete" type="checkbox" name="vehicle" value="Bike"></td>
		</tr>	
	<?php }?>
	<!--This is the end of foreach loop-->
	</table>
	<!--This is the end of pending duty table-->
</ul>
<hr />
<?php endforeach; ?>
<!--The else statement will be active when the total of pending duty is 0 -->
<?php }else{?>
<h6>You had completed every duty</h6>
<?php }?>
</p>
<!--This end of pending duty area-->

<p>
<!--This is the start to show the complete duty-->
<h3>Complete Duty</h3>
<!--Check the complete duty is 0 or more than 0-->
<?php if($complete_duty_count > 0) {?>
<?php foreach($complete_duties as $complete_duty => $rows):?>
<hr />
<h4><?= $complete_duty?></h4>
<hr />
<ul>
	<!--This is the table to show out the complete duty data, it using php if-else to dicide which data need to out put-->
	<table>
		<tr><th>Sub Stuff</th><th>Comment From Supervisor</th></tr>
	<!--This foreach loop will foreach loop the data which passed by the controller and decide the output-->
	<?php foreach($rows as $row) {?>		
		<tr>
			<td><?= $row["complete_duty_substuff"]?></td>
			<td><?php if(empty($row["complete_duty_comment"])){echo ("No Any Comment");}else{echo($row["complete_duty_comment"]);}?></td>
		</tr>	
	<?php }?>
	<!--This is the end of foreach loop-->
	</table>
	<!--This is the end of complete duty table-->
</ul>
<hr />
<?php endforeach; ?>
<!--The else statement will be active when the total of complete duty is 0 -->
<?php }else{?>
<h6>No any record</h6>
<?php }?>
</p>
<!--The end of complete duty area -->

<!--boundary (below are hidden value to external js)-->
<input id="baseURL" type=hidden value="<?=base_url()?>">

</body>
</html>