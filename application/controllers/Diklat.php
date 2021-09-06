<?php
Class diklat extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('diklat_m');

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
							'segment' 		=> 'diklat',
							'model'			=> 'diklat_m'
						);



		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->diklat_m->get_all('id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->diklat_m->get_all('id','DESC');			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->im_render->main('diklat/index', $data);
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
							'segment' 		=> 'diklat',
							'model'			=> 'diklat_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$filter = [
			'category'  => $this->input->post('js_kategori')

		];

		//print_r($filter);

		$query = $this->diklat_m->get_list($filter,$this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->diklat_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->load->view('diklat/content', $data);
	}

	function add(){
		$this->load->view('diklat/add');
	}

	function store(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'diklat' => $this->input->post('f_diklat'),
				'category' => $this->input->post('f_category'),
				'uc' => unique_code(),
			];

			$this->diklat_m->insert_data($data);

			activity_log('Input Data', 'Program Diklat : '.$this->input->post('f_diklat'));

			$this->session->set_flashdata('info', $this->config->item('flash_success'));
		}

		redirect('diklat');
	}

	function edit(){

		$data = NULL;

		$uc = $this->input->post('js_uc');

		$query = $this->diklat_m->get_filtered(array('uc' => $uc));
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('diklat/edit', $data);
	}

	function update(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'diklat' => $this->input->post('f_diklat'),
				'category' => $this->input->post('f_category'),
			];

			$id = ['uc' => $this->input->post('f_uc')];

			$this->diklat_m->update_data($data, $id);

			activity_log('Update Data', 'Program Diklat : '.$this->input->post('f_diklat'));

			$this->session->set_flashdata('info', $this->config->item('flash_update'));
		}

		redirect('diklat');
	}

	function delete($uc = NULL){

		if ($uc != NULL) {
			
			$this->diklat_m->delete_data(array('uc' => $uc));

			activity_log('Hapus Data', 'Program Diklat');

			$this->session->set_flashdata('info', $this->config->item('flash_delete'));
		}

		redirect('diklat');
	}
}