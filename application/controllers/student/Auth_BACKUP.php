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
						'log_uc_person' 	=> $row->uc_person
						);

					$this->session->set_userdata($data);

					redirect('diklat');

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

			$query = $this->user_m->get_login($username);
			if ($query->num_rows() > 0) {
				
				$row = $query->row();

				//CEK PASSWORD
				if(password_verify($password,$row->password)){
					

					//STATUS AKTIF
					if ($row->is_active == 1) {

						//set session

						$data = array(
								'log_uc'		=> $row->uc,
								'log_username'		=> $row->username,
								'log_full_name'		=> $row->full_name,
								'log_email'			=> $row->email,
								'log_category' 		=> $row->category,
								'log_uc_person' 	=> $row->uc_person,
								'log_uc_diklat_participant' => $row->uc_diklat_participant,
								'log_uc_diklat_period' => $row->uc_diklat_period,
								'log_uc_diklat_class' => $row->uc_diklat_class,
								'log_uc_prodi' => $row->uc_prodi,
								'log_photo' => $row->photo
								);


						//UPDATE LAST LOGIN

						$this->user_m->update_data(array('is_online' => 1,'last_login' => time_format(current_time(),'Y-m-d H:i')), array('uc' => $row->uc ));

						$this->session->set_userdata($data);
						
						if ($row->is_claim == 1) {

							if ($row->category == 1) {
								redirect('diklat');
							}
							
							if ($row->category == 2) {
								//redirect instruktur
								redirect('classroom');
							}

							if ($row->category == 3) {
								//redirect student
								redirect('student/classroom');
							}

							if ($row->category == 4) {
								//redirect student
								redirect('subject');
							}

						}

						if ($row->is_claim == 0) {
							//munculkan informasi klaim data

							redirect('auth/claim/'.$row->uc.'/'.$row->uc_person.'/'.$row->category);

						}
						

					}else{

						//FLASH AKUN BELUM AKTIF
						$this->session->set_flashdata('info', $this->config->item('flash_login_akun_not_ready'));
						redirect('auth/login');

					}


				}
				else{

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
			
			//SEND MAIL

			$this->load->library('email');

			$this->email->from('lmspoltekpelsorong2021@gmail.com', 'Administrator : LMS');

	        // Email penerima
	        $this->email->to($email);
	        $this->email->subject('Aktivasi Akun : LMS Poltekpel Sorong');

	        $data_email = [

	        	'full_name' => $fullname,
	        	'email' => $email,
	        	'uc' => $uc_user,
	        	'username' => $this->input->post('f_username'),
	        	'password' => $this->input->post('f_password')
	        	

	        ];

			//SEND MAIL ACTIVATION
			$msg = $this->load->view('auth/temp_email', $data_email, TRUE);

	        // Isi email
	        $this->email->message($msg);

	        if ($this->email->send()) {

	          $this->session->set_flashdata('info', $this->config->item('flash_register'));


	          	//insert to person

				$type_person = $this->input->post('f_type_user');

				$email = trim($this->input->post('f_email'));
				$fullname = $this->input->post('f_nama_lengkap');

				$uc_person = uniqid();

				if ($type_person == 2) {

					$id_number = $this->input->post('f_nik');

					//$query = $this->instructor_m->get_filtered(array('id_number' => $id_number));
					$query = $this->instructor_m->get_id_number($id_number);
					if ($query->num_rows() > 0) {

						$uc_person = $query->row()->uc;
						
						//UPDATE DATA TO instruktur

						$data_ins = [
							
							'full_name' => $fullname
						];

						$this->instructor_m->update_data($data_ins, array('id_number' => $id_number));
					}
					
					
				}

				// if ($type_person == 3) {
					
				// 	//INSERT TO Taruna

				// 	$data_taruna = [
				// 		'uc' => $uc_person,
				// 		'no_peserta' => trim($this->input->post('f_nomor_peserta')),
				// 		'full_name' => $fullname,
						
				// 	];

				// 	$this->student_m->insert_data($data_taruna);
				// }

				//insert to USER
				$uc_user = uniqid();

				$data_user  = [
					'uc' => $uc_user,
					'uc_person' => $uc_person,
					'username' => $this->input->post('f_username'),
					'password' => password_hash($this->input->post('f_password'), PASSWORD_BCRYPT),
					'email' => $email,
					'category' => $this->input->post('f_type_user')
				];

				$this->user_m->insert_data($data_user);

    			redirect('auth/register');

	        } else {

	        	echo  show_error($this->email->print_debugger());

	        	$this->session->set_flashdata('info', $this->config->item('flash_register_gagal'));

    			redirect('auth/register');

	        }
		}

		redirect('register');
	}

	function store_register_BACKUP(){
		if ($this->input->post('f_save')) {
			
			//insert to person

			$type_person = $this->input->post('f_type_user');

			$email = trim($this->input->post('f_email'));
			$fullname = $this->input->post('f_nama_lengkap');

			$uc_person = uniqid();

			if ($type_person == 2) {

				$id_number = $this->input->post('f_nik');

				//$query = $this->instructor_m->get_filtered(array('id_number' => $id_number));
				$query = $this->instructor_m->get_id_number($id_number);
				if ($query->num_rows() > 0) {

					$uc_person = $query->row()->uc;
					
					//UPDATE DATA TO instruktur

					$data_ins = [
						
						'full_name' => $fullname
					];

					$this->instructor_m->update_data($data_ins, array('id_number' => $id_number));
				}
				
				
			}

			if ($type_person == 3) {
				
				//INSERT TO Taruna

				$data_taruna = [
					'uc' => $uc_person,
					'no_peserta' => trim($this->input->post('f_nomor_peserta')),
					'full_name' => $fullname,
					
				];

				$this->student_m->insert_data($data_taruna);
			}

			//insert to USER
			$uc_user = uniqid();

			$data_user  = [
				'uc' => $uc_user,
				'uc_person' => $uc_person,
				'username' => $this->input->post('f_username'),
				'password' => password_hash($this->input->post('f_password'), PASSWORD_BCRYPT),
				'email' => $email,
				'category' => $this->input->post('f_type_user')
			];

			$this->user_m->insert_data($data_user);

			//SEND MAIL

			$this->load->library('email');

			$this->email->from('lmspoltekpelsorong2021@gmail.com', 'Administrator : LMS');

	        // Email penerima
	        $this->email->to($email);
	        $this->email->subject('Aktivasi Akun : LMS Poltekpel Sorong');

	        $data_email = [

	        	'full_name' => $fullname,
	        	'email' => $email,
	        	'uc' => $uc_user,
	        	'username' => $this->input->post('f_username'),
	        	'password' => $this->input->post('f_password')
	        	

	        ];

			//SEND MAIL ACTIVATION
			$msg = $this->load->view('auth/temp_email', $data_email, TRUE);

	        // Isi email
	        $this->email->message($msg);

	        if ($this->email->send()) {

	          $this->session->set_flashdata('info', $this->config->item('flash_register'));

    			redirect('auth/register');

	        } else {

	        echo  show_error($this->email->print_debugger());

	        	$this->session->set_flashdata('info', $this->config->item('flash_register_gagal'));

    			redirect('auth/register');

	        }


			
		}

		redirect('register');
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

		$this->user_m->update_data(array('is_online' => 0), array('uc' => $this->session->userdata('log_uc') ));

		$this->session->sess_destroy();
		redirect('auth/login');
	}
}