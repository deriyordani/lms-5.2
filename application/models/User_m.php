<?php
Class User_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_user';
	}

	function get_list($filter = NULL,$limit = NULL, $offset = 0){
		$sql = " SELECT u.* ";


		if (!$filter['count']) {
 			$sql .= ",i.full_name, i.id_number, i.is_claim  ";
 		}

 		$sql .= "FROM `lms_user` u";


		if (!$filter['count']) {
			$sql .= " 
		    			LEFT JOIN lms_instructor i ON u.uc_person = i.uc
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

			$sql .= " u.uc = '".$filter['uc']."' ";
		}

		if (@$filter['category'] != NULL) {
			if ($where) {
				$sql .= " AND ";
			}
			else {
				$sql .= " WHERE ";
				$where = TRUE;
			}

			if ($filter['category'] == 4) {
				$sql .= " u.category = '".$filter['category']."' OR  u.category = '5' ";
			}else{
				$sql .= " u.category = '".$filter['category']."'  ";
			}

			
		}	


		if ($limit != NULL) {
			$sql .= "  LIMIT ".$offset.", ".$limit." ";
		}


		return $this->exec_query($sql);
	}

	function get_login($username = NULL){
		// $sql = " SELECT * FROM (
		// 		SELECT u1.uc,u1.uc_person, u1.username,u1.password,u1.is_active, s.full_name, dp.is_claim, u1.category, dp.uc_diklat_period, dp.uc_diklat_class
		// 		FROM `lms_user` u1
		// 		LEFT JOIN lms_student s ON u1.uc_person = s.uc
		// 		LEFT JOIN lms_diklat_participant dp ON s.no_peserta = dp.no_peserta
		// 		WHERE dp.is_claim IS NOT NULL

		// 		UNION 

		// 		SELECT u2.uc,u2.uc_person, u2.username,u2.password,u2.is_active, i.full_name, i.is_claim, u2.category, u2.uc as uc_diklat_period, u2.uc as uc_diklat_class
		// 		FROM `lms_user` u2
		// 		LEFT JOIN lms_instructor i ON u2.uc_person = i.uc
		// 		WHERE i.is_claim IS NOT NULL
		// 		) as p WHERE p.username = '".$username."' ";


		// $sql = " SELECT * FROM (
		// 	(SELECT u3.uc,u3.uc_person,u3.photo, u3.username,u3.password,u3.is_active,u3.email, u3.uc_prodi,u3.username as full_name, '1' as is_claim ,u3.category,u3.uc as uc_diklat_participant, u3.uc_prodi as uc_diklat_period, u3.uc as uc_diklat_class
  //   			FROM `lms_user` u3)
  //   			UNION
		// (SELECT u1.uc,u1.uc_person,u1.photo, u1.username,u1.password,u1.is_active,u1.email, u1.uc_prodi, s.full_name, dp.is_claim, u1.category,dp.uc as uc_diklat_participant, dp.uc_diklat_period, dp.uc_diklat_class
		// 		FROM `lms_user` u1
		// 		LEFT JOIN lms_student s ON u1.uc_person = s.uc
		// 		LEFT JOIN lms_diklat_participant dp ON s.no_peserta = dp.no_peserta
  //               WHERE dp.is_claim = '1')
  //               UNION
  //               (SELECT u2.uc,u2.uc_person,u2.photo, u2.username,u2.password,u2.is_active,u2.email,  u2.uc_prodi,i.full_name, i.is_claim, u2.category,u2.uc as uc_diklat_participant, u2.uc as uc_diklat_period, u2.uc as uc_diklat_class
		// 		FROM `lms_user` u2
		// 		LEFT JOIN lms_instructor i ON u2.uc_person = i.uc
  //   			WHERE i.is_claim  = '1')
                
                
  //              ) as p WHERE p.username = '".$username."' GROUP BY p.uc";


		$sql = " SELECT * FROM (

		(SELECT u1.uc,u1.uc_person,u1.photo, u1.username,u1.password,u1.is_active,u1.email, u1.uc_prodi, s.full_name, dp.is_claim, u1.category,dp.uc as uc_diklat_participant, dp.uc_diklat_period, dp.uc_diklat_class
				FROM `lms_user` u1
				LEFT JOIN lms_student s ON u1.uc_person = s.uc
				LEFT JOIN lms_diklat_participant dp ON s.no_peserta = dp.no_peserta
               )
                UNION ALL
                (SELECT u2.uc,u2.uc_person,u2.photo, u2.username,u2.password,u2.is_active,u2.email,  u2.uc_prodi,i.full_name, i.is_claim, u2.category,u2.uc as uc_diklat_participant, u2.uc as uc_diklat_period, u2.uc as uc_diklat_class
				FROM `lms_user` u2
				LEFT JOIN lms_instructor i ON u2.uc_person = i.uc
    			)
                
                
               ) as p WHERE p.username = '".$username."' AND p.is_claim IS NOT NULL GROUP BY p.uc ";

		return $this->exec_query($sql);
	}

	function get_prodi($username = NULL){
		$sql = "

			SELECT u.*, p.prodi
			FROM lms_user u 
			LEFT JOIN lms_prodi p ON u.uc_prodi = p.uc 
			WHERE u.username = '".$username."' AND u.category = '4'
		";

		return $this->exec_query($sql);
	}
}