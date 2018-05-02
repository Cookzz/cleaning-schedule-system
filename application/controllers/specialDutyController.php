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
			if(isset($_POST['cleaners']))
			{
				
			}			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	