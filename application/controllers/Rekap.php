<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model');
        $this->load->model('kehadiran_model');
        $this->load->model('section_model');
    }

	public function index()
	{
        $data['student'] = $this->student_model->get_student_in_diklat_class("606bcfaae0454");
        $data['section'] = $this->section_model->get_section_in_classroom("606bcfaae0454");
        $data['kehadiran'] = $this->kehadiran_model->get_presence_in_class("606bcfaae0454");

		$this->load->view('rekap_view', $data);
	}
}
?>