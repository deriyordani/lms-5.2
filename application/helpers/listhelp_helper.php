<?php


function list_subject($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('subject_m');
	
	if ($filter != NULL) {		
		$query = $CI->subject_m->get_filtered($filter);
	}
	else {
		$query = $CI->subject_m->get_all('id','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}

function list_prodi($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('prodi_m');
	
	if ($filter != NULL) {		
		$query = $CI->prodi_m->get_filtered($filter);
	}
	else {
		$query = $CI->prodi_m->get_all('id','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}

function list_diklat($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('diklat_m');
	
	if ($filter != NULL) {		
		$query = $CI->diklat_m->get_filtered($filter);
	}
	else {
		$query = $CI->diklat_m->get_all('id','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}

function list_diklat_periode($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('diklat_period_m');
	
	if ($filter != NULL) {		
		$query = $CI->diklat_period_m->get_filtered($filter);
	}
	else {
		$query = $CI->diklat_period_m->get_all('id','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}

function list_diklat_class($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('diklat_class_m');
	
	if ($filter != NULL) {		
		$query = $CI->diklat_class_m->get_filtered($filter);
	}
	else {
		$query = $CI->diklat_class_m->get_all('id','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}

function list_dkp($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('diklat_dkp_m');
	
	if ($filter != NULL) {		
		$query = $CI->diklat_dkp_m->get_filtered($filter, 'label_dkp', 'ASC');
	}
	else {
		$query = $CI->diklat_dkp_m->get_all('label_dkp','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}

function list_section($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('section_m');
	
	if ($filter != NULL) {		
		$query = $CI->section_m->get_filtered($filter,'section_label','ASC');
	}
	else {
		$query = $CI->section_m->get_all('id','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}

function list_score($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('ass_attempt_m');
	
	if ($filter != NULL) {		
		$query = $CI->ass_attempt_m->get_filtered($filter,'id','ASC');
	}
	else {
		$query = $CI->ass_attempt_m->get_all('id','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}


function list_content_not_file($filter){
	$CI =& get_instance();
	$CI->load->model('content_files_m');

	$query = $CI->content_files_m->get_not_in_file($filter);

	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}

}

function list_content_file($filter = NULL){
	$CI =& get_instance();
	$CI->load->model('content_files_m');
	
	if ($filter != NULL) {		
		$query = $CI->content_files_m->get_filtered($filter,'id','ASC');
	}
	else {
		$query = $CI->content_files_m->get_all('id','ASC');	
	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else {
		return NULL;
	}
}



function read_title($string){
	$string = htmlspecialchars_decode(stripslashes(mb_convert_encoding($string,"HTML-ENTITIES","UTF-8")));

	return $string;
}

function read_text($string){
	$string = htmlspecialchars_decode(stripslashes($string));

	return $string;
}


?>