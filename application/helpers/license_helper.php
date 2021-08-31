<?php
function get_volume_label($drive) {
	if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
		$volname = $m[1];
	} else {
		$volname = '';
	}

	return $volname;
}

function lic_verification(){
	$CI =& get_instance();
	
	// Get Volume Label	
	$server_serial = get_volume_label("DCC6-1BDD");
	
	if (md5($server_serial) == $CI->config->item('serial_code')) {
		return TRUE;
	}
	else {
		return FALSE;
	}
}
?>