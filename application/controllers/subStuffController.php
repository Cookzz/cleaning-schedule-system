<?php
	class subStuffController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function setNewSubStuff($page = 'stuff')
		{
			$this->load->model("main_model");

			
			if(isset($_POST['newSubStuff']))
			{
				$newSubStuff = $_POST['newSubStuff'];
				if($newSubStuff == NULL)
				{
					echo(false);
				}
				elseif(ctype_space($newSubStuff))
				{
					echo(false);
				}
				else
				{		
					$data = array('sub_stuff' => $newSubStuff);
					$get_query = $this->main_model->get_specify_data("sub_stuff","sub_stuff_id",$data,"sub_stuff");
					$result = $get_query->num_rows();
					
					if($result >= 1)
					{
						echo(false);
					}
					else
					{
						$data = array("sub_stuff"=>$newSubStuff);
						$table = "sub_stuff";
						$insert_query = $this->main_model->insert_data($table,$data);
						
						$get_query = $this->main_model->get_data_order("*","sub_stuff","sub_stuff");
						$sub_stuffs_data = $get_query->result_array();
						echo json_encode($sub_stuffs_data);
					}
					
				}
				
			}
				
		}
		
		public function deleteSubStuff()
		{
			if(isset($_POST['sub_stuff_id']))
			{
				$sub_stuff_id = $_POST['sub_stuff_id'];
				$this->load->model("main_model");
				$data = array("sub_stuff_id"=>$sub_stuff_id);
				
				$get_stuff_query = $this->main_model->get_specify_data("sub_stuff","sub_stuff_id",$data,"sub_stuff");
				$row = $get_stuff_query->row();
				$sub_stuff = $row->sub_stuff;
				
				$duty_data = array("duty_sub_stuff"=>$sub_stuff);
				$delete_duty_query = $this->main_model->delete_data("duty",$duty_data);
				$delete_query = $this->main_model->delete_data("sub_stuff",$data);
				
				$get_query = $this->main_model->get_data_order("*","sub_stuff","sub_stuff");
				$sub_stuff_data = $get_query->result_array();
				echo json_encode($sub_stuff_data);
			}
		}
		
		public function updateSubStuffData()
		{
			$this->load->model("main_model");
			if((isset($_POST['update_sub_stuff'])) && (isset($_POST['sub_stuff_id'])))
			{
				$update_sub_stuff = trim($_POST['update_sub_stuff']);
				$sub_stuff_id = ($_POST['sub_stuff_id']);
				$data = array('sub_stuff' => $update_sub_stuff);
				$query = $this->main_model->get_specify_data("sub_stuff","sub_stuff_id",$data,"sub_stuff");
				$check_sub_stuff_row = $query->num_rows();
				
				$data = array('sub_stuff_id' => $sub_stuff_id);
				$get_query = $this->main_model->get_specify_data("sub_stuff","sub_stuff_id",$data,"sub_stuff");
				$row = $get_query->row();
				$original_sub_stuff = $row->sub_stuff;
			
			//	print_r($update_stuff);
					
				if($check_sub_stuff_row >= 1)
				{
					echo($original_sub_stuff);
				}
				else
				{
					//check new User ID format
					if($update_sub_stuff == NULL)
					{
						echo($original_sub_stuff);
					}
					elseif(!preg_match('/^[a-zA-Z0-9\s]+$/', $update_sub_stuff))
					{
						echo($original_sub_stuff);
					}
					elseif(empty($update_sub_stuff))
					{
						echo($original_sub_stuff);
					}
					else
					{	
						$data = array('sub_stuff' => $update_sub_stuff);			
						$update_query = $this->main_model->update_data("sub_stuff_id",$sub_stuff_id,$data,"sub_stuff");
					
						$duty_data = array("duty_sub_stuff"=>$update_sub_stuff);
						$update_duty_query = $this->main_model->update_data("duty_sub_stuff",$original_sub_stuff,$duty_data,"duty");
						
						echo("Update Success");
					}
				}
			}	
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	