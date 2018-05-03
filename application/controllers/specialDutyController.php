<?php
	class specialDutyController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }

		public function setSpecialDuty()
		{
			$this->load->model("main_model");
			if(isset($_POST['newSpecialDutyString']))
			{
				$newSpecialDutyObject = json_decode($_POST["newSpecialDutyString"], false);
				
				$special_duty_data = array("special_duty_detail" => $newSpecialDutyObject->special_duty_dutyDetail,
										"special_duty_time" => $newSpecialDutyObject->special_duty_time,
										"special_duty_date" => $newSpecialDutyObject->special_duty_date);
										
				$this->main_model->insert_data("special_duty" ,$special_duty_data);
				
				$select_query = $this->main_model->get_specify_data("*","special_duty_id",$special_duty_data,"special_duty");
				$special_duty_id = $select_query->row()->special_duty_id;
				
				for($i=0;$i<sizeof($newSpecialDutyObject->cleaners);$i++)
				{
					$cleaner = $newSpecialDutyObject->cleaners[$i];
					$special_duty_cleaner_data = array("special_duty_cleaner" => $cleaner,"special_duty_id" => $special_duty_id);
					$this->main_model->insert_data("special_duty_cleaner" ,$special_duty_cleaner_data);
				}
				echo(true);
			}			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	