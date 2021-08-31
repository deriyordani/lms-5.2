<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Im_license extends CI_Controller{
	function __construct(){
		$this->CI =& get_instance();
	}

	function get_volume_label($drive) {
		if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
			$volname = $m[1];
		} else {
			$volname = '';
		}

		return $volname;
	}

	function license_valid(){
		// $CI =& get_instance();

		// $vol = str_replace("(","",str_replace(")","",$this->get_volume_label("c")));
		
	
		// if ((encryptIt($vol)) == $CI->config->item('license')) {
		// 	return TRUE;
		// }
		// else {
		// 	return FALSE;
		// }

		return TRUE;
	}
}
?>