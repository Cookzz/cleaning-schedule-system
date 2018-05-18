<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_duty.js"></script>
</head>
<body>  

<h2>Today Special Duty</h2><h5><?= $date?></h4>
<!--This is the body of own special duty page, It allow cleaner to see thier special duty-->
<p>
<!--This is the start to show the special duty-->
<!--Check the special duty is 0 or more than 0-->
<?php if($special_duties_count > 0) {?>
<?php foreach($special_duties as $special_duty):?>
<hr />
<h3>Title : <?= $special_duty["special_duty_title"]?></h3>
<h5>Time : <?= $special_duty["special_duty_time"]?></h5>
Detail : <?= $special_duty["special_duty_detail"]?>
<hr />
<?php endforeach; ?>
<!--The else statement will be active when the total of pending duty is 0 -->
<?php }else{?>
<h6>You had completed every duty</h6>
<?php }?>
</p>
<!--This end of pending duty area-->

<p>

<!--boundary (below are hidden value to external js)-->
<input id="baseURL" type=hidden value="<?=base_url()?>">

</body>
</html>