<?php
Class Forum_comment_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_forum_comment';
	}

	function get_list($uc_content){
		$sql = " SELECT * FROM (SELECT cm.*, s.full_name,us.photo
				FROM `lms_forum_comment` cm
				LEFT JOIN lms_user us ON cm.uc_user = us.uc
				 JOIN lms_student s ON us.uc_person = s.uc
				UNION 
				SELECT cm.*, s.full_name,us.photo
				FROM `lms_forum_comment` cm
				LEFT JOIN lms_user us ON cm.uc_user = us.uc
				 JOIN lms_instructor s ON us.uc_person = s.uc) as comment  ";
		$sql .= " WHERE uc_forum = '".$uc_content."'  ";



		return $this->exec_query($sql);
	}
}