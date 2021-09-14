<?php
Class Diklat_participant_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_diklat_participant';
	}

	function get_list($filter = NULL,$limit = NULL, $offset = 0){


		$sql = "  SELECT dp.* ";

 		if (!$filter['count']) {
 			$sql .= ", dpe.tahun, dpe.periode_mulai, dpe.periode_selesai, p.prodi, d.diklat, d.category as cat_diklat, ddkp.label_dkp, dc.class_label, s.full_name, s.uc as uc_student 
					 ";
 		}

 		$sql .= "FROM `lms_diklat_participant` dp";

		if (!$filter['count']) {
			$sql .= " 
		    			LEFT JOIN `lms_diklat_period` dpe ON dp.uc_diklat_period = dpe.uc
						LEFT JOIN `lms_student` s ON s.no_peserta = dp.no_peserta
						LEFT JOIN `lms_prodi` p ON dpe.uc_prodi = p.uc
						LEFT JOIN `lms_diklat` d ON dpe.uc_diklat = d.uc
						LEFT JOIN `lms_diklat_dkp` ddkp ON dpe.uc_diklat_dkp = ddkp.uc
						LEFT JOIN `lms_diklat_class` dc ON dp.uc_diklat_class = dc.uc
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

			$sql .= " dpe.uc_prodi = '".$filter['uc_prodi']."' ";
		}


		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}



		return $this->exec_query($sql);

	}


	function get_student_by_diklat($uc_diklat_class = NULL, $uc_forum = NULL){
		// $sql = " SELECT dp.*, s.full_name, s.uc as uc_student
		// 	FROM `lms_diklat_participant`  dp
		// 	LEFT JOIN lms_student s ON dp.no_peserta = s.no_peserta
		// 	WHERE dp.uc_diklat_class = '".$uc_diklat_class."' AND dp.is_claim = '1' ";
		// $sql = " SELECT dp.*, s.full_name, s.uc as uc_student
		// 		FROM `lms_diklat_participant`  dp
		// 		LEFT JOIN lms_student s ON dp.no_peserta = s.no_peserta
		// 		WHERE dp.uc NOT IN (SELECT uc_diklat_participant FROM lms_fgroup_participant)
		// 		AND dp.uc_diklat_class = '".$uc_diklat_class."' AND dp.is_claim = '1' ";


		$sql = " SELECT dp.*, s.full_name, s.uc as uc_student
				FROM `lms_diklat_participant`  dp
				LEFT JOIN lms_student s ON dp.no_peserta = s.no_peserta
				WHERE dp.uc NOT IN (
                     
                    SELECT uc_diklat_participant fp
                    FROM lms_fgroup_participant  fp
                    WHERE fp.uc_forum = '".$uc_forum."'
                )
                
				AND dp.uc_diklat_class = '".$uc_diklat_class."' AND dp.is_claim = '1' ";
		//echo $sql;
		return $this->exec_query($sql);
	}

	function get_participant_by_forum($uc_diklat_participant = NULL){
		$sql = " SELECT dp.*, s.uc as uc_student
				FROM `lms_diklat_participant` dp
				LEFT JOIN lms_student s ON dp.no_peserta = s.no_peserta
				WHERE is_claim = '1' AND dp.uc IN (".$uc_diklat_participant.") ";

		return $this->exec_query($sql);
	}

	
}