<!DOCTYPE HTML>  
<html>
<head>
    
</head>
<body>  

<h2>Main Page</h2><hr/>
<!--This this main page body-->
<div class="navbar-header">
<!--This this sidebar button-->
	<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
		<i class="glyphicon glyphicon glyphicon-play"></i>
		<span>Toggle Sidebar</span>
	</button>
</div> 

<p><a href="<?php echo base_url();?>adminHomeController/viewUserPage">User Table</a></p>
<p><a href="<?php echo base_url();?>adminHomeController/viewStuffLocationPage">Stuff Location Table</a></p>
<p><a href="<?php echo base_url();?>adminHomeController/viewSubStuffPage">Sub_Stuff Table</a></p>
<p><a href="<?php echo base_url();?>adminHomeController/viewDutyPage">Duty Table</a></p>
<p><a href="<?php echo base_url();?>adminHomeController/viewMorningSchedulePage">Morning Schedule Table</a></p>
<p><a href="<?php echo base_url();?>adminHomeController/viewAfternoonSchedulePage">Afternoon Schedule Table</a></p>
<p><a href="<?php echo base_url();?>adminHomeController/viewPendingDutyPage">Pending Duty Table</a></p>
<p><a href="<?php echo base_url();?>adminHomeController/viewCompleteDutyPage">Complete Duty Table</a></p>

</body>
</html>