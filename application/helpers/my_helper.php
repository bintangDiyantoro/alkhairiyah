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
    $CI->session->unset_userdata('id');
    $CI->session->unset_userdata('nomor_induk');
    $CI->session->unset_userdata('nisn');
    $CI->session->unset_userdata('nama');
    $CI->session->unset_userdata('tmp_lahir');
    $CI->session->unset_userdata('ttl');
    $CI->session->unset_userdata('jenis_kelamin');
    $CI->session->unset_userdata('agama');
    $CI->session->unset_userdata('alamat');
    $CI->session->unset_userdata('pendidikan_sebelumnya');
    $CI->session->unset_userdata('alamat_ortu');
    $CI->session->unset_userdata('alamat_wali');
    $CI->session->unset_userdata('no_hp_ortu');
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

function netralize4()
{
    $CI = get_instance();
    $CI->session->unset_userdata('alamat_ayah');
    $CI->session->unset_userdata('pendterakhir_ayah');
    $CI->session->unset_userdata('keterangan_ayah');
    $CI->session->unset_userdata('nohape_ayah');
    $CI->session->unset_userdata('alamat_ibu');
    $CI->session->unset_userdata('pendterakhir_ibu');
    $CI->session->unset_userdata('keterangan_ibu');
    $CI->session->unset_userdata('nohape_ibu');;
    $CI->session->unset_userdata('status_wali');
    $CI->session->unset_userdata('pendterakhir_wali');
    $CI->session->unset_userdata('nohape_wali');
    $CI->session->unset_userdata('stwali');
    $CI->session->unset_userdata('wali');
    $CI->session->unset_userdata('search');
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
        return "<a href=" . base_url('admin/aktivasiadmin/') . $id . "\" class=\"badge badge-success adminvrf\" data-id=\"" . $id . "\">Aktifkan</a>";
    } elseif ($vrf == "1") {
        return "<a href=" . base_url('admin/aktivasiadmin/') . $id . "\" class=\"badge badge-info adminvrf\" data-id=\"" . $id . "\">Non Aktifkan</a>";
    }
}

function togglesidebar($data)
{
    $CI = get_instance();
    if ($data == "toggled") {
        return "not_toggled";
    } else {
        return "toggled";
    }
}


function selectedOpt($value, $input)
{
    if ($value === $input) {
        return "selected";
    }
}

function headerLooper($kelas_siswa, $key, $colspan = 1)
{
    for ($i = 1; $i <= 6; $i++) :
        $j = 1;
        foreach ($kelas_siswa as $ks) :
            if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) :
                if ($key === 'class') :
                    echo '<th class="align-middle" scope="col" colspan="' . $colspan . '">Kelas ' . $ks[$key] . '</th>';
                elseif ($key === 'tahun') :
                    echo '<th class="align-middle" scope="col" colspan="' . $colspan . '">' . $ks[$key] . '</th>';
                endif;
                break;
            else :
                if ($j == count($kelas_siswa)) :
                    if ($key === 'class') :
                        echo '<th class="align-middle" scope="col" colspan="' . $colspan . '">Kelas ...</th>';
                    elseif ($key === 'tahun') :
                        echo '<th class="align-middle" scope="col" colspan="' . $colspan . '">.../...</th>';
                    endif;
                endif;
                $j++;
            endif;
        endforeach;
    endfor;
}

function sikapTextArea($idsiswa, $idkelassiswa, $idsemester, $idsikap, $tahun, $nilai_sikap = NULL)
{
    $inputEl = '<td class="align-middle">
                    <div class="form-group ubah-sikap-textarea">
                        <textarea class="form-control ubah-nilai-sikap ubah-sikap-textarea" name="' . $idsiswa . '_' . $idkelassiswa . '_' . $idsemester . '_' . $idsikap . '" id="' . $idsiswa . '_' . $idkelassiswa . '_' . $idsemester . '_' . $idsikap . '">' . $nilai_sikap . '</textarea>
                    </div>
                </td>';

    $tahunInput = explode('/', $tahun)[0];

    if ($tahunInput == date('Y')) {
        if ((int)date('m') >= 7 && (int)date('m') < 12) {
            if ($idsemester == '2') {
                return '<td class="align-middle"></td>';
            } elseif ($idsemester == '1') {
                return $inputEl;
            }
        } else {
            return $inputEl;
        }
    } else {
        return $inputEl;
    }
}

function ubahSikapTextareaLoop($akses_wali_kelas, $idsemester, $idsikap, $nilai_sikap)
{
    for ($i = 1; $i <= 6; $i++) :
        $j = 1;
        foreach ($akses_wali_kelas as $awk) :
            if ((int)$awk["id_kelas"] >= $i * 4 - 3 && (int)$awk["id_kelas"] <= $i * 4) :
                if ($nilai_sikap) {
                    $k = 1;
                    foreach ($nilai_sikap as $ns) {
                        if ($ns["id_kelas"] == $awk["id_kelas"] && $ns["id_semester"] == $idsemester && $ns["id_sikap"] == $idsikap) {
                            echo sikapTextArea($awk["id_siswa"], $awk["id"], $idsemester, $idsikap, $awk["tahun"], $ns["nilai"]);
                            break;
                        } else {
                            if ($k == count($nilai_sikap)) {
                                echo sikapTextArea($awk["id_siswa"], $awk["id"], $idsemester, $idsikap, $awk["tahun"], '');
                            } else {
                                $k++;
                            }
                        }
                    }
                } else {
                    echo sikapTextArea($awk["id_siswa"], $awk["id"], $idsemester, $idsikap, $awk["tahun"]);
                }

                break;
            else :
                if ($j == count($akses_wali_kelas)) :
                    if ($nilai_sikap) {
                        $j = 1;
                        foreach ($nilai_sikap as $ns) {
                            if ((int)$ns["id_kelas"] >= $i * 4 - 3 && (int)$ns["id_kelas"] <= $i * 4 && $ns["id_semester"] == $idsemester && $ns["id_sikap"] == $idsikap) {
                                echo '<td class="align-middle">' . $ns["nilai"] . '</td>';
                                break;
                            } else {
                                if ($j == count($nilai_sikap)) {
                                    echo '<td class="align-middle"></td>';
                                } else {
                                    $j++;
                                }
                            }
                        }
                    } else {
                        echo '<td class="align-middle"></td>';
                    }
                endif;
                $j++;
            endif;
        endforeach;
    endfor;
}

function nilaiSikapLooper($nilai_sikap, $idsemester, $idsikap)
{
    for ($i = 1; $i <= 6; $i++) {
        if ($nilai_sikap) {
            $j = 1;
            foreach ($nilai_sikap as $ns) {
                if ((int)$ns["id_kelas"] >= $i * 4 - 3 && (int)$ns["id_kelas"] <= $i * 4 && $ns["id_semester"] == $idsemester && $ns["id_sikap"] == $idsikap) {
                    echo '<td class="align-middle">' . $ns["nilai"] . '</td>';
                    break;
                } else {
                    if ($j == count($nilai_sikap)) {
                        echo '<td class="align-middle"></td>';
                    } else {
                        $j++;
                    }
                }
            }
        } else {
            echo '<td class="align-middle"></td>';
        }
    }
}
