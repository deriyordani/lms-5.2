<?php
Class Ass_question_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_ass_question';
	}

   function get_keys($uc_exam = 0){
    	$sql  = " SELECT eq.*, eo.`uc` AS  `key`  ";
		$sql .= " FROM `".$this->table_name."` eq ";
		$sql .= " LEFT JOIN `lms_ass_options` eo ON eo.`uc_exam_question` = eq.`uc`";
		$sql .= " AND eo.`is_correct` = '1' ";
		$sql .= " WHERE eq.`uc_assessment` = '".$uc_exam."' ";
		$sql .= " AND eq.`question_type` = '1' ";

		return $this->exec_query($sql);
    }


    function update_keys($result){
        $sql  = " UPDATE `".$this->table_name."` ";
        $sql .= " SET `answer_multiplechoice` = CASE ";
        
        $ucs = "";
        for ($i=0; $i<count($result); $i++) {           
            $sql .= " WHEN `uc` = '".$result[$i]->uc."' THEN '".$result[$i]->key."' ";

            //  Collecting ID(s)
            $ucs .= "'".$result[$i]->uc."',";
        }
        $ucs = substr_replace($ucs, '', -1);

        $sql .= " END ";
        $sql .= " WHERE `uc` IN (".$ucs.")";

        $this->exec_query($sql);
    }

     function generate_question($uc = 0){
        $sql  = " SELECT eq.*, q.uc_subject ";
        $sql .= " FROM `lms_ass_question` eq ";
        $sql .= " LEFT JOIN `lms_question` q ON eq.uc_question = q.uc ";
        $sql .= " LEFT JOIN `lms_subject` c ON q.uc_subject = c.uc ";
        $sql .= " WHERE eq.uc_assessment = '".$uc."' ";
        $sql .= " ORDER BY RAND(); ";

        //echo $sql;

        return $this->exec_query($sql);
    }

    function update_bnee($uc_assessment, $bnee) {
        $sql = " UPDATE `".$this->table_name."` SET `bobot` = '".$bnee."' 
                    WHERE `uc_assessment` = '".$uc_assessment."' 
                    AND `question_type` != '3' ";

        $this->exec_query($sql);
    }

     function get_questions($uc_assessment) {
        $sql = " SELECT aq.* FROM `".$this->table_name."` aq
                    LEFT JOIN `lms_question` q
                    ON q.`uc` = aq.`uc_question`
                    WHERE aq.`uc_assessment` = '".$uc_assessment."' ";

        return $this->exec_query($sql);
    }

    function get_essay_question_answer($uc_assessment, $uc_attempt) {
        $sql = " SELECT aq.*, asa.`uc` AS `uc_answer`, asa.`answer`, asa.`score` 
                    FROM `lms_ass_question` aq 
                    LEFT JOIN `lms_question` q ON q.`uc` = aq.`uc_question` 
                    LEFT JOIN `lms_ass_essay_answer` asa ON asa.`uc_ass_question` = aq.`uc` 
                    AND asa.`uc_ass_attempt` = '".$uc_attempt."' 
                    WHERE aq.`uc_assessment` = '".$uc_assessment."' AND aq.`question_type` = '3'  ";

        return $this->exec_query($sql);            
    }

    function get_questions_BACKUP($uc_assessment) {
        $sql = " SELECT aq.* FROM `".$this->table_name."` aq
                    LEFT JOIN `lms_question` q
                    ON q.`uc` = aq.`uc_question`
                    WHERE aq.`uc_assessment` = '".$uc_assessment."' ";

        return $this->exec_query($sql);
    }
}