<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran_model extends MY_Model {
    function __construct(){
        parent::__construct();
    }

    function get_presence_in_class($classroom){
        $query = $this->db->query("SELECT uc_section, uc_diklat_participant, status FROM lms_kehadiran WHERE uc_classroom = '".$classroom."'");
        return $query->result();
    }
}
?>