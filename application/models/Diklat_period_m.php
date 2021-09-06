<?php
Class Diklat_period_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_diklat_period';
	}

	function get_list($filter = NULL,$limit = NULL, $offset = 0){
		
		$sql = " SELECT dp.*";

 		if (!$filter['count']) {
 			$sql .= ",p.`prodi`, d.`diklat`, d.`category`, ddkp.label_dkp  ";
 		}

 		$sql .= "FROM `lms_diklat_period` dp";

		if (!$filter['count']) {
			$sql .= " 
		    			LEFT JOIN `lms_prodi` p ON dp.`uc_prodi` = p.`uc`
						LEFT JOIN `lms_diklat` d ON dp.`uc_diklat` = d.`uc`
						LEFT JOIN `lms_diklat_dkp` ddkp ON dp.uc_diklat_dkp = ddkp.uc
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

			$sql .= " dp.uc = '".$filter['uc']."' ";
		}	

		if (@$filter['uc_prodi'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " dp.uc_prodi = '".$filter['uc_prodi']."' ";
		}

		if (@$filter['uc_diklat_dkp'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " dp.uc_diklat_dkp = '".$filter['uc_diklat_dkp']."' ";
		}

		if (@$filter['uc_diklat'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " dp.uc_diklat = '".$filter['uc_diklat']."' ";
		}

		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}

		return $this->exec_query($sql);
	}

	function get_combo_periode_diklat($filter = NULL){
		$sql = " SELECT dp.*,p.`prodi`, d.`diklat`, d.`category`, ddkp.label_dkp
				FROM `lms_diklat_period` dp
				LEFT JOIN `lms_prodi` p ON dp.`uc_prodi` = p.`uc`
				LEFT JOIN `lms_diklat` d ON dp.`uc_diklat` = d.`uc`
				LEFT JOIN `lms_diklat_dkp` ddkp ON dp.uc_diklat_dkp = ddkp.uc 

				
				";

			$where = FALSE;

		if (@$filter['uc_prodi'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " dp.uc_prodi = '".$filter['uc_prodi']."' ";
		}

		if (@$filter['uc_diklat'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " dp.uc_diklat = '".$filter['uc_diklat']."' ";
		}

		if (@$filter['uc_dkp'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}
			$sql .= " dp.uc_diklat_dkp = '".$filter['uc_dkp']."' ";
		}

				//echo $sql;

		return $this->exec_query($sql);
	}
}