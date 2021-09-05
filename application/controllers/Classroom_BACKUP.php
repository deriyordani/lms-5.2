<?php
Class Classroom extends CI_Controller{
	function __construct(){
		parent::__construct();

		if ((!$this->im_login->is_login('log_username'))) {
			redirect('auth/login');
		}

		$this->load->model('classroom_m');

		$this->load->model('section_m');

		$this->each_page 	= 10;
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

		$filter = ['uc_instructor' => $this->session->userdata('log_uc_person'), 'count' => FALSE,'is_exist' => 1];

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
		

		$this->im_render->main('classroom/index', $data);
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

		$filter = ['uc_instructor' => $this->session->userdata('log_uc_person'), 'count' => FALSE,'is_exist' => 1];

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
		

		$this->load->view('classroom/content', $data);
	}

	function add(){
		$this->load->view('classroom/add');
	}

	function store(){
		if ($this->input->post('f_save')) {

			$uc_class = unique_code();

			$uc_subject = $this->input->post('f_subject');
			
			$data = [

				'uc' => $uc_class,
				'uc_diklat_class' => $this->input->post('f_kelas'),
				'uc_subject' => $uc_subject,
				'uc_instructor' => $this->session->userdata('log_uc_person'),
				'classroom_title' => $this->input->post('f_class_title'),
				'classroom_code' => $this->input->post('f_class_code'),
			];

			$this->classroom_m->insert_data($data);



			$jml_section = $this->input->post('f_section');

			for ($i=1; $i <= $jml_section ; $i++) { 
				

				$data_section = [

					'uc' => unique_code(),
					'section_label' => 'Pertemuan Ke '.$i,
					'uc_classroom' => $uc_class,
					'sequence' => $i
				];

				$this->section_m->insert_data($data_section);

			}


			//INSERT CBT PESAWAT BANTU
			if ($uc_subject == '6049849edd95c') {
				
				$uc_section = $this->section_m->get_filtered(array('uc_classroom' => $uc_class),'id','ASC',0,1)->row()->uc;
				
				$seq = $this->section_m->get_seq_content($uc_class, $uc_section)->row();

				$data_content = [

					'uc' => unique_code(),
					'uc_classroom' => $uc_class,
					'uc_section' => $uc_section,
					'category' => 1,
					'sequence' => ($seq+1),
					'content_title' => 'CBT Pesawat Bantu',
					'content_description' => 'Materi Pesawat Bantu',
					'uc_tpack' => 'p01'
				];

				$this->load->model('content_m');

				$this->content_m->insert_data($data_content);
			}

			

			$this->session->set_flashdata('info', $this->config->item('flash_success'));
		}

		redirect('classroom');
	}

	function participant($uc_class = NULL, $uc_diklat_class = NULL){
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
							'segment' 		=> 'participant',
							'model'			=> 'student_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$filter = ['uc_instructor' => $this->session->userdata('log_uc_person'), 'count' => FALSE];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		$this->load->model('student_m');
		$query = $this->student_m->get_participant_by_diklat_class($uc_diklat_class,$this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->student_m->get_participant_by_diklat_class($uc_diklat_class);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}

		$this->im_render->main_stu('classroom/participant', $data);
	}

	function page_participant(){

	}

	function manage(){
		$data = NULL;

		$filter = ['uc_instructor' => $this->session->userdata('log_uc_person'), 'count' => FALSE];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		$this->im_render->main_stu('classroom/manage', $data);
	}

	function activity($uc_classroom = NULL, $uc_diklat_class = NULL){
		$data = NULL;

		$filter = [
			'uc_instructor' => $this->session->userdata('log_uc_person'),
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		$this->im_render->main_stu('classroom/activity', $data);
	}

	function task($uc_classroom = NULL, $uc_diklat_class = NULL){

		$data = NULL;

		$filter = [
			'uc_instructor' => $this->session->userdata('log_uc_person'),
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
					$data['section'][$i]['is_active']				= $res->is_active;

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

		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;

		$this->im_render->main_stu('classroom/task', $data);
	}

	function content($parameter = NULL, $uc_classroom = NULL, $uc_diklat_class = NULL,$uc_content = NULL){

		$data = NULL;

		switch ($parameter) {
			case 'add_materi' : $filename = 'add_materi'; break;
			case 'add_cbt' : $filename = 'add_cbt'; break;
			case 'add_assigment' : $filename = 'add_assigment'; break;
			case 'add_link' : $filename = 'add_link'; break;
			case 'add_assessment' : $filename = 'add_assessment'; break;
			case 'edit_materi' : $filename = 'edit_materi'; break;
			case 'edit_cbt' : $filename = 'edit_cbt'; break;
			case 'edit_assigment' : $filename = 'edit_assigment'; break;
			case 'edit_link' : $filename = 'edit_link'; break;
			case 'edit_assessment' : $filename = 'edit_assessment'; break;
			case 'view_materi' : $filename = 'view_materi'; break;
			case 'view_cbt' : $filename = 'view_cbt'; break;
			case 'view_assigment' : $filename = 'view_assigment'; break;
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

			if ($filename == 'view_assessment') {

				$this->load->model('assessment_m');
				$query = $this->assessment_m->get_list($uc_classroom,$uc_content);
				if ($query->num_rows() > 0) {
					$data['assessment'] = $query->row();
				}

			}
		}




		$filter = [
			'uc_instructor' => $this->session->userdata('log_uc_person'),
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		


		


		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;
		$data['action'] = $filename;
		$data['uc_content'] = $uc_content;

		$this->im_render->main_stu('classroom/'.$filename, $data);

	}

	function add_materi($uc_classroom = NULL, $uc_diklat_class = NULL){

		$data = NULL;


		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;

		$this->im_render->main_stu('classroom/add_materi', $data);

	}

	

	function store_content(){
		if ($this->input->post('f_store')) {
			
			$uc_classroom = $this->input->post('f_uc_class');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');


			$this->load->library('upload');

			$config['upload_path'] = './uploads/materi/';
		    $config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|mp4|mp3|jpg|jpeg|png';
		    //$config['max_size'] = 1024;
		    $config['encrypt_name'] = TRUE;

		    $this->upload->initialize($config);
		   

		    if ( ! $this->upload->do_upload('f_lampiran'))
		    {
		       
		        echo  $this->upload->display_errors();
		    }
		    else
		    {
		        $upload_data =  $this->upload->data();
		        $file_att = $upload_data['file_name'];

			    

		    }

		    	$seq = 0;

				$uc_section = $this->input->post('f_section');
				$seq = $this->section_m->get_seq_content($uc_classroom, $uc_section)->row();

				$data = [

					'uc' => unique_code(),
					'uc_classroom' => $uc_classroom,
					'uc_section' => $uc_section,
					'content_title' => $this->input->post('f_judul'),
					'content_description' => $this->input->post('f_deskripsi'),
					'category' => $this->input->post('f_category'),
					'uc_tpack' => $this->input->post('f_tpack'),
					'file_attach' => $file_att,
					'link' => $this->input->post('f_link'),
					'assignment_point' => $this->input->post('f_point'),
					'time_open' => ($this->input->post('f_time_open') != NULL ? time_format($this->input->post('f_time_open'),'Y-m-d H:i' ) : NULL),
					'time_close' => ($this->input->post('f_time_open') != NULL ? time_format($this->input->post('f_time_close'),'Y-m-d H:i' ) : NULL),
					'sequence' => ($seq+1)
				];

				$this->load->model('content_m');

				$this->content_m->insert_data($data);


			//$this->load->library('im_upload');

			//$file_att = $this->im_upload->uploading('f_lampiran', 'materi');

			
		}

		redirect('classroom/task/'.$uc_classroom.'/'.$uc_diklat_class);
	}

	function update_content(){
		if ($this->input->post('f_store')) {
			
			$uc_classroom = $this->input->post('f_uc_class');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');


			$file_att = $this->input->post('f_lampiran_old');

			$this->load->library('upload');
			
			$config['upload_path'] = './uploads/materi/';
		    $config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|mp4|mp3|jpg|jpeg|png';
		    //$config['max_size'] = '5000';
		    $config['encrypt_name'] = TRUE;

		    $this->upload->initialize($config);


		    if (isset($_POST['f_lampiran_old'])) {

		    	if ($_FILES['f_lampiran']['name'] != NULL) {
			    	$path = $config['upload_path'].$file_att;

			    	if ($file_att != NULL) {
			    		if (file_exists($path)){
							unlink($path);
						}
			    	}
			    	


					if ( ! $this->upload->do_upload('f_lampiran'))
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

		    	if ( ! $this->upload->do_upload('f_lampiran'))
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

		
					'content_title' => $this->input->post('f_judul'),
					'content_description' => $this->input->post('f_deskripsi'),
					'category' => $this->input->post('f_category'),
					'uc_tpack' => $this->input->post('f_tpack'),
					'file_attach' => $file_att,
					'link' => $this->input->post('f_link'),
					'assignment_point' => $this->input->post('f_point'),
					'time_open' => time_format($this->input->post('f_time_open'),'Y-m-d H:i' ),
					'time_close' => time_format($this->input->post('f_time_close'),'Y-m-d H:i' )
				];

				$this->load->model('content_m');

				$this->content_m->update_data($data, array('uc' => $this->input->post('f_uc')));


			
		}

		redirect('classroom/task/'.$uc_classroom.'/'.$uc_diklat_class);
	}


	function delete($uc_classroom = NULL){
		if ($uc_classroom != NULL) {
			$this->load->model('content_m');

			$this->classroom_m->update_data(array('is_exist' => 0), array('uc' => $uc_classroom));
		}

		redirect('classroom');

	}

	function delete_content($uc_classroom = NULL, $uc_diklat_class = NULL, $uc_content = NULL){
		if ($uc_content != NULL) {
			$this->load->model('content_m');

			$this->content_m->update_data(array('is_exist' => 0), array('uc' => $uc_content));
		}

		redirect('classroom/task/'.$uc_classroom.'/'.$uc_diklat_class);

	}


	function form_comment(){
		$data = NULL;

		$data['uc_content'] = $this->input->post('js_uc_content');

	
		$this->load->view('classroom/form_comment',$data);

	}

	function store_comment(){

		$this->load->model('comment_m');

		$data = [
			'uc' => unique_code(),
			'comment' => $this->input->post('f_comment'),
			'uc_user' => $this->session->userdata('log_uc'),
			'uc_content' => $this->input->post('f_uc_content')
		];

		$this->comment_m->insert_data($data);
		
	}

	function load_comment(){
		$data = NULL;

		$uc_content = $this->input->post('js_uc_content');

		$this->load->model('comment_m');
		$query_com = $this->comment_m->get_list($uc_content);
		if ($query_com->num_rows() > 0) {
			$data['comment'] = $query_com->result();
		}

		$this->load->view('classroom/load_comment', $data);
	}


	/*START ASSIGNMENT*/

		function add_assigment($uc_classroom = NULL, $uc_diklat_class = NULL){

			$data = NULL;



			$data['uc_classroom'] = $uc_classroom;
			$data['uc_diklat_class'] = $uc_diklat_class;

			$this->im_render->main_stu('classroom/assignment/add_assigment', $data);
		}

		function tugas_terkumpul($uc_classroom = NULL, $uc_diklat_class = NULL,$uc_content = NULL){
			$filter_info = [
				'uc_instructor' => $this->session->userdata('log_uc_person'),
				'uc' => $uc_classroom,
				'uc_diklat_class' => $uc_diklat_class,
				'count' => FALSE
			];

			$data['info'] = $this->classroom_m->get_list($filter_info)->row();



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
								'segment' 		=> 'assignment_score',
								'model'			=> 'Assigment_score_m'
							);



			$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

			$this->load->model('assignment_score_m');

			$filter = [
				'uc_assignment' => $uc_content,
				'count' => FALSE
			];

			$query = $this->assignment_score_m->get_score($filter, $this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->assignment_score_m->get_score($filter);			
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
			}

		


			$data['uc_classroom'] = $uc_classroom;
			$data['uc_diklat_class'] = $uc_diklat_class;
			$data['uc_content'] = $uc_content;

			$this->im_render->main_stu('classroom/assignment/view_assigment_siswa', $data);
		}

		function page_assig_siswa(){
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
								'segment' 		=> 'assignment_score',
								'model'			=> 'Assigment_score_m'
							);



			$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

			$this->load->model('assignment_score_m');

			$filter = [
				'uc_assignment' => $uc_content,
				'count' => FALSE
			];

			$query = $this->assignment_score_m->get_score($filter, $this->each_page, $offset);
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$query = $this->assignment_score_m->get_score($filter);			
			if ($query->num_rows() > 0) {
				$params['total_record'] = $query->num_rows();
				$data['pagination'] 	= $this->im_pagination->render_ajax($params);
				$data['total_record'] 	= $query->num_rows();
			}

			$this->load->view('classroom/assignment/content_assig_siswa', $data);
		}

		function nilai_assignment(){

			$uc = $this->input->post('js_uc');
			$uc_classroom = $this->input->post('js_classroom');
			$uc_diklat_class = $this->input->post('js_diklat_class');

			$this->load->model('assignment_score_m');
			$query = $this->assignment_score_m->get_filtered(array('uc' => $uc));
			if ($query->num_rows() > 0) {
				
				$data['row'] = $query->row();
			}

			$data['uc_classroom'] = $uc_classroom;
			$data['uc_diklat_class'] = $uc_diklat_class;

			$this->load->view('classroom/assignment/nilai_assignment', $data);
		}

		function store_nilai_assignment(){
			if ($this->input->post('f_save')) {

				$uc = $this->input->post('f_uc');
				$uc_classroom = $this->input->post('f_uc_classroom');
				$uc_diklat_class = $this->input->post('f_uc_cdiklat_class');
				$uc_content = $this->input->post('f_uc_content');

				$data = [
					'score' => $this->input->post('f_nilai'),
					'comment' => $this->input->post('f_komentar')
				];

				$this->load->model('assignment_score_m');

				$this->assignment_score_m->update_data($data, array('uc' => $uc));

			}

			redirect('classroom/tugas_terkumpul/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content);
		}

	/*END ASSIGNMENT*/

	/*START PRESENSI*/

	function presensi($uc_classroom = NULL, $uc_diklat_class = NULL){

	}

	/*END PRESENSI*/
	


	/*START FORUM*/

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


			$this->im_render->main_stu('classroom/forum/index', $data);

		}
		// $this->im_render->main('class/forum');
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
				'uc' => unique_code(),
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

		redirect('classroom/forum/'.$uc_classroom.'/'.$uc_diklat_class);
	}

	function view_forum($uc_classroom = NULL, $uc_diklat_class = NULL, $uc_forum = NULL, $uc_group = NULL){

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

		// $this->load->model('Fparticipant_m');

		// $filter = array('uc_fgroup' => $uc_forum);
		// $query = $this->Fparticipant_m->get_checked_list($filter, 'uc_fgroup', 'lms_diklat_participant');
		// $data['interest'] = $query->result();

		$this->load->model('diklat_participant_m');
		$query = $this->diklat_participant_m->get_student_by_diklat($uc_diklat_class);
		if ($query->num_rows() > 0) {
			$data['participant'] = $query->result();
		}


		$this->load->model('fgroup_m');

		$data['kelompok'] = $this->fgroup_m->get_all()->result();


		$data['uc_forum'] = $uc_forum;
		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;

		if ($uc_group != NULL) {

			$this->load->model('fparticipant_m');
			$data['group'] = $this->fparticipant_m->get_group($uc_group)->result();
			
			$this->im_render->main_stu('classroom/forum/view_group', $data);
		}else{
			$this->im_render->main_stu('classroom/forum/view_forum', $data);
		}

		

	}


	function form_comment_forum(){
		$data = NULL;

		$data['uc_content'] = $this->input->post('js_uc_content');

	
		$this->load->view('classroom/forum/form_comment',$data);

	}

	function store_comment_forum(){

		$this->load->model('forum_comment_m');

		$data = [
			'uc' => unique_code(),
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

		$this->load->view('classroom/forum/load_comment', $data);
	}

	function create_group(){
		if ($this->input->post('f_create_group')) {
			
			$uc_classroom = $this->input->post('f_uc_classroom');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');
			$uc_forum = $this->input->post('f_uc_forum');

			$uc_group = unique_code();

			$group_data = [

				'uc' => $uc_group,
				'uc_forum' => $uc_forum,
				'group_name' => $this->input->post('f_group_name')
			];

			$this->load->model('fgroup_m');
			$this->fgroup_m->insert_data($group_data);

			$uc_dikalat_participant = "";
			foreach ($this->input->post('f_participant') as $pt) {
				$uc_dikalat_participant .= "'".$pt."',";
				//$val .= " ('".$uc_group."', '".$pt."', '".."'),";
			}


			$uc_dikalat_participant = substr($uc_dikalat_participant, 0, -1);


			$this->load->model('diklat_participant_m');

			$query  = $this->diklat_participant_m->get_participant_by_forum($uc_dikalat_participant);
			if ($query->num_rows() > 0) {

				$participan = "";

				foreach ($query->result() as $val) {
					$participan .= "('".unique_code()."', '".$uc_group."', '".$val->uc."','".$val->uc_student."'),";
				}

				$participan = substr($participan, 0, -1);


				$this->load->model('fparticipant_m');

				$field = "(`uc`, `uc_fgroup`, `uc_diklat_participant`, `uc_student`)";

				$this->fparticipant_m->insert_multi_value($field, $participan);
			}




		}

		redirect('classroom/view_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_forum);
	}

	function edit_group_forum(){

		$data = NULL;
		$uc_classroom = $this->input->post('js_uc_classroom');
		$uc_diklat_class = $this->input->post('js_uc_diklat_class');
		$uc_forum = $this->input->post('js_uc_forum');

		$uc_group = $this->input->post('js_uc_group');
		// //	Get Interest List AND Selected Item
		$filter = array('uc_fgroup' => $uc_group);


		$this->load->model('fgroup_m');
		$data['group'] = $this->fgroup_m->get_filtered(array('uc' => $uc_group))->row();

		$this->load->model('fparticipant_m');

		$query = $this->fparticipant_m->get_checkedlist($uc_group, $uc_diklat_class);
		$data['participant'] = $query->result();


		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;
		$data['uc_forum'] = $uc_forum;
		$data['uc_group'] = $uc_group;

		$this->load->view('classroom/forum/edit_group', $data);
	}

	function update_group_forum(){
		if ($this->input->post('f_update_group')) {
			
			$uc_classroom = $this->input->post('f_uc_classroom');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');
			$uc_forum = $this->input->post('f_uc_forum');
			$uc_group = $this->input->post('f_uc_group');

			$group_data = [

				'group_name' => $this->input->post('f_group_name')
			];

			$this->load->model('fgroup_m');
			$this->fgroup_m->update_data($group_data, array('uc' => $uc_group));

			$uc_dikalat_participant = "";
			foreach ($this->input->post('f_participant') as $pt) {
				$uc_dikalat_participant .= "'".$pt."',";
				//$val .= " ('".$uc_group."', '".$pt."', '".."'),";
			}


			$uc_dikalat_participant = substr($uc_dikalat_participant, 0, -1);


			$this->load->model('diklat_participant_m');

			//delete dulu

			$this->diklat_participant_m->delete_data(array('uc_fgroup' => $uc_group));

			$query  = $this->diklat_participant_m->get_participant_by_forum($uc_dikalat_participant);
			if ($query->num_rows() > 0) {

				$participan = "";

				foreach ($query->result() as $val) {
					$participan .= "('".unique_code()."', '".$uc_group."', '".$val->uc."','".$val->uc_student."'),";
				}

				$participan = substr($participan, 0, -1);


				$this->load->model('fparticipant_m');

				$field = "(`uc`, `uc_fgroup`, `uc_diklat_participant`, `uc_student`)";

				$this->fparticipant_m->insert_multi_value($field, $participan);
			}
		}

		redirect('classroom/view_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_forum);
	}

	function delete_group_forum($uc_classroom = NULL, $uc_diklat_class = NULL, $uc_forum = NULL, $uc_group = NULL){
		if ($uc_group != NULL) {
			
			$this->load->model('fgroup_m');
			$this->load->model('fparticipant_m');

			$this->fgroup_m->delete_data(array('uc' => $uc_group));

			$this->fparticipant_m->delete_data(array('uc_fgroup' => $uc_group));

			$this->session->set_flashdata('info', $this->config->item('flash_delete'));
		}

		redirect('classroom/view_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_forum);
	}

	/*END FORUM*/


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

			$this->im_render->main_stu('classroom/cbt_play', $data);
		}
	}

	// function view_cbt($uc_classroom = NULL, $uc_diklat_class = NULL, $uc_content = NULL){
	// 	$data = NULL;


	// 	$filter = [
	// 		'uc' => $uc_classroom,
	// 		'uc_diklat_class' => $uc_diklat_class,
	// 		'count' => FALSE
	// 	];

	// 	$data['info'] = $this->classroom_m->get_list($filter)->row();



		
	// }

	/*END CBT*/

	/*CHAT*/

	function check_chat($uc_classroom = NULL, $uc_diklat_class = NULL){
			$data['uc_classroom'] = $uc_classroom;
	        $data['uc_user'] = $this->session->userdata('log_uc');

	        /**
	         * 1. check if the user is already registered on groups_members table
	         */

	        $this->load->model('group_members_m');
	        $check = $this->group_members_m->check($uc_classroom, $this->session->userdata('log_uc'));

	        if ($check == 1) {
	            redirect('classroom/massages/'.$uc_classroom.'/'.$uc_diklat_class);
	        } else {

	            $this->db->insert('lms_groups_members', $data);

	            $this->db->query("UPDATE lms_groups_chats SET total_member = total_member + 1 WHERE uc_classroom = '".$uc_classroom."'");
	            redirect('classroom/massages/'.$uc_classroom.'/'.$uc_diklat_class);
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

	        $this->im_render->main_stu('classroom/chat', $data);

	        //$this->load->view('student/classroom/chat', $data);

	        //$this->template->load('template/main_template', 'chat/group/chat', $this->view_data);
		}

		function ajax_add_chat_message(){
			$uc_classroom = $this->input->post('chat_id');
	        $uc_user = $this->input->post('user_id');
	        $content = $this->input->post('content', true);

	        $data = [
	        	'uc' => unique_code(),
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

	/*ASSESSMENT*/
	function store_assessment(){
		if ($this->input->post('f_store')) {
			
			$uc_classroom = $this->input->post('f_uc_class');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');


		    $seq = 0;

		    $uc_content = unique_code();

			$uc_section = $this->input->post('f_section');
			$seq = $this->section_m->get_seq_content($uc_classroom, $uc_section)->row()->sequence;

			$duration 	= ($this->input->post('f_limit') == 1 ? ($this->input->post('f_duration') * 60) : NULL);
			$attemption = ($this->input->post('f_max') == 1 ? $this->input->post('f_time') : NULL);
			$open_time 	= ($this->input->post('f_open_time') != "" ? time_format($this->input->post('f_open_time'),'Y-m-d H:i') : NULL);
			$close_time = ($this->input->post('f_close_time') != "" ? time_format($this->input->post('f_close_time'),'Y-m-d H:i') : NULL);

			$data = [

				'uc' => $uc_content,
				'uc_classroom' => $uc_classroom,
				'uc_section' => $uc_section,
				'content_title' => $this->input->post('f_judul'),
				'category' => $this->input->post('f_category'),
				'type_ass' => $this->input->post('f_type'),
				'time_open' => $open_time,
				'time_close' => $close_time,
				'sequence' => ($seq+1)
			];

			$this->load->model('content_m');

			$this->content_m->insert_data($data);

			$uc_subject = $this->classroom_m->get_filtered(array('uc' => $uc_classroom))->row()->uc_subject;


			// INSERT TO ASS
			$uc_assessment = unique_code();

			$data = array(
							'uc'						=> $uc_assessment,
							'uc_classroom'				=> $uc_classroom,
							'uc_content'				=> $uc_content,
							'uc_subject'				=> $uc_subject,
							'duration'					=> $duration,
							'passing_grade'				=> $this->input->post('f_passing_grade'),
							'maximum_attempt'			=> $attemption,
							'time_create'				=> current_time(),
							'time_open'					=> $open_time,
							'time_close'				=> $close_time,
							'is_review'					=> $this->input->post('f_review'),
							'uc_instructor'				=> $this->session->userdata('log_uc_person'),
									
					);


			$this->load->model('assessment_m');
			$this->assessment_m->insert_data($data);

			if ($this->input->post('f_qmode') == 0)  {


				$this->load->model('question_m');
				$this->load->model('ass_question_m');
				$this->load->model('ass_options_m');

				$q_quest = $this->question_m->pick_randomize($this->input->post('f_jml'), $uc_subject);
				if ($q_quest->num_rows() > 0) {

					// Preparation field `tech_exam_question` for inserting
					$field_quest = "(`uc`, `uc_question`, `question_title`, `question_text`, `question_att_file`, `question_type`, `answer_truefalse`, `uc_assessment`)";

					$uc_new_question = "";
					$val_quest = "";

					// Fill value for `tech_exam_question`
					foreach ($q_quest->result() as $res) {
						// Definition for uc_exam_question
						$uc_exam_question = unique_code();
						// Value for inserting the question
						$val_quest .= "('".$uc_exam_question."', '".$res->uc."', '".$res->question_title."', '".htmlspecialchars(addslashes(mb_convert_encoding($res->question_text,"HTML-ENTITIES","UTF-8")))."', '".$res->att_file."', '".$res->question_type."', '".$res->truefalse_answer."', '".$uc_assessment."'), ";
						// Get the uc_exam_question
						$uc_new_question .= "'".$uc_exam_question."', ";
					}
					$val_quest = substr_replace($val_quest, '', -2);
					$uc_new_question = substr_replace($uc_new_question, '', -2);

					// Finally INSERT the question
					$this->load->model('ass_question_m');
					$this->ass_question_m->insert_multi_value($field_quest, $val_quest);


					// BEGIN of 'MULTIPLE CHOICE' extra costumization
					// Get and insert options for picked question for question type 'MULTIPLE CHOICE'
					// Get options
					$q_opt = $this->question_m->get_options_for_question($uc_new_question);
					if ($q_opt->num_rows() > 0) {
						$result = $q_opt->result();

						///	Prepare field `tech_exam_option` for inserting
						$field_opt = "(`uc`, `option_text`, `option_att_file`, `is_correct`, `uc_exam_question`,`uc_exam`)";

						///	Prepare value
						$val_opt = "";			
						foreach ($result as $res) {
							$val_opt .= "('".unique_code()."', '".htmlspecialchars(addslashes(mb_convert_encoding($res->option_text,"HTML-ENTITIES","UTF-8")))."','".$res->att_file."','".$res->is_correct."','".$res->uc."','".$uc_assessment."'),";
						}

						$val_opt = substr_replace($val_opt, '', -1);

						//	Finally insert the `tech_question_options`
						$this->load->model('ass_options_m');
						$this->ass_options_m->insert_multi_value($field_opt, $val_opt);

						//	Update question answer, which is the answer is using 'id' at 'ass_options' not 'question_option'		
						$this->load->model('ass_question_m');
						///	Get keys from the option assessment		
						$q_keys = $this->ass_question_m->get_keys($uc_assessment);
						if ($q_keys->num_rows() > 0) {
							// //	Update the keys
							$this->ass_question_m->update_keys($q_keys->result());
						}
						//	END of 'MULTIPLE CHOICE' extra costumization
					}
				}	

			}

			$this->pick_questions();


			//$this->load->library('im_upload');

			//$file_att = $this->im_upload->uploading('f_lampiran', 'materi');

			
		}

		//redirect('classroom/task/'.$uc_classroom.'/'.$uc_diklat_class);
	}
	/*END ASSESSMENT*/

	function pick_questions() {
		$data = NULL;

		$uc_assessment	= '607680e3e0bc2';
		$uc_subject		= '606ab6e6d6e3c';

		//	Get Question Bank
		$this->load->model('question_m');
		//$qquest = $this->question_m->get_filtered(array('uc_subject' => $uc_subject));
		$qquest = $this->question_m->get_not_picked($uc_subject, $uc_assessment);
		$qbank_amt = $qquest->num_rows();
		if ($qbank_amt > 0) {
			$data['q_bank'] = $qquest->result();
		}

		$data['qb_amt'] = $qbank_amt;
		

		//	Get Picked Question
		$this->load->model('ass_question_m');
		$qquest = $this->ass_question_m->get_filtered(array('uc_assessment' => $uc_assessment));
		$qpick_amt = $qquest->num_rows();
		if ($qpick_amt > 0) {
			$data['q_pick'] = $qquest->result();
		}

		$data['qp_amt'] = $qpick_amt;

		$data['uc_assessment'] = $uc_assessment;

		$this->im_render->main('classroom/pick_questions', $data);
	}

	function add_picked() {
		
		$uc_assessment = $this->input->post('f_uc_assessment');
		
		echo "<pre>";
		print_r($this->input->post('ucq'));
		echo "</pre>";

	}

	function manage_admin(){
		$data = NULL;

		$filter = ['uc_instructor' => $this->session->userdata('log_uc_person'), 'count' => FALSE];

		$data['info'] = $this->classroom_m->get_list($filter)->row();

		$this->im_render->main('class/manage', $data);
	}

	function taska(){
		$this->im_render->main('class/task');
	}

	function form_materi(){
		$this->im_render->main('class/form_materi');
	}

	function form_assigment(){
		$this->im_render->main('class/form_assigment');
	}

	function form_assessment(){
		$this->im_render->main('class/form_assessment');
	}

}