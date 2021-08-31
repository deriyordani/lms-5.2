<?php
Class Auth extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('user_m');
		$this->load->model('student_m');
		$this->load->model('instructor_m');


	}

	function index(){
		redirect('auth/login');
	}

	function admin(){
		$this->load->view('auth/login_admin');
	}

	function verifying_admin(){
		if ($this->input->post('f_submit')) {

			$username = trim($this->input->post('f_username'));
			$password = trim($this->input->post('f_password'));

			$query = $this->user_m->get_filtered(array('username' => $username));
			if ($query->num_rows() > 0) {
				
				$row = $query->row();

				//CEK PASSWORD
				if(password_verify($password,$row->password)){

					$data = array(
						'log_uc'		=> $row->uc,
						'log_username'		=> $row->username,
						'log_full_name'		=> $row->full_name,
						'log_category' 		=> $row->category,
						'log_uc_person' 	=> $row->uc_person,
						'log_uc_prodi' => $row->uc_prodi,
						'log_photo' => $row->photo
						);

					$this->session->set_userdata($data);

					redirect('period');

				}else{

					//FLASH Password tidak cocok
					$this->session->set_flashdata('info', $this->config->item('flash_login_password_not_match'));
					redirect('auth/admin');
				}


			}else{
				//FLASH USERNAME TIDAK TERSEDIA
				$this->session->set_flashdata('info', $this->config->item('flash_login_username_not_ready'));
				redirect('auth/admin');
			}
		}

	}

	function logout_admin(){
		$this->session->sess_destroy();
		redirect('auth/admin');
	}

	function generate_pass(){
		echo password_hash('adminlms123!', PASSWORD_BCRYPT);
	}

	function login(){
		$this->load->view('auth/login');
	}

	function verifying(){
		if ($this->input->post('f_submit')) {

			$username = $this->input->post('f_username');
			$password = $this->input->post('f_password');

			$query = $this->user_m->get_filtered(array('username' => $username));
			if ($query->num_rows() > 0) {
				
				$row = $query->row();
				$uc_user = $row->uc;
				$username = $row->username;
				$full_name = $row->full_name;
				$category = $row->category;
				$uc_person = $row->uc_person;
				$photo = $row->photo;

				//CEK PASSWORD
				if(password_verify($password,$row->password)){

					if ($category == 1) {
						$data = array(
							'log_uc'		=> $uc_user,
							'log_username'		=> $username,
							'log_full_name'		=> $full_name,
							'log_category' 		=> $category,
							'log_photo' => $photo
							);

						$this->session->set_userdata($data);

						redirect('period');

					}elseif ($category == 2) {
						
						$qins = $this->instructor_m->get_login_ins($uc_user);
						if ($qins->num_rows() > 0) {
							$qins = $query->row();
							$data = array(
								'log_uc'		=> $uc_user,
								'log_username'		=> $username,
								'log_full_name'		=> $full_name,
								'log_category' 		=> $category,
								'log_photo' => $photo,
								'log_uc_prodi' => $qins->uc_prodi,
								'log_uc_person' => $uc_person
								);

							$this->session->set_userdata($data);
						}

					}elseif ($category == 3) {
						// code...
					}
					// $data = array(
					// 	'log_uc'		=> $row->uc,
					// 	'log_username'		=> $row->username,
					// 	'log_full_name'		=> $row->full_name,
					// 	'log_category' 		=> $row->category,
					// 	'log_photo' => $row->photo
					// 	);

					// $this->session->set_userdata($data);

					// redirect('period');

				}else{

					//FLASH Password tidak cocok
					$this->session->set_flashdata('info', $this->config->item('flash_login_password_not_match'));
					redirect('auth/login');
				}


			}else{
				//FLASH USERNAME TIDAK TERSEDIA
				$this->session->set_flashdata('info', $this->config->item('flash_login_username_not_ready'));
				redirect('auth/login');
			}
			
		}
	}

	function claim($uc_user = NULL, $uc_person = NULL, $category = NULL){
		if ($uc_user != NULL) {

			$data = NULL;
			
			if ($category == 2) {
				
				$q_ins = $this->instructor_m->get_filtered(array('uc' => $uc_person));
				if ($q_ins->num_rows() > 0) {
					
					$data['rs_ins'] = $q_ins->row();
				}

				$this->load->view('auth/claim_ins', $data);

			}else{

				$q_stu = $this->student_m->get_info_student($uc_person);
				if ($q_stu->num_rows() > 0) {
					
					$data['rs_stu'] = $q_stu->row();
				}

				$this->load->view('auth/claim_stu', $data);

			}


		}else{
			redirect('auth/login');
		}
	}

	function update_claim_ins(){
		if ($this->input->post('f_claim')) {
			

			$data = ['is_claim' => 1];

			$where = ['uc' => $this->input->post('f_uc_person')];

			$this->instructor_m->update_data($data, $where);
		}


		redirect('classroom');
	}

	function update_claim_stu(){
		if ($this->input->post('f_claim')) {
			

			$data = ['is_claim' => 1];

			$where = ['no_peserta' => $this->input->post('f_no_peserta')];

			$this->load->model('diklat_participant_m');
			$this->diklat_participant_m->update_data($data, $where);
		}


		redirect('student/classroom');
	}

	function register(){
		$this->load->view('auth/register');
	}

	function store_register() {
		if ($this->input->post('f_save')) {
			$type_person = $this->input->post('f_type_user');

			$email 		= trim($this->input->post('f_email'));
			$username 	= trim($this->input->post('f_username'));
			$password 	= trim($this->input->post('f_password'));

			$uc_person = NULL;
			$uc_user = uniqid();
			$row_user = NULL;


			//	CHECK PERSON AVAILABILITY
			if ($type_person == 2) {
				//	IF INSCTRUCTOR
				$id_number = $this->input->post('f_id_number');

				$query = $this->instructor_m->get_available($id_number);
				
				if ($query->num_rows() > 0) {
					$row = $query->row();
					$uc_person 	= $row->uc;
					$full_name 	= $row->full_name;
					$is_claim	= $row->is_claim;
					$row_user	= $row->uc_user;

					if ($row_user != NULL) {
						//echo "CLAIMED";
						$this->session->set_flashdata('info', $this->config->item('flash_register_claimed'));
					}
 				}
 				else {
 					//echo "NA";
 					$this->session->set_flashdata('info', $this->config->item('flash_register_no_avail'));
 				}
			}
			
			if ($type_person == 3) {
				//	IF STUDENT
				$no_peserta = $this->input->post('f_id_number');

				$query = $this->student_m->get_available($no_peserta);

				if ($query->num_rows() > 0) {
					$row = $query->row();
					$uc_person 	= $row->uc;
					$full_name 	= $row->full_name;
					$is_claim 	= $row->is_claim;
					$row_user	= $row->uc_user;

					if ($row_user != NULL) {
						//echo "CLAIMED";
						$this->session->set_flashdata('info', $this->config->item('flash_register_claimed'));
					}
 				}
 				else {
 					//echo "NA";
 					$this->session->set_flashdata('info', $this->config->item('flash_register_no_avail'));
 				}
			}
			
			//SEND MAIL
			if (($uc_person != NULL) && ($row_user == NULL)){				
				//	If Person Available & Hasn't Claim Yet
				$this->load->library('email');

				$this->email->from('lmspoltekpelsorong2021@gmail.com', 'Administrator : LMS');

		        // Email penerima
		        $this->email->to($email);
		        $this->email->subject('Aktivasi Akun : LMS Poltekpel Sorong');

		        $data_email = [
		        	'full_name' => $full_name,
		        	'email' => $email,
		        	'uc' => $uc_user,
		        	'username' => $username,
		        	'password' => $password
		        ];

				//SEND MAIL ACTIVATION
				$msg = $this->load->view('auth/temp_email', $data_email, TRUE);

		        // Isi email
		        $this->email->message($msg);

		        //	UPDATE CLAIM STATUS
		        if ($this->email->send()) {
		        	//	If Mail Successfully Sent
		        	$this->session->set_flashdata('info', $this->config->item('flash_register'));
					
					$update_data = array('is_claim' => 1);

		        	if ($type_person == 2) {
						//	IF INSCTRUCTOR
						$filter = array('id_number' => $id_number);
						$this->instructor_m->update_data($update_data, array());
					}
						
					// if ($type_person == 3) {
					// 	//	IF STUDENT
					// 	$filter = array('no_peserta' => $no_peserta);
					// 	$this->load->model('diklat_participant_m');
					// 	$this->diklat_participant_m->update_data($update_data, $filter);
					// }
		        }
		        else {
		        	//	If Fail to Send
		        	echo  show_error($this->email->print_debugger());

		        	$this->session->set_flashdata('info', $this->config->item('flash_register_gagal'));
		        }

		        //	INSERT USER
		        $data_user  = [
					'uc' => $uc_user,
					'uc_person' => $uc_person,
					'username' => $username,
					'password' => password_hash($password, PASSWORD_BCRYPT),
					'email' => $email,
					'category' => $this->input->post('f_type_user')
				];

				$this->user_m->insert_data($data_user);
			}
		}

		redirect('auth/register');
	}

	function activation($uc_user = NULL){
		if ($uc_user != NULL) {
			
			$this->user_m->update_data(array('is_active' => 1),array('uc' => $uc_user));

			$this->session->set_flashdata('info', $this->config->item('flash_activation'));
		}

		redirect('auth/login');
	}

	function forgotPass(){
		$this->load->view('auth/forgotpass');
	}

	function send_forgot_pass(){
		if ($this->input->post('f_store')) {

			$email = $this->input->post('f_email');
			$query = $this->user_m->get_filtered(array('email' => $email));
			if ($query->num_rows() > 0) {
				
				$row = $query->row();

				$data['uc'] = $row->uc;
				$data['email'] = $row->uc;
				$data['username'] = $row->username;
				$data['time'] = time();

				//SEND MAIL ACTIVATION
				$msg = $this->load->view('auth/email_forgot_temp', $data, TRUE);

				$this->load->library('email');

				$this->email->from('lmspoltekpelsorong2021@gmail.com', 'Administrator : LMS');

		        // Email penerima
		        $this->email->to($email);
		        $this->email->subject('Password Recovery : LMS Poltekpel Sorong');


		        // Isi email
	        	$this->email->message($msg);

	        	if ($this->email->send()) {

		          $this->session->set_flashdata('info', $this->config->item('flash_send_forgot_pass'));

	    			redirect('auth/register');

		        } else {

		          //show_error($this->email->print_debugger());

		        	$this->session->set_flashdata('info', $this->config->item('flash_send_forgot_pass'));

	    			redirect('auth/register');

		        }


			}else{

				$this->session->set_flashdata('info', $this->config->item('flash_email_tidak_ditemukan'));

				redirect('auth/forgotpass');
			}
			
		}

		redirect('auth/forgotpass');
	}

	function change_password($uc = NULL, $time = NULL){
		if ($uc != NULL) {

			$cur_time = time(); //fetching current time to check with GET variable's time
			
			if ($cur_time - $time < 3600) 
			{
			 // link is not expired
				$data['uc'] = $uc;
				$data['time'] = $time;

				$this->load->view('auth/form_reset_password',$data);
			}
			else
			{
			 // link has been expired
				$this->session->set_flashdata('info', $this->config->item('flash_pass_expired'));

		    	redirect('auth/forgotpass');
			}

		}else{

			redirect('auth/forgotpass');
		}
	}

	function store_change_password(){
		if ($this->input->post('f_store')) {

			$data = [

				'password' => password_hash($this->input->post('f_password'), PASSWORD_BCRYPT)
			];

			$this->user_m->update_data($data, array('uc' => $uc));
			
			$this->session->set_flashdata('info', $this->config->item('flash_pass_success'));
		}

		redirect('auth/login');
	}

	function logout(){

		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

		// $this->user_m->update_data(array('is_online' => 0), array('uc' => $this->session->userdata('log_uc') ));

		$this->session->sess_destroy();
		redirect('auth/login');
	}
}