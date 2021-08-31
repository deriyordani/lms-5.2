<?php
Class Prodi_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_prodi';
	}
}