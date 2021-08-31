<?php
Class Schedule_week_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_sched_week';
	}

	// function get_list() {
	// 	$sql = "
	// 			SELECT s.*, dc.`class_label` 
	// 				, dp.`label_periode`, dp.`tahun`, dp.`periode_mulai`, dp.`periode_selesai`
	// 				, p.`prodi`
	// 				, d.`diklat`, d.`category`

	// 				FROM `lms_schedule` s

	// 				LEFT JOIN `lms_diklat_class` dc
	// 				ON dc.`uc` = s.`uc_diklat_class`
	// 				LEFT JOIN `lms_diklat_period` dp
	// 				ON dp.`uc` = dc.`uc_diklat_period`
	// 				LEFT JOIN `lms_prodi` p
	// 				ON p.`uc` = dp.`uc_prodi`
	// 				LEFT JOIN `lms_diklat` d
	// 				ON d.`uc` = dp.`uc_diklat`
	// 			";

	// 	return $this->exec_query($sql);		
	// }
}