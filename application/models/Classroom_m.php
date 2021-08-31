<?php
Class Classroom_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_classroom';
	}

	function get_list($filter = NULL,$limit = NULL, $offset = 0){


		$sql = "  SELECT cl.* ";

 		if (!$filter['count']) {
 			$sql .= ", dc.class_label, s.subject_code, s.subject_title, dpe.tahun, dpe.periode_mulai, dpe.periode_selesai,
					d.diklat, d.category as cat_diklat, p.prodi, dpk.label_dkp, i.full_name
					 ";
 		}

 		$sql .= "FROM `lms_classroom` cl";

		if (!$filter['count']) {
			$sql .= " 
		    			LEFT JOIN lms_diklat_class dc ON cl.uc_diklat_class = dc.uc
						LEFT JOIN lms_diklat_period dpe ON dc.uc_diklat_period = dpe.uc
						LEFT JOIN lms_diklat d ON dpe.uc_diklat = d.uc
						LEFT JOIN lms_prodi p ON dpe.uc_prodi = p.uc
						LEFT JOIN lms_diklat_dkp dpk ON dpe.uc_diklat_dkp = dpk.uc
						LEFT JOIN lms_subject s ON cl.uc_subject = s.uc
						LEFT JOIN lms_instructor i ON cl.uc_instructor = i.uc
	    			";
	    }

	    $where = FALSE;

	    if (@$filter['is_exit'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " cl.is_exit = '".$filter['is_exit']."' ";
		}
		
	    if (@$filter['uc'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " cl.uc = '".$filter['uc']."' ";
		}


		if (@$filter['uc_diklat_class'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " cl.uc_diklat_class = '".$filter['uc_diklat_class']."' ";
		}



		if (@$filter['uc_instructor'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " cl.uc_instructor = '".$filter['uc_instructor']."' ";
		}


		if (@$filter['uc_prodi'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " dpe.uc_prodi = '".$filter['uc_prodi']."' ";
		}


		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}

		//echo $sql;

		return $this->exec_query($sql);	


	}
}