<?php
	class adminSpecialDutyController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function updateSpecialDuty()
		{
			$this->load->model("main_model");
			if(isset($_POST['specialDutyString']))
			{
				$specialDuty = json_decode($_POST["specialDutyString"], false);

				$special_duty_id = $specialDuty->special_duty_id;
					
				$data = array('special_duty_title' => $specialDuty->special_duty_title,
							  'special_duty_detail' => $specialDuty->special_duty_detail,
							  'special_duty_time' => $specialDuty->special_duty_time,
							  'special_duty_date' => $specialDuty->special_duty_date);
								  
				$this->main_model->update_data("special_duty_id",$special_duty_id,$data,"special_duty");
				
				echo("Update Success");
			}			
		}
		
		public function deleteSpecialDutyData()
		{
			$this->load->model("main_model");
			if(isset($_POST['special_duty_id']))
			{
				$special_duty_id = $_POST["special_duty_id"];
				
				$data = array("special_duty_id" => $special_duty_id);
				$this->main_model->delete_data("special_duty",$data);
			}			
		}	
	}