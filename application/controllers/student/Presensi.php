<?php
Class Presensi extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('classroom_m');

		$this->load->model('section_m');

		$this->each_page 	= 10;
		$this->page_int 	= 5;
	}

	function rekap($uc_classroom = NULL, $uc_diklat_class = NULL, $output = NULL){
		$data = NULL;

		$filter = [
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$this->load->model('classroom_m');
		$this->load->model('section_m');
		$this->load->model('diklat_class_m');
		$this->load->model('kehadiran_m');

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		if ($uc_diklat_class != NULL) {
			$query = $this->diklat_class_m->get_detail($uc_diklat_class);
			
			if ($query->num_rows() > 0) {
				//$data['info'] = $query->row();
				
				$qsection 	= $this->section_m->get_in_classroom($uc_classroom);
				if ($qsection->num_rows() > 0) {
					$section = $qsection->result();

			        $query = $this->kehadiran_m->presence_student($uc_classroom, $this->session->userdata('log_uc_diklat_participant'));
			        
			        if ($query->num_rows() > 0) {
			        	$presence = $query->result();

			        	
			        	$data['no_peserta'] = $presence[0]->no_peserta;
			        	$data['nama_peserta'] 	= $presence[0]->full_name;

			        	foreach($presence as $pre) {
			        		$kehadiran[$pre->uc_section]['status'] = $pre->status;
			        	}

			        	$data['kehadiran'] = $kehadiran;
			        }
				}
			}
		}		

		$data['section'] 	= $section;
		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;

		if ($output == "excel") {
        	$this->load->view('monitoring/presensi/excel', $data);
        }
        else {
  			//$this->im_render->main('student/presensi/rekap', $data);
  			$this->im_render->main_stu('student/presensi/rekap', $data);
        }
	}
}