<!DOCTYPE HTML>  
<html>
<head>

</head>
<body>  

<h2>Main Page</h2><hr/>


<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
   <?php foreach($special_duties as $special_duty):?>
    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#<?= $special_duty['special_duty_id']?>" role="tab" aria-controls="nav-home" aria-selected="true"><?= $special_duty["special_duty_title"]?></a>
    <?php endforeach;?>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
 <?php foreach($special_duties as $special_duty):?>
  <div class="tab-pane fade" id="<?= $special_duty['special_duty_id']?>" role="tabpanel" aria-labelledby="nav-home-tab"><h6>Date : <?= $special_duty["special_duty_date"]?></h6><h6>Time : <?= $special_duty["special_duty_time"]?></h6>
    <?= $special_duty["special_duty_detail"]?></div>
  <?php endforeach;?>
</div>


</body>
</html>