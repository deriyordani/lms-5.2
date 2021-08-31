<?php
Class Instructor_temp_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_instructor_temp';
	}

	function temp_not_in_real() {
		$sql = "SELECT * FROM `lms_instructor_temp` WHERE `id_number`
					NOT IN 
					(
					SELECT `id_number` FROM `lms_instructor`
					)";

		return $this->exec_query($sql);			
	}
}
?>	