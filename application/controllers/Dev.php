<?php
Class Dev extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function tpack($uc_tpack = NULL){
		$data = NULL;

		$data['uc_tpack'] = $uc_tpack;

		if ($uc_tpack != NULL) {
			$this->load->model('tpack_section_m');
			$query = $this->tpack_section_m->get_filtered(array('uc_tpack' => $uc_tpack), 'sequence', 'ASC');
			if ($query->num_rows() > 0) {
				$data['section'] = $query->result();
			}

			$this->load->view('tpack/section_list', $data);
		}
		else {

		}
	}

	function section($uc_tpack = NULL, $uc_tpack_section = NULL, $section = 1, $page = 1){
		$data = NULL;

		$data['uc_tpack'] 			= $uc_tpack;
		$data['uc_tpack_section']	= $uc_tpack_section;
		$data['section']			= $section;
		$data['video']				= $page;

		if ($uc_tpack_section != NULL) {
			$this->load->model('tpack_page_m');
			$query = $this->tpack_page_m->get_filtered(array('uc_tpack_section' => $uc_tpack_section), 'page', 'ASC');
			if ($query->num_rows() > 0) {
				$data['page'] = $query->result();
			}

			$this->im_render->main_stu('tpack/play', $data);
		}
		else {

		}
	}

	function attempt() {
		$this->load->view('assessment/attempt');
	}

}	