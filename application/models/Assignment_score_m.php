<?php
Class Assignment_score_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_assignment_score';
	}

	function get_score($filter = NULL,$limit = NULL, $offset = 0){
		$sql = " SELECT ag.* ";

		if (!$filter['count']) {

			$sql .= " , s.no_peserta, s.full_name  ";
		}

		$sql .= " FROM `lms_assignment_score` ag ";


		if (!$filter['count']) {
			$sql .= " LEFT JOIN lms_student s ON ag.uc_participant = s.uc ";

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

			$sql .= " ag.uc = '".$filter['uc']."' ";
		}

		if (@$filter['uc_assignment'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			$sql .= " ag.uc_assignment = '".$filter['uc_assignment']."' ";
		}

		return $this->exec_query($sql);


	}
}