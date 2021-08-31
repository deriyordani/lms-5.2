<?php
Class Assessment_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_assessment';
	}

	function get_list($uc_classroom, $uc_content){
		$sql = " SELECT a.*, ea.score,ea.uc_assessment,ea.uc_student, COUNT(*)AS `attempted`,max(ea.score) as final_score
				FROM `lms_assessment` a
				LEFT JOIN lms_ass_attempt ea ON ea.uc_assessment = a.uc

				AND ea.uc_student = '".$this->session->userdata('log_uc_person')."'
				AND ea.is_done = '1'
				WHERE a.is_exist = '1' AND a.uc_classroom = '".$uc_classroom."' AND a.uc_content = '".$uc_content."' ";

				//echo $sql;

		return $this->exec_query($sql);
	}

	function get_diklat($uc) {
		$sql = " SELECT a.`uc_classroom`, c.`uc_diklat_class` 
					FROM `lms_assessment` a
					LEFT JOIN `lms_classroom` c
					ON c.`uc` = a.`uc_classroom`
					WHERE a.`uc` = '".$uc."'";

		return $this->exec_query($sql);
	}
}