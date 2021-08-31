<?php
Class Forum extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function come_in(){
		$this->im_render->main_stu('class/forum_comin');
	}
}