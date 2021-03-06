<?php
Class Question extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('question_m');
		$this->load->model('question_option_m');

		$this->each_page 	= 20;
		$this->page_int 	= 5;

	}

	function index(){

		$data = NULL;

		// $page = 1;
		// //	Pagination Initialization
		// $this->load->library('im_pagination');
		// ///	Define Offset
		// $offset = ($page - 1) * $this->each_page;
		// //	Define Parameters
		// $params = array(
		// 					'page_number'	=> $page,
		// 					'each_page'		=> $this->each_page,
		// 					'page_int'		=> $this->page_int,	
		// 					'segment' 		=> 'question',
		// 					'model'			=> 'question_m'
		// 				);

		// $data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		// $query = $this->question_m->get_filtered(array('uc_subject' => $uc_subject),'id', 'DESC', $this->each_page, $offset);
		// if ($query->num_rows() > 0) {
		// 	$data['result'] = $query->result();
		// }

		// $query = $this->question_m->get_filtered(array('uc_subject' => $uc_subject),'id','DESC');			
		// if ($query->num_rows() > 0) {
		// 	$params['total_record'] = $query->num_rows();
		// 	$data['pagination'] 	= $this->im_pagination->render_ajax($params);
		// 	$data['total_record'] 	= $query->num_rows();
		// }

		$this->im_render->main('question/index', $data);
	}

	function page(){
		$data = NULL;
		
		$page 	= ($this->input->post('js_page') != 1 ? $this->input->post('js_page') : 1);

		$diklat = $this->input->post('js_diklat');
		$prodi = $this->input->post('js_prodi');
		$subject = $this->input->post('js_subject');

		$filter = [

			'uc_diklat' => $diklat,
			'uc_prodi' => $prodi,
			'uc_subject' => $subject,
			'count' => FALSE
		];

		//	Pagination Initialization
		$this->load->library('im_pagination');
		///	Define Offset
		$offset = ($page - 1) * $this->each_page;
		//	Define Parameters
		$params = array(
							'page_number'	=> $page,
							'each_page'		=> $this->each_page,
							'page_int'		=> $this->page_int,	
							'segment' 		=> 'question',
							'model'			=> 'question_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->question_m->get_list($filter, $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->question_m->get_list($filter);			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}


		$this->load->view('question/content', $data);
	}


	function add(){
		if ($this->input->post('f_proses')) {

			
            // $data['diklat'] = $this->input->post('f_diklat_filter');
            // $data['prodi'] = $this->input->post('f_prodi_filter');
            // $data['subject'] = $this->input->post('f_subject_filter');

            $data['uc_diklat'] = $this->input->post('f_diklat_filter');
            $data['uc_prodi'] = $this->input->post('f_prodi_filter');
            $data['uc_subject'] = $this->input->post('f_subject_filter');

			$data['entry_mode'] = $this->input->post('f_mode');

			$this->im_render->main_stu('question/add', $data);
		}
		
	}

	function store(){
		if ($this->input->post('f_save_single')) {
			$this->do_insert();

			redirect('question');
		}

		if ($this->input->post('f_save_group')) {
			$this->do_insert();

			$data['uc_subject'] = $this->input->post('f_uc_subject');

			$data['entry_mode']		= 2;

			$this->im_render->main('question/add',$data);
		}

		if ($this->input->post('f_finish')) {
			// $this->do_insert();

			redirect('question');
		}
	}

	function do_insert(){
		$file_att = NULL;

			$uc_classroom = $this->input->post('f_uc_class');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');
			$uc_subject = $this->input->post('f_uc_subject');

			$texts = htmlspecialchars(addslashes($this->input->post('f_deskripsi')));
			$title = htmlspecialchars(addslashes(mb_convert_encoding($this->input->post('f_judul'),"HTML-ENTITIES","UTF-8")));

			if ($this->input->post('f_type') == 1) {
				$answer = 0;
			}
			elseif ($this->input->post('f_type') == 2) {

				$answer = $this->input->post('f_tf'); 
			}elseif ($this->input->post('f_type') == 3) {
				$answer = 0;
			}

			$uc_question = unique_code();

			// $this->load->library('im_upload');
			// $file_img = $this->im_upload->uploading('f_lampiran','question');


			$this->load->library('upload');

			$config['upload_path'] = './uploads/question/';
		    $config['allowed_types'] = 'jpg|jpeg|png';
		    $config['max_size'] = '5000';
		    $config['encrypt_name'] = TRUE;

		    $this->upload->initialize($config);
		   

		    // if ( ! $this->upload->do_upload('f_lampiran'))
		    // {
		       
		    //     echo  $this->upload->display_errors();
		    // }
		    // else
		    // {
		        $upload_data =  $this->upload->data();
		        $file_att = $upload_data['file_name'];

			    

		   // }

			$data = [
				'uc' => $uc_question,
				'uc_subject' => $uc_subject,
				'question_title' => $title,
				'question_text' => $texts,
				'question_type' => $this->input->post('f_type'),
				'truefalse_answer' => $answer,
				'att_file' => ($file_att != NULL ? $file_att : NULL ),
				'author' => $this->session->userdata('log_uc_person')
			];

			$this->question_m->insert_data($data);


			if ($this->input->post('f_type') == 1) {
				$this->insert_option($uc_question);
			}

			$this->session->set_flashdata('info', $this->config->item('flash_success'));
	}

	function insert_option($uc_question){
		$value = "";

		$this->load->library('upload');

		$config['upload_path'] = './uploads/question/';
	    $config['allowed_types'] = 'jpg|jpeg|png';
	    $config['max_size'] = '5000';
	    $config['encrypt_name'] = TRUE;

	    $this->upload->initialize($config);

		for ($i=1; $i<=5; $i++) {


			$option 	= ($this->input->post('f_option_'.$i) != NULL ? htmlspecialchars(addslashes($this->input->post('f_option_'.$i))) : NULL);

			if ($_POST['f_option_'.$i] != NULL) {
				$answer = 0;
				
				
				
				if ($this->input->post('f_key') == $i) {
					$answer = 1;
				}


				$att_file = $this->input->post('f_lampiran_op_old_'.$i);


				if ($_FILES['f_lampiran_op_'.$i]['type'] != NULL) {

					if ( ! $this->upload->do_upload('f_lampiran_op_'.$i)){
				       
				        echo  $this->upload->display_errors();
				    }
				    else{

				        $upload_data =  $this->upload->data();
				        $att_file = $upload_data['file_name'];
				    }


				    $value .= "('".unique_code()."','".$uc_question."','".$option."', '".$answer."', '".$att_file."'),";

				}else{


					$answer = 0;
				
					// $option 	= ($this->input->post('f_option'.$i) != NULL ? htmlspecialchars(addslashes($this->input->post('f_option'.$i))) : NULL);
												
					if ($this->input->post('f_key') == $i) {
						$answer = 1;
					}

					$att_file = $this->input->post('f_lampiran_op_old_'.$i);


					$value .= "('".unique_code()."','".$uc_question."','".$option."', '".$answer."', '".$att_file."'),";

				}

				

			}


			
		}


		if ($value != NULL) {
			
				$field = "(`uc`,`uc_question`,`option_text`, `is_correct`,`att_file`)";

				$values = substr_replace($value, '', -1);


				//echo $values;

				$this->question_option_m->insert_multi_value($field,$values);
			}	
	}

	function edit($uc = NULL) {
		if ($uc != NULL) {
			$data = NULL;

			$uc_question = $uc;

			$row = $this->question_m->get_filtered(array('uc' => $uc_question))->row();
			$data['row'] = $row;
			$data['option'] = $this->question_option_m->get_filtered(array('uc_question'=> $uc_question))->result();

			if ($row->question_type == 1) {
				//$this->im_render->main('question/edit_mc', $data);
				$this->im_render->main_stu('question/edit_mc', $data);
			}
			elseif ($row->question_type == 2) {
				$this->im_render->main_stu('question/edit_tf', $data);
			}
			elseif ($row->question_type == 3) {
				$this->im_render->main_stu('question/edit_essay', $data);
			}
		}

		//redirect('question');
	}


	function update_mc(){
		if ($this->input->post('f_store')) {
			$texts = htmlspecialchars(addslashes($this->input->post('f_deskripsi')));
			$title = htmlspecialchars(addslashes(mb_convert_encoding($this->input->post('f_judul'),"HTML-ENTITIES","UTF-8")));

			$uc_question = $this->input->post('f_uc');
			$file_att = $this->input->post('f_att_file_old');


		    if ($_FILES['f_lampiran']['name'] != NULL) {
				$this->load->library('upload');
				
				$config['upload_path'] = './uploads/question/';
			    $config['allowed_types'] = 'jpg|jpeg|png';
			    $config['max_size'] = '5000';
			    $config['encrypt_name'] = TRUE;

			    $this->upload->initialize($config);

		    	if ($this->input->post('f_att_file_old') != "") {
		    		//echo "<br /> DELETE OLD ONE";
		    		$path = $config['upload_path'].$file_att;

			    	if ($file_att != NULL) {
			    		if (file_exists($path)){
							unlink($path);
						}
			    	}
		    	}

		    	//echo "<br /> UPLOAD";
		    	if ( ! $this->upload->do_upload('f_lampiran')){
			        echo  $this->upload->display_errors();
			    }
			    else{
			        $upload_data =  $this->upload->data();
			        $file_att = $upload_data['file_name'];
			    }
		    }			

			$data = [
				'question_title' => $title,
				'question_text' => $texts,
				'att_file' => $file_att,
				'author' => $this->session->userdata('log_uc_person')
			];

			$where = ['uc' => $uc_question];

			$this->question_m->update_data($data,$where);

			$this->question_option_m->delete_data(array('uc_question' => $uc_question));

			$this->insert_option($uc_question);

			$this->session->set_flashdata('info', $this->config->item('flash_update'));
			
		}

		redirect('question');
	}

	function update_tf(){
		if ($this->input->post('f_store')) {
			$texts = htmlspecialchars(addslashes($this->input->post('f_deskripsi')));
			$title = htmlspecialchars(addslashes(mb_convert_encoding($this->input->post('f_judul'),"HTML-ENTITIES","UTF-8")));

			$uc_question = $this->input->post('f_uc');
			$file_att = $this->input->post('f_att_file_old');


		    if ($_FILES['f_lampiran']['name'] != NULL) {
				$this->load->library('upload');
				
				$config['upload_path'] = './uploads/question/';
			    $config['allowed_types'] = 'jpg|jpeg|png';
			    $config['max_size'] = '5000';
			    $config['encrypt_name'] = TRUE;

			    $this->upload->initialize($config);

		    	if ($this->input->post('f_att_file_old') != "") {
		    		//echo "<br /> DELETE OLD ONE";
		    		$path = $config['upload_path'].$file_att;

			    	if ($file_att != NULL) {
			    		if (file_exists($path)){
							unlink($path);
						}
			    	}
		    	}

		    	//echo "<br /> UPLOAD";
		    	if ( ! $this->upload->do_upload('f_lampiran')){
			        echo  $this->upload->display_errors();
			    }
			    else{
			        $upload_data =  $this->upload->data();
			        $file_att = $upload_data['file_name'];
			    }
		    }			

			$data = [
				'question_title' => $title,
				'question_text' => $texts,
				'att_file' => $file_att,
				'truefalse_answer' => $this->input->post('f_tf'),
				'author' => $this->session->userdata('log_uc_person')
			];

			$where = ['uc' => $uc_question];

			$this->question_m->update_data($data,$where);

			$this->session->set_flashdata('info', $this->config->item('flash_update'));
		}

		redirect('question');
	}

	function update_essay(){
		if ($this->input->post('f_store')) {
			$texts = htmlspecialchars(addslashes($this->input->post('f_deskripsi')));
			$title = htmlspecialchars(addslashes(mb_convert_encoding($this->input->post('f_judul'),"HTML-ENTITIES","UTF-8")));

			$uc_question = $this->input->post('f_uc');
			$file_att = $this->input->post('f_att_file_old');


		    if ($_FILES['f_lampiran']['name'] != NULL) {
				$this->load->library('upload');
				
				$config['upload_path'] = './uploads/question/';
			    $config['allowed_types'] = 'jpg|jpeg|png';
			    $config['max_size'] = '5000';
			    $config['encrypt_name'] = TRUE;

			    $this->upload->initialize($config);

		    	if ($this->input->post('f_att_file_old') != "") {
		    		//echo "<br /> DELETE OLD ONE";
		    		$path = $config['upload_path'].$file_att;

			    	if ($file_att != NULL) {
			    		if (file_exists($path)){
							unlink($path);
						}
			    	}
		    	}

		    	//echo "<br /> UPLOAD";
		    	if ( ! $this->upload->do_upload('f_lampiran')){
			        echo  $this->upload->display_errors();
			    }
			    else{
			        $upload_data =  $this->upload->data();
			        $file_att = $upload_data['file_name'];
			    }
		    }			

			$data = [
				'question_title' => $title,
				'question_text' => $texts,
				'att_file' => $file_att,	
				'author' => $this->session->userdata('log_uc_person')
			];

			$where = ['uc' => $uc_question];

			$this->question_m->update_data($data,$where);

			$this->session->set_flashdata('info', $this->config->item('flash_update'));
		}

		redirect('question');
	}

	function view(){
		$data = NULL;

		$uc_question = $this->input->post('js_uc_question');

		$data['row'] = $this->question_m->get_filtered(array('uc' => $uc_question))->row();

		$data['option'] = $this->question_option_m->get_filtered(array('uc_question'=> $uc_question))->result();

		$this->load->view('question/view', $data);
	}

	function view_picked(){
		$data = NULL;

		$uc_question = $this->input->post('js_uc_question');

		$this->load->model('ass_question_m');
		$row = $this->ass_question_m->get_filtered(array('uc' => $uc_question))->row();
		$uc_question = $row->uc_question;

		$data['row'] = $this->question_m->get_filtered(array('uc' => $uc_question))->row();

		$data['option'] = $this->question_option_m->get_filtered(array('uc_question'=> $uc_question))->result();

		$this->load->view('question/view', $data);


	}

	function view_picked_BACKUP(){
		$data = NULL;

		$uc_question = $this->input->post('js_uc_question');

		$this->load->model('ass_question_m');
		$this->load->model('ass_options_m');

		$row = $this->ass_question_m->get_filtered(array('uc' => $uc_question))->row();
		$data['row'] = $row;

		$data['option'] = $this->ass_options_m->get_filtered(array('uc_exam_question'=> $row->uc))->result();

		$this->load->view('question/view_picked', $data);
	}

	function delete($uc_question = NULL){

		$where_q = ['uc' => $uc_question];

		$this->question_m->delete_data($where_q);

		$where_o = ['uc_question' => $uc_question];

		$this->question_option_m->delete_data($where_o);

		redirect('question');
	}

}