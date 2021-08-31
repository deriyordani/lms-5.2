<?php
Class Question_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_question';
	}

    function get_list($filter = NULL,$limit = NULL, $offset = 0){



        $sql = " SELECT qs.*";

        if (!$filter['count']) {
            $sql .= ", sj.subject_title, d.diklat, p.prodi ";
        }

        $sql .= "FROM `lms_question` qs";

        if (!$filter['count']) {
            $sql .= " 
                        LEFT JOIN lms_subject sj ON qs.uc_subject = sj.uc
                        LEFT JOIN lms_diklat d ON sj.uc_diklat = d.uc
                        LEFT JOIN lms_prodi p ON sj.uc_prodi = p.uc 
                    ";
        }

        $where = FALSE;

        if (@$filter['uc'] != NULL) {
            if ($where) {
                $sql .= " AND ";
            }
            else {
                $sql .= " WHERE ";
                $where = TRUE;
            }

            $sql .= " qs.uc = '".$filter['uc']."' ";
        }   

        if (@$filter['uc_prodi'] != NULL) {
            if ($where) {
                $sql .= " AND ";
            }
            else {
                $sql .= " WHERE ";
                $where = TRUE;
            }
            $sql .= " sj.uc_prodi = '".$filter['uc_prodi']."' ";
        }

        if (@$filter['uc_diklat'] != NULL) {
            if ($where) {
                $sql .= " AND ";
            }
            else {
                $sql .= " WHERE ";
                $where = TRUE;
            }
            $sql .= " sj.uc_diklat = '".$filter['uc_diklat']."' ";
        }

        if (@$filter['uc_subject'] != NULL) {
            if ($where) {
                $sql .= " AND ";
            }
            else {
                $sql .= " WHERE ";
                $where = TRUE;
            }
            $sql .= " qs.uc_subject = '".$filter['uc_subject']."' ";
        }

        if ($limit != NULL) {
            $sql .= "  LIMIT ".$offset.", ".$limit." ";
        }

        //echo $sql;

        

        return $this->exec_query($sql);


    }


    function get_not_picked($uc_subject, $uc_assessment) {
        $sql = " SELECT * FROM `lms_question` 
                WHERE `uc` NOT IN 
                (
                SELECT `uc_question` FROM `lms_ass_question` WHERE `uc_assessment` = '".$uc_assessment."'  
                )
                AND `uc_subject` = '".$uc_subject."' ";

        return $this->exec_query($sql);        
    }

	function pick_randomize($amount_question = 0, $subject = NULL) {
		$sql  = " SELECT * FROM `".$this->table_name."` ";

        if ($subject != NULL) {            
            $sql .= " WHERE `uc_subject` = '".$subject."' ";
        }
        
        $sql .= " ORDER BY RAND() LIMIT ".$amount_question;

		return $this->exec_query($sql);
	}


	function get_options_for_question($uc_new_question = 0) {
		$sql  = " SELECT eq.`uc`, eq.`uc_question`, qo.`option_text`, qo.`is_correct`,  qo.`att_file` ";
        $sql .= " FROM `lms_ass_question` eq  ";
        $sql .= " LEFT JOIN `lms_question` q ON q.`uc` = eq.`uc_question` ";
        $sql .= " LEFT JOIN `lms_question_options` qo ON qo.`uc_question` = q.`uc` ";
        $sql .= " WHERE eq.`uc` IN (".$uc_new_question.") ";
        $sql .= " AND eq.`question_type` = '1'  ";

        return $this->exec_query($sql);

    }
}