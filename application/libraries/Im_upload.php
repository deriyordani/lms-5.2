<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Im_upload{
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->library('upload');
		
		$this->upload_path		= './uploads/';
		$this->remove_spaces	= 'TRUE';
		$this->allowed_types	= 'jpeg|jpg|png|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|sql|zip|rar|swf|flv|mp4|mp3';
	}
	
	function uploading($form_file = NULL, $format = 'etc'){
		//	switching upload folder, depend on 'format'
		switch($format){
			case 'image'			:	$folder = 'image';			break;
			case 'photo'	:	$folder = 'photo';			break;
			case 'sound'			:	$folder = 'sound';			break;
			case 'movie'			:	$folder = 'movie';			break;
			case 'document'			:	$folder = 'document';		break;
			case 'etc'				:	$folder = 'etc';			break;
			case 'question'			: 	$folder ='question';  		break;
			case 'user'				: 	$folder ='user';  			break;
			case 'video'			:	$folder = 'video';			break;
			case 'materi'			:	$folder = 'materi';			break;
			case 'assignment'			:	$folder = 'assignment';			break;
			default					:	$folder = $format;			break;
		}
		
		//	do upload
		if($form_file != NULL){
			$config['upload_path']		= $this->upload_path.$folder;
			$config['remove_spaces'] 	= $this->remove_spaces;
			$config['allowed_types'] 	= $this->allowed_types;
			
			$this->CI->upload->initialize($config);
			if ($this->CI->upload->do_upload($form_file)){
				$upload_data =  $this->CI->upload->data();

				return $upload_data['file_name'];

			}
			else{
				$upload_data =  $this->CI->upload->data();
				return NULL;
			}
		}
		else{
			return NULL;
		}		
	}
	
	function replacing($old_file = NULL, $new_file = NULL, $format = 'etc'){
		//	switching upload folder, depend on 'format'
		switch($format){
			case 'image'	:	$folder = 'image';			break;
			case 'photo'	:	$folder = 'photo';			break;
			case 'sound'	:	$folder = 'sound';			break;
			case 'movie'	:	$folder = 'movie';			break;
			case 'document'	:	$folder = 'document';		break;
			case 'etc'		:	$folder = 'etc';			break;
			case 'question'	: 	$folder ='question';  		break;
			case 'user'		: 	$folder ='user';  			break;
			case 'video'	:	$folder = 'video';			break;
			case 'assignment'			:	$folder = 'assignment';			break;
			case 'materi'			:	$folder = 'materi';			break;
			default			:	$folder = $format;			break;
		}
		
		//	delete old file
		if($old_file != NULL){
			$path = $this->upload_path.$folder."/".$old_file;
			if (file_exists($path)){
				unlink($path);
			}	
		}
		
		return $this->uploading($new_file, $format);
	}

	function deleting($file = NULL, $format = 'etc'){
		//	switching file folder, depend on 'format'
		switch($format){
			case 'image'	:	$folder = 'image';			break;
			case 'photo'	:	$folder = 'photo';			break;
			case 'sound'	:	$folder = 'sound';			break;
			case 'movie'	:	$folder = 'movie';			break;
			case 'document'	:	$folder = 'document';		break;
			case 'etc'		:	$folder = 'etc';			break;
			case 'question'	: 	$folder ='question';	  	break;
			case 'user'		: 	$folder ='user';  			break;
			case 'video'	:	$folder = 'video';			break;
			case 'materi'			:	$folder = 'materi';			break;
			case 'assignment'			:	$folder = 'assignment';			break;
			default			:	$folder = $format;			break;
		}
		
		//	delete file
		if($file != NULL){
			$path = $this->upload_path.$folder."/".$file;
			if (file_exists($path)){
				unlink($path);
			}	
		}
	}
}