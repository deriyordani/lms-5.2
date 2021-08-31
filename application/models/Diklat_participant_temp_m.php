<?php
Class Diklat_participant_temp_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_diklat_participant_temp';
	}

	function temp_not_in_real() {
		$sql = "SELECT dpt.*, st.`full_name` 
					FROM `lms_diklat_participant_temp` dpt 
					LEFT JOIN `lms_student_temp` st 
					ON st.`no_peserta` = dpt.`no_peserta` 
					WHERE dpt.`no_peserta` NOT IN 
					( SELECT `no_peserta` FROM `lms_diklat_participant` )";

		return $this->exec_query($sql);			
	}
}
?>	