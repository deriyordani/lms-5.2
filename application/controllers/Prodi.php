<?php
Class Prodi extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/admin');
		}

		$this->load->model('prodi_m');

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
							'segment' 		=> 'prodi',
							'model'			=> 'prodi_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->prodi_m->get_all('id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->prodi_m->get_all('id','DESC');			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->im_render->main('prodi/index', $data);
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
							'segment' 		=> 'prodi',
							'model'			=> 'prodi_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->prodi_m->get_all('id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->prodi_m->get_all('id','DESC');			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->load->view('prodi/content', $data);
	}

	function add(){
		$this->load->view('prodi/add');
	}

	function store(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'prodi' => $this->input->post('f_prodi'),
				'uc' => uniqid(),
			];

			$this->prodi_m->insert_data($data);

			activity_log('Input Data', 'Prodi : '.$this->input->post('f_prodi'));

			
			$this->session->set_flashdata('info', $this->config->item('flash_success'));

		}

		redirect('prodi');
	}

	function edit(){

		$data = NULL;

		$uc = $this->input->post('js_uc');

		$query = $this->prodi_m->get_filtered(array('uc' => $uc));
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('prodi/edit', $data);
	}

	function update(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'prodi' => $this->input->post('f_prodi')
			];

			$id = ['uc' => $this->input->post('f_uc')];

			$this->prodi_m->update_data($data, $id);

			activity_log('Update Data', 'Prodi : '.$this->input->post('f_prodi'));

			$this->session->set_flashdata('info', $this->config->item('flash_update'));

		}

		redirect('prodi');
	}

	function delete($uc = NULL){

		if ($uc != NULL) {
			
			$this->prodi_m->delete_data(array('uc' => $uc));

			activity_log('Hapus Data', 'Prodi');

			$this->session->set_flashdata('info', $this->config->item('flash_delete'));
		}

		redirect('prodi');
	}
}