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
		$this->im_render->main('question/index');
	}

	function lists($uc_classroom = NULL, $uc_diklat_class, $uc_subject = NULL){
		$data = NULL;

		$filter = [
			'uc_instructor' => $this->session->userdata('log_uc_person'),
			'uc' => $uc_classroom,
			'uc_diklat_class' => $uc_diklat_class,
			'count' => FALSE
		];

		$this->load->model('classroom_m');

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
							'segment' 		=> 'dkp',
							'model'			=> 'question_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->question_m->get_filtered(array('uc_subject' => $uc_subject),'id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->question_m->get_filtered(array('uc_subject' => $uc_subject),'id','DESC');			
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}
		
		$data['info'] = $this->classroom_m->get_list($filter)->row();


		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;
		$data['uc_subject'] = $uc_subject;

		$this->im_render->main_stu('question/list', $data);
	}

	function page(){
		$data = NULL;

		$page 	= ($this->input->post('js_page') != 1 ? $this->input->post('js_page') : 1);

		$uc_classroom = $this->input->post('js_classroom');
		$uc_diklat_class = $this->input->post('js_diklat_class');
		$uc_subject = $this->input->post('js_subject');

		//	Pagination Initialization
		$this->load->library('im_pagination');
		///	Define Offset
		$offset = ($page - 1) * $this->each_page;
		//	Define Parameters
		$params = array(
							'page_number'	=> $page,
							'each_page'		=> $this->each_page,
							'page_int'		=> $this->page_int,	
							'segment' 		=> 'dkp',
							'model'			=> 'question_m'
						);

		$data['numbering'] 	= ($this->each_page * ($page-1)) + 1;

		$query = $this->question_m->get_filtered(array('uc_subject' => $uc_subject),'id', 'DESC', $this->each_page, $offset);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$query = $this->question_m->get_filtered(array('uc_subject' => $uc_subject),'id','DESC');		
		if ($query->num_rows() > 0) {
			$params['total_record'] = $query->num_rows();
			$data['pagination'] 	= $this->im_pagination->render_ajax($params);
			$data['total_record'] 	= $query->num_rows();
		}


		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;
		$data['uc_subject'] = $uc_subject;

		$this->load->view('question/content', $data);
	}

	function add($uc_classroom = NULL, $uc_diklat_class, $uc_subject =NULL){
		$data = NULL;


		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;
		$data['uc_subject'] = $uc_subject;

		$this->im_render->main_stu('question/add', $data);
	}

	function store(){
		if ($this->input->post('f_store')) {
			
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
			}

			$uc_question = uniqid();

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

		redirect('question/list/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_subject);
	}

	function insert_option($uc_question){
		$value = "";

		$this->load->library('upload');

		$config['upload_path'] = './uploads/question/';
	    $config['allowed_types'] = 'jpg|jpeg|png';
	    $config['max_size'] = '5000';
	    $config['encrypt_name'] = TRUE;

	    $this->upload->initialize($config);

		for ($i=1; $i<=4; $i++) {


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


				    $value .= "('".uniqid()."','".$uc_question."','".$option."', '".$answer."', '".$att_file."'),";

				}else{


					$answer = 0;
				
					// $option 	= ($this->input->post('f_option'.$i) != NULL ? htmlspecialchars(addslashes($this->input->post('f_option'.$i))) : NULL);
												
					if ($this->input->post('f_key') == $i) {
						$answer = 1;
					}

					$att_file = $this->input->post('f_lampiran_op_old_'.$i);


					$value .= "('".uniqid()."','".$uc_question."','".$option."', '".$answer."', '".$att_file."'),";

				}

				

			}


			
		}


		if ($value != NULL) {
			
				$field = "(`uc`,`uc_question`,`option_text`, `is_correct`,`att_file`)";

				$values = substr_replace($value, '', -1);


				echo $values;

				$this->question_option_m->insert_multi_value($field,$values);
			}	
	}

	function edit($uc = NULL, $uc_classroom = NULL, $uc_diklat_class, $uc_subject =NULL, $type_question = NULL){

		$data = NULL;

		$data['uc_classroom'] = $uc_classroom;
		$data['uc_diklat_class'] = $uc_diklat_class;
		$data['uc_subject'] = $uc_subject;

		$query1 = $this->question_m->get_filtered(array('uc' => $uc));
		if ($query1->num_rows() > 0) {
			$data['row'] = $query1->row();
		}

		$query = $this->question_option_m->get_filtered(array('uc_question' => $uc));
		if ($query->num_rows() > 0) {
			$data['option'] = $query->result();
		}



		if ($type_question == 1) {
			$this->im_render->main_stu('question/edit_mc', $data);
		}else{
			$this->im_render->main_stu('question/edit_tf', $data);
		}

		
	}

	function update_mc(){
		if ($this->input->post('f_store')) {
			
			$texts = htmlspecialchars(addslashes($this->input->post('f_deskripsi')));
			$title = htmlspecialchars(addslashes(mb_convert_encoding($this->input->post('f_judul'),"HTML-ENTITIES","UTF-8")));

			if ($this->input->post('f_type') == 1) {
				$answer = 0;
			}
			elseif ($this->input->post('f_type') == 2) {

				$answer = $this->input->post('f_tf'); 
			}

			$file_att = $this->input->post('f_att_file_old');

			$this->load->library('upload');
			
			$config['upload_path'] = './uploads/question/';
		    $config['allowed_types'] = 'jpg|jpeg|png';
		    $config['max_size'] = '5000';
		    $config['encrypt_name'] = TRUE;

		    $this->upload->initialize($config);


		    if (isset($_POST['f_att_file_old'])) {

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

			// $att_file = $this->input->post('f_att_file_old');

			// if ($_FILES['f_lampiran']['name'] != NULL) {
				
			// 	$att_file = $this->im_upload->replacing('f_att_file_old','f_lampiran','question');

			// }else{

			// 	$att_file = $this->im_upload->uploading('f_lampiran','question');
			// }
			
			$uc_question = $this->input->post('f_uc');

			$data = [
				
				'question_title' => $title,
				'question_text' => $texts,
				//'question_type' => $this->input->post('f_type'),
				'truefalse_answer' => $answer,
				'att_file' => $file_att,
				'author' => $this->session->userdata('log_uc_person')
			];

			$where = ['uc' => $uc_question];

			$this->question_m->update_data($data,$where);

			$this->question_option_m->delete_data(array('uc_question' => $uc_question));

			$this->insert_option($uc_question);

			$this->session->set_flashdata('info', $this->config->item('flash_update'));


			$uc_classroom = $this->input->post('f_uc_class');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');
			$uc_subject = $this->input->post('f_uc_subject');
		

		}


		redirect('question/list/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_subject);
	}

	function update_tf(){
		if ($this->input->post('f_store')) {
		

			$answer = $this->input->post('f_tf'); 

			$file_att = $this->input->post('f_att_file_old');

			$this->load->library('upload');
			
			$config['upload_path'] = './uploads/question/';
		    $config['allowed_types'] = 'jpg|jpeg|png';
		    $config['max_size'] = '5000';
		    $config['encrypt_name'] = TRUE;

		    $this->upload->initialize($config);


		    if (isset($_POST['f_att_file_old'])) {

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

			// $att_file = $this->input->post('f_att_file_old');

			// if ($_FILES['f_lampiran']['name'] != NULL) {
				
			// 	$att_file = $this->im_upload->replacing('f_att_file_old','f_lampiran','question');

			// }else{

			// 	$att_file = $this->im_upload->uploading('f_lampiran','question');
			// }


			$texts = htmlspecialchars(addslashes($this->input->post('f_deskripsi')));
			$title = htmlspecialchars(addslashes(mb_convert_encoding($this->input->post('f_judul'),"HTML-ENTITIES","UTF-8")));
			
			$uc_question = $this->input->post('f_uc');

			$data = [
				
				'question_title' => $title,
				'question_text' => $texts,
				'question_type' => $this->input->post('f_type'),
				'truefalse_answer' => $answer,
				'att_file' => $file_att,
				'author' => $this->session->userdata('log_uc_person')
			];

			$where = ['uc' => $uc_question];

			$this->question_m->update_data($data,$where);

			$this->session->set_flashdata('info', $this->config->item('flash_update'));


			$uc_classroom = $this->input->post('f_uc_class');
			$uc_diklat_class = $this->input->post('f_uc_diklat_class');
			$uc_subject = $this->input->post('f_uc_subject');

		}

		redirect('question/list/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_subject);
	}

	function view(){
		$data = NULL;

		$uc_question = $this->input->post('js_uc_question');

		$data['row'] = $this->question_m->get_filtered(array('uc' => $uc_question))->row();

		$data['option'] = $this->question_option_m->get_filtered(array('uc_question'=> $uc_question))->result();

		$this->load->view('question/view', $data);
	}

	function delete($uc_question = NULL, $uc_classroom = NULL, $uc_diklat_class, $uc_subject = NULL){

		$where_q = ['uc' => $uc_question];

		$this->question_m->delete_data($where_q);

		$where_o = ['uc_question' => $uc_question];

		$this->question_option_m->delete_data($where_o);

		redirect('question/list/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_subject);
	}
}