<?php
	class adminPendingDutyController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function updatePendingDuty()
		{
			$this->load->model("main_model");
			if(isset($_POST['pendingDutyString']))
			{
				$pendingDuty = json_decode($_POST["pendingDutyString"], false);

				$pending_duty_id = $pendingDuty->pending_duty_id;
					
				$data = array('pending_duty_task' => $pendingDuty->pending_duty_task,
							  'pending_duty_subtask' => $pendingDuty->pending_duty_subtask,
							  'pending_duty_cleaner' => $pendingDuty->pending_duty_cleaner,
							  'pending_duty_comment' => $pendingDuty->pending_duty_comment,
							  'pending_duty_schedule' => $pendingDuty->pending_duty_schedule,
							  'pending_duty_date' => $pendingDuty->pending_duty_date);
								  
				$this->main_model->update_data("pending_duty_id",$pending_duty_id,$data,"pending_duty");
				
				echo("Update Success");
			}			
		}
		
		public function deletePendingDutyData()
		{
			$this->load->model("main_model");
			if(isset($_POST['pending_duty_id']))
			{
				$pending_duty_id = $_POST["pending_duty_id"];
				
				$data = array("pending_duty_id" => $pending_duty_id);
				$this->main_model->delete_data("pending_duty",$data);
			}			
		}	
	}