<?php
Class Instructor_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_instructor';
	}

	function get_list_detail($filter = NULL, $limit = NULL, $offset = NULL) {

		$sql = "  SELECT i.* ";

		if (!$filter['count']) {
 			$sql .= ",p.`prodi`, u.username";
 		}

 		$sql .= " FROM `lms_instructor` i";

		if (!$filter['count']) {
			$sql .= " 
		    			LEFT JOIN `lms_prodi` p ON p.`uc` = i.`uc_prodi`
		    			LEFT JOIN lms_user u ON u.uc_person = i.uc
	    			";
	    }

	    $where = FALSE;

	    if (@$filter['uc_prodi'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " i.uc_prodi = '".$filter['uc_prodi']."' ";
		}

		if (@$filter['search'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " i.full_name LIKE '%".$filter['search']."%' OR i.id_number LIKE '%".$filter['search']."%'";
		}


	

		$sql .= " ORDER BY i.`full_name` ASC ";


		if($limit != NULL){
			$sql .= " LIMIT ".$offset.",".$limit." ";
		}	
		
		return $this->exec_query($sql);
	}

	function get_id_number($id_number = NULL){
		$sql = " SELECT * FROM `lms_instructor` WHERE id_number = TRIM('".$id_number."') ";

		return $this->exec_query($sql);
	}

	function get_login_ins($uc_user = NULL){
		$sql = "

			SELECT i.*, p.prodi
			FROM `".$this->table_name."` i
			LEFT JOIN lms_prodi p ON i.uc_prodi = p.uc
			LEFT JOIN lms_user u ON u.uc_person = i.uc

			WHERE u.uc = '".$uc_user."';
		";

		return $this->exec_query($sql);
	}	

	function get_available($id_number = NULL){
		$sql = " SELECT i.*, u.`uc` AS `uc_user` 
					FROM `lms_instructor` i
					LEFT JOIN `lms_user` u
					ON u.`uc_person` = i.`uc`
					WHERE i.`id_number` = TRIM('".$id_number."') ";
		//echo $sql;
		return $this->exec_query($sql);
	}
}