<?php
Class Chatroom_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_chat';
	}

	function get_chat($uc_classroom, $uc_diklat_class){
		$sql = " SELECT c.*, u.email, u.username,u.photo
				FROM ".$this->table_name." c
				LEFT JOIN lms_user u ON c.uc_user = u.uc
				WHERE c.uc_classroom = '".$uc_classroom."' AND c.uc_diklat_class = '".$uc_diklat_class."'
				ORDER BY c.id ASC
		 ";

		return $this->exec_query($sql);
	}

}