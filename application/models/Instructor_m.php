<?php
Class Instructor_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_instructor';
	}

	function get_id_number($id_number = NULL){
		$sql = " SELECT * FROM `lms_instructor` WHERE id_number = TRIM('".$id_number."') ";

		return $this->exec_query($sql);
	}	
}