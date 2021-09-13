<?php
Class Peserta_diklat extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('diklat_participant_m');
		$this->load->model('student_m');

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
							'segment' 		=> 'Peserta_diklat',
							'model'			=> 'diklat_participant_m'
						);



		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$filter = ['uc_prodi' => $this->session->userdata('log_uc_prodi'), 'count' => FALSE];


		$query = $this->diklat_participant_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->diklat_participant_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->im_render->main('peserta_diklat/index', $data);
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
							'segment' 		=> 'Peserta_diklat',
							'model'			=> 'diklat_participant_m'
						);



		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$filter = ['uc_prodi' => $this->session->userdata('log_uc_prodi'), 'count' => FALSE];

		$query = $this->diklat_participant_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->diklat_participant_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->load->view('peserta_diklat/content', $data);

	}

	function add(){
		$this->load->view('peserta_diklat/add');
	}

	function store() {
		if ($this->input->post('f_save')) {
			$this->load->model('diklat_participant_temp_m');
			$this->load->model('student_temp_m');

			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

			$config['upload_path'] 		= './excel/'; //buat folder dengan nama assets di root folder
			$config['allowed_types'] 	= 'xls|xlsx|csv';
			$config['max_size'] 		= 10000;

			$this->load->library('upload');
			$this->upload->initialize($config);


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
				$value_stu 		= "";
				$curr_seafarer 	= "";

				$field = "(`uc`,`uc_diklat_period`,`uc_diklat_class`,`no_peserta`)";
				$field_stu = "(`uc`,`no_peserta`,`full_name`)";

				$uc_diklat_period = $this->input->post('f_uc_diklat_periode');
				$uc_diklat_class = $this->input->post('f_kelas');

				$this->db->truncate('lms_diklat_participant_temp');
				$this->db->truncate('lms_student_temp');

				$i = 1;

				for ($row = 7; $row <= $highestRow; $row++){  
					//PREPARE DATA

					$rowData = $sheet->rangeToArray('C' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);

					$nomor_peserta 	= ($rowData[0][0] != NULL ? $rowData[0][0] : NULL);
					$full_name  	= ($rowData[0][1] != NULL ? $rowData[0][1] : NULL);
					

					if (isset($nomor_peserta)) { // Check for seafarer code
						if ($curr_seafarer != $nomor_peserta) {	
							$value .= "('".unique_code()."','".$uc_diklat_period."','".$uc_diklat_class."','".trim($nomor_peserta)."'),";
							$value_stu .= "('".unique_code('ST')."','".trim($nomor_peserta)."','".str_replace("'", "''", $full_name)."'),";

							$curr_seafarer = trim($nomor_peserta);

						}else{
							$message = 'No Participant <b>'.$curr_seafarer.'</b> has exist from this Participant!';

							$this->session->set_flashdata('msg', $message);
						}

						if (($i%50) == 0) {

							$value = substr_replace($value, '', -1);
							$value_stu = substr_replace($value_stu, '', -1);

							$this->diklat_participant_temp_m->insert_multi_value($field,$value);
							$this->student_temp_m->insert_multi_value($field_stu, $value_stu);
							
							
							$value = "";
							$value_stu = "";
						}
					}
	 
					$i++;

				}
				if ($value != "") {

					$value = substr_replace($value, '', -1);
					$value_stu = substr_replace($value_stu, '', -1);

					$this->diklat_participant_temp_m->insert_multi_value($field,$value);
					$this->student_temp_m->insert_multi_value($field_stu, $value_stu);

				}

				//	INSERT TEMP to REAL
				$value 			= "";
				$value_stu 		= "";

				$query = $this->diklat_participant_temp_m->temp_not_in_real();
				//echo "<br /> NR : ".$query->num_rows();
				if ($query->num_rows() > 0) {
					$i = 1;

					foreach ($query->result() as $res) {
						$value .= "('".$res->uc."','".$res->uc_diklat_period."','".$res->uc_diklat_class."','".$res->no_peserta."'),";
						$value_stu .= "('".$res->uc_student."','".$res->no_peserta."','".str_replace("'", "''", $res->full_name)."'),";

						if (($i%50) == 0) {

							$value = substr_replace($value, '', -1);
							$value_stu = substr_replace($value_stu, '', -1);

							// echo "<br /> V : ".$value;
							// echo "<br /> VS : ".$value_stu;
							$this->diklat_participant_m->insert_multi_value($field,$value);
							$this->student_m->insert_multi_value($field_stu, $value_stu);
							
							
							$value = "";
							$value_stu = "";
						}

						$i++;
					}

					if ($value != "") {
						$value = substr_replace($value, '', -1);
						$value_stu = substr_replace($value_stu, '', -1);

						// echo "<br /> V : ".$value;
						// echo "<br /> VS : ".$value_stu;

						$this->diklat_participant_m->insert_multi_value($field,$value);
						$this->student_m->insert_multi_value($field_stu, $value_stu);
					}
				}
			}
		}

		activity_log('Upload Data', 'Peserta Diklat');

		$this->db->truncate('lms_diklat_participant_temp');
		$this->db->truncate('lms_student_temp');

		redirect('peserta_diklat');
	}

	function store_BACKUP(){
		if ($this->input->post('f_save')) {
			

			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

			$config['upload_path'] 		= './excel/'; //buat folder dengan nama assets di root folder
			$config['allowed_types'] 	= 'xls|xlsx|csv';
			$config['max_size'] 		= 10000;

			$this->load->library('upload');
			$this->upload->initialize($config);


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

				$field = "(`uc`,`uc_diklat_period`,`uc_diklat_class`,`no_peserta`)";

				$uc_diklat_period = $this->input->post('f_uc_diklat_periode');
				$uc_diklat_class = $this->input->post('f_kelas');

				$i = 1;

				for ($row = 7; $row <= $highestRow; $row++){  
					//PREPARE DATA

					$rowData = $sheet->rangeToArray('C' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);

					$nomor_peserta 	= ($rowData[0][0] != NULL ? $rowData[0][0] : NULL);
					

					if (isset($nomor_peserta)) { // Check for seafarer code
						if ($curr_seafarer != $nomor_peserta) {	
							$value .= "('".unique_code()."','".$uc_diklat_period."','".$uc_diklat_class."','".trim($nomor_peserta)."'),";

							$curr_seafarer = trim($nomor_peserta);

						}else{
							$message = 'No Participant <b>'.$curr_seafarer.'</b> has exist from this Participant!';

							$this->session->set_flashdata('msg', $message);
						}

						if (($i%50) == 0) {

							$value = substr_replace($value, '', -1);
							$this->diklat_participant_m->insert_multi_value($field,$value);
							
							
							$value = "";
						}
					}
	 
					$i++;

				}
				if ($value != "") {

					$value = substr_replace($value, '', -1);
					$this->diklat_participant_m->insert_multi_value($field, $value);

				}
			}


		}

		redirect('peserta_diklat');
	}

	function edit(){
		$data = NULL;
		$uc = $this->input->post('js_uc');

		$query = $this->student_m->get_filtered(array('uc' => $uc));
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$data['diklat'] = $this->diklat_participant_m->get_filtered(array('no_peserta' => $data['row']->no_peserta))->row();
		

		$this->load->view('peserta_diklat/edit', $data);
	}

	function update(){
		if ($this->input->post('f_save')) {
			
			$uc_student = $this->input->post('f_uc_student');

			$data_student = [

				'no_peserta' => $this->input->post('f_id_number'),
				'full_name' => $this->input->post('f_full_name')
			];

			$this->student_m->update_data($data_student, array('uc' => $uc_student));

			$uc_diklat_participant = $this->input->post('f_uc_diklat_participant');

			$data_participant = [
				'uc_diklat_class' => $this->input->post('f_kelas'),
				'no_peserta' => $this->input->post('f_id_number')
			];

			$this->diklat_participant_m->update_data($data_participant, array('uc' => $uc_diklat_participant));
		}

		redirect('peserta_diklat');
	}

	function delete($$uc_part_diklat,$uc_student){

		$this->diklat_participant_m->delete_data(array('uc' => $uc_person));
		$this->student_m->delete_data(array('uc_person' => $uc_student));
		$this->user_m->delete_data(array('uc_person' => $uc_student));
		redirect('peserta_diklat');

	}

	function delete_user($uc_part_diklat,$uc_student){
		$this->diklat_participant_m->update_data(array('is_claim' => 0), array('uc' => $uc_part_diklat));
		$this->user_m->delete_data(array('uc_person' => $uc_student));


		redirect('peserta_diklat');
	}


	function add_single(){
		$this->load->view('peserta_diklat/add_single');
	}

	function store_single(){
		if ($this->input->post('f_save')) {

			$no_peserta = $this->input->post('f_id_number');

			$data_stu = [
				'uc' => unique_code(),
				'no_peserta' => $no_peserta,
				'full_name' => $this->input->post('f_full_name')
			];

			$this->student_m->insert_data($data_stu);

			$data_diklat_par = [

				'uc' => unique_code(),
				'uc_diklat_period' => $this->input->post('f_uc_diklat_periode'),
				'uc_diklat_class' => $this->input->post('f_kelas'),
				'no_peserta' => $no_peserta
			];

			$this->diklat_participant_m->insert_data($data_diklat_par);
		}

		redirect('peserta_diklat');
	}

	function changepassword(){
		$data = NULL;

		$uc = $this->input->post('js_uc');

		$category = $this->input->post('js_category');

		
		$query = $this->user_m->get_filtered(array('uc_person' => $uc));		

		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		$this->load->view('peserta_diklat/changepassword', $data);
		
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

		redirect('peserta_diklat');
	}

	
}