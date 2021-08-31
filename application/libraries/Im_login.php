<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Im_login extends CI_Controller{
	function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->library('session');
		$this->CI->load->model('user_m');
	}
	
	function verifying($username = NULL, $password = NULL){
		$filter = array(
						'username'	=> $username,
						'password'	=> $password
						);

		$query = $this->CI->user_m->get_filtered($filter);
		if($query->num_rows() > 0 ){
			$row = $query->row();
			return $row;
		}
		else{
			return FALSE;
		}
	}
	
	function is_login($session_name = NULL){
		if ($session_name != NULL) {
			if ($this->CI->session->userdata($session_name) != NULL) {
				return TRUE;

				//update last activity by id user
				
			}
			else {
				return FALSE;
			}
		}
		else {
			return FALSE;
		}
	}

	function is_admin(){
		if ($this->CI->session->userdata('log_user_category') == 1) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	function is_instructor(){
		if ($this->CI->session->userdata('log_user_category') == 2) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
}