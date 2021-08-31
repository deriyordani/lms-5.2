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