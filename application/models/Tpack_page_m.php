<?php
Class Tpack_page_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_tpack_page';
	}
}