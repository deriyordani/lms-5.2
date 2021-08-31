<?php
class MY_Model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function insert_data($data){		
		$this->db->insert($this->table_name, $data);			
	}
	
	function insert_multi_value($field, $value){
		$sql  = "INSERT INTO ".$this->table_name." ".$field." VALUE ".$value."";
		
		$this->exec_query($sql);
	}

	// function insert_multi_value_other_db($db_name, $table_name, $field, $value){
	// 	$sql  = "INSERT INTO `".$db_name."`.`".$table_name."` ".$field." VALUES ".$value."; ";
		
	// 	$this->exec_query($sql);
	// }
	
	function update_data($data=NULL, $filter=NULL){
		$this->db->update($this->table_name, $data, $filter);
	}
	
	function delete_data($filter){
		$this->db->delete($this->table_name, $filter);
	}
	
	function get_all($order_by = "id", $ordered = "DESC", $limit = NULL, $offset = NULL){
		if($limit == NULL){
			$this->db->order_by($order_by, $ordered);
			return $this->db->get($this->table_name);	
		}
		else{
			if($offset == NULL){
				$offset = 0;
			}
			$this->db->order_by($order_by, $ordered);
			return $this->db->get($this->table_name, $limit, $offset);
		}		
	}
	
	function get_filtered($filter, $order_by="id", $ordered="DESC", $limit=NULL, $offset=NULL){
		if($limit == NULL){
			$this->db->order_by($order_by, $ordered); 
			return $this->db->get_where($this->table_name, $filter);	
		}
		else{
			if($offset == NULL){
				$offset = 0;
			}
			$this->db->where($filter);
			$this->db->order_by($order_by, $ordered);
			return $this->db->get_where($this->table_name, $filter, $limit, $offset);
		}
	}
	
	function exec_query($query){
		return $this->db->query($query);
	}
	
	function get_last_record(){
		return $this->get_all("id", "DESC", 1, 0);
	}
	
	function get_last_id(){
		$query = $this->get_all("id", "DESC", 1, 0);
		
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->id;
		}
		else{
			return 0;
		}		
	}

	function get_in($field, $value){
		$sql  = " SELECT * FROM ".$this->table_name." ";
		$sql .= " WHERE `".$field."` IN (".$value.") ";
		
		return $this->exec_query($sql);
	}

	function delete_in($field, $value){
		$sql  = " DELETE FROM ".$this->table_name." ";
		$sql .= " WHERE `".$field."` IN (".$value.") ";
		
		return $this->exec_query($sql);	
	}
}