<?php
Class Subject_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_subject';
	}

	function get_list($filter = NULL,$limit = NULL, $offset = 0){
		
		$sql = " SELECT s.*";

 		if (!$filter['count']) {
 			$sql .= ", d.diklat, d.category as cat_diklat, p.prodi, dkp.label_dkp  ";
 		}

 		$sql .= "FROM `lms_subject` s";

		if (!$filter['count']) {
			$sql .= " 
		    			LEFT JOIN `lms_diklat` d ON s.uc_diklat = d.uc
						LEFT JOIN `lms_prodi` p ON s.uc_prodi = p.uc
						LEFT JOIN `lms_diklat_dkp` dkp ON s.uc_diklat_dkp = dkp.uc
	    			";
	    }

	    $where = FALSE;

	    if (@$filter['uc'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " s.uc = '".$filter['uc']."' ";
		}	

		if (@$filter['uc_diklat'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " s.uc_diklat = '".$filter['uc_diklat']."' ";
		}

		if (@$filter['uc_prodi'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " s.uc_prodi = '".$filter['uc_prodi']."' ";
		}

		if (@$filter['uc_diklat_dkp'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " s.uc_diklat_dkp IS NOT NULL ";
		}

		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}

		//echo $sql;

		return $this->exec_query($sql);

	}

	function get_subject_classroom($filter) {
		$sql = " SELECT s.*, c.`uc`AS `uc_classroom`, c.`uc_diklat_class`, c.`classroom_title`, i.`full_name` 
					FROM `lms_subject` s 
					LEFT JOIN `lms_classroom` c
					ON c.`uc_subject` = s.`uc`
					AND c.`uc_diklat_class` = '".$filter['uc_diklat_class']."'
					LEFT JOIN `lms_instructor` i 
					ON i.`uc` = c.`uc_instructor`
					WHERE s.`uc_diklat` = '".$filter['uc_diklat']."'
					AND s.`uc_prodi` = '".$filter['uc_prodi']."' ";

		//echo $sql;
		return $this->exec_query($sql);			
	}
}