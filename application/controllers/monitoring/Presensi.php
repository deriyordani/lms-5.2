<?php
Class Presensi extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('monitoring/login');
		}

		$this->each_page 	= 10;
		$this->page_int 	= 5;
	}

	function diklat() {
		$data = NULL;

		$this->im_render->main('monitoring/presensi/diklat', $data);
	}

	function list_program() {
		$data = NULL;

        $uc_diklat = $this->input->post('js_uc_diklat');

        if ($uc_diklat == '60fa030218852') {
        	//	If DKP
        	$this->load->model('diklat_dkp_m');
        	$query = $this->diklat_dkp_m->get_all('label_dkp', 'ASC');
        	if ($query->num_rows() > 0 ) {
	            $data['result'] = $query->result();
	        }

	        $this->load->view('prodi/select_dkp_ajax',$data);
        }
        else {
        	//	If Pembentukan or Peningkatan
	        $this->load->model('prodi_m');
	        $query = $this->prodi_m->get_all('prodi', 'ASC');
	        if ($query->num_rows() > 0 ) {
	            $data['result'] = $query->result();
	        }
        	
        	$this->load->view('prodi/select_prodi_ajax',$data);
        }
	}

	function periode() {
		$data = NULL;

		$this->load->model('classroom_m');

		$uc_diklat 	= $this->input->post('f_diklat');
		$uc_program = $this->input->post('f_program');

		$this->load->model('diklat_class_m');

		/*
		if ($uc_diklat == '60fa030218852') {
			// If DKP

		}
		else {
			// If Pembentukan or Peningkatan
			$filter = array(
							'uc_prodi'	=> $uc_program,
							'uc_diklat'	=> $uc_diklat
							);
		}

		$query = $this->classroom_m->get_presensi($filter);
		*/

		$filter = array(
						'uc_prodi'	=> $uc_program,
						'uc_diklat'	=> $uc_diklat
						);

		//$query = $this->classroom_m->get_presensi($filter);

		$filter['count'] = FALSE;
		$query = $this->diklat_class_m->get_diklat_class($filter);

		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$data['uc_diklat'] 	= $uc_diklat;
		$data['uc_program']	= $uc_program;
		$data['submit'] = TRUE;

		$this->im_render->main('monitoring/presensi/periode', $data);
	}

	function periode_ajax() {
		$data = NULL;

		$this->load->model('classroom_m');

		$uc_diklat 	= $this->input->post('js_diklat');
		$uc_program = $this->input->post('js_prodi');

		$this->load->model('diklat_class_m');

		/*
		if ($uc_diklat == '60fa030218852') {
			// If DKP

		}
		else {
			// If Pembentukan or Peningkatan
			$filter = array(
							'uc_prodi'	=> $uc_program,
							'uc_diklat'	=> $uc_diklat
							);
		}

		$query = $this->classroom_m->get_presensi($filter);
		*/

		$filter = array(
						'uc_prodi'	=> $uc_program,
						'uc_diklat'	=> $uc_diklat
						);

		//$query = $this->classroom_m->get_presensi($filter);

		$filter['count'] = FALSE;
		$query = $this->diklat_class_m->get_diklat_class($filter);

		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$data['uc_diklat'] 	= $uc_diklat;
		$data['uc_program']	= $uc_program;
		$data['submit'] = TRUE;

		$this->load->view('monitoring/presensi/periode', $data);
	}

	function subject($uc_diklat = NULL, $uc_program = NULL, $uc_diklat_class = NULL) {
		$data = NULL;

		$data['uc_diklat'] 	= $uc_diklat;
		$data['uc_program']	= $uc_program;
		$data['uc_diklat_class'] = $uc_diklat_class;

		$this->load->model('subject_m');
		$this->load->model('diklat_class_m');

		if ($uc_diklat_class != NULL) {
			$query = $this->diklat_class_m->get_detail($uc_diklat_class);
			if ($query->num_rows() > 0) {
				$data['info'] = $query->row();

				$filter = array(	
							'uc_prodi'			=> $uc_program,
							'uc_diklat'			=> $uc_diklat,
							'uc_diklat_class' 	=> $uc_diklat_class	
							);

				$query = $this->subject_m->get_subject_classroom($filter);

				if ($query->num_rows() > 0) {
					$data['result'] = $query->result();
				}

				//print_r($data['info']);

				$this->im_render->main('monitoring/presensi/classroom', $data);
			}
		}
	}

	function rekap($uc_classroom = NULL, $uc_diklat_class = NULL, $output = NULL) {
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

		if ($uc_classroom != NULL) {
			$query = $this->classroom_m->get_detail($uc_classroom);
			if ($query->num_rows() > 0) {
				$data['classroom'] = $query->row();

				if ($uc_diklat_class != NULL) {
					$query = $this->diklat_class_m->get_detail($uc_diklat_class);
					
					if ($query->num_rows() > 0) {
						$data['info'] = $query->row();
						
						$qsection 	= $this->section_m->get_in_classroom($uc_classroom);
						if ($qsection->num_rows() > 0) {
							$section = $qsection->result();
					        $query = $this->kehadiran_m->presence_instructor($uc_classroom);
					        
					        if ($query->num_rows() > 0) {
					        	$presence = $query->result();

					        	$data['id_number'] = $presence[0]->id_number;
					        	$data['full_name'] = $presence[0]->full_name;

					        	foreach($presence as $pre) {
					        		$kehadiran[$pre->uc_section]['status'] = $pre->status;
					        	}

					        	$data['kehadiran'] = $kehadiran;
					        }

					        $data['section'] 	= $section;
						}
					}
				}		
			}
		}

		$data['uc_classroom']		= $uc_classroom;
		$data['uc_diklat_class'] 	= $uc_diklat_class;

		if ($output == "excel") {
        	$this->load->view('monitoring/presensi/excel', $data);
        }
        else {
  			$this->im_render->main('monitoring/presensi/rekap', $data);
        }
	}
}
?>	