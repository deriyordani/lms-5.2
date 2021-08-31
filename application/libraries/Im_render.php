<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Im_render extends CI_Controller{
	function __construct(){
		$this->CI =& get_instance();			
	}
	
	function main($view_page, $data = NULL){
		$data['view_page'] = $view_page;
		if($data != NULL){
			$this->CI->load->view('envi/main', $data);	
		}
		else{
			$this->CI->load->view('envi/main');
		}
	}

	function main_stu($view_page, $data = NULL){
		$data['view_page'] = $view_page;
		if($data != NULL){
			$this->CI->load->view('envi_student/main', $data);	
		}
		else{
			$this->CI->load->view('envi_student/main');
		}
	}
	
	function main_admin($view_page, $data = NULL){
		$data['view_page'] = $view_page;
		if($data != NULL){
			$this->CI->load->view('admin/envi_admin/main', $data);	
		}
		else{
			$this->CI->load->view('admin/envi_admin/main');
		}
	}
}
?>