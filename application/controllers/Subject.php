<?php
Class Subject extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('subject_m');

		$this->each_page 	= 100;
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
							'segment' 		=> 'subject',
							'model'			=> 'subject_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$category = $this->session->userdata('log_category');

		$filter = NULL;
		if ($category == 4) {
			
			$filter = [

				'uc_prodi' => $this->session->userdata('log_uc_prodi'),
				'count' => false
			];
		}

		if ($category == 5) {
			
			$filter = [

				'uc_diklat_dkp' => 1,
				'count' => false
			];

		}

		$query = $this->subject_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->subject_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		if ($category != 5) {
			$this->im_render->main('subject/index', $data);
		}else{

			$this->im_render->main('subject/dkp/index', $data);
		}

		
	}

	function page(){
		$data = NULL;

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
							'segment' 		=> 'subject',
							'model'			=> 'subject_m'
						);

		$category = $this->session->userdata('log_category');

		$filter = NULL;
		if ($category == 4) {
			
			$filter = [

				'uc_prodi' => $this->session->userdata('log_uc_prodi'),
				'count' => false
			];

		}else{

			$filter = [

				'uc_prodi' => $this->input->post('js_prodi'),
				'uc_diklat' => $this->input->post('js_diklat'),
				'count' => FALSE

			];
		
		}

		

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->subject_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->subject_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->load->view('subject/content', $data);
	}

	function add(){
		$this->load->view('subject/add');
	}

	function store(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'subject_code' => $this->input->post('f_subject_code'),
				'subject_title' => $this->input->post('f_subject_title'),
				'uc_diklat' => $this->input->post('f_diklat'),
				'uc_diklat_dkp' => $this->input->post('f_diklat_dkp'),
				'uc_prodi' => $this->input->post('f_prodi'),
				'category' => $this->input->post('f_category'),
				'uc' => unique_code()
			];

			$this->subject_m->insert_data($data);

			activity_log('Input Data', 'Subject: '.$this->input->post('f_subject_code').'-'.$this->input->post('f_subject_title'));

			$this->session->set_flashdata('info', $this->config->item('flash_success'));
		}

		redirect('subject');
	}

	function edit(){

		$data = NULL;

		$uc = $this->input->post('js_uc');

		$query = $this->subject_m->get_filtered(array('uc' => $uc));
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('subject/edit', $data);
	}

	function update(){
		if ($this->input->post('f_save')) {
			
			$data = [
				'subject_code' => $this->input->post('f_subject_code'),
				'subject_title' => $this->input->post('f_subject_title'),
				'uc_diklat' => $this->input->post('f_diklat'),
				'uc_diklat_dkp' => $this->input->post('f_diklat_dkp'),
				'uc_prodi' => $this->input->post('f_prodi'),
				'category' => $this->input->post('f_category'),
			];

			$id = ['uc' => $this->input->post('f_uc')];

			$this->subject_m->update_data($data, $id);

			activity_log('Update Data', 'Subject: '.$this->input->post('f_subject_code').'-'.$this->input->post('f_subject_title'));

			$this->session->set_flashdata('info', $this->config->item('flash_update'));
		}

		redirect('subject');
	}

	function delete($uc = NULL){

		if ($uc != NULL) {
			
			$this->subject_m->delete_data(array('uc' => $uc));

			activity_log('Hapus Data', 'Subject');

			$this->session->set_flashdata('info', $this->config->item('flash_delete'));
		}

		redirect('subject');
	}

}