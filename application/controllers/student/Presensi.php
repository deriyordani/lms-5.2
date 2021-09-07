<?php
Class Presensi extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('classroom_m');

		$this->load->model('section_m');

		$this->each_page 	= 5;
		$this->page_int 	= 5;
	}

	function rekap($uc_classroom = NULL, $uc_diklat_class = NULL, $type = NULL){
		$data = NULL;

		$filter = [
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$data['info'] = $this->classroom_m->get_list($filter)->row();


	    $data['section'] = $this->section_m->get_section_in_classroom($uc_classroom);
        if ($this->session->userdata('log_category') == 2) {
        	//	Instruktur
			$data['student'] = $this->student_m->get_student_in_diklat_class($uc_classroom);
        	$data['kehadiran'] = $this->kehadiran_m->get_presence_in_class($uc_classroom);
        }
        elseif ($this->session->userdata('log_category') == 3) {
        	//	Student
        }

        $data['uc_classroom'] = $uc_classroom;
        $data['uc_diklat_class'] = $uc_diklat_class;

        if ($type == "excel") {
        	$this->load->view('presensi/excel', $data);
        }
        else {
			$this->im_render->main_stu('student/presensi/rekap', $data);
        }
	}
}