<?php
	class LoginController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function viewLoginForm($page = 'login')
		{
			if(!file_exists(APPPATH.'views/login/'.$page.'.php'))
			{
				show_404();
			}
			
			$data['title'] = 'Login Form';
			
			$this->load->view('login/'.$page,$data);
		}
		
		public function viewLoginValidation()
		{
			$this->load->model("main_model");
			
			if((isset($_POST['user_id']))&&(isset($_POST['passwords'])))
			{	
				$user_id = $_POST["user_id"];
				$password = $_POST["passwords"];
				
				$inputErr = array();
				//vaidate username
				if($user_id == NULL)
				{
					$inputErr[] = $user_id;
				}
				else
				{
					$data = array('user_id' => $user_id);
					$query = $this->main_model->get_specify_data('*',"user_id",$data,"users");
					$result = $query->num_rows();
					
					if($result<=0)
					{
						$inputErr[] = $user_id;
					}
					else
					{
						//validate password
						if($password == NULL)
						{
							$inputErr[] = $password;
						}
						else
						{
							$data = array('user_id' => $user_id);
							$query = $this->main_model->get_specify_data("user_password","user_password",$data,"users");
							$result = $query->row()->user_password;
							if($result === $password)
							{
								
							}
							else
							{
								$inputErr[] = $password;
							}
						}
					}
				}	
		
				if(empty($inputErr))
				{	
					$this->load->library('session');
					
					$data = array('user_id' => $user_id);
					$query = $this->main_model->get_specify_data("id","id",$data,"users");
					$uid = $query->row()->id;	
					
					$query = $this->main_model->get_specify_data("user_access_level","user_access_level",$data,"users");
					$user_access_level = $query->row()->user_access_level;
					
					$_SESSION['user_access_level'] = $user_access_level;
					$_SESSION['uid'] = $uid;
					
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
						$week_number = array("week_number" => $week);
						
						//Select morning schedule and insert to pending order
						$query = $this->main_model->get_specify_data("*","stuff",$week_number,"morning_schedule");
						$schedule_results = $query->result_array();
						
						foreach($schedule_results as $schedule_result)
						{
							$stuff = $schedule_result["stuff"];
							
							$data = array("duty_stuff"=>$stuff);
							$query = $this->main_model->get_specify_data("*","duty_stuff",$data,"duty");
							$duty_results = $query->result_array();
							$duty_number = $query->num_rows();
							if($duty_number != 0)
							{
								foreach($duty_results as $duty_result)
								{
									if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
									{
										$duty_sub_stuff = $duty_result['duty_sub_stuff'];
									
										$data = array("pending_duty_stuff"=>$stuff,
												"pending_duty_substuff"=>$duty_sub_stuff,
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
									$data = array("pending_duty_stuff"=>$stuff,
											"pending_duty_substuff"=>"No any substuff",
											"pending_duty_cleaner"=>$schedule_result[$day],
											"pending_duty_schedule"=>"morning",
											"pending_duty_date"=>date("Y/m/d"));
											
									$query = $this->main_model->insert_data("pending_duty",$data);
								}
							}
							
						}
						
						//Select afternoon schedule and insert to pending order
						$query = $this->main_model->get_specify_data("*","stuff",$week_number,"afternoon_schedule");
						$schedule_results = $query->result_array();
						
						foreach($schedule_results as $schedule_result)
						{
							$stuff = $schedule_result["stuff"];
							
							$data = array("duty_stuff"=>$stuff);
							$query = $this->main_model->get_specify_data("*","duty_stuff",$data,"duty");
							$duty_results = $query->result_array();
							$duty_number = $query->num_rows();
							if($duty_number != 0)
							{
								foreach($duty_results as $duty_result)
								{
									if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
									{
										$duty_sub_stuff = $duty_result['duty_sub_stuff'];
									
										$data = array("pending_duty_stuff"=>$stuff,
												"pending_duty_substuff"=>$duty_sub_stuff,
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
									$data = array("pending_duty_stuff"=>$stuff,
											"pending_duty_substuff"=>"No any substuff",
											"pending_duty_cleaner"=>$schedule_result[$day],
											"pending_duty_schedule"=>"afternoon",
											"pending_duty_date"=>date("Y/m/d"));
											
									$query = $this->main_model->insert_data("pending_duty",$data);
								}
							}
							
						}
						
					}
					
					if($_SESSION['user_access_level'] ==1)
					{
						echo("adminHomeController/viewMainPage");
					}
					elseif($_SESSION['user_access_level'] ==2)
					{
						echo("HomeController/viewMainPage");
					}
					elseif($_SESSION['user_access_level'] ==3)
					{
						echo("HomeController/viewMainPage");
					}
					
				}
				else
				{
					echo(false);
					
				}
			}
		}
		
		public function viewLogout($page = 'homepage')
		{
			$this->load->library('session');
			unset($_SESSION['uid']);
			unset($_SESSION['user_access_level']);
			redirect("HomeController/viewHomePage");
		}
		
	}