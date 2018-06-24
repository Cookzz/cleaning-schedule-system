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
							$data = array('pending_duty_date' => date("Y/m/d"));
							$query = $this->main_model->get_specify_data("*","pending_duty_id",$data,"pending_duty");
							$pending_duty_rows = $query->num_rows();
							$data = array('complete_duty_date' => date("Y/m/d"));
							$query = $this->main_model->get_specify_data("*","complete_duty_id",$data,"complete_duty");
							$complete_duty_rows = $query->num_rows();
							
							if($pending_duty_rows <= 0 && $complete_duty_rows <=0 )
							{
								$day = strtolower(date("l"));
								$week = date("W");
								$week_number = array("week_number" => $week,"remark" => "active");
								
								//Select morning schedule and insert to pending order
								$query = $this->main_model->get_specify_data("*","task",$week_number,"morning_schedule");
								$schedule_results = $query->result_array();
								$morning_schedule_results_count = $query->num_rows();
								
								if($morning_schedule_results_count > 0)
								{
									foreach($schedule_results as $schedule_result)
									{
										$task = $schedule_result["task"];
										
										$data = array("duty_task"=>$task);
										$query = $this->main_model->get_specify_data("*","duty_task",$data,"duty");
										$duty_results = $query->result_array();
										$duty_number = $query->num_rows();
										if($duty_number != 0)
										{
											foreach($duty_results as $duty_result)
											{
												if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
												{
													$duty_sub_task = $duty_result['duty_sub_task'];
												
													$data = array("pending_duty_task"=>$task,
															"pending_duty_subtask"=>$duty_sub_task,
															"pending_duty_cleaner"=>$schedule_result[$day],
															"pending_duty_schedule"=>"morning",
															"pending_duty_date"=>date("Y/m/d"));
															
													$query = $this->main_model->insert_data("pending_duty",$data);
												}
												
											}
										}
										else
										{
											if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
											{										
												$data = array("pending_duty_task"=>$task,
														"pending_duty_subtask"=>"No any subtask",
														"pending_duty_cleaner"=>$schedule_result[$day],
														"pending_duty_schedule"=>"morning",
														"pending_duty_date"=>date("Y/m/d"));
														
												$query = $this->main_model->insert_data("pending_duty",$data);
											}
										}
										
									}
								}
								
								
								
								//Select afternoon schedule and insert to pending order
								$query = $this->main_model->get_specify_data("*","task",$week_number,"afternoon_schedule");
								$schedule_results = $query->result_array();
								$afternoon_schedule_results_count = $query->num_rows();
								
								if($afternoon_schedule_results_count > 0)
								{
									foreach($schedule_results as $schedule_result)
									{
										$task = $schedule_result["task"];
										
										$data = array("duty_task"=>$task);
										$query = $this->main_model->get_specify_data("*","duty_task",$data,"duty");
										$duty_results = $query->result_array();
										$duty_number = $query->num_rows();
										if($duty_number != 0)
										{
											foreach($duty_results as $duty_result)
											{
												if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
												{
													$duty_sub_task = $duty_result['duty_sub_task'];
												
													$data = array("pending_duty_task"=>$task,
															"pending_duty_subtask"=>$duty_sub_task,
															"pending_duty_cleaner"=>$schedule_result[$day],
															"pending_duty_schedule"=>"afternoon",
															"pending_duty_date"=>date("Y/m/d"));
															
													$query = $this->main_model->insert_data("pending_duty",$data);
												}
												
											}
										}
										else
										{
											if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
											{
												$data = array("pending_duty_task"=>$task,
														"pending_duty_subtask"=>"Do not have any subtask currently",
														"pending_duty_cleaner"=>$schedule_result[$day],
														"pending_duty_schedule"=>"afternoon",
														"pending_duty_date"=>date("Y/m/d"));
														
												$query = $this->main_model->insert_data("pending_duty",$data);
											}
										}
										
									}
								}
								
								if($afternoon_schedule_results_count == 0 && $afternoon_schedule_results_count == 0)
								{
									$data = array("complete_duty_task"=>"This day don't have any duty",
											"complete_duty_date"=>date("Y/m/d"));
														
									$query = $this->main_model->insert_data("complete_duty",$data);
								}
								
								$new_remark = array("remark" => "active");
								$query = $this->main_model->update_data("remark","repair",$new_remark,"morning_schedule");
								$query = $this->main_model->update_data("remark","repair",$new_remark,"afternoon_schedule");							
							}
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
			$get_afternoon_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"afternoon_schedule");
			$afternoon_schedules = $get_afternoon_schedule_query->result_array();
							
			$task = array();
			$monday = array();
			$tuesday = array();
			$wednesday = array();
			$thursday = array();
			$friday = array();
			$saturday = array();
			$sunday = array();
					
			foreach($afternoon_schedules as $afternoon_schedule)
			{
				array_push($task,$afternoon_schedule['task']);
				array_push($monday,$afternoon_schedule['monday']);
				array_push($tuesday,$afternoon_schedule['tuesday']);
				array_push($wednesday,$afternoon_schedule['wednesday']);
				array_push($thursday,$afternoon_schedule['thursday']);
				array_push($friday,$afternoon_schedule['friday']);
				array_push($saturday,$afternoon_schedule['saturday']);
				array_push($sunday,$afternoon_schedule['sunday']);
			}
					
			$scheduleObject->setScheduleData($task,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday);
				
			echo (json_encode($scheduleObject));
			
		}

	
		public function loadSpecialDutyData()
		{
			if(isset($_POST['user_id']))	
			{
				$this->load->model("main_model");
				
				$user_id = array('user_id' => $_POST['user_id']);
				
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
						
				$specialDutyObject = new specialDutyObject();
				$specialDutyObject->setSpecialDutyData($special_duty_title,$special_duty_detail,$special_duty_time,$special_duty_date);
				
				echo (json_encode($specialDutyObject));
			}	
		}
		
		public function loadDailyDutyData()
		{
			if(isset($_POST['user_id']))	
			{
				$this->load->model("main_model");
				
				$user_id = array('user_id' => $_POST['user_id']);
				$query = $this->main_model->get_specify_data("user_name","user_name",$user_id,"users");
				$user_name = $query->row()->user_name;
				$query = $this->main_model->get_specify_data("user_id","user_id",$user_id,"users");
				$user_id = $query->row()->user_id;
				
				//Select pending duty from pending table
				if(date("G") < 13)
				{
					$time = "morning";
				}
				else
				{
					$time = "afternoon";
				}
				$cleaner = array("pending_duty_cleaner" => $user_id."_".$user_name , "pending_duty_date" => date("Y/m/d"), "pending_duty_schedule" => $time);
				$get_pending_query = $this->main_model->get_specify_data("*","pending_duty_task",$cleaner,"pending_duty");
				$pending_duties = $get_pending_query->result_array();
					
				$daily_duty_task = array();
				$daily_duty_subtask = array();
				$daily_duty_comment = array();
				$daily_duty_id = array();

						
				foreach($pending_duties as $pending_duty)
				{
					array_push($daily_duty_task,$pending_duty['pending_duty_task']);
					array_push($daily_duty_subtask,$pending_duty['pending_duty_subtask']);
					array_push($daily_duty_comment,$pending_duty['pending_duty_comment']);
					array_push($daily_duty_id,$pending_duty['pending_duty_id']);
				}
						
				$dailyDutyObject = new dailyDutyObject();
				$dailyDutyObject->setDailyDutyData($daily_duty_task,$daily_duty_subtask,$daily_duty_comment,$daily_duty_id);
				
				echo (json_encode($dailyDutyObject));
			}	
		}
		
		public function loadCompletedDutyData()
		{
			if(isset($_POST['user_id']))
			{
				$this->load->model("main_model");
				
				$user_id = array('user_id' => $_POST['user_id']);
				$query = $this->main_model->get_specify_data("user_name","user_name",$user_id,"users");
				$user_name = $query->row()->user_name;
				$query = $this->main_model->get_specify_data("user_id","user_id",$user_id,"users");
				$user_id = $query->row()->user_id;
				
				//Select pending duty from pending table
				if(date("G") < 13)
				{
					$time = "morning";
				}
				else
				{
					$time = "afternoon";
				}
				$cleaner = array("complete_duty_cleaner" => $user_id."_".$user_name , "complete_duty_date" => date("Y/m/d"));
				$get_complete_query = $this->main_model->get_specify_data("*","complete_duty_task",$cleaner,"complete_duty");
				$completed_duties = $get_complete_query->result_array();
					
				$completed_duty_task = array();
				$completed_duty_subtask = array();
				$completed_duty_comment = array();

						
				foreach($completed_duties as $completed_duty)
				{
					array_push($completed_duty_task,$completed_duty['complete_duty_task']);
					array_push($completed_duty_subtask,$completed_duty['complete_duty_subtask']);
					array_push($completed_duty_comment,$completed_duty['complete_duty_comment']);
				}
						
				$completedDutyObject = new completedDutyObject();
				$completedDutyObject->setCompletedDutyData($completed_duty_task,$completed_duty_subtask,$completed_duty_comment);
				
				echo (json_encode($completedDutyObject));
			}	
		}
		
		public function completeOwnDuty()
		{	
			if(isset($_POST['pending_duty_id']))	
			{
				$this->load->model("main_model");
							
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
				
				echo("true");
			}
			else		
			{
				echo("false");
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
	
	class specialDutyObject
	{
		function setSpecialDutyData($special_duty_title,$special_duty_detail,$special_duty_time,$special_duty_date)
		{
			$this->special_duty_title = $special_duty_title;
			$this->special_duty_detail = $special_duty_detail;
			$this->special_duty_time = $special_duty_time;
			$this->special_duty_date = $special_duty_date;
			
		}
	}

	class dailyDutyObject
	{
		function setDailyDutyData($daily_duty_task,$daily_duty_subtask,$daily_duty_comment,$daily_duty_id)
		{
			$this->daily_duty_task = $daily_duty_task;
			$this->daily_duty_subtask = $daily_duty_subtask;
			$this->daily_duty_comment = $daily_duty_comment;
			$this->daily_duty_id = $daily_duty_id;
			
		}
	}
	
	class completedDutyObject
	{
		function setCompletedDutyData($completed_duty_task,$completed_duty_subtask,$completed_duty_comment)
		{
			$this->completed_duty_task = $completed_duty_task;
			$this->completed_duty_subtask = $completed_duty_subtask;
			$this->completed_duty_comment = $completed_duty_comment;
			
		}
	}

?>
	
	
	
	
	
	
	
	
	
	
	
	
	