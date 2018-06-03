<!DOCTYPE HTML>  
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mainPageStyle.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cleaner_schedule.js"></script>
</head>
<body>  

<h2>Main Page</h2><hr/>

<img src="<?php echo base_url(); ?>assets/images/checklist.jpg" class="mainPageimg">
<h3 class="pageTitle">Latest Special Duties</h3>
<div class="mainPage">
    <?php foreach($special_duties as $special_duty):?>
    
    <h3 class="titleLabel"><?= $special_duty["special_duty_title"]?></h3>
    <hr class="titleHr">
    
    <div class="timeDateContainer">
        <div class="dateLabel"><label>Date:</label> <?= $special_duty["special_duty_date"]?></div>
        <div class="timeLabel"><label>Time:</label> <?= $special_duty["special_duty_time"]?></div>
    </div>
    <br>
    <div class="details">
        <h6 class="detailsLabel more"><label>Details:</label> <?= $special_duty["special_duty_detail"]?></h6>
    </div>
    <hr />
    <?php endforeach;?>
</div>


</body>
</html>