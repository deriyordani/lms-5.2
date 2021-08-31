<?php
Class Master extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function checkphp(){
		php_info();
	}

	function check_diklat(){
		$this->load->model('diklat_m');

		$uc = $this->input->post('js_uc');

		$query = $this->diklat_m->get_filtered(array('uc' => $uc));
		if ($query->num_rows() > 0) {
			
			$row = $query->row();


			$data['type_course'] = $row->category;

			echo json_encode($data);
		}
	}

	function get_diklat_info(){
		$this->load->model('diklat_period_m');

		$uc = $this->input->post('js_uc');

		$query = $this->diklat_period_m->get_combo_periode_diklat($uc);
		if ($query->num_rows() > 0) {
			
			$row = $query->row();

			$data['label_dkp'] = $row->label_dkp;
			$data['diklat'] = $row->diklat;
			$data['tahun'] = $row->tahun;
			$data['prodi'] = $row->prodi;
			$data['type_course'] = $row->category;
			$data['periode_mulai'] = time_format($row->periode_mulai, 'd M Y');
			$data['periode_selesai'] = time_format($row->periode_selesai, 'd M Y');

			echo json_encode($data);
		}
	}

	function load_tahun_periode_by_diklat_periode(){
		$data = NULL;

		$this->load->model('diklat_period_m');

		$uc_diklat = $this->input->post('js_uc_diklat');
		$uc_prodi = $this->input->post('js_uc_prodi');

		$filter = ['uc_diklat' => $uc_diklat, 'uc_prodi' => $uc_prodi];

		$query = $this->diklat_period_m->get_combo_periode_diklat($filter);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$this->load->view('peserta_diklat/load_tahun', $data);
	}

	function load_tahun_periode_by_dkp(){
		$data = NULL;

		$this->load->model('diklat_period_m');

		$uc_diklat = $this->input->post('js_uc_diklat');
		$uc_dkp = $this->input->post('js_uc_dkp');

		$filter = ['uc_diklat' => $uc_diklat, 'uc_dkp' => $uc_dkp];

		$query = $this->diklat_period_m->get_combo_periode_diklat($filter);
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$this->load->view('peserta_diklat/load_tahun', $data);
	}

	function load_kelas_by_period(){
		$data = NULL;
		$this->load->model('diklat_class_m');
		$uc_period = $this->input->post('js_uc_period');

		$query = $this->diklat_class_m->get_filtered(array('uc_diklat_period' => $uc_period),'class_label','ASC');
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$this->load->view('peserta_diklat/load_kelas_by_period', $data);
	}

	function subject_by_prody(){
		$data = NULL;
		$this->load->model('subject_m');

		$uc_diklat = $this->input->post('js_uc_diklat');
		$uc_prodi = $this->input->post('js_uc_prodi');

		$query = $this->subject_m->get_filtered(array('uc_diklat' => $uc_diklat, 'uc_prodi' => $uc_prodi));
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$this->load->view('classroom/subject_by_prody', $data);
	}

	function insert_to_page(){

		$this->load->model('tpack_page_m');

		for ($i=1; $i <= 30; $i++) {

			$data = [

				'uc' => uniqid(),
				'uc_tpack_section' => 'ps0105',
				'page' => $i
			];


			$this->tpack_page_m->insert_data($data);

			
		}
	}

	function ins_by_prody(){
		$data = NULL;
		$this->load->model('instructor_m');

		$uc_prodi = $this->input->post('js_uc_prodi');

		$query = $this->instructor_m->get_filtered(array('uc_prodi' => $uc_prodi));
		if ($query->num_rows() > 0) {
			$data['result'] = $query->result();
		}

		$this->load->view('classroom/ins_by_prody', $data);
	
	}

	function uploader_file(){
		$this->load->library('uploader');



	    $data = $this->uploader->upload($_FILES['files'], array(
	        'limit' => 10, //Maximum Limit of files. {null, Number}
	        'maxSize' => 500, //Maximum Size of files {null, Number(in MB's)}
	        'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
	        'required' => false, //Minimum one file is required for upload {Boolean}
	        'uploadDir' => './uploads/materi/', //Upload directory {String}
	        'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
	        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
	        'replace' => false, //Replace the file if it already exists  {Boolean}
	        'perms' => null, //Uploaded file permisions {null, Number}
	        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
	        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
	        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
	        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
	        'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
	        'onRemove' => null //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
	    ));

	    if($data['isComplete']){
	        $files = $data['data'];

	        echo json_encode($files['metas'][0]['name']);
	    }

	    if($data['hasErrors']){
	        $errors = $data['errors'];
	        echo json_encode($errors);
	    }

	    exit;
	}

	function delete_uploader_file(){
		if(isset($_POST['file'])){
		    $file = '../../../uploads/materi/' . $_POST['file'];
		    if(file_exists($file)){
		        unlink($file);
		    }
		}
	}
}