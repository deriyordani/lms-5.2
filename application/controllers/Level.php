<?php
Class Level extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('level_m');

		$this->each_page 	= 5;
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
							'segment' 		=> 'level',
							'model'			=> 'level_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->level_m->get_all('id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->level_m->get_all('id','DESC');			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->im_render->main('level/index', $data);
	}

	function page(){
		$page 	= ($this->input->post('js_page') != 1 ? $this->input->post('js_page') : 1);

		//	Pagination Initialization
		$this->load->library('im_pagination');
		///	Define Offset
		$offset = ($page - 1) * $this->each_page;
		//	Define Parameters
		$params = array(
							'page_number'	=> $page,
							'each_page'		=> $this->each_page,
							'page_int'		=> $this->page_int,	
							'segment' 		=> 'level',
							'model'			=> 'level_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->level_m->get_all('id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->level_m->get_all('id','DESC');			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->load->view('level/content', $data);
	}

	function add(){
		$this->load->view('level/add');
	}

	function store(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'label' => $this->input->post('f_label'),
				'majors' => $this->input->post('f_majors'),
				'level_majors' => $this->input->post('f_level_majors'),
				'uc' => unique_code(),
			];

			$this->level_m->insert_data($data);

			$this->session->set_flashdata('info', $this->config->item('flash_success'));
		}

		redirect('level');
	}

	function edit(){

		$data = NULL;

		$uc = $this->input->post('js_uc');

		$query = $this->level_m->get_filtered(array('uc' => $uc));
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('level/edit', $data);
	}

	function update(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'label' => $this->input->post('f_label'),
				'majors' => $this->input->post('f_majors'),
				'level_majors' => $this->input->post('f_level_majors')
			];

			$id = ['uc' => $this->input->post('f_uc')];

			$this->level_m->update_data($data, $id);

			$this->session->set_flashdata('info', $this->config->item('flash_update'));
		}

		redirect('level');
	}

	function delete($uc = NULL){

		if ($uc != NULL) {
			
			$this->level_m->delete_data(array('uc' => $uc));

			$this->session->set_flashdata('info', $this->config->item('flash_delete'));
		}

		redirect('level');
	}
}