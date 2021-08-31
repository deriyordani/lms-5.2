<?php
Class Schedule extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('schedule_m');
		$this->load->model('schedule_week_m');
		$this->load->model('schedule_plot_m');

	}

	function index(){
		$data = NULL;

		$this->load->model('schedule_m');

		$uc_prodi = $this->session->userdata('log_uc_prodi');
		$query = $this->schedule_m->get_list(NULL, $uc_prodi);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$this->im_render->main('monitoring/schedule/index', $data);
	}

	function add() {
		$this->im_render->main('monitoring/schedule/form_add');
	}

	function insert_schedule() {
		//if ($this->input->post('f_save')) {
			$this->load->model('schedule_m');

			$data = array (
							'uc' 				=> uniqid(),
							'uc_diklat_class'	=> $this->input->post('f_class')
							);

			$this->schedule_m->insert_data($data);
		//}

		redirect('monitoring/schedule');
	}

	function manage($uc) {
		if ($uc != NULL) {
			$data['uc'] = $uc;

			//	Get Schedule Detail
			$query = $this->schedule_m->get_list($uc);
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
			}

			$query = $this->schedule_week_m->get_filtered(array('uc_schedule' => $uc), 'minggu_ke', 'ASC');
			if ($query->num_rows() > 0) {
				$data['result'] = $query->result();
			}

			$this->im_render->main('monitoring/schedule/manage', $data);
		}
		else {
			redirect('monitoring/schedule');
		}
	}

	function insert_week() {
		if ($this->input->post('f_save')) {

			$this->load->model('schedule_week_m');

			$uc = $this->input->post('f_uc');

			$data = array(
							'uc'			=> uniqid(),
							'uc_schedule'	=> $uc,
							'minggu_ke'		=> $this->input->post('f_week'),
							'tanggal_mulai'	=> time_format($this->input->post('f_tanggal_awal'),"Y-m-d"),
							'tanggal_akhir' => time_format($this->input->post('f_tanggal_akhir'),"Y-m-d")
						);

			$this->schedule_week_m->insert_data($data);

			redirect('monitoring/schedule/manage/'.$uc);
		}
	}

	function delete_week($uc = NULL, $uc_week = NULL) {
		//	Delete Plot
		$this->schedule_plot_m->delete_data(array('uc_sched_week' => $uc_week));

		//	Delete Week
		$this->schedule_week_m->delete_data(array('uc' => $uc_week));

		redirect('monitoring/schedule/manage/'.$uc);
	}

	function plot($uc = NULL, $uc_sched_week = NULL, $uc_diklat = NULL, $uc_prodi = NULL) {
		$data = NULL;

		$data['uc_schedule']	= $uc;
		$data['uc_sched_week']	= $uc_sched_week;
		$data['uc_diklat'] 		= $uc_diklat;
		$data['uc_prodi'] 		= $uc_prodi;

		//	Get Schedule Detail
		$query = $this->schedule_m->get_list($uc);
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		//	Get Week Detail
		$query = $this->schedule_week_m->get_filtered(array('uc' => $uc_sched_week));
		if ($query->num_rows() > 0) {
			$data['week'] = $query->row();
		}

		//	Get Subject
		$this->load->model('subject_m');
		$filter = array(
							'uc_diklat'	=> $uc_diklat,
							'uc_prodi' 	=> $uc_prodi
						);

		$query = $this->subject_m->get_filtered($filter, 'subject_title', 'ASC');
		if ($query->num_rows() > 0) {
			$data['subject'] = $query->result(); 
		}

		//	Get Instructor
		$this->load->model('instructor_m');
		$query = $this->instructor_m->get_filtered(array('is_claim' => 1));
		if ($query->num_rows() > 0) {
			$data['instructor'] = $query->result();
		}

		//	Get Plot Data
		$query = $this->schedule_plot_m->get_list($uc_sched_week);
		if ($query->num_rows() > 0) {
			$plot = $query->result();

			foreach ($plot as $pl) {
				$splot[$pl->jam_ke]['jam_mulai'] 		= $pl->jam_mulai;
				$splot[$pl->jam_ke]['jam_selesai'] 		= $pl->jam_selesai;
				$splot[$pl->jam_ke]['subject_title'] 	= $pl->subject_title;
				$splot[$pl->jam_ke]['instructor'] 		= $pl->full_name;
			}

			$data['splot'] = $splot;
		}

		

		$this->im_render->main('monitoring/schedule/plot', $data);
	}

	function insert_plot() {
		if ($this->input->post('f_save')) {
			$jam_mulai 		= $this->input->post('f_jam_mulai');
			$jam_selesai 	= $this->input->post('f_jam_selesai');
			$subject 		= $this->input->post('f_uc_subject');
			$instructor 	= $this->input->post('f_uc_instructor');
			
			$field = "(`uc`, `uc_sched_week`, `jam_ke`, `jam_mulai`, `jam_selesai`, `uc_subject`, `uc_instructor`)";
			$value = NULL;

			foreach ($subject as $idx => $sub) {
				
				if ($sub != NULL) {
					$value .= "('".uniqid()."', '".$this->input->post('f_uc_sched_week')."', '".$idx."', '".$jam_mulai[$idx]."', '".$jam_selesai[$idx]."', '".$subject[$idx]."', '".$instructor[$idx]."'),";
				}
			}

			if ($value != NULL) {
				$value = substr_replace($value, '', -1);
	            $this->schedule_plot_m->insert_multi_value($field, $value);
            }

            //redirect('monitoring/schedule/plot/'.$this->input->post('f_uc_schedule')."/".$this->input->post('f_uc_sched_week')."/".$this->input->post('f_uc_diklat')."/".$this->input->post('f_uc_prodi'));
		}

		redirect('monitoring/schedule/plot/'.$this->input->post('f_uc_schedule')."/".$this->input->post('f_uc_sched_week')."/".$this->input->post('f_uc_diklat')."/".$this->input->post('f_uc_prodi'));
	}

	function edit_plot($uc = NULL, $uc_sched_week = NULL, $uc_diklat = NULL, $uc_prodi = NULL) {
		$data = NULL;

		$data['uc_schedule']	= $uc;
		$data['uc_sched_week']	= $uc_sched_week;
		$data['uc_diklat'] 		= $uc_diklat;
		$data['uc_prodi'] 		= $uc_prodi;

		//	Get Schedule Detail
		$query = $this->schedule_m->get_list($uc);
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row();
		}

		//	Get Week Detail
		$query = $this->schedule_week_m->get_filtered(array('uc' => $uc_sched_week));
		if ($query->num_rows() > 0) {
			$data['week'] = $query->row();
		}

		//	Get Subject
		$this->load->model('subject_m');
		$filter = array(
							'uc_diklat'	=> $uc_diklat,
							'uc_prodi' 	=> $uc_prodi
						);

		$query = $this->subject_m->get_filtered($filter, 'subject_title', 'ASC');
		if ($query->num_rows() > 0) {
			$data['subject'] = $query->result(); 
		}

		//	Get Instructor
		$this->load->model('instructor_m');
		$query = $this->instructor_m->get_filtered(array('is_claim' => 1));
		if ($query->num_rows() > 0) {
			$data['instructor'] = $query->result();
		}

		//	Get Plot Data
		$query = $this->schedule_plot_m->get_list($uc_sched_week);
		if ($query->num_rows() > 0) {
			$plot = $query->result();
			// echo "<pre>";
			// print_r($plot);
			// echo "</pre>";

			$data['plot'] = $query->result();

			foreach ($plot as $pl) {
				$splot[$pl->jam_ke]['uc_plot'] 			= $pl->uc;
				$splot[$pl->jam_ke]['jam_mulai'] 		= $pl->jam_mulai;
				$splot[$pl->jam_ke]['jam_selesai'] 		= $pl->jam_selesai;
				$splot[$pl->jam_ke]['uc_subject'] 		= $pl->uc_subject;
				$splot[$pl->jam_ke]['subject_title'] 	= $pl->subject_title;
				$splot[$pl->jam_ke]['uc_instructor'] 	= $pl->uc_instructor;
				$splot[$pl->jam_ke]['instructor'] 		= $pl->full_name;
			}
		}

		// echo "<pre>";
		// print_r($splot);
		// echo "</pre>";

		$data['splot'] = $splot;

		$this->im_render->main('monitoring/schedule/edit_plot', $data);
	}

	function update_plot() {
		if ($this->input->post('f_save')) {
			// Delete Previous Data
			$this->schedule_plot_m->delete_data(array('uc_sched_week' => $this->input->post('f_uc_sched_week')));
			
			// Reinsert
			$this->insert_plot();	
		}
	}

	function insert_plot_BACKUP() {
		if ($this->input->post('f_save')) {
			
			$jam_mulai 		= $this->input->post('f_jam_mulai');
			$jam_selesai 	= $this->input->post('f_jam_selesai');

			$field = "(`uc`, `uc_sched_week`, `jam_ke`, `jam_mulai`, `jam_selesai`, `uc_subject`, `uc_instructor`)";
			if ($this->input->post('f_jam_ke') != NULL) {
				$value = NULL;
				foreach ($this->input->post('f_jam_ke') as $jk) {
					$value .= "('".uniqid()."', '".$this->input->post('f_uc_sched_week')."', '".$jk."', '".$jam_mulai[$jk]."', '".$jam_selesai[$jk]."', '".$this->input->post('f_uc_subject')."', '".$this->input->post('f_uc_instructor')."'),";					
				}

				$value = substr_replace($value, '', -1);
                $this->schedule_plot_m->insert_multi_value($field, $value);

                redirect('monitoring/schedule/plot/'.$this->input->post('f_uc_schedule')."/".$this->input->post('f_uc_sched_week')."/".$this->input->post('f_uc_diklat')."/".$this->input->post('f_uc_prodi'));
			}
			else {
				echo "nope";
			}
		}	
	}

	function load_list_period() {
		$data = NULL;
        
		$this->load->model('diklat_period_m');

		if ($this->input->post('js_diklat') != "") {
			$filter['uc_diklat'] = $this->input->post('js_diklat');
		}

		if ($this->input->post('js_prodi') != "") {
			$filter['uc_prodi'] = $this->input->post('js_prodi');
		}

		// $filter['uc_diklat'] = '602f321ea55b3';
		// $filter['uc_prodi'] = '602cd11d55d2f';

		$filter['count'] = FALSE;

		$query = $this->diklat_period_m->get_list($filter);
		if ($query->num_rows() > 0 ) {
            $data['result'] = $query->result();
        }

		$this->load->view('monitoring/schedule/load_list_period', $data);
	}

	function load_list_class() {
		$data = NULL;

		$this->load->model('diklat_class_m');

		if ($this->input->post('js_period') != "") {
			$query = $this->diklat_class_m->get_filtered(array('uc_diklat_period' => $this->input->post('js_period')), 'class_label', 'ASC');

			if ($query->num_rows() > 0 ) {
            	$data['result'] = $query->result();
	        }
		}

		$this->load->view('monitoring/schedule/load_list_class', $data);
	}

	function is_intersecting() {
		// $uc_instructor = '6099eef732a0a';
		// $jam_mulai = '07.00';
		// $jam_selesai = '08.00';
		// $uc_week = '60ee2cc82ea84';

		$uc_instructor = $this->input->post('js_uc_instructor');
		$jam_mulai = $this->input->post('js_jam_mulai');
		$jam_selesai = $this->input->post('js_jam_selesai');
		$uc_week = $this->input->post('js_uc_week'); 

		//	Get Week Date
		$query = $this->schedule_week_m->get_filtered(array('uc' => $uc_week));
		if ($query->num_rows() > 0) {
			$week = $query->row();

			$tgl_mulai = $week->tanggal_mulai;
			$tgl_akhir = $week->tanggal_akhir;
		}

		$this->load->model('schedule_plot_m');
		$query = $this->schedule_plot_m->get_intersecting($uc_instructor, $tgl_mulai, $tgl_akhir, $jam_mulai, $jam_selesai);

		if ($query->num_rows() > 0) {
			$result = TRUE;
		}
		else {
			$result = FALSE;
		}

		echo json_encode($result);

		// if ($query->num_rows() > 0) {
		// 	$result = "TRUE";
		// }
		// else {
		// 	$result = "FALSE";
		// }

		// echo $result;

		
	}

}