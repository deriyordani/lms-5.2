<?php
Class Section_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_section';
	}

	function get_seq_content($uc_classroom, $uc_section){
		$sql = " SELECT sequence FROM `lms_content` where uc_classroom = '".$uc_classroom."' AND uc_section = '".$uc_section."' ORDER BY sequence DESC limit 0,1 ";

		return $this->exec_query($sql);
	}

	function get_section(){
		$sql = " SELECT DISTINCT (k.uc_section), s.section_label
					FROM `lms_kehadiran` k
					LEFT JOIN lms_section s ON k.uc_section = s.uc
					WHERE k.uc_classroom = '606bcfaae0454' AND k.uc_student IS NOT NULL " ;

		return $this->exec_query($sql);
	}

	function get_section_in_classroom($classroom){
        $query = $this->db->query("SELECT uc, section_label, sequence FROM lms_section WHERE uc_classroom = '".$classroom."' ORDER BY sequence");
        return $query->result();
    }
}