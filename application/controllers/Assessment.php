<?php
Class Assessment extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('assessment_m');
		$this->load->model('ass_attempt_m');
		$this->load->model('ass_question_m');
	}

	function is_accessible($unique_code = NULL){
		$filter = array('uc' => $unique_code);
		$query = $this->assessment_m->get_filtered($filter);

		if ($query->num_rows() > 0) {
			$row = $query->row();

			if (($row->time_open !== NULL) || ($row->time_close != NULL)) {
				$current_time = current_time();

				if (($current_time >= $row->time_open) && ($current_time <= $row->time_close)) {
					return TRUE;
				}
				else if(($current_time >= $row->time_open) && ($row->time_close == NULL) ){
					return TRUE;
				}
				else {
					return FALSE;
				}	
			}
			else {
				return TRUE;
			}
		}
	}

	function attempt(){
		$uc_exam = $this->input->post('f_unique');
		$uc_user = $this->session->userdata('log_uc_person');

		if ($uc_exam && $uc_user) {

			//	IF ACCESSING THROUGH LIST, contain posted "unique code of assessment"
			$data = NULL;

			//	Set Examination to 'has attempted'
			$values = array('has_attempt' => 1);
			$filter = array('uc' => $uc_exam);
			$this->assessment_m->update_data($values, $filter);

			// Data for adding information to session
				$this->load->model('student_m');

				$uc_classroom = $this->input->post('f_uc_classroom');
				$uc_diklat_class = $this->input->post('f_uc_diklat_class');
				$uc_content = $this->input->post('f_uc_content');

				$uc_subject = $this->assessment_m->get_filtered(array('uc' => $uc_exam))->row()->uc_subject;

			// 	$r_user = $this->student_m->get_filtered(array('uc' => $uc_user))->row();

				$data_ses = array(
						'in_attempt'		=> TRUE,
						'uc_classroom'	=> $uc_classroom,
						'uc_diklat_class'	=> $uc_diklat_class,
						'uc_subject'	=> $uc_subject,
						'uc_content'	=> $uc_content
				);

			//	Set Status to (in) Attempting Examination
			$this->session->set_userdata($data_ses);

			//	Check is there any unfinish attempt
			$filter = array(
								'uc_assessment'	=> $uc_exam,
								'uc_student'	=> $uc_user,
								'is_done'	=> 0
							);

			$query = $this->ass_attempt_m->get_filtered($filter);
			
			if ($query->num_rows() > 0) {
				//	BEGIN of CONTINUE UNFINISH ASSESSMENT
				$uf = $query->row();
				
				$this->attempt_continue($uf->uc, $uc_exam);
				//	END of CONTINUE UNFINISH ASSESSMENT
			} else {
				//	BEGIN of NEW ASSESSMENT
				$this->attempt_new($uc_exam, $uc_user);
				//	END of NEW ASSESSMENT
			}

		} else {
			//	IF ACCESSING DIRECTLY INTO THE METHOD
			redirect('home');
		}
	}

	public function attempt_new($uc_exam = NULL, $uc_user = NULL){

		if (($uc_exam != NULL) && ($uc_user != NULL)) {

			// Get detail examination
			$exam = $this->assessment_m->get_filtered(array('uc' => $uc_exam))->row();

			//	Generate randomize questions
			$query = $this->ass_question_m->generate_question($uc_exam);
			$max_question = $query->num_rows();

			if ($max_question > 0) {
				$result = $query->result();

				//	Insert into ass_attempt	
				///	Convert record of questions and answers into comma separation
				$question	= "";
				$keys		= "";
				$ans		= "";
				$marks		= "";
				
				$i = 0;
				$curr_quest = 0;
				$key_match_open = FALSE;
				
				foreach ($result as $res) {
					$question 	.= $res->uc.",";

					// For get keys and answer
					if ($res->id != $curr_quest) {

						$ans .= "NULL,";
						$marks .= "0,";

						if ($res->question_type == 1) {

							$keys .= $res->answer_multiplechoice.",";

						} elseif ($res->question_type == 2) {

							$keys .= $res->answer_truefalse.",";

						} elseif ($res->question_type == 3) {
							$keys .= NULL.",";
						}

						
						$curr_quest = $res->id;

						$i++;
					}


					// $keys .= $res->answer_multiplechoice;
				}

				$question 	= substr_replace($question, '', -1);
				$keys		= substr_replace($keys, '', -1);
				$ans		= substr_replace($ans, '', -1);
				// $marks		= substr_replace($marks, '', -1);

				// Generate automatic duration
				$duration = $exam->duration;
				
				///	Finally, the insert thing...
				
				//// Generating Unique Code for Attempt
				$unique_code = unique_code();

				//// Set start time
				$start_time = current_time();
				/////	Put start time to session, for counting remain time
				$this->session->set_userdata(array('start_time' => $start_time));

				$data = array(
								'uc'				=> $unique_code,
								'uc_assessment'			=> $uc_exam,
								'uc_student'			=> $uc_user,
								'questions'			=> $question,
								'keyss'				=> $keys,
								'answers'			=> $ans,
								// 'is_marks'			=> $marks,
								'time_start'		=> $start_time,
								'time_remain'		=> $duration,
							);

				$this->ass_attempt_m->insert_data($data);				
			} else {
				redirect('examination_student/attempt_empty');
			}
			
			//	Generate Assessment Questions for Viewing Purpose
			$questions = explode(',', $question);

			$q_replace = explode(',', $question);
				$uc_question = "";
				foreach ($q_replace as $qy) {
					$uc_question .= "'".$qy."'".',';

				}

				$q_replace_s = explode(',', $uc_question);

			$query = $this->ass_attempt_m->get_my_questions($q_replace_s[0]);
			if ($query->num_rows() > 0) {
				$result = $query->result();
					
				$data['result'] = $result;
				$data['question_text'] = read_text(htmlspecialchars_decode(stripslashes($data['result'][0]->question_text)));

				if ($result[0]->question_type == 3) {
					//	Get Essay Answer
					$this->load->model('ass_essay_answer_m');
					$filter = array(
									'uc_ass_attempt'	=> $unique_code,
									'uc_ass_question'	=> $result[0]->uc
									);

					$q_essay = $this->ass_essay_answer_m->get_filtered($filter);
					if ($q_essay->num_rows() > 0) {
						$data['essay'] = $q_essay->row();
					}
				}
			}
			$data['max_question']	= $i;
			$data['att_code']		= $unique_code;
			$data['duration']		= $duration;
			$data['uc_exam' ]		= $uc_exam;

			$this->load->view('assessment/attempt', $data);
		} else {
			redirect('home');
		}
		
	}

	public function attempt_continue($att_uc = NULL, $uc_exam = NULL) {
		if ($att_uc != NULL) {

			// 	Update Start Time
			$start_time = current_time();
			$data 	= array('time_start' => $start_time);
			$filter = array('uc' => $att_uc);
			$this->ass_attempt_m->update_data($data, $filter);
			///	Put start time to session, for counting remain time
			$this->session->set_userdata(array('start_time' => $start_time));

			//	Get 'questions', 'keys', and 'answers' for the assessment just attempted

			$query = $this->ass_attempt_m->get_filtered(array('uc' => $att_uc));

			// This for avoid direct access through URL, so make sure the 'att_code' really exist
			if ($query->num_rows() > 0) {
				$row = $query->row();
				
				//	Generate Assessment Questions for Viewing Purpose
				$questions	= explode(',', $row->questions);
				$answers	= explode(',', $row->answers);
				// $marks		= explode(',', $row->is_marks);

				$q_replace = explode(',', $row->questions);
				$uc_question = "";
				foreach ($q_replace as $qy) {
					$uc_question .= "'".$qy."'".',';

				}

				$q_replace_s = explode(',', $uc_question);

				$query = $this->ass_attempt_m->get_my_questions($q_replace_s[0]);
				if ($query->num_rows() > 0) {
					$result = $query->result();
					
					$data['result'] = $result;
					$data['question_text'] = read_text(htmlspecialchars_decode(stripslashes($data['result'][0]->question_text)));

					if ($result[0]->question_type == 3) {
						//	Get Essay Answer
						$this->load->model('ass_essay_answer_m');
						$filter = array(
										'uc_ass_attempt'	=> $att_uc,
										'uc_ass_question'	=> $result[0]->uc
										);

						$q_essay = $this->ass_essay_answer_m->get_filtered($filter);
						if ($q_essay->num_rows() > 0) {
							$data['essay'] = $q_essay->row();
						}
					}
				}
			}

			$data['att_code']		= $att_uc;
			$data['uc_exam']		= $uc_exam;
			$data['max_question']	= count($questions);
			$data['time_running']	= $row->time_running;
			$data['duration']		= $row->time_remain;
			$data['value']			= $answers[0];
			$data['answers']		= $answers;
			// $data['marks']			= $marks;

			$this->load->view('assessment/attempt_continue', $data);
		}
	}

	public function page_attempt(){
		$data = NULL;
		$uc_attempt = $this->input->post('js_attempt');

		if ($uc_attempt != NULL) {

			$no = $this->input->post('js_no');

			//	Get attempt student
			$query = $this->ass_attempt_m->get_filtered(array('uc' => $uc_attempt));
			if ($query->num_rows() > 0) {
				$row = $query->row();
				
				//	Generate Assessment Questions for Viewing Purpose
				$questions	= explode(',', $row->questions);
				$answers	= explode(',', $row->answers);
				// $marks		= explode(',', $row->is_marks);


				$q_replace = explode(',', $row->questions);
				$uc_question = "";
				foreach ($q_replace as $qy) {
					$uc_question .= "'".$qy."'".',';

				}

				$q_replace_s = explode(',', $uc_question);

				$query = $this->ass_attempt_m->get_my_questions($q_replace_s[$no]);
				if ($query->num_rows() > 0) {
					$result = $query->result();
					
					$data['result'] = $result;
					$data['question_text'] = read_text(htmlspecialchars_decode(stripslashes($data['result'][0]->question_text)));

					if ($result[0]->question_type == 3) {
						//	Get Essay Answer
						$this->load->model('ass_essay_answer_m');
						$filter = array(
										'uc_ass_attempt'	=> $uc_attempt,
										'uc_ass_question'	=> $result[0]->uc
										);

						$q_essay = $this->ass_essay_answer_m->get_filtered($filter);
						if ($q_essay->num_rows() > 0) {
							$data['essay'] = $q_essay->row();
						}
					}
				}

				$data['max_question']	= count($questions);
				$data['no']				= $no+1;
				$data['duration']		= $row->time_remain;
				$data['value']			= $answers[$no];

				$this->load->view('assessment/page_attempt', $data);
			}
			else {
				redirect('home');
			}

		}
	}

	public function save_essay_answer_ajax() {
		$this->save_essay_answer($_POST['js_uc_attempt'],$_POST['js_uc_assque'],$_POST['js_answer'],$_POST['js_uc_answer'],$_POST['js_time_running']);
	}

	public function save_essay_answer($uc_attempt, $uc_assque, $answer, $uc_answer, $time_running) {
		$this->load->model('ass_essay_answer_m');
		
		$data  = "";

		$uc_ass_attempt = $uc_attempt;
		$uc_ass_question = $uc_assque;
		$answer = $answer;

		if ($uc_answer == NULL) {
			// INSERT
			$data = array(
							'uc'				=> uniqid(),
							'uc_ass_attempt'	=> $uc_ass_attempt,
							'uc_ass_question'	=> $uc_ass_question,
							'answer'			=> $answer
						);

			$this->db->trans_start();
			$this->ass_essay_answer_m->insert_data($data);
			$this->db->trans_complete();
		}
		else {
			//	UPDATE
			$data = array('answer' => $answer);
			$filter = array('uc'  => $uc_answer);

			$this->db->trans_start();
			$this->ass_essay_answer_m->update_data($data, $filter);
			$this->db->trans_complete();
		}

		$filter 	= array('uc' => $uc_attempt);
		$row 		= $this->ass_attempt_m->get_filtered($filter)->row();

		/* New remain time */
		$r_xam = $this->assessment_m->get_filtered(array('uc' => $row->uc_assessment))->row();
		$time_remain = $r_xam->duration-$time_running;

		$data 		= array(
							'time_remain'	=> $time_remain,
							'time_running'	=> ($time_running < 0 ? 0 : $time_running),
							'time_finish'	=> current_time()
							);

		$this->db->trans_start();
		$this->ass_attempt_m->update_data($data, $filter);
		$this->db->trans_complete();

		$ps = NULL;
		
		$ps['state'] = $this->db->trans_status();
		$ps['answer'] = $answer;
		
		echo json_encode($ps);
	}

	public function save_answer_ajax(){
		$this->save_answer($_POST['js_att_code'],$_POST['js_q_index'],$_POST['js_answer'],$_POST['js_time_running']);
	}

	public function save_answer($att_code, $q_index, $answer, $time_running){ 

		$data = "";

		$filter 	= array('uc' => $att_code);
		$row 		= $this->ass_attempt_m->get_filtered($filter)->row();
		
		//	Explode answer into array
		$a_arr		= explode(',', $row->answers);
		//	Explode marking into array
		//$m_arr		= explode(',', $row->is_marks);

		//	Update answer
		$replace 	= array($q_index => $answer);
		$a_arr 		= array_replace($a_arr, $replace);

		//	Update marking
		// $replace_marks 	= array($q_index => $is_marks);
		//$m_arr 			= array_replace($m_arr, $replace_marks);

		/* New remain time */
		$r_xam = $this->assessment_m->get_filtered(array('uc' => $row->uc_assessment))->row();
		$time_remain = $r_xam->duration-$time_running;

		$data 		= array(
							'answers' 		=> implode(',', $a_arr),
							// 'is_marks' 		=> implode(',', $m_arr),
							'time_remain'	=> $time_remain,
							'time_running'	=> ($time_running < 0 ? 0 : $time_running),
							'time_finish'	=> current_time()
							);

		$this->db->trans_start();
		$this->ass_attempt_m->update_data($data, $filter);
		$this->db->trans_complete();

		$ps = NULL;
		
		$ps['state'] = $this->db->trans_status();
		$ps['answer'] = $answer;
		
		echo json_encode($ps);
	}

	public function finish_by_time($att_code, $q_index = NULL, $answer = NULL,   $time_running = NULL){
		if ($att_code != NULL) {

			// Save last data attempt
			$this->save_answer($att_code, $q_index, $answer,  $time_running);
			
			//	Update Finish Time
			$data = array(
							'time_finish' 		=> current_time(),
							'is_done'			=> 1
						);
			$filter = array('uc'	=> $att_code);
			$this->ass_attempt_m->update_data($data, $filter);

			//	Calculate Score
			$this->scoring($att_code);

			/* BEGIN Of Check if scoring worked */
				$q_att = $this->ass_attempt_m->get_filtered(array('uc' => $att_code))->row();
				if ($q_att->score != NULL) {
					
					//	Update Finish Time
					$data = array(
									'time_finish' 		=> current_time(),
									'is_done'			=> 1
								);
					$filter = array('uc'	=> $att_code);
					$this->ass_attempt_m->update_data($data, $filter);
					
					// Clear all fucking print
					ob_end_clean();
					
					// $this->score($att_code);

					redirect('student/classroom/content/view_assessment/'.$this->session->userdata('uc_classroom').'/'.$this->session->userdata('uc_diklat_class').'/'.$this->session->userdata('uc_content'));
					
				} else {

					echo "Data Failed";
					// $data['msg'] = "Data Failed";
					// $this->im_render->main('info', $data);
				}
			/* END Of Check if scoring worked */

		} else {
			$data['msg'] = "Access Denied";
			$this->im_render->main('info', $data);
		}
	}

	public function scoring($att_code = NULL){
		if ($att_code != NULL) {

			//	Get keys and answers
			$query = $this->ass_attempt_m->get_filtered(array('uc' => $att_code));
			if ($query->num_rows() > 0) {
				$row = $query->row();

				$questions	= explode(',', $row->questions);
				$answer_arr = explode(',', $row->answers);
				$key_arr	= explode(',', $row->keyss);
			}

			// echo "<br /> QUE : ".$row->questions;
			// echo "<pre>";
			// print_r($questions);
			// echo "</pre>";
			// echo "<hr />";

			// echo "<br /> ANS : ".$row->answers;
			// echo "<pre>";
			// print_r($answer_arr);
			// echo "</pre>";
			// echo "<hr />";

			// echo "<br /> KEY : ".$row->keyss;
			// echo "<pre>";
			// print_r($key_arr);
			// echo "</pre>";

			// Prop for insert exam_attempt
			$result_arr			= array();
			$true = 0;
			$false = 0;
			$z = 0;

			foreach ($answer_arr as $aa ){
				// Count the score and result answer 
				if ($answer_arr[$z] == $key_arr[$z]) {
					array_push($result_arr, 1);

					$true++;
				}
				else {
					array_push($result_arr, 0);

					$false++;
				}
				// Count the score and result answer

				$z++;
			}

			// BEGIN Of Update exam_attempt
			$a_result = implode(',', $result_arr);

			$total_score = value_format((($true / count($questions)) * 100), ',', '.', 2);

			///	updating score
			$data = array(
							'answer_true'		=> $true,
							'answer_false'		=> $false,
							'answer_result'		=> $a_result,
							'non_essay_score'	=> $total_score,
							'score'				=> $total_score,
							'time_finish'		=> current_time()
						);

			$filter = array('uc' => $att_code);

			$this->ass_attempt_m->update_data($data, $filter);
			// END Of Update exam_attempt
		}
	}

	public function scoring_BACKUP($att_code = NULL){
		if ($att_code != NULL) {

			//	Get keys and answers
			$query = $this->ass_attempt_m->get_filtered(array('uc' => $att_code));
			if ($query->num_rows() > 0) {
				$row = $query->row();

				$questions	= explode(',', $row->questions);
				$answer_arr = explode(',', $row->answers);
				$key_arr	= explode(',', $row->keyss);
			}

			// Prop for insert exam_attempt
			$result_arr			= array();
			$true = 0;
			$false = 0;
			$z = 0;

			foreach ($answer_arr as $aa ){

				/* Count the score and result answer */
					if ($answer_arr[$z] == $key_arr[$z]) {
						array_push($result_arr, 1);

						$true++;
					}
					else {
						array_push($result_arr, 0);

						$false++;
					}
				/* Count the score and result answer */

				$z++;
			}

			/* BEGIN Of Update exam_attempt */
				$a_result = implode(',', $result_arr);

				$total_score = value_format((($true / count($questions)) * 100), ',', '.', 2);

				///	updating score
				$data = array(
								'answer_true'		=> $true,
								'answer_false'		=> $false,
								'answer_result'		=> $a_result,
								'score'				=> $total_score,
								'time_finish'		=> current_time()
							);

				$filter = array('uc' => $att_code);

				$this->ass_attempt_m->update_data($data, $filter);
			/* END Of Update exam_attempt */
		}
	}

	public function score($att_code = '463-93060-44-22') {
		if ($att_code != NULL) {

			$data = NULL;

			$filter['uc'] = $att_code;

			$query = $this->ass_attempt_m->get_filtered(array('uc' => $att_code));
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
			}

			//	Remove 'in attempt' status
			$this->session->unset_userdata('in_attempt');		

			$this->load->view('assessment/score', $data);

		} else {
			redirect('home');
		}
	}

	public function finish(){
		//$answer	= (isset($_POST['f_essay_answer']) ? $_POST['f_essay_answer'] : NULL );

		$answer	= $this->input->post('f_essay_answer');
		$assque	= $this->input->post('f_uc_assque');

		//echo " + ".$answer." - ".$assque;
		
		//	Re-set the att_code, weather it from "Form Submit" or "Finish by Time"
		$att_code = ($this->input->post('f_att_code') != NULL || $this->input->post('f_att_code') != "" ? $this->input->post('f_att_code') : $this->session->userdata('att_code'));


		if ($att_code != NULL) {	
			$ques_no 	= $this->input->post('f_curr_no');
			$q_index 	= $ques_no - 1;

			//echo "ATTC : ".$att_code;
			

			// Update Last answered
			if ($this->input->post('f_question_type') == 3) {
				$answer	= (isset($_POST['f_essay_answer']) ? $_POST['f_essay_answer'] : NULL );
				$this->save_essay_answer($att_code, $this->input->post('f_uc_assque'), $this->input->post('f_essay_answer'), $this->input->post('f_uc_ess_answer'), $_POST['f_time_running']);
			}
			else {
				$answer	= (isset($_POST['f_answer']) ? $_POST['f_answer'] : NULL );
				$this->save_answer($att_code, $q_index, $answer, $_POST['f_time_running']);
			}
			
			//	Calculate Score
			$this->scoring($att_code);
			// BEGIN Of Check if scoring worked
			$q_att = $this->ass_attempt_m->get_filtered(array('uc' => $att_code))->row();
			if ($q_att->score != NULL) {
				
				//	Update Finish Time
				$data = array(
								'time_finish' 		=> current_time(),
								'is_done'			=> 1
							);
				$filter = array('uc'	=> $att_code);
				$this->ass_attempt_m->update_data($data, $filter);
				
				// Clear all fucking print
				ob_end_clean();
				
				redirect('student/classroom/content/view_assessment/'.$this->session->userdata('uc_classroom').'/'.$this->session->userdata('uc_diklat_class').'/'.$this->session->userdata('uc_content'));
				
			} else {
				$data['msg'] = "Data Failed";
				$this->im_render->main('info', $data);
			}
			// END Of Check if scoring worked
		}
		else {
			$data['msg'] = "Access Denied";
			$this->im_render->main('info', $data);
		}
	}


}