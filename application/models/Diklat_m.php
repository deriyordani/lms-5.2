<?php
Class Diklat_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_diklat';
	}

	function get_list($filter = NULL,$limit = NULL, $offset = 0){
		$sql = " SELECT * FROM ".$this->table_name."  ";

		//echo $filter['category'];

		if (@$filter['category'] != NULL) {
			$sql .= " WHERE category = '".$filter['category']."' ";
		}

		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}

		//echo $sql;

		return $this->exec_query($sql);

	}
}