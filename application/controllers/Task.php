<?php
Class Task extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function view($type_parameter = NULL, $id = NULL){

		switch ($type_parameter) {
			case 'document': $menu = 'document'; break;
			case 'multimedia': $menu = 'multimedia'; break;
			case 'tpack': $menu = 'tpack'; break;
			case 'assigment': $menu = 'assigment'; break;
			case 'assessment': $menu = 'assessment'; break;
		
		}

		$this->$menu();
	}

	function document(){
		$this->im_render->main_stu('task/document');
	}

	function multimedia(){
		echo "sdd";
	}

	function tpack(){
		$data['page'] = '1.mp4';
		$this->im_render->main_stu('task/tpack',$data);
	}

	function tpack_page($page){
		$data = NULL;

		$data['page'] = $page.".mp4";

		$this->im_render->main_stu('task/tpack', $data);
	}

	function assigment(){
		$this->im_render->main_stu('task/assigment');
	}

	function assessment(){
		$this->im_render->main_stu('task/assessment');
	}




}