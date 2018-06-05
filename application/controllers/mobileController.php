<?php
	class mobileController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function test()
		{
			
			echo("If this appear = success!!");
				
		}
	}
?>
	
	
	
	
	
	
	
	
	
	
	
	
	