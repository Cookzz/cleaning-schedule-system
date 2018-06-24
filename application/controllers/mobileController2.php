<?php
	class MobileController2 extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
				$this->load->model("main_model");
				$this->load->library('session');
        }
		
		public function mobileLogin()
		{
            
        }
            
?>