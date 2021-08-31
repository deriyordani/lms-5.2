<?php
Class Schedule_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_schedule';
	}

	function get_list($uc = NULL, $uc_prodi = NULL) {
		$sql = "
				SELECT s.*, dc.`class_label` 
					, dp.`label_periode`, dp.`tahun`, dp.`periode_mulai`, dp.`periode_selesai`
					, p.`uc` AS `uc_prodi`, p.`prodi`
					, d.`uc` AS `uc_diklat`, d.`diklat`, d.`category`

					FROM `lms_schedule` s

					LEFT JOIN `lms_diklat_class` dc
					ON dc.`uc` = s.`uc_diklat_class`
					LEFT JOIN `lms_diklat_period` dp
					ON dp.`uc` = dc.`uc_diklat_period`
					LEFT JOIN `lms_prodi` p
					ON p.`uc` = dp.`uc_prodi`
					LEFT JOIN `lms_diklat` d
					ON d.`uc` = dp.`uc_diklat`
				";

		$where = FALSE;
		if ($uc != NULL) {
			$sql .= " WHERE s.`uc` = '".$uc."' ";

			$where = TRUE;
		}

		if ($uc_prodi != NULL) {
			if (!$where) {
				$sql .= " WHERE p.`uc` = '".$uc_prodi."' ";
			}
			else {
				$sql .= " AND p.`uc` = '".$uc_prodi."' ";
			}
		}

		return $this->exec_query($sql);		
	}
}