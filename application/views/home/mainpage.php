<!DOCTYPE HTML>  
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mainPageStyle.css">
</head>
<body>  

<h2>Main Page</h2><hr/>

<div class="mainPage">
    <?php foreach($special_duties as $special_duty):?>
    <h3><?= $special_duty["special_duty_title"]?></h3>
    <h6><label>Date:</label> <?= $special_duty["special_duty_date"]?></h6>
    <h6><label>Time:</label> <?= $special_duty["special_duty_time"]?></h6>
    <h6><label>Details:</label> <?= $special_duty["special_duty_detail"]?></h6>
    <hr />
    <?php endforeach;?>
</div>


</body>
</html>