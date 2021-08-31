<?php
Class Classroom extends CI_Controller{
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

	function index(){
		$data = NULL;

		$page = 1;
		//	Pagination Initialization
		$this->load->library('im_pagination');
		///	Define Offset
		$offset = ($page - 1) * $this->each_page;
		//	Define Parameters
		$params = array(
							'page_number'	=> $page,
							'each_page'		=> $this->each_page,
							'page_int'		=> $this->page_int,	
							'segment' 		=> 'classroom',
							'model'			=> 'classroom_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$filter = ['uc_prodi' => $this->session->userdata('log_uc_prodi'), 'count' => FALSE,'is_exist' => 1];

		$query = $this->classroom_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->classroom_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}


		$this->im_render->main('monitoring/classroom/index', $data);
	}


}