<?php
Class Account extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}
	}

	function index(){

		$data = NULL;

		$this->load->model('user_m');
		$this->load->model('student_m');
		$this->load->model('instructor_m');

		$uc_person = $this->session->userdata('log_uc');


		$type_user = $this->session->userdata('log_category');

		// echo $type_user;

		// if ($type_user == 2) {
			
		// 	$row = $this->instructor_m->get_filtered(array('uc' => $uc_person))->row();
		// }elseif ($type_user == 3) {
			
		// 	$row = $this->student_m->get_filtered(array('uc' => $uc_person))->row();
		// }

		// $data['full_name'] = ($row->full_name);

		$data['row'] = $this->user_m->get_filtered(array('uc' => $uc_person))->row();

		$this->im_render->main_stu('account/index', $data);
	}

	function update_profile(){
		if ($this->input->post('f_submit')) {

			$this->load->model('user_m');
			$this->load->model('student_m');
			$this->load->model('instructor_m');
			

			$type_user = $this->session->userdata('log_category');

			$uc_person = $this->input->post('f_uc_person');
			$uc_user = $this->input->post('f_uc_user');

			$photo_old = $this->input->post('f_photo_old');

			if ($_FILES['f_photo']['name'] != NULL) {
					
				$photo_old = $this->im_upload->replacing('f_photo_old','f_photo','photo');

			}else{

				$photo_old = $this->im_upload->uploading('f_photo','photo');
			}

			$password = $this->user_m->get_filtered(array('uc' => $uc_user))->row()->password;

			if ($this->input->post('f_password_new') == NULL) {
				$password_set = $password;
			}else{
				$password_set = password_hash($this->input->post('f_password_new'), PASSWORD_BCRYPT);
			}

			$data = [

				'username' => $this->input->post('f_username'),
				'email' => $this->input->post('f_email'),
				'password' => $password_set,
				'photo' => $photo_old

			];

			$this->user_m->update_data($data, array('uc' => $uc_user));


			// if ($type_user == 2) {
			
				
			// 	$data = [

			// 		'full_name' => $this->input->post('f_full_name')

			// 	];

			// 	$this->instructor_m->update_data($data, array('uc' => $uc_person));

			// }elseif ($type_user == 3) {
				
			// 	$data = [

			// 		'full_name' => $this->input->post('f_full_name')

			// 	];

			// 	$this->student_m->update_data($data, array('uc' => $uc_person));
			// }


			$data = array(
						
						'log_username'		=> $this->input->post('f_username'),
						'log_photo' 		=> $photo_old
						);

					$this->session->set_userdata($data);




			$this->session->set_flashdata('info', $this->config->item('flash_update'));
		}

		redirect('account');
	}
}