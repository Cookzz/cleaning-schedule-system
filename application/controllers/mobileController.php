<?php
	class MobileController extends CI_Controller
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
			if(isset($_POST['userData']))
			{			
				$userData = json_decode($_POST["userData"]);
				$user_id = $userData->user_id;
				$user_password = $userData->user_password;
				
				$data = array('user_id' => $user_id);
				$query = $this->main_model->get_specify_data('*',"user_id",$data,"users");
				$result = $query->num_rows();
					
				if($result<=0)
				{
					echo("false");
				}
				else
				{
					$data = array('user_id' => $user_id);
					$query = $this->main_model->get_specify_data("*","user_password",$data,"users");
					$result = $query->row()->user_password;
					$user_access_level = $query->row()->user_access_level;
					if($result === $user_password)
					{
						if($user_access_level == 3)
						{
							//$_SESSION['mobile_uid'] = $query->row()->user_id;
							echo("true");							
						}
						else
						{				
							echo("notCleaner");
						}

					}
					else
					{
						echo("false");
					}
				}
			}
		}
		
		
	
		public function loadUserData()
		{
			if(isset($_POST['user_id']))
			{
				$uid = $_POST['user_id'];
				$userObject = new userObject();
				
				$data = array('user_id' => $uid);
				$query = $this->main_model->get_specify_data('*',"user_id",$data,"users");
						
				$userObject->setUserData($query->row()->user_id,$query->row()->user_name,$query->row()->user_picture);
				
				echo (json_encode($userObject));
			}
		}
		
		public function loadMorningScheduleData()
		{
			$scheduleObject = new scheduleObject();
				
			$week_number = array("week_number" => date("W"));
			$get_morning_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"morning_schedule");
			$morning_schedules = $get_morning_schedule_query->result_array();
						
			$task = array();
			$monday = array();
			$tuesday = array();
			$wednesday = array();
			$thursday = array();
			$friday = array();
			$saturday = array();
			$sunday = array();
				
			foreach($morning_schedules as $morning_schedule)
			{
				array_push($task,$morning_schedule['task']);
				array_push($monday,$morning_schedule['monday']);
				array_push($tuesday,$morning_schedule['tuesday']);
				array_push($wednesday,$morning_schedule['wednesday']);
				array_push($thursday,$morning_schedule['thursday']);
				array_push($friday,$morning_schedule['friday']);
				array_push($saturday,$morning_schedule['saturday']);
				array_push($sunday,$morning_schedule['sunday']);
			}
				
			$scheduleObject->setScheduleData($task,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday);
				
			echo (json_encode($scheduleObject));
			
		}
	
		public function loadAfternoonScheduleData()
		{
			$scheduleObject = new scheduleObject();
					
			$week_number = array("week_number" => date("W"));
			$get_morning_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"afternoon_schedule");
			$morning_schedules = $get_morning_schedule_query->result_array();
							
			$task = array();
			$monday = array();
			$tuesday = array();
			$wednesday = array();
			$thursday = array();
			$friday = array();
			$saturday = array();
			$sunday = array();
					
			foreach($morning_schedules as $morning_schedule)
			{
				array_push($task,$morning_schedule['task']);
				array_push($monday,$morning_schedule['monday']);
				array_push($tuesday,$morning_schedule['tuesday']);
				array_push($wednesday,$morning_schedule['wednesday']);
				array_push($thursday,$morning_schedule['thursday']);
				array_push($friday,$morning_schedule['friday']);
				array_push($saturday,$morning_schedule['saturday']);
				array_push($sunday,$morning_schedule['sunday']);
			}
					
			$scheduleObject->setScheduleData($task,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday);
				
			echo (json_encode($scheduleObject));
			
		}
	}
	
	public function loadAfternoonScheduleData()
		{
			if(isset($_POST['user_id'])))	
			{
				$this->load->model("main_model");
				
				$user_id = array('id' => $_POST['user_id']);
				
				$query = $this->main_model->get_specify_data("user_name","user_name",$user_id,"users");
				$user_name = $query->row()->user_name;
				$query = $this->main_model->get_specify_data("user_id","user_id",$user_id,"users");
				$user_id = $query->row()->user_id;
				
				$special_duty_date = array("special_duty_date" => date("Y-m-d"));
				$query = $this->main_model->get_specify_data("special_duty_id","special_duty_id",$special_duty_date,"special_duty");
				$special_duties_id = $query->result_array();
				
				$special_duties_id_array = array("default");
				foreach ($special_duties_id as $special_duty_id)
				{
					array_push($special_duties_id_array,$special_duty_id['special_duty_id']);
				}

				$cleaner = array("special_duty_cleaner"=> $user_id."_".$user_name);
				$query = $this->main_model->get_specify_data3("special_duty_id","special_duty_cleaner_id DESC",$cleaner,"special_duty_id",$special_duties_id_array,"special_duty_cleaner");
				$special_duties_id = $query->result_array();
				
				$special_duties_id_array = array("default");
				foreach ($special_duties_id as $special_duty_id)
				{
					array_push($special_duties_id_array,$special_duty_id['special_duty_id']);
				}
				
				$special_duty_date = array("special_duty_date" => date("Y-m-d"));
				$special_duties_id = array("special_duties_id" => $special_duties_id);
				$query = $this->main_model->get_specify_data3("*","special_duty_time ASC",$special_duty_date,"special_duty_id",$special_duties_id_array,"special_duty");
				$special_duties = $query->result_array();
				
				$special_duty_title = array();
				$special_duty_detail = array();
				$special_duty_time = array();
				$special_duty_date = array();

						
				foreach($special_duties as $special_duty)
				{
					array_push($special_duty_title,$special_duty['special_duty_title']);
					array_push($special_duty_detail,$special_duty['special_duty_detail']);
					array_push($special_duty_time,$special_duty['special_duty_time']);
					array_push($special_duty_date,$special_duty['special_duty_date']);
				}
						
				$specialScheduleObject = new specialScheduleObject();
				$specialScheduleObject->setSpecialScheduleData($special_duty_title,$special_duty_detail,$special_duty_time,$special_duty_date);
				
				echo (json_encode($specialScheduleObject));
			}	
		}
	}
	
	
	class userObject
	{
		function setUserData($uid,$user_name,$user_image)
		{
			$this->uid = $uid;
			$this->user_name = $user_name;
			$this->user_image = $user_image;
		}
	}
	
	class scheduleObject
	{
		function setScheduleData($task,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday)
		{
			$this->task = $task;
			$this->monday = $monday;
			$this->tuesday = $tuesday;
			$this->wednesday = $wednesday;
			$this->thursday = $thursday;
			$this->friday = $friday;
			$this->saturday = $saturday;
			$this->sunday = $sunday;
			
		}
	}
	
	class specialScheduleObject
	{
		function setSpecialScheduleData($special_duty_title,$special_duty_detail,$special_duty_time,$special_duty_date)
		{
			$this->special_duty_title = $special_duty_title;
			$this->special_duty_detail = $special_duty_detail;
			$this->special_duty_time = $special_duty_time;
			$this->special_duty_date = $special_duty_date;
			
		}
	}


?>
	
	
	
	
	
	
	
	
	
	
	
	
	