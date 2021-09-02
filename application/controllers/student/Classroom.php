<?php
Class Classroom extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('classroom_m');

		$this->load->model('section_m');

		$this->each_page 	= 5;
		$this->page_int 	= 5;
	}

	function index(){
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

		// echo "<pre>";
		// print_r($this->session->userdata());
		// echo "</pre>";

		// echo $this->session->userdata('log_uc_diklat_class');

		$filter = [ 'uc_diklat_class' => $this->session->userdata('log_uc_diklat_class'),'count' => FALSE];

		$query = $this->classroom_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->classroom_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		

		// UPDATE LEAVE VISIT
		if ($this->session->userdata('sess_uc_classroom') != NULL) {
			
			$this->leave_section();

			///UNSET SESSION
			$data_sess_class = [

				'sess_uc_classroom' => NULL,
				'sess_uc_section' => NULL
			];


			$this->session->set_userdata($data_sess_class);

		}
		

		$this->im_render->main_stu('student/classroom/index', $data);
	}


	function leave_section(){

		$this->load->model('kehadiran_m');
		
		$current_data = time_format(current_time(), 'Y-m-d');

		$filter_presensi = [

    		'uc_classroom' => $this->session->userdata('sess_uc_classroom'),
    		'uc_section' => $this->session->userdata('sess_uc_section'),
    		'uc_diklat_participant' => $this->session->userdata('log_uc_diklat_participant'),

    	];

    	$query = $this->kehadiran_m->get_data_stu($current_data,$this->session->userdata('log_uc_diklat_participant'), $this->session->userdata('sess_uc_classroom'), $this->session->userdata('sess_uc_section'));
    	if ($query->num_rows() > 0) {
    		
    		$row = $query->row();

			$leave_time_current = time_format(current_time(), 'Y-m-d H:i');

	    	$visit_time     	=	strtotime($row->visit_time);
	        $leave_time_last    =	strtotime($leave_time_current);
	        
	        //menghitung selisih dengan hasil detik
	        $diff    = $leave_time_last - $visit_time;

	        $data_presensi = [

	    		'leave_time' => $leave_time_current,
	    		'last_access' => time_format(current_time(), 'Y-m-d H:i'),
	    		'duration' => ($diff+$row->duration) //satuan detik
			];


			//print_r($data_presensi);

			$this->kehadiran_m->update_data($data_presensi,$filter_presensi);

		}
	}


	function page(){
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
							'segment' 		=> 'classroom',
							'model'			=> 'classroom_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$filter = ['uc_diklat_class' => $this->session->userdata('log_uc_diklat_class'), 'count' => FALSE];

		$query = $this->classroom_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->classroom_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}
		

		$this->load->view('student/classroom/content', $data);
	}

	// function activity($uc_classroom = NULL, $uc_diklat_class = NULL){
	// 	$data = NULL;

	// 	$filter = [
	// 		'uc' => $uc_classroom,
	// 		'uc_diklat_class' => $uc_diklat_class,
	// 		'count' => FALSE
	// 	];

	// 	$data['info'] = $this->classroom_m->get_list($filter)->row();

	// 	// $this->load->model('kehadiran_m');

	// 	// $current_time = current_time();

	// 	// $current_date = time_format($current_time ,'Y-m-d');
	// 	// $uc_student = $this->session->userdata('log_uc_person');

	// 	// $query = $this->kehadiran_m->get_date($current_date,$uc_student);
	// 	// if ($query->num_rows() == 0) {
			
	// 	// 	$data_presensi = [

	// 	// 		'uc' => uniqid(),
	// 	// 		'uc_classroom' => $uc_classroom,
	// 	// 		'uc_instructor' => $data['info']->uc_instructor,
	// 	// 		'uc_student' => $uc_student,
	// 	// 		'status' => 1,
	// 	// 		'date_time' => $current_time
	// 	// 	];

	// 	// 	$this->kehadiran_m->insert_data($data_presensi);
	// 	// }

	// 	$this->im_render->main_stu('student/classroom/activity', $data);
	// }

	function task($uc_classroom = NULL, $uc_diklat_class = NULL){
			$data = NULL;

			$filter = [
				'uc' => $uc_classroom,
				'uc_diklat_class' => $uc_diklat_class,
				'count' => FALSE
			];

			$data['info'] = $this->classroom_m->get_list($filter)->row();

			$this->load->model('content_m');

			$query = $this->content_m->get_content_by_section($uc_classroom, $uc_diklat_class);
			if ($query->num_rows() > 0) {
				
				$result = $query->result();


				$i = 0;
	            $curr_section = NULL;

				foreach ($result as $res) {
					
					if ($curr_section != $res->uc) {
						
						$j = 0;

						$data['section'][$i]['uc'] 		= $res->uc;
						$data['section'][$i]['section_label'] 		= $res->section_label;
						$data['content'][$i][$j]['uc_content']   		= $res->uc_content;

						$data['content'][$i][$j]['uc_content']   		= $res->uc_content;
						$data['content'][$i][$j]['id_content']   		= $res->id_content;
						$data['content'][$i][$j]['seq_content']   		= $res->seq_content;
						$data['content'][$i][$j]['content_title']   	= $res->content_title;
						$data['content'][$i][$j]['content_description'] = $res->content_description;
						$data['content'][$i][$j]['category']   			= $res->category;
						$data['content'][$i][$j]['assignment_point']   	= $res->assignment_point;
						$data['content'][$i][$j]['time_open']   		= $res->time_open;
						$data['content'][$i][$j]['time_close']   		= $res->time_close;
						$data['content'][$i][$j]['create_time']				= $res->create_time;
						$data['content'][$i][$j]['file_attach']				= $res->file_attach;

						$curr_section = $res->uc;

	                    $i++;
	                    $j++;

					}else{

						$data['content'][$i-1][$j]['uc_content']   		= $res->uc_content;
						$data['content'][$i-1][$j]['id_content']   		= $res->id_content;
						$data['content'][$i-1][$j]['seq_content']   		= $res->seq_content;
						$data['content'][$i-1][$j]['content_title']   		= $res->content_title;
						$data['content'][$i-1][$j]['content_description'] 	= $res->content_description;
						$data['content'][$i-1][$j]['category']   			= $res->category;
						$data['content'][$i-1][$j]['assignment_point']   	= $res->assignment_point;
						$data['content'][$i-1][$j]['time_open']   			= $res->time_open;
						$data['content'][$i-1][$j]['time_close']   			= $res->time_close;
						$data['content'][$i-1][$j]['create_time']				= $res->create_time;
						$data['content'][$i-1][$j]['file_attach']				= $res->file_attach;

						$j++;
					}

				}



			}


			$this->load->model('kehadiran_m');

			// PRENSENSI

				//cek section is active 1 where uc classroom
				$this->load->model('section_m');
				$qs = $this->section_m->get_filtered(array('is_active' => 1, 'uc_classroom' => $uc_classroom));
				if ($qs->num_rows() > 0) {
					
					$section = $qs->row();

					$filter_presensi = [

	            		'uc_classroom' => $uc_classroom,
	            		'uc_section' => $section->uc,
	            		'uc_diklat_participant' => $this->session->userdata('log_uc_diklat_participant'),

	            	];

	            	$current_data = time_format(current_time(), 'Y-m-d');

	            	$query = $this->kehadiran_m->get_data_stu($current_data,$this->session->userdata('log_uc_diklat_participant'),$uc_classroom, $section->uc);
	            	if ($query->num_rows() > 0) {
	            		
	            		$row = $query->row();
	            		//JIKA SUDAH ADA RECORDNYA UPDATE


	        			$visit_time = time_format(current_time(), 'Y-m-d H:i');

		            	$visit_time     	=	strtotime($row->visit_time);
				        $leave_time_last    =	strtotime($row->leave_time);
				        
				        //menghitung selisih dengan hasil detik
				        $diff    = $leave_time_last - $visit_time;

						
						if ($row->leave_time != NULL) {
							$duration = ($row->duration+$diff); //satuan detik
						}else{
							$duration = (0+$diff); //satuan detik
						}


	        			$data_presensi = [

		            		'visit_time' => time_format(current_time(), 'Y-m-d H:i'),
		          

	            		];

	            		$this->kehadiran_m->update_data($data_presensi,$filter_presensi);



	            	}else{
	            		//INSERT PERTAMA KALI

	            		$data_presensi = [
	            			'uc' => uniqid(),
	            			'uc_classroom' => $uc_classroom,
		            		'uc_section' => $section->uc,
		            		'uc_diklat_participant' => $this->session->userdata('log_uc_diklat_participant'),
		            		'date_time' => time_format(current_time(), 'Y-m-d H:i'),
		            		'first_access' => time_format(current_time(), 'Y-m-d H:i'),
		            		'visit_time' => time_format(current_time(), 'Y-m-d H:i')

	            		];

	            		$this->kehadiran_m->insert_data($data_presensi);

	            		//SET SESSION UC CLASS DAN SECTION

	            		


	            		
	            	}


	            	$data_sess_class = [

	            			'sess_uc_classroom' => $uc_classroom,
	            			'sess_uc_section' => $section->uc
	            		];


	            		$this->session->set_userdata($data_sess_class);

	            		//print_r($this->session->userdata());

				}else{
					
					$this->session->set_flashdata('info', $this->config->item('flash_class_nonaktif'));

					redirect('student/classroom');
				}
			

			// END PRESENSI



			$data['uc_classroom'] = $uc_classroom;
			$data['uc_diklat_class'] = $uc_diklat_class;

			$this->im_render->main_stu('student/classroom/task', $data);
	}

	function content($parameter = NULL, $uc_classroom = NULL, $uc_diklat_class = NULL,$uc_content = NULL){

		$data = NULL;

		switch ($parameter) {
			
			case 'view_materi' : $filename = 'view_materi'; break;
			case 'view_cbt' : $filename = 'view_cbt'; break;
			case 'view_assignment' : $filename = 'view_assignment'; break;
			//case 'view_assigment_siswa' : $filename = 'view_assigment_siswa'; break;
			case 'view_link' : $filename = 'view_link'; break;
			case 'view_assessment' : $filename = 'view_assessment'; break;
			
		}


		if ($uc_content != NULL) {
			$this->load->model('content_m');

			$query = $this->content_m->get_filtered(array('uc' => $uc_content));
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
			}

			$this->load->model('comment_m');
			$query_com = $this->comment_m->get_list($uc_content);
			if ($query_com->num_rows() > 0) {
				$data['comment'] = $query_com->result();
			}


			if ($filename == 'view_assignment') {
				
				$this->load->model('assignment_score_m');

				$query = $this->assignment_score_m->get_filtered(array('uc_assignment' => $uc_content,'uc_participant' => $this->session->userdata('log_uc_person')));
				if ($query->num_rows() > 0) {

					$data['row_assign'] = $query->row();

					$data['assignment_check']  = FALSE;
				}else{

					$data['assignment_check']  = TRUE;
				}
			}


			if ($filename == 'view_assessment') {

				$this->load->model('assessment_m');
				$query = $this->assessment_m->get_list($uc_classroom,$uc_content);
				if ($query->num_rows() > 0) {
					$data['assessment'] = $query->row();
				}

			}


			$uc_tpack = $this->content_m->get_filtered(array('uc' => $uc_content))->row()->uc_tpack;

		

			$data['uc_tpack'] = $uc_tpack;

			if ($uc_tpack != NULL) {
				$this->load->model('tpack_section_m');
				$query = $this->tpack_section_m->get_filtered(array('uc_tpack' => $uc_tpack), 'sequence', 'ASC');
				if ($query->num_rows() > 0) {
					$data['section'] = $query->result();
				}

				//$this->im_render->main_stu('classroom/cbt_section',$data);
			}

		}



		$filter = [
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

	


		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;
		$data['action'] = $filename;
		$data['uc_content'] = $uc_content;

		$this->im_render->main_stu('student/classroom/'.$filename, $data);

	}


	/*ASSIGNMENT*/

		function send_assignment(){

			if ($this->input->post('f_submit')) {
				
				$uc_classroom = $this->input->post('f_uc_classroom');
				$uc_diklat_class = $this->input->post('f_uc_diklat_class');
				$uc_content = $this->input->post('f_uc_content');

				$this->load->library('upload');

				$config['upload_path'] = './uploads/assignment/';
			    $config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|zip';
			    $config['max_size'] = '5000';
			    $config['encrypt_name'] = TRUE;

			    $this->upload->initialize($config);
			   

			    if ( ! $this->upload->do_upload('f_file_attach'))
			    {
			       
			        echo  $this->upload->display_errors();
			    }
			    else
			    {
			        $upload_data =  $this->upload->data();
			        
			        $data = [

						'uc' => uniqid(),
						'uc_assignment' => $uc_content,
						'uc_participant' => $this->session->userdata('log_uc_person'),
						'file_attach' => $upload_data['file_name'],
						'submit_time' => time_format(current_time(), 'Y-m-d H:i')
					];

					$this->load->model('assignment_score_m');

					$this->assignment_score_m->insert_data($data);

					$this->session->set_flashdata('info', $this->config->item('flash_tugas_terkirim'));

					

			    }

				

			}

			redirect('student/classroom/content/view_assignment/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content);

			
		}

		function send_assignment_update(){
			if ($this->input->post('f_submit_replace')) {
				
				$uc_classroom = $this->input->post('f_uc_classroom');
				$uc_diklat_class = $this->input->post('f_uc_diklat_class');
				$uc_content = $this->input->post('f_uc_content');


				$file_att = $this->input->post('f_file_old');

				$this->load->library('upload');
				
				$config['upload_path'] = './uploads/assignment/';
			    $config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|zip';
			    $config['max_size'] = '5000';
			    $config['encrypt_name'] = TRUE;

			    $this->upload->initialize($config);


			    if (isset($_POST['f_file_old'])) {

			    	if ($_FILES['f_file_attach_update']['name'] != NULL) {
				    	$path = $config['upload_path'].$file_att;

				    	if (file_exists($path)){
							unlink($path);
						}


						if ( ! $this->upload->do_upload('f_file_attach_update'))
					    {
					       
					        echo  $this->upload->display_errors();
					    }
					    else
					    {
					        $upload_data =  $this->upload->data();
					        $file_att = $upload_data['file_name'];
					    }


				    }

			    }else{

			    	if ( ! $this->upload->do_upload('f_file_attach_update'))
				    {
				       
				        echo  $this->upload->display_errors();
				    }
				    else
				    {
				        $upload_data =  $this->upload->data();
				        $file_att = $upload_data['file_name'];
				    }
			    }


				$data = [

					'file_attach' => $file_att,
					'submit_time' => time_format(current_time(), 'Y-m-d H:i')
				];

				$this->load->model('assignment_score_m');

				$this->assignment_score_m->update_data($data, array('uc' => $this->input->post('f_uc')));

				$this->session->set_flashdata('info', $this->config->item('flash_tugas_terkirim'));

			}

			redirect('student/classroom/content/view_assignment/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content);
		}

	/*END ASSIGNMENT*/

	/*FORUM*/

	function forum($uc_classroom = NULL, $uc_diklat_class = NULL){
		if ($uc_classroom != NULL || $uc_diklat_class != NULL) {
			
			$data = NULL;


			$filter = [
				'uc' => $uc_classroom,
				'uc_diklat_class' => $uc_diklat_class,
				'count' => FALSE
			];

			$data['info'] = $this->classroom_m->get_list($filter)->row();

			
			$this->load->model('forum_m');


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
								'segment' 		=> 'forum',
								'model'			=> 'forum_m'
							);



			$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

			$where = [
				'uc_classroom' => $uc_classroom,
				'uc_diklat_class' => $uc_diklat_class,
			];

			$query = $this->forum_m->get_filtered($where,'id', 'DESC', $this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->forum_m->get_filtered($where);			
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
			}


			$data['uc_classroom'] = $uc_classroom;
			$data['uc_diklat_class'] = $uc_diklat_class;


			$this->im_render->main_stu('student/classroom/forum', $data);

		}
	}

	function page_forum(){

		$data= NULL;

		$this->load->model('forum_m');


		$page = ($this->input->post('js_page') != 1 ? $this->input->post('js_page') : 1);

		$uc_classroom = $this->input->post('js_uc_classroom');
		$uc_diklat_class = $this->input->post('js_uc_diklat_class');

		//	Pagination Initialization
		$this->load->library('im_pagination');
		///	Define Offset
		$offset = ($page - 1) * $this->each_page;
		//	Define Parameters
		$params = array(
							'page_number'	=> $page,
							'each_page'		=> $this->each_page,
							'page_int'		=> $this->page_int,	
							'segment' 		=> 'forum',
							'model'			=> 'forum_m'
						);



		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$where = [
			'uc_classroom' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
		];

		$query = $this->forum_m->get_filtered($where,'id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->forum_m->get_filtered($where);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->load->view('classroom/forum/content', $data);


		
	}

	function posting_forum(){
		if ($this->input->post('f_posting')) {
			
			$uc_classroom = $this->input->post('f_uc_classroom');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');

			$this->load->library('im_upload');

			$file_att = $this->im_upload->uploading('f_file_attach', 'materi');

			$data = [
				'uc' => uniqid(),
				'uc_classroom' => $uc_classroom,
				'uc_diklat_class' => $uc_diklat_class,
				'uc_instructor' => $this->session->userdata('log_uc_person'),
				'topic' => $this->input->post('f_topic'),
				'topic_description' => $this->input->post('f_topic_des'),
				'file_attach' => $file_att
			];

			$this->load->model('forum_m');
			$this->forum_m->insert_data($data);
		}

		redirect('student/classroom/forum/'.$uc_classroom.'/'.$uc_diklat_class);
	}

	function view_forum($uc_classroom = NULL, $uc_diklat_class = NULL, $uc_forum = NULL){

		$data = NULL;


		$filter = [
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		
		$this->load->model('forum_m');

		$query = $this->forum_m->get_filtered(array('uc' => $uc_forum));
		if ($query->num_rows() > 0) {
			
			$data['row'] = $query->row();
		}


		$this->load->model('forum_comment_m');
		$query_com = $this->forum_comment_m->get_list($uc_forum);
		if ($query_com->num_rows() > 0) {
			$data['comment'] = $query_com->result();
		}



		$this->im_render->main_stu('student/classroom/view_forum', $data);

	}


	function form_comment_forum(){
		$data = NULL;

		$data['uc_content'] = $this->input->post('js_uc_content');

	
		$this->load->view('student/classroom/form_comment',$data);

	}

	function store_comment_forum(){

		$this->load->model('forum_comment_m');

		$data = [
			'uc' => uniqid(),
			'comment' => $this->input->post('f_comment'),
			'uc_user' => $this->session->userdata('log_uc'),
			'uc_forum' => $this->input->post('f_uc_content')
		];

		$this->forum_comment_m->insert_data($data);
		
	}

	function load_comment_forum(){
		$data = NULL;

		$uc_content = $this->input->post('js_uc_content');

		$this->load->model('forum_comment_m');
		$query_com = $this->forum_comment_m->get_list($uc_content);
		if ($query_com->num_rows() > 0) {
			$data['comment'] = $query_com->result();
		}

		$this->load->view('student/classroom/forum/load_comment', $data);
	}

	/*END FORUM*/


	/*START CHAT*/

		function check_chat($uc_classroom = NULL, $uc_diklat_class = NULL){
			$data['uc_classroom'] = $uc_classroom;
	        $data['uc_user'] = $this->session->userdata('log_uc');

	        /**
	         * 1. check if the user is already registered on groups_members table
	         */

	        $this->load->model('group_members_m');
	        $check = $this->group_members_m->check($uc_classroom, $this->session->userdata('log_uc'));

	        if ($check == 1) {
	            redirect('student/classroom/massages/'.$uc_classroom.'/'.$uc_diklat_class);
	        } else {

	            $this->db->insert('lms_groups_members', $data);

	            $this->db->query("UPDATE lms_groups_chats SET total_member = total_member + 1 WHERE uc_classroom = '".$uc_classroom."'");
	            redirect('student/classroom/massages/'.$uc_classroom.'/'.$uc_diklat_class);
	        }
		}



		function massages($uc_classroom = NULL, $uc_diklat_class = NULL){

	        /* Send in chat_id and user_id */
	        $data['uc_classroom'] = $uc_classroom;
	        $data['uc_user'] = $this->session->userdata('log_uc');

	        $this->session->set_userdata('last_chat_message_id_' . $uc_classroom, 0);


			$filter = [
				'uc' => $uc_classroom,
				'uc_diklat_class' => $uc_diklat_class,
				'count' => FALSE
			];

			$data['info'] = $this->classroom_m->get_list($filter)->row();

	        $this->im_render->main_stu('student/classroom/chat', $data);

	        //$this->load->view('student/classroom/chat', $data);

	        //$this->template->load('template/main_template', 'chat/group/chat', $this->view_data);
		}

		function ajax_add_chat_message(){
			$uc_classroom = $this->input->post('chat_id');
	        $uc_user = $this->input->post('user_id');
	        $content = $this->input->post('content', true);

	        $data = [
	        	'uc' => uniqid(),
	        	'uc_classroom' => $uc_classroom,
	        	'uc_user' => $uc_user,
	        	'content' => $content
	        ];

	        $this->load->model('chats_messages_m');

	        $this->chats_messages_m->insert_data($data);


	        /* Executing the method on model */
	        echo $this->_get_chats_messages($chat_id);
		}

		public function ajax_get_chats_messages()
	    {
	        /* Posting */
	        $uc_classroom = $this->input->post('chat_id');

	        echo $this->_get_chats_messages($uc_classroom);
	    }

		function _get_chats_messages($uc_classroom){

			$this->load->model('chats_messages_m');

			$last_chat_message_id = (int) $this->session->userdata('last_chat_message_id_' . $uc_classroom);

	        /* Executing the method on model */
	        $chats_messages = $this->chats_messages_m->get_chats_messages($uc_classroom, $last_chat_message_id);
	        if ($chats_messages->num_rows() > 0) {
	        	
	        	$base_url = base_url();

	            /* Store the last chat message id */
	            $last_chat_message_id = $chats_messages->row($chats_messages->num_rows() - 1)->id;

	            $this->session->set_userdata('last_chat_message_id_' . $uc_classroom, $last_chat_message_id);

	            $chats_messages_html = "<div>";

	            foreach ($chats_messages->result() as $chats_messages) {

	            	$record = $this->db->get_where('lms_user', ['id' => $chats_messages->uc_user])->row_array();


                    if ($record['photo'] != NULL) {
                        
                        $avatar = base_url().'uploads/photo/'.$record['photo'];

                    }else{

                        $avatar = base_url().'assets/img/illustrations/profiles/profile-2.png';

                    }

                    $user_current = ($this->session->userdata('log_uc') == $chats_messages->uc_user) ? 'class="chat-message-right pb-4"' : 'class="chat-message-left pb-4"';


       //              $chats_messages_html .= '

       // 					<div class="'.$user_current.' pb-4">
							// 	<div>
							// 		<img src="'.$avatar.'" class="rounded-circle mr-1"  width="40" height="40">
									
							// 	</div>
							// 	<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
							// 		<div class="font-weight-bold mb-1">'.$chats_messages->username.'</div>
							// 		<p>'.$chats_messages->content.'</p>
							// 		<div class="text-muted small text-nowrap mt-2">'.$chats_messages->timestamp.'</div>
							// 	</div>
							// </div>

       //              ';

                    $chats_messages_html = '<div '.$user_current.' >
								<div>
									<img src="'.$avatar.'" class="rounded-circle mr-1"  width="40" height="40">
									
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">'.$chats_messages->username.'</div>
									<p>'.$chats_messages->content.'</p>
									<div class="text-muted small text-nowrap mt-2">'.$chats_messages->timestamp.'</div>
								</div>
							</div>';
	            }

	            $chats_messages_html .= "</div>";

	           

	             $result = [
		                'status'    => 'ok',
		                'content'   => $chats_messages_html,
		                'last_chat_message_id' => $last_chat_message_id
		            ];

		            return json_encode($result);
		            exit();

	        }else {
	            $result = [
	                'status'    => 'ok',
	                'content'   => '',
	                'last_chat_message_id' => $last_chat_message_id
	            ];

	            return json_encode($result);
	            exit();
        	}
		}
	/*END CHAT*/


	/*CBT*/

	function section($uc_classroom , $uc_diklat_class,$uc_content, $uc_tpack = NULL, $uc_tpack_section = NULL, $section = 1, $page = 1){

		$data = NULL;


		$filter = [
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		$data['uc_tpack'] 			= $uc_tpack;
		$data['uc_tpack_section']	= $uc_tpack_section;
		$data['section']			= $section;
		$data['video']				= $page;
		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;
		$data['uc_content'] = $uc_content;

		if ($uc_tpack_section != NULL) {
			$this->load->model('tpack_page_m');
			$query = $this->tpack_page_m->get_filtered(array('uc_tpack_section' => $uc_tpack_section), 'page', 'ASC');
			if ($query->num_rows() > 0) {
				$data['page'] = $query->result();
			}

			$this->im_render->main_stu('student/classroom/cbt_play', $data);
		}
	}
}