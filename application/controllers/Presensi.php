<?php
Class Presensi extends CI_Controller{
	function __construct(){
		parent::__construct();


		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/admin');
		}

		$this->load->model('kehadiran_m');

		$this->load->model('classroom_m');
		$this->load->model('section_m');
		$this->load->model('student_m');

		$this->each_page 	= 5;
		$this->page_int 	= 5;
	}

	function presensi_instruktur(){
		$uc_sec = $this->input->post('js_sec');
		$uc_classroom = $this->input->post('js_classroom');

        if ($uc_sec)
        {
            $status = $this->input->post('js_status');

            if($status == 1)
            {
                $data = array('is_active' => 1);
            }
            else
            {
                $data = array('is_active' => 0);
            }

            // Check if any section active
            $avai = 1;
            $query = $this->section_m->get_filtered(array('is_active' => 1,'uc_classroom' => $uc_classroom));
            if ($query->num_rows() > 0)
            {

            	$where = array('uc_classroom' => $uc_classroom);
                $this->section_m->update_data(array('is_active' => 0), $where);
                // $r_sce = $query->row();

                // if ($r_sce->uc != $uc_sec)
                // {
                //     $avai = 0;

                //     $where = array('uc_classroom' => $uc_classroom);
                // 	$this->section_m->update_data(array('is_active' => 0), $where);

                // }
            }

            

            $status = 0;

            // Update Proccess
                // if ($avai == 1)
                // {

                   
                    //ACTIVE section
                    $where = array('uc' => $uc_sec, 'uc_classroom' => $uc_classroom);
                    $this->section_m->update_data($data, $where);

               // }

            /*PRESENSI DOSEN*/

            	$this->load->model('kehadiran_m');

            	$filter_presensi = [

            		'uc_classroom' => $uc_classroom,
            		'uc_section' => $uc_sec,
            		'uc_instructor' => $this->session->userdata('log_uc_person')
            	];

            	$current_data = time_format(current_time(), 'Y-m-d');

            	$query = $this->kehadiran_m->get_data_ins($current_data,$this->session->userdata('log_uc_person'),$uc_classroom, $uc_sec);
            	if ($query->num_rows() > 0) {
            		
            		$row = $query->row();
            		//JIKA SUDAH ADA RECORDNYA UPDATE

            		if($status == 1)
		            {
		                $data_presensi = [

		            		'visit_time' => time_format(current_time(), 'Y-m-d H:i')

	            		];

	            		$this->kehadiran_m->update_data($data_presensi,$filter_presensi);
		            }
		            else
		            {	
		            	$leave_time_current = time_format(current_time(), 'Y-m-d H:i');

		            	$visit_time     	=	strtotime($row->visit_time);
				        $leave_time_last    =	strtotime($leave_time_current);
				        
				        //menghitung selisih dengan hasil detik
				        $diff    = $leave_time_last - $visit_time;

		                $data_presensi = [

		            		'leave_time' => $leave_time_current,
		            		'last_access' => time_format(current_time(), 'Y-m-d H:i'),
		            		'duration' => $diff //satuan detik
	            		];

	            		$this->kehadiran_m->update_data($data_presensi,$filter_presensi);
		            }

            	}else{
            		//INSERT PERTAMA KALI

            		$data_presensi = [
            			'uc' => unique_code(),
            			'uc_classroom' => $uc_classroom,
	            		'uc_section' => $uc_sec,
	            		'uc_instructor' => $this->session->userdata('log_uc_person'),
	            		'date_time' => time_format(current_time(), 'Y-m-d H:i'),
	            		'first_access' => time_format(current_time(), 'Y-m-d H:i'),
	            		'visit_time' => time_format(current_time(), 'Y-m-d H:i')

            		];

            		$this->kehadiran_m->insert_data($data_presensi);
            	}



            /*END PRESENSI*/

                echo json_encode($avai);
        }
	}

	function leave_section(){

		$current_data = time_format(current_time(), 'Y-m-d');

		$filter_presensi = [

    		'uc_classroom' => $this->session->userdata('sess_uc_classroom'),
    		'uc_section' =>$this->session->userdata('sess_uc_section'),
    		'uc_diklat_participant' => $this->session->userdata('log_uc_diklat_participant'),

    	];

    	$query = $this->kehadiran_m->get_data_stu($current_data,$this->session->userdata('log_uc_diklat_participant'),$this->session->userdata('sess_uc_classroom'), $this->session->userdata('sess_uc_section'));
    	if ($query->num_rows() > 0) {
    		
   //  		$row = $query->row();

			// $leave_time_current = time_format(current_time(), 'Y-m-d H:i');

	  //   	$visit_time     	=	strtotime($row->visit_time);
	  //       $leave_time_last    =	strtotime($leave_time_current);
	        
	  //       //menghitung selisih dengan hasil detik
	  //       $diff    = $leave_time_last - $visit_time;

	  //       $data_presensi = [

	  //   		'leave_time' => $leave_time_current,
	  //   		'last_access' => time_format(current_time(), 'Y-m-d H:i'),
	  //   		'duration' => ($diff+$row->duration) //satuan detik
			// ];

			// $this->kehadiran_m->update_data($data_presensi,$filter_presensi);

		}

		$data['status'] = 'success';

		echo json_encode($data);
	}

	

	function view_ins($uc_classroom = NULL, $uc_diklat_class = NULL){
		if ($uc_classroom != NULL || $uc_diklat_class != NULL) {
			$data = NULL;

			$filter = [
				'uc' => $uc_classroom,
				'uc_diklat_class' => $uc_diklat_class,
				'count' => FALSE
			];

			$data['info'] = $this->classroom_m->get_list($filter)->row();

			$page = 1;
			//	Pagination Initialization
			$this->load->library('im_pagination');
			///	Define Offset
			$offset = ($page - 1) * $this->each_page;
			//	Define Parameters
			$params = array(
								'page_number'	=> $page,
								'each_page'		=> $this->each_page,
								'page_int'		=> $this->page_int,	
								'segment' 		=> 'level',
								'model'			=> 'kehadiran_m'
							);

			$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

			$where = [

				'uc_diklat_class' => $uc_diklat_class,
				'current_date' => time_format(current_time(), 'Y-m-d')
			];

			$query = $this->kehadiran_m->get_view($where, $this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->kehadiran_m->get_view($where);			
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
			}

			$data['uc_classroom'] = $uc_classroom;

			$this->im_render->main_stu('presensi/view_ins', $data);
		}
	}

	function set_status(){
		$uc_classroom = $this->input->post('js_uc_classroom');
		$uc_student = $this->input->post('js_uc_student');
		$status = $this->input->post('js_status');

		$date_time = time_format(current_time(), 'Y-m-d H:i');

		$uc_kehadiran = $this->input->post('js_kehadiran');


		$filter = [

			'uc_classroom' => $uc_classroom,
			'uc_student' => $uc_student,
			'date_time' => time_format(current_time(), 'Y-m-d H:i:s')
		];


		if ($uc_kehadiran == "") {
			

			$data_insert = [

				'uc' => unique_code(),
				'uc_classroom' => $uc_classroom,
				'uc_instructor' => $this->session->userdata('log_uc_person'),
				'uc_student' => $uc_student,
				'status' => $status,
				'date_time' => time_format(current_time(), 'Y-m-d H:i')
			];

			$this->kehadiran_m->insert_data($data_insert);

		}else{

			$data_update = [

				'uc_instructor' => $this->session->userdata('log_uc_person'),
				'uc_student' => $uc_student,
				'status' => $status,
				'date_time' => time_format(current_time(), 'Y-m-d H:i')
			];

			$this->kehadiran_m->update_data($data_update, array('uc' => $uc_kehadiran));
		}
		
	}

	function page_ins(){
		$data = NULL;


		$page 	= ($this->input->post('js_page') != 1 ? $this->input->post('js_page') : 1);
		//	Pagination Initialization
		$this->load->library('im_pagination');
		///	Define Offset
		$offset = ($page - 1) * $this->each_page;
		//	Define Parameters
		$params = array(
							'page_number'	=> $page,
							'each_page'		=> $this->each_page,
							'page_int'		=> $this->page_int,	
							'segment' 		=> 'level',
							'model'			=> 'kehadiran_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$where = [

			'uc_diklat_class' => $uc_diklat_class,
			'current_date' => time_format(current_time(), 'Y-m-d')
		];

		$query = $this->kehadiran_m->get_view($where, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->kehadiran_m->get_view($where);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}


		$this->load->view('presensi/content_ins', $data);
	}

	function view_student($uc_classroom = NULL, $uc_diklat_class = NULL){
		if ($uc_classroom != NULL || $uc_diklat_class != NULL) {
			$data = NULL;

			$filter = [
				'uc' => $uc_classroom,
				'uc_diklat_class' => $uc_diklat_class,
				'count' => FALSE
			];

			$data['info'] = $this->classroom_m->get_list($filter)->row();

			$page = 1;
			//	Pagination Initialization
			$this->load->library('im_pagination');
			///	Define Offset
			$offset = ($page - 1) * $this->each_page;
			//	Define Parameters
			$params = array(
								'page_number'	=> $page,
								'each_page'		=> $this->each_page,
								'page_int'		=> $this->page_int,	
								'segment' 		=> 'classroom',
								'model'			=> 'classroom_m'
							);

			$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;


			$query = $this->kehadiran_m->get_filtered(array('uc_classroom' => $uc_classroom,'uc_student' => $this->session->userdata('log_uc_person')),'id','DESC',$this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->kehadiran_m->get_filtered(array('uc_classroom' => $uc_classroom,'uc_student' => $this->session->userdata('log_uc_person')));
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
			}



			$this->im_render->main_stu('presensi/view_student', $data);
		}else{
			redirecct('student/classroom');
		}


	}

	function rekap_kelas($uc_classroom = NULL, $uc_diklat_class = NULL, $type = NULL){
		$data = NULL;

		$filter = [
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		$data['student'] = $this->student_m->get_student_in_diklat_class($uc_classroom);
        $data['section'] = $this->section_m->get_section_in_classroom($uc_classroom);
        $data['kehadiran'] = $this->kehadiran_m->get_presence_in_class($uc_classroom);

        $data['uc_classroom'] = $uc_classroom;
        $data['uc_diklat_class'] = $uc_diklat_class;

        if ($type == "excel") {
        	$this->load->view('presensi/excel', $data);
        }
        else {
			$this->im_render->main_stu('presensi/rekap_kelas', $data);
        }
	}

	function student($uc_classroom = NULL, $uc_diklat_class = NULL, $type = NULL){
		$data = NULL;

		$filter = [
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$data['info'] = $this->classroom_m->get_list($filter)->row();


	    $data['section'] = $this->section_m->get_section_in_classroom($uc_classroom);
        if ($this->session->userdata('log_category') == 2) {
        	//	Instruktur
			$data['student'] = $this->student_m->get_student_in_diklat_class($uc_classroom);
        	$data['kehadiran'] = $this->kehadiran_m->get_presence_in_class($uc_classroom);
        }
        elseif ($this->session->userdata('log_category') == 3) {
        	//	Student
        }

        $data['uc_classroom'] = $uc_classroom;
        $data['uc_diklat_class'] = $uc_diklat_class;

        if ($type == "excel") {
        	$this->load->view('presensi/excel', $data);
        }
        else {
			$this->im_render->main_stu('presensi/rekap_kelas', $data);
        }
	}

	function set(){
		$data = array(
						'uc'					=> unique_code(),
						'uc_classroom' 			=> $this->input->post('f_uc_classroom'),
						'uc_section'			=> $this->input->post('f_uc_section'),
						'uc_diklat_participant'	=> $this->input->post('f_uc_dikpar'),
						'status'				=> $this->input->post('f_presence')
					);

		$filter = array(
							'uc_section'			=> $this->input->post('f_uc_section'),
							'uc_diklat_participant'	=> $this->input->post('f_uc_dikpar')
						);

		//	Cek if Exist
		$query = $this->kehadiran_m->get_filtered($filter);
		if ($query->num_rows() > 0) {
			//	If Exist, Just Update
			$this->kehadiran_m->update_data($data, $filter);
		}
		else {
			//	Insert New
			$this->kehadiran_m->insert_data($data);
		}

		redirect('presensi/rekap_kelas/'.$this->input->post('f_uc_classroom').'/'.$this->input->post('f_uc_dikclass'));
	}

	function export_rekap_kelas($uc_classroom = NULL, $uc_diklat_class = NULL){
		$pdf = new \TCPDF();
		$tanggal = date('d-m-Y');

		$pdf->AddPage('L');
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(115, 0, "Laporan Order - ".$tanggal, 0, 1, 'L');
        $pdf->SetAutoPageBreak(true, 0);

        $pdf->Output('Rekap Pertemuan - '.$tanggal.'.pdf'); 

	}
}