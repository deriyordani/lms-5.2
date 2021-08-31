<?php
Class Content_files_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_content_files';
	}

	function get_not_in_file($uc_content){
		$sql = " SELECT * FROM `lms_content_files` WHERE uc_content = '".$uc_content."' AND type NOT IN ('link') ";

		return $this->exec_query($sql);
	}

}