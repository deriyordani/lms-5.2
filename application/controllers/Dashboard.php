<?php
Class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){

		$this->load->model('log_m');

		$data['log'] = $this->log_m->get_filtered(array('log_user' => $this->session->userdata('log_uc')),'id','DESC')->result();

		$session = $this->session->userdata('log_category');

		if ($session == '1' || $session == '2') {
			$this->im_render->main('dashboard', $data);
		
		}elseif ($session == '3') {
			$this->im_render->main_stu('dashboard_user', $data);
		}

		

	}

	function tgl(){
		$n = 100;
 
		// menentukan timestamp 10 hari berikutnya dari tanggal hari ini
		$nextN = mktime(0, 0, 0, 11, 8 + $n, 2020);

		echo date("d-m-Y", $nextN);
	}
}