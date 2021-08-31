<?php
Class Ass_attempt_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_ass_attempt';
	}

	function get_my_questions($uc_question = 0){
		$sql = " SELECT eq . * , eo.`option_text`, eo.`option_att_file`, eo.`is_correct`, 
				eo.`id` AS `option_id`, eo.`uc` AS `option_uc`, c.content_title, s.subject_title
				FROM `lms_ass_question` eq 
				LEFT JOIN `lms_ass_options` eo ON eq.`uc` = eo.`uc_exam_question`
				LEFT JOIN `lms_question` q ON eq.`uc_question` = q.`uc`
				LEFT JOIN `lms_assessment` e ON eq.`uc_assessment` = e.`uc`
				LEFT JOIN lms_content c ON e.uc_content = c.uc
				LEFT JOIN lms_subject s ON q.uc_subject = s.uc ";
		$sql .= " WHERE eq.`uc` IN (".$uc_question.") ";
		$sql .= " ORDER BY RAND() ;";



		return $this->exec_query($sql);
	}

	function get_attempted($uc_content) {
		$sql = " SELECT aa.*, s.`full_name`, s.`no_peserta` 
					FROM `lms_ass_attempt` aa 
					LEFT JOIN `lms_student` s ON s.`uc` = aa.`uc_student` 
					WHERE aa.`uc_assessment` = ( SELECT `uc` FROM `lms_assessment` WHERE `uc_content` = '".$uc_content."' ) ";
		
		return $this->exec_query($sql);
	}
}