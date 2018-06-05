<?php
	class ownDutyController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function completeDuty($page = 'task')
		{
			$this->load->model("main_model");
			
			if(isset($_POST['pending_duty_id']))
			{	
				$pending_duty_id = ($_POST['pending_duty_id']);
				
				$pending_duty_id = array('pending_duty_id' => $pending_duty_id);
				$query = $this->main_model->get_specify_data("*","pending_duty_id",$pending_duty_id,"pending_duty");
				$result = $query->row_array();
				$this->main_model->delete_data("pending_duty",$pending_duty_id);
				
				$data = array('complete_duty_task' => $result["pending_duty_task"],
								"complete_duty_subtask" => $result["pending_duty_subtask"],
								"complete_duty_cleaner" => $result["pending_duty_cleaner"],
								"complete_duty_schedule" => $result["pending_duty_schedule"],
								"complete_duty_time" => date("G:i:s"),
								"complete_duty_date" => date("Y/m/d"));
				$query = $this->main_model->insert_data("complete_duty",$data);
			}
				
		}
	}
	
?>	
	
	
	
	
	
	
	
	
	
	
	