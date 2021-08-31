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

		$this->each_page 	= 30;
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

			if ($prodi != NULL) {
				
				$query = $this->instructor_m->get_filtered(array('uc_prodi' => $prodi),'id','DESC', $this->each_page, $offset);
				if ($query->num_rows() > 0) {
					$data['result'] = $query->result();
				}

				$query = $this->instructor_m->get_filtered(array('uc_prodi' => $prodi));			
				if ($query->num_rows() > 0) {
					$params['total_record'] = $query->num_rows();
					$data['pagination'] 	= $this->im_pagination->render_ajax($params);
					$data['total_record'] 	= $query->num_rows();
				}

			}else{


				$query = $this->instructor_m->get_all('id','DESC', $this->each_page, $offset);
				if ($query->num_rows() > 0) {
					$data['result'] = $query->result();
				}

				$query = $this->instructor_m->get_all();			
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
			
			$query = $this->instructor_m->get_all('id','DESC', $this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->instructor_m->get_all();			
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
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

		if ($akses != 'instruktur') {
            $this->load->view('user/content', $data);
        }else{
             $this->load->view('user/instruktur', $data);
        }
                        

		// $this->load->view('user/content', $data);
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
							$value .= "('".uniqid()."','".trim($id_number)."','".str_replace("'", "''", $full_name)."','".$uc_prodi."'),";

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
			}
		}

		redirect('users/lists/instruktur/2');
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
			$data = [

				'id_number' => trim($this->input->post('f_nip')),
				'full_name' => $this->input->post('f_full_name')
			];

			$this->instructor_m->update_data($data, array('uc' => $this->input->post('f_uc')));
		}

		redirect('users/instruktur');
	}

	function delete_ins($uc = NULL){

		$this->instructor_m->delete_data(array('uc' => $uc));

		redirect('users/instruktur');
	}

	function store_user_prodi(){
		if ($this->input->post('f_save')) {
			
			$uc_user = uniqid();

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
		}

		redirect('users');
	}

	function delete($uc = NULL){

		$this->user_m->delete_data(array('uc' => $uc));

		redirect('users');
	}

	function changepassword(){
		$data = NULL;

		$uc = $this->input->post('js_uc');

		$category = $this->input->post('js_category');

		if ($category == 'instruktur') {
			$query = $this->user_m->get_filtered(array('uc_person' => $uc));		
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

			if ($new_pass == $re_pass) {

				$data_user = [
					'password' => password_hash($new_pass, PASSWORD_BCRYPT),
				];

				$where = ['uc' => $uc];
				
				$this->user_m->update_data($data_user, $uc);


				$this->session->set_flashdata('info', $this->config->item('flash_success'));

				redirect('users/lists/instruktur/2');


			}else{

				$this->session->set_flashdata('info', $this->config->item('not_matching_pass'));

				redirect('users/lists/instruktur/2');
			}
		}
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