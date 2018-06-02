<!DOCTYPE HTML>  
<html>
<head>

</head>
<body>  

<h2>Main Page</h2><hr/>

<?php foreach($special_duties as $special_duty):?>
<h3><?= $special_duty["special_duty_title"]?></h3>
<h6>Date : <?= $special_duty["special_duty_date"]?></h6><h6>Time : <?= $special_duty["special_duty_time"]?></h6>
<?= $special_duty["special_duty_detail"]?>
<hr />
<?php endforeach;?>

</body>
</html>