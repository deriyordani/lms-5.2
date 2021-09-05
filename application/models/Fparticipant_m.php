<?php
Class Fparticipant_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_fgroup_participant';
	}

	function get_group($uc_group = NULL){
		$sql = " SELECT p.*, gp.group_name, u.photo, s.full_name

				FROM `".$this->table_name."` p
				LEFT JOIN lms_fgroup gp ON gp.uc = p.uc_fgroup
				LEFT JOIN lms_student s ON p.uc_student = s.uc
				LEFT JOIN lms_user u ON s.uc = u.uc_person

				WHERE gp.uc = '".$uc_group."';

		 ";

		 //echo $sql;

		return $this->exec_query($sql);
	}

	function get_checkedlist($uc_group = NULL, $uc_diklat_class = NULL){
		$sql =  " SELECT r . * , p.`uc_diklat_participant`, s.no_peserta, s.full_name
				FROM `lms_diklat_participant` r 
				LEFT JOIN `lms_fgroup_participant` p  ON p.`uc_diklat_participant` = r.`uc` 
				AND p.`uc_fgroup` = '".$uc_group."'

				LEFT JOIN `lms_student` s ON r.no_peserta = s.no_peserta
				WHERE r.uc NOT IN (SELECT uc_diklat_participant FROM lms_fgroup_participant)
				AND r.`uc_diklat_class` = '".$uc_diklat_class."'
				AND r.is_claim = '1' ";

		return $this->exec_query($sql);	
	}

	// function get_checked_list($filter = NULL, $pick_field = NULL, $reference_table = NULL, $uc_diklat_class){
	// 	$sql  = "SELECT r . * , p.`".$pick_field."` ";
	// 	$sql .= " FROM `".$reference_table."` r ";
	// 	$sql .= " LEFT JOIN `".$this->table_name."` p ";
	// 	$sql .= " ON p.`".$pick_field."` = r.`uc` ";
		

	// 	if ($filter != NULL) {
	// 		$i = 0;
	// 		foreach ($filter as $key => $fil) {
	// 			$sql .= " AND p.`".$key."` = '".$fil."' ";

	// 			$i++;
	// 		}	
	// 	}

	// 	$sql .= " where r.uc_diklat_class = '605bf11c1e78f' ";

	// 	echo $sql;
		
	// 	return $this->exec_query($sql);	
	// }
}