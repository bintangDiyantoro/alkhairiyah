<?php

function isActive()
{
    //get instance to call CI Libraries within this function
    $CI = get_instance();
    if (!$CI->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $CI->session->userdata('role_id');
        $menu = ucfirst($CI->uri->segment(1));
        $queryMenu = $CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        $user_access = $CI->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id])->row_array();
        if ($user_access < 1) {
            redirect('auth/blocked');
        }
    }
}
function check_access($role_id, $menu_id)
{
    $CI = get_instance();
    $result = $CI->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function selectwali($name){
    $CI = get_instance();
    if($CI->session->userdata('wali') == $name){
        return 'selected';
    }
}

function selectKel($jns_kelamin)
{
    $CI = get_instance();
    if ($CI->session->userdata('jenis_kelamin') == $jns_kelamin) {
        return 'selected';
    }
}

function stu_back(){
    $CI = get_instance();
    if($CI->session->userdata('wali') == 'Ayah' && $CI->session->userdata('wali') == 'Ibu'){
        return '/pendaftaran';
    }elseif($CI->session->userdata('wali') == 'Lainnya'){
        return '/pendaftaran/wali';
    }
}