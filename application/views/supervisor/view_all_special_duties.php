<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/special_duty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/supervisorViewSpecialDutyStyle.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>  

<h2 class="title">All Special Duties</h2><hr class="pageHr" />

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<!--This Table is to output the data which by controller and delete,update button-->
	<div class="table-responsive">
		<table id="special_duty_table" class="table table-striped table-bordered table-responsive" border="1">
			<thead>
				<tr class="tableTitle">
					<th class="noLabel">No.</th>
					<th class="specialDutyLabel">Special Duty Title</th>
					<th class="specialDutyDetail">Special Duty Detail</th>
					<th class="timeLabel">Special Duty Time</th>
					<th class="dateLabel">Special Duty Date</th>
					<th class="modifyLabel">Modify</th>
					<th class="deleteLabel">Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1?><?php foreach($special_duties as $special_duty):?>
				<tr>
					<td><?php echo $i ?></td>
					<td id="<?php echo($special_duty["special_duty_id"])?>_special_duty_title"><?php echo $special_duty["special_duty_title"]; ?></td>
					<td id="<?php echo($special_duty["special_duty_id"])?>_special_duty_detail" class="details"><span class="detailsLabel more"><?= $special_duty["special_duty_detail"]?></span></td>
					<td id="<?php echo($special_duty["special_duty_id"])?>_special_duty_time"><?php echo $special_duty["special_duty_time"]; ?></td>
					<td id="<?php echo($special_duty["special_duty_id"])?>_special_duty_date"><?php echo $special_duty["special_duty_date"]; ?></td>
					<td><center><button type="button" onclick="window.location.href='<?php echo base_url(); ?>HomeController/viewSpecifySpecialDutyPage/<?php echo $special_duty["special_duty_id"];?>'" class="update">Modify</button></center></td>
					<td><center><button style="width:80px;height:30px" type="button" id="<?php echo $special_duty["special_duty_id"];?>_delete" class="w3-text-red fa fa-trash delete"></button></center></td>
				</tr>
				<?php $i = $i+1?><?php endforeach; ?>	
			</tbody>
			<tfoot>
				<tr>
					<th>No.</th>
					<th>Special Duty Title</th>
					<th>Special Duty Detail</th>
					<th>Special Duty Time</th>
					<th>Special Duty Date</th><th>Modify</th>
					<th>Delete</th>
				</tr>
			</tfoot>
		</table>
	</div>
</form>

<!--hidden value for external js file-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>