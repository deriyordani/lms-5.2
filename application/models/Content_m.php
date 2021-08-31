<?php
Class Content_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_content';
	}

	function get_content_by_section($uc_classroom = NULL, $uc_diklat_class = NULL){
		$sql = " SELECT s.*, c.id as id_content,c.uc as uc_content,c.content_title, c.sequence as seq_content, c.content_description, c.category, c.uc_tpack,c.file_attach, c.link,c.assignment_point, c.time_open, c.time_close, c.create_time
			FROM `lms_section` s
			LEFT JOIN lms_content c ON c.uc_section = s.uc
			AND c.is_exist ='1'
            LEFT JOIN lms_classroom cl ON s.uc_classroom = cl.uc
			WHERE s.uc_classroom = '".$uc_classroom."' AND cl.uc_diklat_class = '".$uc_diklat_class."'  ";

			if ($this->session->userdata('log_category') == 3) {
				$sql .= " AND s.is_active = '1' ";
			}

		return $this->exec_query($sql);
	}
}