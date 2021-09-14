<?php
Class Users extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('user_m');

		$this->load->model('instructor_temp_m');
		$this->load->model('instructor_m');

		$this->each_page 	= 10;
		$this->page_int 	= 10;
	}

	function index(){
		redirect('users/lists/instruktur/2');
	}

	function lists($akses = 'instruktur', $category = 2, $prodi = NULL){

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
							'segment' 		=> 'users',
							'model'			=> 'instructor_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$filter = ['category' => $category, 'count' => FALSE];

		if ($akses == 'instruktur') {
			
			if ($this->session->userdata('log_uc_prodi') != NULL) {
				$filter['uc_prodi'] = $this->session->userdata('log_uc_prodi');

				$query = $this->instructor_m->get_list_detail($filter, $this->each_page, $offset);
				if ($query->num_rows() > 0) {
					$data['result'] = $query->result();
				}

				$query = $this->instructor_m->get_list_detail($filter);
				if ($query->num_rows() > 0) {
					$params['total_record'] = $query->num_rows();
					$data['pagination'] 	= $this->im_pagination->render_ajax($params);
					$data['total_record'] 	= $query->num_rows();
				}

			}else{
				$query = $this->instructor_m->get_list_detail(NULL, $this->each_page, $offset);
				if ($query->num_rows() > 0) {
					$data['result'] = $query->result();
				}

				$query = $this->instructor_m->get_list_detail(NULL);
				if ($query->num_rows() > 0) {
					$params['total_record'] = $query->num_rows();
					$data['pagination'] 	= $this->im_pagination->render_ajax($params);
					$data['total_record'] 	= $query->num_rows();
				}
			}

		}else{
			$query = $this->user_m->get_list($filter, $this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->user_m->get_list($filter);			
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
			}
		}

		$data['akses'] = $akses;
		$data['category'] = $category;

		$this->im_render->main('user/index',$data);

	}

	function page(){
		$data = NULL;

		$page 	= ($this->input->post('js_page') != 1 ? $this->input->post('js_page') : 1);

		$akses = $this->input->post('js_akses');
		$category = $this->input->post('js_category');

		//	Pagination Initialization
		$this->load->library('im_pagination');
		///	Define Offset
		$offset = ($page - 1) * $this->each_page;
		//	Define Parameters
		$params = array(
							'page_number'	=> $page,
							'each_page'		=> $this->each_page,
							'page_int'		=> $this->page_int,	
							'segment' 		=> 'users',
							'model'			=> 'user_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$filter = ['category' => $category, 'count' => FALSE];

		if ($akses == 'instruktur') {
			
			if ($this->session->userdata('log_uc_prodi') != NULL) {
				$filter['uc_prodi'] = $this->session->userdata('log_uc_prodi');

				$query = $this->instructor_m->get_list_detail($filter, $this->each_page, $offset);
				if ($query->num_rows() > 0) {
					$data['result'] = $query->result();
				}

				$query = $this->instructor_m->get_list_detail($filter);
				if ($query->num_rows() > 0) {
					$params['total_record'] = $query->num_rows();
					$data['pagination'] 	= $this->im_pagination->render_ajax($params);
					$data['total_record'] 	= $query->num_rows();
				}

			}else{
				$query = $this->instructor_m->get_list_detail(NULL, $this->each_page, $offset);
				if ($query->num_rows() > 0) {
					$data['result'] = $query->result();
				}

				$query = $this->instructor_m->get_list_detail(NULL);
				if ($query->num_rows() > 0) {
					$params['total_record'] = $query->num_rows();
					$data['pagination'] 	= $this->im_pagination->render_ajax($params);
					$data['total_record'] 	= $query->num_rows();
				}
			}

		}else{
			$query = $this->user_m->get_list($filter, $this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->user_m->get_list($filter);			
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
			}
		}

		$data['akses'] = $akses;
		$data['category'] = $category;

		if ($akses != 'instruktur') {
            $this->load->view('user/content', $data);
        }else{
             $this->load->view('user/instruktur', $data);
        }
	}

	function upload_ins(){
		if ($this->input->post('f_upload')) {
			
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

			$config['upload_path'] 		= './excel/'; //buat folder dengan nama assets di root folder
			$config['allowed_types'] 	= 'xls|xlsx|csv';
			$config['max_size'] 		= 10000;

			$this->load->library('upload');
			$this->upload->initialize($config);

			$uc_prodi = $this->input->post('f_uc_prodi');


			if(! $this->upload->do_upload('f_file')){

				$this->upload->display_errors();

			}else{


				$upload_data	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
				$inputFileName 	= 'excel/'.$upload_data['file_name'];

				try {
					$inputFileType 	= IOFactory::identify($inputFileName);
					$objReader 		= IOFactory::createReader($inputFileType);
					$objPHPExcel 	= $objReader->load($inputFileName);
				} catch(Exception $e) {
					die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
				}

				$sheet 			= $objPHPExcel->getSheet(0);
				$highestRow 	= $sheet->getHighestRow();
				$highestColumn 	= $sheet->getHighestColumn();
				$value 			= "";
				$curr_seafarer 	= "";

				$field = "(`uc`,`id_number`,`full_name`,`uc_prodi`)";

				$this->db->truncate('lms_instructor_temp');

				$i = 1;

				for ($row = 6; $row <= $highestRow; $row++){  
					//PREPARE DATA

					$rowData = $sheet->rangeToArray('C' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);

					//print_r($rowData);

					$id_number 	= ($rowData[0][0] != NULL ? $rowData[0][0] : NULL);
					$full_name 	= ($rowData[0][1] != NULL ? $rowData[0][1] : NULL);
					
					

					if (isset($id_number)) { 
						if ($curr_seafarer != $id_number) {	
							$value .= "('".unique_code()."','".trim($id_number)."','".str_replace("'", "''", $full_name)."','".$uc_prodi."'),";

							$curr_seafarer = trim($id_number);

						}else{
							$message = 'No Participant <b>'.$curr_seafarer.'</b> has exist from this Participant!';

							$this->session->set_flashdata('msg', $message);
						}

						if (($i%50) == 0) {

							$value = substr_replace($value, '', -1);
							$this->instructor_temp_m->insert_multi_value($field,$value);
							
							
							$value = "";
						}
					}
	 
					$i++;

				}
				if ($value != "") {

					$value = substr_replace($value, '', -1);
					$this->instructor_temp_m->insert_multi_value($field, $value);

				}

				//	INSERT TEMP TO REAL
				$value = "";

				$query = $this->instructor_temp_m->temp_not_in_real();
				if ($query->num_rows() > 0) {
					$i = 1;

					foreach ($query->result() as $res) {
						$value .= "('".$res->uc."','".$res->id_number."','".str_replace("'", "''", $res->full_name)."','".$res->uc_prodi."'),";

						if (($i%50) == 0) {

							$value = substr_replace($value, '', -1);
							
							$this->instructor_m->insert_multi_value($field,$value);
							
							$value = "";
							$value_stu = "";
						}

						$i++;
					}

					if ($value != "") {
						$value = substr_replace($value, '', -1);
						
						$this->instructor_m->insert_multi_value($field,$value);
					}
				}

				$this->db->truncate('lms_instructor_temp');


				activity_log('Upload Data', 'Instruktur');
			}
		}

		if($uc_prodi != NULL){
			redirect('users/lists/instruktur/2/'.$uc_prodi);

		}else{
			
			redirect('users/lists/instruktur/2');
		}

		
	}

	function edit_ins(){
		$data = NULL;

		$uc = $this->input->post('js_uc');

		$query = $this->instructor_m->get_filtered(array('uc' => $uc));			
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('user/edit_ins', $data);
	}

	function update_ins(){
		if ($this->input->post('f_save')) {

			$uc_prodi = $this->input->post('f_uc_prodi');

			$data = [

				'id_number' => trim($this->input->post('f_nip')),
				'full_name' => $this->input->post('f_full_name'),
				'uc_prodi' => $this->input->post('f_prodi')
			];

			activity_log('Update Data', 'User : Instruktur '.$this->input->post('f_full_name'));

			$this->instructor_m->update_data($data, array('uc' => $this->input->post('f_uc')));
		}

		if($uc_prodi != NULL){
			redirect('users/lists/instruktur/2/'.$uc_prodi);

		}else{
			
			redirect('users/lists/instruktur/2');
		}
	}

	function delete_ins($uc = NULL, $uc_prodi = NULL){

		$this->instructor_m->delete_data(array('uc' => $uc));

		activity_log('Hapus Data', 'User : Instruktur ');

		
		if($uc_prodi != NULL){
			redirect('users/lists/instruktur/2/'.$uc_prodi);

		}else{
			
			redirect('users/lists/instruktur/2');
		}
	}

	function delete_user($uc = NULL, $uc_prodi = NULL){

		$this->instructor_m->update_data(array('is_claim' => 0),array('uc' => $uc));
		$this->user_m->delete_data(array('uc_person' => $uc));

		activity_log('Hapus Data', 'User : Instruktur ');

		
		if($uc_prodi != NULL){
			redirect('users/lists/instruktur/2/'.$uc_prodi);

		}else{
			
			redirect('users/lists/instruktur/2');
		}
	}

	function store_user_prodi(){
		if ($this->input->post('f_save')) {
			
			$uc_user = unique_code();

			$data_user  = [
				'uc' => $uc_user,
				'username' => $this->input->post('f_username'),
				'password' => password_hash($this->input->post('f_password'), PASSWORD_BCRYPT),
				'email' => $this->input->post('f_email'),
				'category' => ($this->input->post('f_type') == 1 ? 4 : 5),
				'is_active' => 1,
				'uc_prodi' => $this->input->post('f_prodi'),

			];

			$this->user_m->insert_data($data_user);

			activity_log('Input Data', 'User : Prodi'.$this->input->post('f_username'));
		}

		redirect('users');
	}

	function delete($uc = NULL){

		$this->user_m->delete_data(array('uc' => $uc));

		activity_log('Hapus Data', 'User');

		redirect('users');
	}

	function changepassword(){
		$data = NULL;

		$uc = $this->input->post('js_uc');

		$category = $this->input->post('js_category');

		if ($category == 'instruktur') {
			$query = $this->user_m->get_filtered(array('uc_person' => $uc));
			$data['prodi'] = $this->instructor_m->get_filtered(array('uc' => $uc))->row();
		}else{
			$query = $this->user_m->get_filtered(array('uc' => $uc));		
		}
			
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('user/changepassword', $data);
	}

	function update_password(){
		if ($this->input->post('f_save')) {
			
			$new_pass = $this->input->post('f_password');
			$re_pass	= $this->input->post('f_re_password');
			$uc = $this->input->post('f_uc');
			$uc_prodi = $this->input->post('f_uc_prodi');

			if ($new_pass == $re_pass) {

				$data_user = [
					'password' => password_hash($new_pass, PASSWORD_BCRYPT),
				];

				$where = ['uc' => $uc];
				
				$this->user_m->update_data($data_user, $where);

				activity_log('Update Data', 'User : Password');

				$this->session->set_flashdata('info', $this->config->item('flash_success'));

				
			}else{

				$this->session->set_flashdata('info', $this->config->item('not_matching_pass'));

				
			}
		}

		if($uc_prodi != NULL){
			redirect('users/lists/instruktur/2/'.$uc_prodi);

		}else{
			
			redirect('users/lists/instruktur/2');
		}
	}

	function edit_user(){
		$data =NULL;

		$query = $this->user_m->get_filtered(array('uc' => $this->input->post('js_uc')));
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('user/edit_user', $data);
	}

	function update_user(){
		if ($this->input->post('f_save')) {
			$data = [

				'username' => $this->input->post('f_username'),
				'email' => $this->input->post('f_email')
			];

			$where = array('uc' => $this->input->post('f_uc'));

			$this->user_m->update_data($data, $where);
		}

		redirect('users/lists/prodi/4');
	}

	function store_ins(){
		if($this->input->post('f_store')){

			$uc_prodi = $this->input->post('f_uc_prodi');

			if (!$this->is_exist_ins(trim($this->input->post('f_id_number')))) {
				$data = [
					'uc' => unique_code(),
					'id_number' => trim($this->input->post('f_id_number')),
					'full_name' => $this->input->post('f_full_name'),
					'uc_prodi' => $uc_prodi
				];

				activity_log('Input Data', 'User : Instruktur '.$this->input->post('f_full_name'));

				$this->instructor_m->insert_data($data);

				$this->session->set_flashdata('info', $this->config->item('flash_success'));
				
				if($uc_prodi != NULL){
					redirect('users/lists/instruktur/2/'.$uc_prodi);

				}else{
					
					redirect('users/lists/instruktur/2');
				}
			}	
			else {
				$this->session->set_flashdata('info', $this->config->item('flash_ins_number_exist'));
				redirect('users/lists/instruktur/2');
			}
		}
		else {
			redirect('users/lists/instruktur/2');
		}
	}

	function is_exist_ins($id_number = NULL) {
		if ($id_number != NULL) {
			$query = $this->instructor_m->get_filtered(array('id_number' => $id_number));
			if ($query->num_rows() > 0) {
				return TRUE;	
			}
			else {
				return FALSE;
			}
		}
		else {
			return FALSE;
		}
	}

	function is_exist_ins_ajax() {
		$status = $this->is_exist_ins(trim($this->input->post('js_id_number')));

		echo json_encode($status);
	}

	// function instruktur(){

	// 	$data = NULL;

	// 	$page = 1;
	// 	//	Pagination Initialization
	// 	$this->load->library('im_pagination');
	// 	///	Define Offset
	// 	$offset = ($page - 1) * $this->each_page;
	// 	//	Define Parameters
	// 	$params = array(
	// 						'page_number'	=> $page,
	// 						'each_page'		=> $this->each_page,
	// 						'page_int'		=> $this->page_int,	
	// 						'segment' 		=> 'users',
	// 						'model'			=> 'user_m'
	// 					);

	// 	$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;


	// 	$query = $this->instructor_m->get_all('id','DESC', $this->each_page, $offset);
	// 	if ($query->num_rows() > 0) {
	// 		$data['result'] = $query->result();
	// 	}

	// 	$query = $this->instructor_m->get_all();			
	// 	if ($query->num_rows() > 0) {
	// 		$params['total_record'] = $query->num_rows();
	// 		$data['pagination'] 	= $this->im_pagination->render_ajax($params);
	// 		$data['total_record'] 	= $query->num_rows();
	// 	}

	// 	$this->im_render->main('user/instruktur_prodi', $data);
	// }




}