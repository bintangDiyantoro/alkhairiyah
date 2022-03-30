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
function selectwali($name)
{
    $CI = get_instance();
    if ($CI->session->userdata('wali') == $name) {
        return 'selected';
    }
}

function selectwali2($name)
{
    $CI = get_instance();
    if ($CI->session->userdata('wali2') == $name) {
        return 'selected';
    }
}
function selectitip($status)
{
    $CI = get_instance();
    if ($CI->session->userdata('titip') == $status) {
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

function stu_back()
{
    $CI = get_instance();
    if ($CI->session->userdata('wali') == 'Ayah' && $CI->session->userdata('wali') == 'Ibu') {
        return '/pendaftaran';
    } elseif ($CI->session->userdata('wali') == 'Lainnya') {
        return '/pendaftaran/wali';
    }
}

function netralize()
{
    $CI = get_instance();
    $CI->session->unset_userdata('nama_ayah');
    $CI->session->unset_userdata('alamat_ayah');
    $CI->session->unset_userdata('pekerjaan_ayah');
    $CI->session->unset_userdata('pendterakhir_ayah');
    $CI->session->unset_userdata('keterangan_ayah');
    $CI->session->unset_userdata('nohape_ayah');
    $CI->session->unset_userdata('nama_ibu');
    $CI->session->unset_userdata('alamat_ibu');
    $CI->session->unset_userdata('pekerjaan_ibu');
    $CI->session->unset_userdata('pendterakhir_ibu');
    $CI->session->unset_userdata('keterangan_ibu');
    $CI->session->unset_userdata('nohape_ibu');
    $CI->session->unset_userdata('nama_wali');
    $CI->session->unset_userdata('alamat_wali');
    $CI->session->unset_userdata('status_wali');
    $CI->session->unset_userdata('pekerjaan_wali');
    $CI->session->unset_userdata('pendterakhir_wali');
    $CI->session->unset_userdata('nohape_wali');
    $CI->session->unset_userdata('stwali');
    $CI->session->unset_userdata('wali');
    $CI->session->unset_userdata('search');
    $CI->session->unset_userdata('tgl_lahir');
}

function netralize2()
{
    $CI = get_instance();
    $CI->session->unset_userdata('nama_ayah');
    $CI->session->unset_userdata('alamat_ayah');
    $CI->session->unset_userdata('pekerjaan_ayah');
    $CI->session->unset_userdata('pendterakhir_ayah');
    $CI->session->unset_userdata('keterangan_ayah');
    $CI->session->unset_userdata('nohape_ayah');
    $CI->session->unset_userdata('nama_ibu');
    $CI->session->unset_userdata('alamat_ibu');
    $CI->session->unset_userdata('pekerjaan_ibu');
    $CI->session->unset_userdata('pendterakhir_ibu');
    $CI->session->unset_userdata('keterangan_ibu');
    $CI->session->unset_userdata('nohape_ibu');
    $CI->session->unset_userdata('nama_wali');
    $CI->session->unset_userdata('alamat_wali');
    $CI->session->unset_userdata('status_wali');
    $CI->session->unset_userdata('pekerjaan_wali');
    $CI->session->unset_userdata('pendterakhir_wali');
    $CI->session->unset_userdata('nohape_wali');
    $CI->session->unset_userdata('stwali');
    $CI->session->unset_userdata('wali');
    // $CI->session->unset_userdata('search');
    $CI->session->unset_userdata('tgl_lahir');
}

function netralize3()
{
    $CI = get_instance();
    $CI->session->unset_userdata('nama_ayah2');
    $CI->session->unset_userdata('alamat_ayah2');
    $CI->session->unset_userdata('pekerjaan_ayah2');
    $CI->session->unset_userdata('pendterakhir_ayah2');
    $CI->session->unset_userdata('keterangan_ayah2');
    $CI->session->unset_userdata('nohape_ayah2');
    $CI->session->unset_userdata('nama_ibu2');
    $CI->session->unset_userdata('alamat_ibu2');
    $CI->session->unset_userdata('pekerjaan_ibu2');
    $CI->session->unset_userdata('pendterakhir_ibu2');
    $CI->session->unset_userdata('keterangan_ibu2');
    $CI->session->unset_userdata('nohape_ibu2');
    $CI->session->unset_userdata('nama_wali2');
    $CI->session->unset_userdata('alamat_wali2');
    $CI->session->unset_userdata('status_wali2');
    $CI->session->unset_userdata('pekerjaan_wali2');
    $CI->session->unset_userdata('pendterakhir_wali2');
    $CI->session->unset_userdata('nohape_wali2');
    $CI->session->unset_userdata('stwali2');
    $CI->session->unset_userdata('wali2');
    $CI->session->unset_userdata('titip');
    $CI->session->unset_userdata('tgl_lahir2');
}

function is_image($file)
{
    $tmp = explode(".", $file);
    $res = strtolower(end($tmp));
    if ($res == "jpg" || $res == "jpeg" || $res == "png" || $res == "bmp") {
        return TRUE;
    } else {
        return FALSE;
    }
}

function admvrf($vrf, $id)
{
    if ($vrf == "0") {
        return "<a href=". base_url('admin/aktivasiadmin/') . $id."\" class=\"badge badge-success adminvrf\" data-id=\"".$id."\">Aktifkan</a>";
    } elseif ($vrf == "1") {
        return "<a href=" . base_url('admin/aktivasiadmin/') . $id . "\" class=\"badge badge-info adminvrf\" data-id=\"" . $id . "\">Non Aktifkan</a>";
    }
}