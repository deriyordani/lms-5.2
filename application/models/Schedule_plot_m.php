<?php
Class Schedule_plot_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_sched_plot';
	}

	function get_list($uc_sched_week) {
		$sql = "
				SELECT sp.*
					, s.`subject_title`
					, i.`full_name`

					FROM `lms_sched_plot` sp

					LEFT JOIN `lms_subject` s
					ON s.`uc` = sp.`uc_subject`
					LEFT JOIN `lms_instructor` i
					ON i.`uc` = sp.`uc_instructor`

					WHERE `uc_sched_week` = '".$uc_sched_week."'

					ORDER BY sp.`jam_ke` ASC
				";

		return $this->exec_query($sql);		
	}

	function get_intersecting($uc_instructor, $tgl_mulai, $tgl_akhir, $jam_mulai, $jam_selesai) {
		$sql = "SELECT sp.*, sw.`minggu_ke`, dc.`class_label` 
				, dp.`uc_diklat`, dp.`uc_diklat_dkp`, dp.`tahun`, dp.`periode_mulai`, dp.`periode_selesai`
				, d.`diklat`, d.`category`, dd.`label_dkp`
				FROM `lms_sched_plot` sp 
				LEFT JOIN `lms_sched_week` sw
				ON sw.`uc` = sp.`uc_sched_week`
				LEFT JOIN `lms_schedule` s
				ON s.`uc` = sw.`uc_schedule`
				LEFT JOIN `lms_diklat_class` dc
				ON dc.`uc` = s.`uc_diklat_class`
				LEFT JOIN `lms_diklat_period` dp
				ON dp.`uc` = dc.`uc_diklat_period` 
				LEFT JOIN `lms_diklat` d
				ON d.`uc` = dp.`uc_diklat`
				LEFT JOIN `lms_diklat_dkp` dd
				ON dd.`uc` = dp.`uc_diklat_dkp`
				WHERE sp.`uc_instructor` = '".$uc_instructor."'

				AND ((sw.`tanggal_mulai` <= '".$tgl_mulai."' AND sw.`tanggal_akhir` >= '".$tgl_mulai."')
				OR (sw.`tanggal_mulai` <= '".$tgl_akhir."' AND sw.`tanggal_akhir` >= '".$tgl_akhir."'))


				AND ((sp.`jam_mulai` BETWEEN '".$jam_mulai."' AND ('".$jam_selesai."' - '0.1'))
				OR (sp.`jam_selesai` BETWEEN ('".$jam_mulai."' + '0.1') AND ('".$jam_selesai."' - '0.1')))";

					
		
		//echo $sql;		
		return $this->exec_query($sql);		
	}
}