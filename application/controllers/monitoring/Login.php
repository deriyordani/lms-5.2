<?php
Class Login extends CI_COntroller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->load->view('monitoring/login');
	}

	function verifying(){
		if ($this->input->post('f_submit')) {

			$username = $this->input->post('f_username');
			$password = $this->input->post('f_password');

			$query = $this->user_m->get_prodi($username);
			if ($query->num_rows() > 0) {
				
				$row = $query->row();

				//CEK PASSWORD
				if(password_verify($password,$row->password)){

					$data = array(
						'log_uc'		=> $row->uc,
						'log_username'		=> $row->username,
						'log_full_name'		=> $row->full_name,
						'log_category' 		=> $row->category,
						'log_prodi'			=> $row->prodi
						);

					$this->session->set_userdata($data);

					redirect('monitoring/activity');

				}else{

					//FLASH Password tidak cocok
					$this->session->set_flashdata('info', $this->config->item('flash_login_password_not_match'));
					redirect('monitoring/login');
				}


			}else{
				//FLASH USERNAME TIDAK TERSEDIA
				$this->session->set_flashdata('info', $this->config->item('flash_login_username_not_ready'));
				redirect('monitoring/login');
			}
		}
	}


	function logout(){
		$this->session->sess_destroy();
		redirect('auth/login');
	}
	
}