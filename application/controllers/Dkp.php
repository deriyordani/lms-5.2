<?php
Class Dkp extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/admin');
		}

		$this->load->model('diklat_dkp_m');

		$this->each_page 	= 20;
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
							'segment' 		=> 'dkp',
							'model'			=> 'diklat_dkp_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->diklat_dkp_m->get_all('id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->diklat_dkp_m->get_all('id','DESC');			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->im_render->main('dkp/index', $data);
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
							'segment' 		=> 'dkp',
							'model'			=> 'diklat_dkp_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->diklat_dkp_m->get_all('id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->diklat_dkp_m->get_all('id','DESC');			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->load->view('dkp/content', $data);
	}

	function add(){
		$this->load->view('dkp/add');
	}

	function store(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'label_dkp' => $this->input->post('f_label'),
				'uc' => uniqid(),
			];

			$this->diklat_dkp_m->insert_data($data);

			$this->session->set_flashdata('info', $this->config->item('flash_success'));
		}

		redirect('dkp');
	}

	function edit(){

		$data = NULL;

		$uc = $this->input->post('js_uc');

		$query = $this->diklat_dkp_m->get_filtered(array('uc' => $uc));
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('dkp/edit', $data);
	}

	function update(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'label_dkp' => $this->input->post('f_label'),
			];

			$id = ['uc' => $this->input->post('f_uc')];

			$this->diklat_dkp_m->update_data($data, $id);

			$this->session->set_flashdata('info', $this->config->item('flash_update'));
		}

		redirect('dkp');
	}

	function delete($uc = NULL){

		if ($uc != NULL) {
			
			$this->diklat_dkp_m->delete_data(array('uc' => $uc));

			$this->session->set_flashdata('info', $this->config->item('flash_delete'));
		}

		redirect('dkp');
	}
}