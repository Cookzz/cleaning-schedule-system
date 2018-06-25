<?php
	class UserController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function addNewUser()
		{
			$this->load->model("main_model");
			
			if((isset($_POST['newUsername'])) && (isset($_POST['newUserIC'])) && (isset($_POST['newUserPosition'])) && (isset($_POST['IcOrPassport'])))
			{
				$newUsername = $_POST['newUsername'];
				$newUserIC = $_POST['newUserIC'];
				$newUserPosition = $_POST['newUserPosition'];
				$IcOrPassport = $_POST["IcOrPassport"];
				
				$inputErr = array();
				
				if($newUsername == NULL)
				{
					$inputErr[] = $newUsername;
				}
				elseif(ctype_space($newUsername))
				{
					$inputErr[] = $newUsername;
				}
				else if (!preg_match('/^[a-zA-Z\s]+$/', $newUsername))
				{
					$inputErr[] = $newUsername;
				}
				
				
				if($newUserIC == NULL)
				{
					$inputErr[] = $newUserIC;
				}
				elseif(ctype_space($newUserIC))
				{
					$inputErr[] = $newUserIC;
				}
				elseif($IcOrPassport == 1)
				{	
					if(strlen($newUserIC) < 14 || strlen($newUserIC) >14)
					{
						$inputErr[] = $newUserIC;
					}
					elseif(!preg_match("/^\d{6}\-\d{2}\-\d{4}$/", $newUserIC))
					{
						$inputErr[] = $newUserIC;
					}
					else
					{
						$data = array('user_IC' => $newUserIC);
						$query = $this->main_model->get_specify_data("*","id",$data,"users");
						$row_count = $query->num_rows();
						
						if($row_count >=1)
						{
							$inputErr[] = $newUserIC;
						}
					}
				}
				elseif($IcOrPassport == 2)
				{	
					$data = array('user_IC' => $newUserIC);
					$query = $this->main_model->get_specify_data("*","id",$data,"users");
					$row_count = $query->num_rows();
						
					if($row_count >=1)
					{
						$inputErr[] = $newUserIC;
					}
				}				
				
				if(empty($inputErr))
				{
					do{
						$rand_num = rand(16000000,16999999);
						$data = array('user_id' => $rand_num);
						$query = $this->main_model->get_specify_data("*","id",$data,"users");
						$row_count = $query->num_rows();
					}while($row_count>=1);
					
					$position_name = array('position_name' => $newUserPosition);
								
					$query = $this->main_model->get_specify_data("position_access_level","id",$position_name,"position");
					$result = $query->row();
					$access_level = $result->position_access_level;
					
					$data = array("user_id"=>$rand_num,
								"user_name"=>trim($newUsername),
								"user_password"=>$rand_num,
								"user_IC"=>trim($newUserIC),
								"user_email"=>"fff".$rand_num."@gmail.com",
								"user_position"=>$newUserPosition,
								"user_access_level"=> $access_level,
								"user_picture"=> "loginIcon.png");
								
					$table = "users";
					$insert_query = $this->main_model->insert_data($table,$data);
					
					$get_query = $this->main_model->get_specify_data("*","id",$data,$table);
					$user_data = $get_query->result_array();
					
					$get_position_query = $this->main_model->get_data("*","position");			
					$position = $get_position_query->result_array();
					
					echo json_encode(array($user_data,$position));
				}
				
			}
			elseif(isset($_POST['newUserIC']))
			{
				$newUserIC = $_POST['newUserIC'];
				$IcOrPassport = $_POST["IcOrPassport"];
				
				if($newUserIC == NULL)
				{
					echo("Please Enter User IC/No or Passport");
				}
				elseif(ctype_space($newUserIC))
				{
					echo("Please Enter User IC/No or Passport");
				}
				elseif($IcOrPassport == 1)
				{	
					if(strlen($newUserIC) < 14 || strlen($newUserIC) >14)
					{
						echo("Invalid User IC/No Format");
					}
					elseif(!preg_match("/^\d{6}\-\d{2}\-\d{4}$/", $newUserIC))
					{
						echo("Invalid User IC/No Format");
					}
					else
					{
						$data = array('user_IC' => $newUserIC);
						$query = $this->main_model->get_specify_data("*","id",$data,"users");
						$row_count = $query->num_rows();
						
						if($row_count >=1)
						{
							echo("Duplicate User IC/No or Passport");
						}
					}
				}
				elseif($IcOrPassport == 2)
				{	
				
					$data = array('user_IC' => $newUserIC);
					$query = $this->main_model->get_specify_data("*","id",$data,"users");
					$row_count = $query->num_rows();
						
					if($row_count >=1)
					{
						echo("Duplicate User IC/No or Passport");
					}
					
				}
				
				
			}
			elseif(isset($_POST['newUsername']))
			{
				$newUsername = $_POST['newUsername'];
				
				if($newUsername == NULL)
				{
					echo("Please Enter the Username");
				}
				elseif(ctype_space($newUsername))
				{
					echo("Please Enter the Username");
				}
				else if (!preg_match('/^[a-zA-Z\s]+$/', $newUsername))
				{
					echo("Invalid the Username");
				}
				
			}	
		}
		public function deleteUserData()
		{
			$this->load->model("main_model");
			if((isset($_POST['id']))) 
			{		
				$id = $_POST['id'];
				$data = array("id" => $id);
				$query = $this->main_model->delete_data("users",$data);
					
				echo (true);
			}	
		}
		
		public function updateUserData()
		{
			$this->load->model("main_model");
			if(isset($_POST['user_data_string']))
			{
				$user_data = json_decode($_POST["user_data_string"], false);
				
				$user_id = array('user_id' => $user_data->user_id , 'id !=' => $user_data->id);
				$check_user_id_query = $this->main_model->get_specify_data("*","id",$user_id,"users");
				$check_user_id_row = $check_user_id_query->num_rows();
				
				$user_IC = array('user_IC' => $user_data->user_IC , 'id !=' => $user_data->id);
				$check_user_IC_query = $this->main_model->get_specify_data("*","id",$user_IC,"users");
				$check_user_IC_row = $check_user_IC_query->num_rows();
				
				$user_email = array('user_email' => $user_data->user_email , 'id !=' => $user_data->id);
				$check_user_email_query = $this->main_model->get_specify_data("*","id",$user_email,"users");
				$check_user_email_row = $check_user_email_query->num_rows();
				
				
				$data = array('id' => $user_data->id);
				$query = $this->main_model->get_specify_data("*","id",$data,"users");
				$result = $query->result_array();
				
				if($check_user_id_row >= 1)
				{
					echo json_encode($result);
				}
				elseif($check_user_IC_row >= 1)
				{
					echo json_encode($result);
				}
				elseif($check_user_email_row >= 1)
				{
					echo json_encode($result);
				}
				else
				{
					//check new User ID format
					if(!(strlen($user_data->user_id) == 8))
					{
						echo json_encode($result);
					}
					elseif(!preg_match('/^([0-9]+)$/', $user_data->user_id))
					{
						echo json_encode($result);
					}
					elseif($user_data->user_id == NULL)
					{
						echo json_encode($result);
					}
					elseif(ctype_space($user_data->user_id))
					{
						echo json_encode($result);
					}
					//check new User Name format
					elseif($user_data->user_name == NULL)
					{
						echo json_encode($result);
					}
					elseif(ctype_space($user_data->user_name))
					{
						echo json_encode($result);
					}
					elseif(!preg_match('/^[a-zA-Z\s]+$/', $user_data->user_name))
					{
						echo json_encode($result);
					}
					//check new User IC format
					elseif($user_data->user_IC == NULL)
					{
						echo json_encode($result);
					}
					elseif(ctype_space($user_data->user_IC))
					{
						echo json_encode($result);
					}
					//check new User Email format
					elseif(!filter_var($user_data->user_email, FILTER_VALIDATE_EMAIL))
					{
						echo json_encode($result);
					}
					elseif($user_data->user_email == NULL)
					{
						echo json_encode($result);
					}
					elseif(ctype_space($user_data->user_email))
					{
						echo json_encode($result);
					}
					// check new User Password format
					elseif($user_data->user_password == NULL)
					{
						echo json_encode($result);
					}
					elseif(ctype_space($user_data->user_password))
					{
						echo json_encode($result);
					}
					elseif(strlen($user_data->user_password) < 8)
					{
						echo json_encode($result);
					}
					else
					{
						$user_original_name = $result[0]["user_name"];
						$user_original_id = $result[0]["user_id"];
						
						$user_id_name = $user_original_id."_".$user_original_name;
						$new_user_data = $user_original_id."_".$user_data->user_name;
						
						//Update morning schedule and afternoon schedule monday to sunday cleaner data
						$cleaner = "monday='".$user_id_name."' OR tuesday='".$user_id_name."' OR 
									wednesday='".$user_id_name."' OR thursday='".$user_id_name."' 
									OR friday='".$user_id_name."' OR saturday='".$user_id_name."' 
									OR sunday='".$user_id_name."'";
						
						$new_cleaner_data = array('monday' => $new_user_data,
											'tuesday' => $new_user_data,
											'wednesday' => $new_user_data,
											'thursday' => $new_user_data,
											'friday' => $new_user_data,
											'saturday' => $new_user_data,
											'sunday' => $new_user_data);
						
						$query = $this->main_model->update_data2($cleaner,$new_cleaner_data,"morning_schedule");
						$query = $this->main_model->update_data2($cleaner,$new_cleaner_data,"afternoon_schedule");
						
						//Update pending duty and complete duty table cleaner data
						$pending_cleaner = "pending_duty_cleaner='".$user_id_name."'";						
						$new_cleaner_data = array('pending_duty_cleaner' => $new_user_data);						
						$query = $this->main_model->update_data2($pending_cleaner,$new_cleaner_data,"pending_duty");
						
						$complete_cleaner = "complete_duty_cleaner='".$user_id_name."'";						
						$new_cleaner_data = array('complete_duty_cleaner' => $new_user_data);						
						$query = $this->main_model->update_data2($complete_cleaner,$new_cleaner_data,"complete_duty");
						
						$special_duty_cleaner = "special_duty_cleaner='".$user_id_name."'";						
						$new_cleaner_data = array('special_duty_cleaner' => $new_user_data);						
						$query = $this->main_model->update_data2($special_duty_cleaner,$new_cleaner_data,"special_duty_cleaner");
						
						$schedule_Cleaner = "monday='".$user_id_name."' OR 
											tuesday='".$user_id_name."' OR
											wednesday='".$user_id_name."' OR
											thursday='".$user_id_name."' OR
											friday='".$user_id_name."' OR
											saturday='".$user_id_name."' OR
											sunday='".$user_id_name."'";	
											
						$new_cleaner_data = array('monday' => $new_user_data,
												'tuesday' => $new_user_data,
												'wednesday' => $new_user_data,
												'thursday' => $new_user_data,
												'friday' => $new_user_data,
												'saturday' => $new_user_data,
												'sunday' => $new_user_data);						
						$query = $this->main_model->update_data2($schedule_Cleaner,$new_cleaner_data,"morning_schedule");
						$query = $this->main_model->update_data2($schedule_Cleaner,$new_cleaner_data,"afternoon_schedule");
						//Update user table data
						$position_name = array('position_name' => $user_data->user_position);
									
						$query = $this->main_model->get_specify_data("position_access_level","id",$position_name,"position");
						$access_level_result = $query->row();
						$access_level = $access_level_result->position_access_level;
					
						$data = array(
							'user_id' => $user_data->user_id,
							'user_name' => $user_data->user_name,
							'user_password' => $user_data->user_password,
							'user_IC' => $user_data->user_IC,
							'user_email' => $user_data->user_email,
							'user_position' => $user_data->user_position,
							'user_access_level' => $access_level,
							'join_date' => $user_data->join_date
						);
				
						$update_query = $this->main_model->update_data("id",$user_data->id,$data,"users");
					
						echo json_encode(array("Update Success",$access_level));
					}
				}
			}	
			else
			{
				echo("Update Incomplete");
			}
		}
	}
?>