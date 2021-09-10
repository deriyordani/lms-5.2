<?php
Class Period extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('diklat_period_m');

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
							'segment' 		=> 'period',
							'model'			=> 'diklat_period_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;
		
		if ($this->session->userdata('log_category') == 4) {
			$filter['uc_prodi'] = $this->session->userdata('log_uc_prodi');
		}

		if ($this->session->userdata('log_category') == 5) {
			$filter['uc_diklat'] = "DKP";
		}

		$filter['count'] = FALSE;

		$query = $this->diklat_period_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$filter['count'] = TRUE;
		$query = $this->diklat_period_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->im_render->main('period/index', $data);
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
							'segment' 		=> 'period',
							'model'			=> 'diklat_period_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;


		if ($this->input->post('js_diklat') != NULL) {
			$filter['uc_diklat'] = $this->input->post('js_diklat');
		}

		if ($this->input->post('js_prodi') != NULL) {
			$filter['uc_prodi'] = $this->input->post('js_prodi');
		}

		if ($this->input->post('js_program') != NULL) {
			$filter['uc_diklat_dkp'] = $this->input->post('js_program');
		}

		if ($this->session->userdata('log_category') == 4) {
			$filter['uc_prodi'] = $this->session->userdata('log_uc_prodi');
		}

		$filter['count'] = FALSE;

		$query = $this->diklat_period_m->get_list($filter, $this->each_page, $offset);
		
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$filter['count'] = TRUE;
		$query = $this->diklat_period_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->load->view('period/content', $data);
	}

	function add(){
		$this->load->view('period/add');
	}

	function store(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'uc' => unique_code(),
				'uc_prodi' => $this->input->post('f_prodi'),
				'uc_diklat' => $this->input->post('f_diklat'),
				'uc_diklat_dkp' => $this->input->post('f_diklat_dkp'),
				'label_periode' => $this->input->post('f_label'),
				'tahun' => $this->input->post('f_tahun'),
				'periode_mulai' => $this->input->post('f_periode_mulai'),
				'periode_selesai' => $this->input->post('f_periode_selesai')
			];

			$this->diklat_period_m->insert_data($data);

			activity_log('Input Data', 'Periode Diklat'.$this->input->post('f_label'));

			$this->session->set_flashdata('info', $this->config->item('flash_success'));
		}

		redirect('period');
	}

	function edit(){
		$data = NULL;

		$uc = $this->input->post('js_uc');

		$query = $this->diklat_period_m->get_detail($uc);
		if ($query->num_rows() > 0) {
			
			$data['row'] = $query->row();
		}

		$this->load->view('period/edit', $data);
	}

	function update(){
		if ($this->input->post('f_save')) {
			
			$data = [

				'uc_prodi' => $this->input->post('f_prodi'),
				'uc_diklat' => $this->input->post('f_diklat'),
				'uc_diklat_dkp' => $this->input->post('f_diklat_dkp'),
				'tahun' => $this->input->post('f_tahun'),
				'label_periode' => $this->input->post('f_label'),
				'periode_mulai' => $this->input->post('f_periode_mulai'),
				'periode_selesai' => $this->input->post('f_periode_selesai')
			];

			$where = ['uc' => $this->input->post('f_uc')];

			$this->diklat_period_m->update_data($data, $where);

			activity_log('Update Data', 'Periode Diklat'.$this->input->post('f_label'));

			$this->session->set_flashdata('info', $this->config->item('flash_success'));
		}

		redirect('period');
	}

	function delete($uc = NULL){

		if ($uc != NULL) {
			
			$this->diklat_period_m->delete_data(array('uc' => $uc));

			activity_log('Hapus Data', 'Periode Diklat');

			$this->session->set_flashdata('info', $this->config->item('flash_delete'));
		}

		redirect('period');
	}

	function kelas($uc_diklat_period = NULL){
		if ($uc_diklat_period != NULL) {
			$data = NULL;

			$filter = ['uc' => $uc_diklat_period,'count' => FALSE];

			$data['info'] = $this->diklat_period_m->get_list($filter)->row();

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

			$this->load->model('diklat_class_m');

			$query = $this->diklat_class_m->get_filtered(array('uc_diklat_period' => $uc_diklat_period),'id', 'DESC', $this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->diklat_class_m->get_filtered(array('uc_diklat_period' => $uc_diklat_period),'id','DESC');			
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
			}



			$this->im_render->main('period/class', $data);
		}else{
			redirect('period');
		}
	}

	function page_class(){

	}

	function add_class(){
		$data = NULL;

		$data['uc_period_diklat'] = $this->input->post('js_uc_period_diklat');

		$this->load->view('period/class_add', $data);
	}

	function store_class(){
		if ($this->input->post('f_save')) {

			$uc_period_diklat = $this->input->post('f_uc_period_diklat');
			
			$data = [

				'uc' => unique_code(),
				'uc_diklat_period' => $uc_period_diklat,
				'class_label' => $this->input->post('f_label'),
			];

			$this->load->model('diklat_class_m');
			$this->diklat_class_m->insert_data($data);

			activity_log('Input Data', 'Periode Diklat : Kelas'.$this->input->post('f_label'));

			$this->session->set_flashdata('info', $this->config->item('flash_success'));

			
		}

		redirect('period/kelas/'.$uc_period_diklat);
	}

	function edit_class(){
		$data = NULL;

		$this->load->model('diklat_class_m');

		$uc_class = $this->input->post('js_uc');

		$query = $this->diklat_class_m->get_filtered(array('uc' => $uc_class));
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('period/class_edit', $data);
	}

	function update_class(){
		if ($this->input->post('f_save')) {

			$uc_period_diklat = $this->input->post('f_uc_period_diklat');
			
			$data = [

				'class_label' => $this->input->post('f_label'),
			];

			$where = [

				'uc' => $this->input->post('f_uc')
			];

			$this->load->model('diklat_class_m');
			$this->diklat_class_m->update_data($data, $where);

			activity_log('Update Data', 'Periode Diklat : Kelas'.$this->input->post('f_label'));

			$this->session->set_flashdata('info', $this->config->item('flash_update'));

			
		}

		redirect('period/kelas/'.$uc_period_diklat);
	}

	function delete_class($uc = NULL, $uc_period_diklat = NULL){
		if ($uc != NULL) {
			
			$this->load->model('diklat_class_m');
			$this->diklat_class_m->delete_data(array('uc' => $uc));

			activity_log('Hapus Data', 'Periode Diklat : Kelas');

			$this->session->set_flashdata('info', $this->config->item('flash_delete'));
		}

		redirect('period/kelas/'.$uc_period_diklat);
	}


}