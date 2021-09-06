<?php
Class Diklat_class_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_diklat_class';
	}

	function get_diklat_class($filter) {
		$sql = " SELECT dc.*, dp.`label_periode`, dp.`tahun`, dp.`periode_mulai`, dp.`periode_selesai` , d.`category`
					FROM `lms_diklat_class` dc
					LEFT JOIN `lms_diklat_period` dp
					ON dp.`uc` = dc.`uc_diklat_period`
					LEFT JOIN `lms_diklat` d 
					ON d.`uc` = dp.`uc_diklat` ";

		if ($filter['uc_prodi'] != NULL) {
			$sql .= " WHERE dp.`uc_prodi` = '".$filter['uc_prodi']."' ";
		}			
		if ($filter['uc_diklat'] != NULL) {
			$sql .= " AND dp.`uc_diklat` = '".$filter['uc_diklat']."' "; 
		}
		
		return $this->exec_query($sql);			
	}

	function get_detail($uc) {
		$sql = "SELECT dc.*, dp.`label_periode`, dp.`tahun`, dp.`periode_mulai`, dp.`periode_selesai` 
					, d.`uc` AS `uc_diklat`, d.`diklat`, d.`category`, p.`uc` AS `uc_prodi`, p.`prodi`
					FROM `lms_diklat_class` dc
					LEFT JOIN `lms_diklat_period` dp
					ON dp.`uc` = dc.`uc_diklat_period`
					LEFT JOIN `lms_diklat` d 
					ON d.`uc` = dp.`uc_diklat` ";

		$sql .= " LEFT JOIN `lms_prodi` p ON p.`uc` = dp.`uc_prodi` ";


		$sql .= " WHERE dc.`uc` = '".$uc."' ";

		return $this->exec_query($sql);
	}
}