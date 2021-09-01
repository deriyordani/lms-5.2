<?php
Class Log_m extends MY_Model{
	function __construct(){
		parent::__construct();

		
		$this->table_name = 'lms_activity_log';
	}

	function activity_log($limit = NULL, $offset = 0){
		$sql = " SELECT l.*, u.fullname, u.photo
				FROM `lms_activity_log` l
				LEFT JOIN lms_user u ON l.log_user = u.uc 
				ORDER BY l.id desc
				";

		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}

		return $this->exec_query($sql);
	}
}