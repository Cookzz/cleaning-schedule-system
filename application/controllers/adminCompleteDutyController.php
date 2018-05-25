<?php
	class adminCompleteDutyController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function updateCompleteDuty()
		{
			$this->load->model("main_model");
			if(isset($_POST['completeDutyString']))
			{
				$completeDuty = json_decode($_POST["completeDutyString"], false);

				$complete_duty_id = $completeDuty->complete_duty_id;
					
				$data = array('complete_duty_task' => $completeDuty->complete_duty_task,
							  'complete_duty_subtask' => $completeDuty->complete_duty_subtask,
							  'complete_duty_cleaner' => $completeDuty->complete_duty_cleaner,
							  'complete_duty_comment' => $completeDuty->complete_duty_comment,
							  'complete_duty_schedule' => $completeDuty->complete_duty_schedule,
							  'complete_duty_time' => $completeDuty->complete_duty_time,
							  'complete_duty_date' => $completeDuty->complete_duty_date);
								  
				$this->main_model->update_data("complete_duty_id",$complete_duty_id,$data,"complete_duty");
				
				echo("Update Success");
			}			
		}
		
		public function deleteCompleteDutyData()
		{
			$this->load->model("main_model");
			if(isset($_POST['complete_duty_id']))
			{
				$complete_duty_id = $_POST["complete_duty_id"];
				
				$data = array("complete_duty_id" => $complete_duty_id);
				$this->main_model->delete_data("complete_duty",$data);
			}			
		}	
	}