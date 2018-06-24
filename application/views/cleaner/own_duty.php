<!DOCTYPE HTML>  
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/own_duty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/cleanerOwnDutyStyle.css">
</head>
<body>  

<h2 class="pageTitle">Today's Duties</h2><hr class="titleHr">
<h3 class="titleDate">Date: <?= $date?></h3>
<br>
<!--This is the body of own duty page, It allow cleaner to see pending duty and coomplete duty-->

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#pendingDutyTab">Pending Duty</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#completedDutyTab">Completed Duty</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="pendingDutyTab">
      <!--Check the pending duty is 0 or more than 0-->
        <?php if($pending_duty_count > 0) {?>
        <?php foreach($pending_duties as $pending_duty => $rows):?>
        <hr class="topDutyTitleHr" />
        <h4 class="dutyTitle"><?= $pending_duty?></h4>
        <hr class="bottomDutyTitleHr" />
        <ul>
            <!--This is the table to show out the pending duty data, it using php if-else to dicide which data need to out put-->
            <table class="pendingDutyTable table-responsive">
                <tr>
                    <th class="subTaskCol">Sub Task</th>
                    <th class="subCommentCol">Comment From Supervisor</th>
                    <th class="subStateCol">State</th>
                </tr>
            <!--This foreach loop will foreach loop the data which passed by the controller and decide the output-->
            <?php foreach($rows as $row) {?>		
                <tr>
                    <td><?= $row["pending_duty_subtask"]?></td>
                    <td><?php if(empty($row["pending_duty_comment"])){echo ("No Comments");}else{echo($row["pending_duty_comment"]);}?></td>
                    <td><input id="<?= $row["pending_duty_id"]?>" class="complete" type="checkbox" name="vehicle" value="Bike"></td>
                </tr>	
            <?php }?>
            <!--This is the end of foreach loop-->
            </table>
            <!--This is the end of pending duty table-->
        </ul>
        <?php endforeach; ?>
        <!--The else statement will be active when the total of pending duty is 0 -->
        <?php }else{?>
        <h6>All duties are completed</h6>
        <?php }?>
  </div>
  <div class="tab-pane container fade" id="completedDutyTab">
      <!--Check the complete duty is 0 or more than 0-->
        <?php if($complete_duty_count > 0) {?>
        <?php foreach($complete_duties as $complete_duty => $rows):?>
        <hr />
        <h4><?= $complete_duty?></h4>
        <hr />
        <ul>
            <!--This is the table to show out the complete duty data, it using php if-else to dicide which data need to out put-->
            <table class="completedDutyTable table-responsive">
                <tr><th>Sub Task</th>
                <th>Comment From Supervisor</th>
                </tr>
            <!--This foreach loop will foreach loop the data which passed by the controller and decide the output-->
            <?php foreach($rows as $row) {?>		
                <tr>
                    <td><?= $row["complete_duty_subtask"]?></td>
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
        <h6>There are no completed duties at the moment</h6>
        <?php }?>
  </div>
</div>

<!--The end of complete duty area -->

<!--boundary (below are hidden value to external js)-->
<input id="baseURL" type=hidden value="<?=base_url()?>">

</body>
</html>