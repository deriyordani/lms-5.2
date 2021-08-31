<?php
Class Student_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_student';
	}

	function get_id_number($id_number = NULL){
		$sql = " SELECT * FROM `lms_student` WHERE no_peserta = TRIM('".$id_number."') ";

		return $this->exec_query($sql);
	}	

	function get_info_student($uc = NULL){
		$sql = " SELECT s.*, dp.is_claim, dc.class_label, dpe.tahun, dpe.periode_mulai, dpe.periode_selesai,
				p.prodi,dk.diklat, dk.category, dkp.label_dkp
				FROM `lms_student` s
				LEFT JOIN lms_diklat_participant dp ON s.no_peserta = dp.no_peserta
				LEFT JOIN lms_diklat_class dc ON dp.uc_diklat_class = dc.uc
				LEFT JOIN lms_diklat_period dpe ON dp.uc_diklat_period = dpe.uc
				LEFT JOIN lms_prodi p ON dpe.uc_prodi = p.uc
				LEFT JOIN lms_diklat dk ON dpe.uc_diklat = dk.uc
				LEFT JOIN lms_diklat_dkp dkp ON dpe.uc_diklat_dkp = dkp.uc WHERE s.uc = '".$uc."' ";

		return $this->exec_query($sql);
	}

	function get_participant_by_diklat_class($uc_diklat_class = NULL,$limit = NULL, $offset = 0){
		$sql = " SELECT s.*, u.last_login
				FROM `lms_student` s 
				LEFT JOIN lms_diklat_participant dp ON dp.no_peserta = s.no_peserta
				LEFT JOIN lms_diklat_class dc ON dp.uc_diklat_class = dc.uc
				LEFT JOIN lms_user u ON u.uc_person = s.uc
				WHERE dp.uc_diklat_class = '".$uc_diklat_class."' ";


		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}

		//echo $sql;

		return $this->exec_query($sql);	
	}


	function get_student_in_diklat_class($classroom){
        $query = $this->db->query("SELECT a.no_peserta, a.full_name, b.uc FROM `lms_student` a
                                JOIN
                                (SELECT `lms_diklat_participant`.`uc`,`lms_diklat_participant`.`no_peserta` 
                                FROM `lms_diklat_participant` 
                                LEFT JOIN `lms_classroom` 
                                ON `lms_diklat_participant`.`uc_diklat_class` = `lms_classroom`.`uc_diklat_class` 
                                WHERE `lms_classroom`.`uc` = '".$classroom."' AND `lms_diklat_participant`.`is_claim` = 1) b
                                ON a.no_peserta = b.no_peserta"
        );
        return $query->result();
    }
}