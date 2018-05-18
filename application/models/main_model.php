<?php
	class main_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		
		public function get_data($selectField,$table)
		{	
			$this->db->select($selectField);
			$query = $this->db->get($table);
			
			return $query;
		}
		
		public function get_data_order($selectField,$oderField,$table)
		{
			$this->db->select($selectField);
			$this->db->order_by($oderField, "asc");
			$query = $this->db->get($table);
			
			return $query;
		}
		
		public function get_limit_date($selectField,$oderField,$limit_number,$table)
		{
			$this->db->select($selectField);
			$this->db->order_by($oderField);
			$this->db->limit(5);
			$query = $this->db->get($table);
			
			return $query;
		}
		

		public function get_specify_data($selectField,$oderField,$data,$table)
		{
			$this->db->select($selectField);
			$this->db->order_by($oderField, "asc");
			$query = $query = $this->db->get_where($table,$data);
			
			return $query;
		}
				
		public function get_specify_data2($selectField,$oderField,$data,$table)
		{
			$this->db->select($selectField);
			$this->db->order_by($oderField);
			$query = $query = $this->db->get_where($table,$data);
			
			return $query;
		}
		
		public function get_specify_data3($selectField,$oderField,$data,$dataField,$data2,$table)
		{
			$this->db->select($selectField);
			$this->db->order_by($oderField);
			$this->db->where($data);
			$this->db->where_in($dataField,$data2);
			$query = $query = $this->db->get($table);
			
			return $query;
		}
		
		public function insert_data($table,$data)
		{
			$data = $data;
		//	$data = array(
		//			'title' => 'My title',
		///			'name' => 'My Name',
		///			'date' => 'My date'
		//			);

			$query = $this->db->insert($table, $data);
			
			return $query;
		}
		
		public function delete_data($table,$data)
		{
			$query = $this->db->delete($table,$data);
			return $query;
		}
		
		public function delete_whole_table($table)
		{
			$query = $this->db->empty_table($table);
			return $query;
		}
		
		public function update_data($where_field,$where_data,$data,$table)
		{
			$this->db->where($where_field, $where_data);
			$this->db->update($table, $data);
		}
		
		public function update_data2($where_field,$data,$table)
		{
			$this->db->where($where_field);
			$this->db->update($table, $data);
		}
	}

?>