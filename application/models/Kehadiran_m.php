<?php
Class Kehadiran_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_kehadiran';
	}

	function get_date($date = NULL, $uc_student = NULL, $uc_classroom){
		$sql = " SELECT * FROM `lms_kehadiran` where DATE(date_time) = '".$date."' AND uc_diklat_participant = '".$uc_student."' AND uc_classroom = '".$uc_classroom."' ";

		return $this->exec_query($sql);
	}

	function get_data_ins($date = NULL, $uc_ins = NULL, $uc_classroom = NULL, $uc_section = NULL){
		$sql = " SELECT * FROM `lms_kehadiran` where DATE(date_time) = '".$date."' AND uc_instructor = '".$uc_ins."' AND uc_classroom = '".$uc_classroom."' AND uc_section = '".$uc_section."' ";

		return $this->exec_query($sql);
	}

	function get_data_stu($date = NULL, $uc_ins = NULL, $uc_classroom = NULL, $uc_section = NULL){
		$sql = " SELECT * FROM `lms_kehadiran` where DATE(date_time) = '".$date."' AND uc_diklat_participant = '".$uc_ins."' AND uc_classroom = '".$uc_classroom."' AND uc_section = '".$uc_section."' ";

		return $this->exec_query($sql);
	}

	function get_view($filter = NULL,$limit = NULL, $offset = 0 ){

		$sql = " SELECT s.*, k.uc as uc_kehadiran, k.status, k.date_time
				FROM `lms_student` s 
				LEFT JOIN lms_diklat_participant dp ON dp.no_peserta = s.no_peserta
				LEFT JOIN lms_kehadiran k ON k.uc_student = s.uc
				AND DATE(k.date_time) = '".$filter['current_date']."'
				WHERE dp.is_claim = '1' AND dp.uc_diklat_class = '".$filter['uc_diklat_class']."' ";

		//echo $sql;

		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}

		return $this->exec_query($sql);
	}

	function get_rekap(){
		$sql = " SELECT kh.*, se.section_label
				FROM `lms_kehadiran` kh
				 JOIN lms_classroom cl ON kh.uc_classroom = cl.uc
				 JOIN lms_section se ON kh.uc_section = se.uc

				WHERE  kh.uc_student IS NOT NULL AND kh.uc_classroom = '606bcfaae0454' ";

		return $this->exec_query($sql);
	}

	function get_presence_in_class($classroom){
        $query = $this->db->query("SELECT uc_section, uc_diklat_participant, status FROM lms_kehadiran WHERE uc_classroom = '".$classroom."'");
        return $query->result();
    }
}