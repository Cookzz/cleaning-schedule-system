<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_duty.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/cleanerOwnSpecialDutyStyle.css">
</head>
<body>  

<h2 class="pageTitle">Today's Special Duty</h2><hr class="titleHr" /><h3 class="titleDate">Date: <?= $date?></h3><br>
<!--This is the body of own special duty page, It allow cleaner to see thier special duty-->

<!--This is the start to show the special duty-->
<!--Check the special duty is 0 or more than 0-->
<?php if($special_duties_count > 0) {?>
<?php foreach($special_duties as $special_duty):?>
<hr class="topTaskTitleHr" />
    <h3 class="taskTitle"><?= $special_duty["special_duty_title"]?></h3>
<hr class="bottomTaskTitleHr" />
<h4 class="specialDutyLabel"><b>Time:</b> <?= $special_duty["special_duty_time"]?></h4>
<h4 class="specialDutyLabel"><b>Detail:</b> <?= $special_duty["special_duty_detail"]?></h4>
<hr />
<?php endforeach; ?>
<!--The else statement will be active when the total of pending duty is 0 -->
<?php }else{?>
<h6>You Do Not Have Any Special Duties</h6>
<?php }?>

<!--This end of pending duty area-->

<p>

<!--boundary (below are hidden value to external js)-->
<input id="baseURL" type=hidden value="<?=base_url()?>">

</body>
</html>