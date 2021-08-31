<?php
//	BEGIN of TIME FORMAT
function time_format($the_time, $format){
date_default_timezone_set('Etc/GMT-7');
	return date($format, strtotime($the_time));
}
//	END of TIME FORMAT

// 	BEGIN of SMART FORM
function select_set($form_value, $exist_value){
	if($form_value == $exist_value){
		return ' selected="selected"';
	}
}

function check_set($form_value, $exist_value){
	if(is_array($exist_value)){
		foreach($exist_value as $ev){
			if($form_value == $ev){
				return ' checked="checked"';
				//break;
			}
		}	
	}
	else{
		if($form_value == $exist_value){
			return ' checked="checked"';
		}
	}
}

function radio_set($form_value, $exist_value){
	if($form_value == $exist_value){
		return ' checked="checked"';
		//break;
	}
}
//	END of SMART FORM


//	BEGIN of POST NAME
function post_name($str){
	//	remove HTML tags
	$str = strip_tags($str);
	
	//	remove these character
	$ell = array('`','~','!','@','#','$','%','^','&',';',':',"'",'\\','.','/','?', '"', ',');		
	$str = str_replace($ell, "", $str);
	
	//	remove space before and after string
	$str = trim($str);
	
	//	replace
	$str = preg_replace("![^a-z0-9]+!i", "-", $str);
	
	$str = strtolower($str);
	
	return $str;
}
//	END of POST NAME

function current_time(){	
	date_default_timezone_set('Etc/GMT-7');
	$datestring = "Y-m-d H:i:s";
	
	return date($datestring);
}

//	BEGIN of VALUE FORMAT
function value_format($value=0, $thou_sep=".", $dec_sep=",", $dec_digi=0){
	return number_format($value, $dec_digi, $dec_sep, $thou_sep);
}
//	END of VALUE FORMAT

//	BEGIN of MONTH NAME
function month_name($no = NULL){
	switch($no){
		case 1	:	$name = "Januari";		break;
		case 2	:	$name = "Februari";		break;
		case 3	:	$name = "Maret";		break;
		case 4	:	$name = "April";		break;
		case 5	:	$name = "Mei";			break;
		case 6	:	$name = "Juni";			break;
		case 7	:	$name = "Juli";			break;
		case 8	:	$name = "Agustus";		break;
		case 9	:	$name = "September";	break;
		case 10	:	$name = "Oktober";		break;
		case 11	:	$name = "November";		break;
		case 12	:	$name = "Desember";		break;		
	}
	
	return $name;
}

function combo_month($frm_var = "fMonth", $value = NULL){
	if($value != NULL){
		?>
		<select name="<?=$frm_var?>">
		<option value="">-- pilih --</option>
		<?php
			for($i=1; $i<=12; $i++){
				?><option value="<?=$i?>" <?=select_set($i, $value)?> ><?=month_name($i)?></option><?php
			}
		?></select><?
	}
	else{
		?>
		<select name="<?=$frm_var?>">
			<option value="">-- pilih --</option>
			<option value="1" selected="selected">Januari</option>
			<option value="2">Februari</option>
			<option value="3">Maret</option>
			<option value="4">April</option>
			<option value="5">Mei</option>
			<option value="6">Juni</option>
			<option value="7">Juli</option>
			<option value="8">Agustus</option>
			<option value="9">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
		</select>
		<?php	
	}
}
//	END of MONTH NAME 

//	BEGIN of UNIQUE CODE
function unique_code($unique = NULL){
date_default_timezone_set('Etc/GMT-7');
	$date = date_create();
	if ($unique == NULL) {
		$unique = rand(10,99);
	}
	$code = rand(100,999)."-".substr(date_timestamp_get($date), -5)."-".rand(10,99)."-".rand(10,99);

	return $code;
}
//	END of UNIQUE CODE


function thousand_separator($value=0, $thou_sep=".", $dec_sep=",", $dec_digi=0){
	return number_format($value, $dec_digi, $thou_sep, $dec_sep);
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}


function decryptIt($data, $key = 'DPKP-2017-OKT') {
    $key = md5($key);
    $data = base64_decode($data);
    $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,
        $key, $data, MCRYPT_MODE_CBC, md5($key));
    $decrypted = rtrim($decrypted, "\0");
    return $decrypted;
}

function encryptIt($data, $key = 'DPKP-2017-OKT') {
    $key = md5($key);
    $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256,
        $key, $data, MCRYPT_MODE_CBC, md5($key));
    $encrypted = base64_encode($encrypted);

    return $encrypted;
}

function get_category($value = NULL){
	switch($value){
		case 1	:	$name = "Pembentukan";		break;
		case 2	:	$name = "Peningkatan";		break;
		case 3	:	$name = "Short Course";		break;	
	}
	
	return $name;
}

?>