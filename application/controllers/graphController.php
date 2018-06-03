<?php
	class graphController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function getRating()
		{
			$this->load->model("main_model");
				
			$query = $this->main_model->get_data("*","rating");
			$ratingData = $query->result_array();	
			
			echo json_encode($ratingData);
		}
		
		public function getDuty()
		{
			$this->load->model("main_model");
				
			$query = $this->main_model->get_data("*","pending_duty");
			$pendingDutyData = $query->num_rows();	
			
			$query = $this->main_model->get_data("*","complete_duty");
			$completeDutyData = $query->num_rows();	
			
			$totalNumberDuty = $pendingDutyData + $completeDutyData;
			$completeDutyPercent = ($completeDutyData/$totalNumberDuty)*100;
			$pendingDutyPercent = 100 - $completeDutyPercent;
			
			$dutyDataArray = array("completeDutyPercent" => $completeDutyPercent , "pendingDutyPercent" => $pendingDutyPercent);
			echo json_encode($dutyDataArray);
		}
			
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	