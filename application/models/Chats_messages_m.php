<?php
Class Chats_messages_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_chats_messages';
	}


	public function get_chats_messages($uc_classroom, $last_chat_message_id = 0){
		$sql = "  	SELECT cm.id,cm.uc_user,cm.content,
					DATE_FORMAT(cm.created_at, '%D of %M %Y at %H:%i:%s') AS timestamp, u.username,u.photo
					FROM lms_chats_messages AS cm
					JOIN lms_user AS u ON cm.uc_user = u.uc 

					 WHERE 
	                    cm.uc_classroom = ?
	                AND 
	                    cm.id > ?
	                ORDER BY
	                    cm.id
	                ASC
					";



		$result = $this->db->query($sql, [$uc_classroom, $last_chat_message_id]);

		//echo $sql;
        return $result;
	}

}