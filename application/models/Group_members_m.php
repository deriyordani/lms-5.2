<?php
Class Group_members_m extends MY_Model{
	function __construct(){
		parent::__construct();

		$this->table_name = 'lms_groups_members';
	}

	public function check($uc_user, $uc_classroom)
    {
        $check = $this->db->get_where($this->table_name, ['uc_classroom' => $uc_classroom, 'uc_user' => $uc_user]);

        if ($check->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}