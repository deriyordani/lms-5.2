<?php

function activity_log($aksi, $item){
    $CI =& get_instance();

    $parms = [

        'uc' => uniqid(),
        'log_item' => $item,
        'log_aksi' => $aksi,
        'log_user' => $CI->session->userdata('log_uc'),
        'log_type_user' => $CI->session->userdata('log_category')
    ];

    $CI->load->model('log_m');


    $CI->log_m->insert_data($parms);

}
?>