<?php
Class Subject_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_subject';
	}

	function get_list($filter = NULL,$limit = NULL, $offset = 0){
		
		$sql = " SELECT s.*";

 		if (!$filter['count']) {
 			$sql .= ", d.diklat, d.category as cat_diklat, p.prodi  ";
 		}

 		$sql .= "FROM `lms_subject` s";

		if (!$filter['count']) {
			$sql .= " 
		    			LEFT JOIN `lms_diklat` d ON s.uc_diklat = d.uc
						LEFT JOIN `lms_prodi` p ON s.uc_prodi = p.uc
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
}