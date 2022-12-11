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

function guruKelas($idKelas, $waliKelas)
{
    $i = 1;
    foreach ($waliKelas as $wk) {
        if ($i == count($waliKelas)) {
            return '-';
        } else {
            if ($idKelas === $wk['id_kelas']) {
                return $wk["gurukelas"];
                break;
            } else {
                $i++;
            }
        }
    }
}

function classCardColor($idKelas)
{
    $idKelas = (int)$idKelas;
    switch ($idKelas) {
        case $idKelas >= 1 && $idKelas <= 4:
            return "kelas-1";
            break;
        case $idKelas >= 5 && $idKelas <= 8:
            return "kelas-2";
            break;
        case $idKelas >= 9 && $idKelas <= 12:
            return "kelas-3";
            break;
        case $idKelas >= 12 && $idKelas <= 16:
            return "kelas-4";
            break;
        case $idKelas >= 17 && $idKelas <= 20:
            return "kelas-5";
            break;
        case $idKelas >= 21 && $idKelas <= 24:
            return "kelas-6";
            break;
    }
}

function classBtnCardColor($idKelas)
{
    $idKelas = (int)$idKelas;
    switch ($idKelas) {
        case $idKelas >= 1 && $idKelas <= 4:
            return "btn-kelas-1";
            break;
        case $idKelas >= 5 && $idKelas <= 8:
            return "btn-kelas-2";
            break;
        case $idKelas >= 9 && $idKelas <= 12:
            return "btn-kelas-3";
            break;
        case $idKelas >= 12 && $idKelas <= 16:
            return "btn-kelas-4";
            break;
        case $idKelas >= 17 && $idKelas <= 20:
            return "btn-kelas-5";
            break;
        case $idKelas >= 21 && $idKelas <= 24:
            return "btn-kelas-6";
            break;
    }
}

function hasilPencarianSiswa($query)
{
    $CI = get_instance();
    $j = 1;
    foreach ($query as $q) :
        if ($q["class"] !== "lulus" && $q["class"] !== "belum daftar") :
            echo '<div class="row mt-3">
            <h4 class="text-center">Hasil Pencarian:</h4>
        </div>
            <div class="row" style="overflow-x: auto!important;">
                <table class="table table-hover my-3">
                <thead>
                <tr>
                <th scope="col" class="align-middle text-left">Nama</th>
                <th scope="col" class="align-middle" >Kelas</th>
                <th scope="col" class="align-middle" >Opsi</th>
                <th scope="col" class="align-middle" >Nomor Induk</th>
                <th scope="col" class="align-middle" >NISN</th>
                <th scope="col" class="align-middle" >Jenis Kelamin</th>
                </tr>
                </thead>
                <tbody>';
            break;
        else :
            if ($j == count($query)) {
                echo '<h4>Data tidak ditemukan</h4>
                    <p>Silahkan masukkan data siswa tersebut</p>
                    <button class="btn btn-info my-2" data-target="#FormTambahSiswa" data-toggle="modal">Tambah Siswa</button>
                    <button class="btn btn-secondary cari-lagi" style="margin-left: 1px;">Cari Siswa Lain</button>';
            } else {
                $j++;
            }
        endif;
    endforeach;
    $i = 1;
    foreach ($query as $q) :
        if ($q["class"] !== "lulus" && $q["class"] !== "belum daftar") :
            echo '<tr>
                    <td class="align-middle text-left">' . $q["nama"] . '</td>
                    <td class="align-middle">' . $q["class"] . '</td>';
            echo '<td class="align-middle">';
            if ($q["class"] === "-") :
                if (explode('/', $_SERVER["HTTP_REFERER"])[4] == "sppkelas") :
                    echo '<span class="badge badge-primary badge-masukkan-siswa" data-csrf="' . $CI->csrf["hash"] . '" data-idsiswa="' . $q["id"] . '" data-idkelas="' . explode('/', $_SERVER["HTTP_REFERER"])[5] . '" data-tahun="' . explode('/', $_SERVER["HTTP_REFERER"])[6] . '/' . explode('/', $_SERVER["HTTP_REFERER"])[7] .  '" data-name="' . $q["nama"] . '" style="cursor:pointer">
                        Tambahkan Ke Kelas
                        </span>';
                else :
                    echo '<span style="cursor:pointer" class="badge badge-primary badge-masukkan-siswa" data-csrf="' . $CI->csrf["hash"] . '" data-idsiswa="' . $q["id"] . '" data-idkelas="' . $CI->session->userdata("id_kelas") . '" data-tahun="' . $CI->session->userdata("tahun") . '" data-name="' . $q["nama"] . '">
                        Tambahkan Ke Kelas
                        </span>';
                endif;
            else :
                echo '<span href="#" class="badge badge-secondary" style="cursor: pointer;">Tambahkan Ke Kelas</span>';
            endif;
            echo '</td>';
            echo '<td class="align-middle">' . $q["nomor_induk"] . '</td>
                                <td class="align-middle">' . $q["nisn"] . '</td>
                                <td class="align-middle">';
            if ($q["jenis_kelamin"] == "L") {
                echo "Laki-laki";
            } elseif ($q["jenis_kelamin"] == "P") {
                echo "Perempuan";
            }
            echo '</td>
                </tr>';
        endif;
    endforeach;
    foreach ($query as $q) {
        if ($q["class"] !== "lulus" && $q["class"] !== "belum daftar") {
            echo '</tbody>
            </table>
                </div>
                <div class="row d-flex justify-content-end mt-2">
                    <button class="btn btn-success cari-lagi mr-1">Cari Siswa Lain</button>';
            if (explode('/', $_SERVER["HTTP_REFERER"])[4] == "sppkelas") {
                echo '<span style="height: 35px;margin-left: 3px;" class="btn btn-secondary spp-cari-siswa-batal">Batal</span>';
            } else {
                echo '<a href="' . base_url('admin/daftarsiswa/' . $CI->session->userdata("id_kelas") . '/' . $CI->session->userdata('tahun')) . '" class="btn btn-secondary">Batal</a>';
            }
            echo '</div>';
            break;
        }
    }
}

function siswaTidakDitemukan()
{
    return '<h4>Data tidak ditemukan</h4>
            <p class="text-center">Silahkan masukkan data siswa tersebut</p>
            <button class="btn btn-info my-2" data-target="#FormTambahSiswa" data-toggle="modal">Tambah Siswa</button>
            <button class="btn btn-secondary cari-lagi" style="margin-left: 1px;">Cari Siswa Lain</button>';
}

function headerLooper($kelas_siswa, $key, $colspan = 1)
{
    for ($i = 1; $i <= 6; $i++) :
        $j = 1;
        foreach ($kelas_siswa as $ks) :
            if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) :
                if ($key === 'class') :
                    echo '<th class="align-middle tb-hidden" scope="col" colspan="' . $colspan . '">Kelas ' . $ks[$key] . '</th>';
                elseif ($key === 'tahun') :
                    echo '<th class="align-middle tb-hidden" scope="col" colspan="' . $colspan . '">' . $ks[$key] . '</th>';
                endif;
                break;
            else :
                if ($j == count($kelas_siswa)) :
                    if ($key === 'class') :
                        echo '<th class="align-middle tb-hidden" scope="col" colspan="' . $colspan . '">Kelas ...</th>';
                    elseif ($key === 'tahun') :
                        echo '<th class="align-middle tb-hidden" scope="col" colspan="' . $colspan . '">.../...</th>';
                    endif;
                endif;
                $j++;
            endif;
        endforeach;
    endfor;
}

function sikapTextArea($idsiswa, $idkelassiswa, $idsemester, $idsikap, $tahun, $nilai_sikap = NULL)
{
    $inputEl = '<td class="align-middle tb-sikap-hidden ubah-sikap-td">
                    <div class="form-group ubah-sikap-textarea-wrapper">
                        <textarea class="form-control ubah-nilai-sikap ubah-sikap-textarea" name="' . $idsiswa . '_' . $idkelassiswa . '_' . $idsemester . '_' . $idsikap . '" id="' . $idsiswa . '_' . $idkelassiswa . '_' . $idsemester . '_' . $idsikap . '">' . $nilai_sikap . '</textarea>
                    </div>
                </td>';

    $tahunInput = explode('/', $tahun)[0];

    if ($tahunInput == date('Y')) {
        if ((int)date('m') >= 7 && (int)date('m') <= 12) {
            if ($idsemester == '2') {
                return '<td class="align-middle tb-sikap-hidden"></td>';
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
                    echo '<td class="align-middle tb-sikap-hidden">' . $ns["nilai"] . '</td>';
                    break;
                } else {
                    if ($j == count($nilai_sikap)) {
                        echo '<td class="align-middle tb-sikap-hidden"></td>';
                    } else {
                        $j++;
                    }
                }
            }
        } else {
            echo '<td class="align-middle tb-sikap-hidden"></td>';
        }
    }
}

function kkmInput($awk, $id_semester, $nilaikkm = NULL)
{
    echo '<td class="align-middle tb-hidden" scope="col" colspan="2">
                            <div class="form-group">
                                <input type="text" class="form-control ubah-nilai-pengetahuan-keterampilan" name="kkm_' . $awk["id_siswa"] . "_" . $awk["id"] . '_' . $id_semester . '" id="kkm_' . $awk["id_siswa"] . "_" . $awk["id"] . '_' . $id_semester . '" maxlength="2" value="' . $nilaikkm . '" style="margin-bottom:-15px">
                            </div>
                        </td>';
}

function kkmInputLooper($akses_wali_kelas, $kkm)
{
    for ($i = 1; $i <= 6; $i++) {
        $j = 1;
        foreach ($akses_wali_kelas as $awk) {
            if ((int)$awk["id_kelas"] >= $i * 4 - 3 && (int)$awk["id_kelas"] <= $i * 4) {
                if ($kkm) {
                    $l = 1;
                    $m = 1;
                    foreach ($kkm as $k) {
                        if ($k["id_kelas"] == $awk["id_kelas"]) {
                            if ($k["id_semester"] == "1") {
                                kkmInput($awk, '1', $k["kkm"]);
                                break;
                            } else {
                                if ($l == count($kkm)) {
                                    kkmInput($awk, '1');
                                } else {
                                    $l++;
                                }
                            }
                        } else {
                            if ($l == count($kkm)) {
                                kkmInput($awk, '1');
                                break;
                            } else {
                                $l++;
                            }
                        }
                    }
                    foreach ($kkm as $k) {
                        if ($k["id_kelas"] == $awk["id_kelas"]) {
                            if ($k["id_semester"] == "2") {
                                kkmInput($awk, '2', $k["kkm"]);
                                break;
                            } else {
                                if ($m == count($kkm)) {
                                    if (date('Y') == explode('/', $awk["tahun"])[0] && (int)date('m') >= 7 && (int)date('m') <= 12) {
                                        echo '<td class="align-middle tb-hidden" scope="col" colspan="2"></td>';
                                    } else {
                                        kkmInput($awk, '2');
                                    }
                                } else {
                                    $m++;
                                }
                            }
                        } else {
                            if ($m == count($kkm)) {
                                if (date('Y') == explode('/', $awk["tahun"])[0] && (int)date('m') >= 7 && (int)date('m') <= 12) {
                                    echo '<td class="align-middle tb-hidden" scope="col" colspan="2"></td>';
                                } else {
                                    kkmInput($awk, '2');
                                }
                                break;
                            } else {
                                $m++;
                            }
                        }
                    }
                } else {
                    kkmInput($awk, '1');
                    if (date('Y') == explode('/', $awk["tahun"])[0] && (int)date('m') >= 7 && (int)date('m') <= 12) {
                        echo '<td class="align-middle tb-hidden" scope="col" colspan="2"></td>';
                    } else {
                        kkmInput($awk, '2');
                    }
                }
                break;
            } else {
                if ($j == count($akses_wali_kelas)) {
                    if ($kkm) {
                        $n = 1;
                        $o = 1;
                        foreach ($kkm as $k) {
                            if ((int)$k["id_kelas"] >= $i * 4 - 3 && (int)$k["id_kelas"] <= $i * 4) {
                                if ($k["id_semester"] == "1") {
                                    echo '<td class="align-middle tb-hidden" scope="col" colspan="2">' . $k["kkm"] . '</td>';
                                    break;
                                } else {
                                    echo '<td class="align-middle tb-hidden" scope="col" colspan="2"></td>';
                                    break;
                                }
                            } else {
                                if ($n == count($kkm)) {
                                    echo '<td class="align-middle tb-hidden" scope="col" colspan="2"></td>';
                                    break;
                                } else {
                                    $n++;
                                }
                            }
                        }
                        foreach ($kkm as $k) {
                            if ((int)$k["id_kelas"] >= $i * 4 - 3 && (int)$k["id_kelas"] <= $i * 4) {
                                if ($k["id_semester"] == "2") {
                                    echo '<td class="align-middle tb-hidden" scope="col" colspan="2">' . $k["kkm"] . '</td>';
                                    break;
                                } else {
                                    $o++;
                                }
                            } else {
                                if ($o == count($kkm)) {
                                    echo '<td class="align-middle tb-hidden" scope="col" colspan="2"></td>';
                                    break;
                                } else {
                                    $o++;
                                }
                            }
                        }
                    } else {
                        echo '<td class="align-middle tb-hidden" scope="col" colspan="2"></td>
                        <td class="align-middle tb-hidden" scope="col" colspan="2"></td>';
                    }
                } else {
                    $j++;
                }
            }
        }
    }
}

function kkmLooper($kkm)
{
    for ($i = 1; $i <= 6; $i++) {
        if ($kkm) {
            $j = 1;
            $l = 1;
            foreach ($kkm as $k) {
                if ((int)$k["id_kelas"] >= $i * 4 - 3 && (int)$k["id_kelas"] <= $i * 4) {
                    if ($k["id_semester"] == "1") {
                        echo '<td class="align-middle" scope="col" colspan="2">' . $k["kkm"] . '</td>';
                        break;
                    } else {
                        if ($j == count($kkm)) {
                            echo '<td class="align-middle" scope="col" colspan="2"></td>';
                        } else {
                            $j++;
                        }
                    }
                } else {
                    if ($j == count($kkm)) {
                        echo '<td class="align-middle" scope="col" colspan="2"></td>';
                    } else {
                        $j++;
                    }
                }
            }
            foreach ($kkm as $k) {
                if ((int)$k["id_kelas"] >= $i * 4 - 3 && (int)$k["id_kelas"] <= $i * 4) {
                    if ($k["id_semester"] == "2") {
                        echo '<td class="align-middle" scope="col" colspan="2">' . $k["kkm"] . '</td>';
                        break;
                    } else {
                        if ($l == count($kkm)) {
                            echo '<td class="align-middle" scope="col" colspan="2"></td>';
                        } else {
                            $l++;
                        }
                    }
                } else {
                    if ($l == count($kkm)) {
                        echo '<td class="align-middle" scope="col" colspan="2"></td>';
                    } else {
                        $l++;
                    }
                }
            }
        } else {
            echo '<td class="align-middle" scope="col" colspan="2"></td>
                <td class="align-middle" scope="col" colspan="2"></td>';
        }
    }
}

function nilaiMapelInput($awk, $idsemester, $idmapelinduk, $idkompetensiinti, $nilai = NULL)
{
    if ($idsemester == '2') {
        if (explode('/', $awk["tahun"])[0] == date("Y") && (int)date('m') >= 7 && (int)date("m") <= 12) {
            echo '<td class="align-middle tb-hidden" scope="col"></td>';
        } else {
            echo '<td class="align-middle tb-hidden" scope="col">
                <div class="form-group">
                <input type="text" class="form-control ubah-nilai-pengetahuan-keterampilan" name="' . $awk["id_siswa"] . "_" . $awk["id"] . '_' . $idsemester . '_' . $idmapelinduk . '_' . $idkompetensiinti . '" id="' . $awk["id_siswa"] . "_" . $awk["id"] . '_' . $idsemester . '_' . $idmapelinduk . '_' . $idkompetensiinti . '" style="width:30px;padding:5px;margin-bottom:-15px" maxlength="2" value="' . $nilai . '">
                </div>
            </td>';
        }
    } else {
        echo '<td class="align-middle tb-hidden" scope="col">
            <div class="form-group">
            <input type="text" class="form-control ubah-nilai-pengetahuan-keterampilan" name="' . $awk["id_siswa"] . "_" . $awk["id"] . '_' . $idsemester . '_' . $idmapelinduk . '_' . $idkompetensiinti . '" id="' . $awk["id_siswa"] . "_" . $awk["id"] . '_' . $idsemester . '_' . $idmapelinduk . '_' . $idkompetensiinti . '" style="width:30px;padding:5px;margin-bottom:-15px" maxlength="2" value="' . $nilai . '">
            </div>  
            </td>';
    }
}

function nilaiKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, $idsemester, $idKI)
{
    $x = 1;
    foreach ($nilai_pengetahuan_keterampilan as $npk) {
        if ($npk["id_mapel_induk"] == $idmapelinduk) {
            if ((int)$npk["id_kelas"] >= $i * 4 - 3 && (int)$npk["id_kelas"] <= $i * 4) {
                if ($npk["id_semester"] == $idsemester) {
                    if ($npk["id_kompetensi_inti"] == $idKI) {
                        echo '<td class="align-middle tb-hidden" scope="col">' . $npk["nilai"] . '</td>';
                        break;
                    } else {
                        if ($x == count($nilai_pengetahuan_keterampilan)) {
                            echo '<td class="align-middle tb-hidden" scope="col"></td>';
                        } else {
                            $x++;
                        }
                    }
                } else {
                    if ($x == count($nilai_pengetahuan_keterampilan)) {
                        echo '<td class="align-middle tb-hidden" scope="col"></td>';
                    } else {
                        $x++;
                    }
                }
            } else {
                if ($x == count($nilai_pengetahuan_keterampilan)) {
                    echo '<td class="align-middle tb-hidden" scope="col"></td>';
                } else {
                    $x++;
                }
            }
        } else {
            if ($x == count($nilai_pengetahuan_keterampilan)) {
                echo '<td class="align-middle tb-hidden" scope="col"></td>';
            } else {
                $x++;
            }
        }
    }
}

function inputKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, $awk, $idsemester, $idkompetensiinti)
{
    $y = 1;
    foreach ($nilai_pengetahuan_keterampilan as $npk) {
        if ($npk["id_mapel_induk"] == $idmapelinduk) {
            if ((int)$npk["id_kelas"] >= $i * 4 - 3 && (int)$npk["id_kelas"] <= $i * 4) {
                if ($npk["id_semester"] == $idsemester) {
                    if ($npk["id_kompetensi_inti"] == $idkompetensiinti) {
                        nilaiMapelInput($awk, $idsemester, $idmapelinduk, $idkompetensiinti, $npk["nilai"]);
                        break;
                    } else {
                        if ($y == count($nilai_pengetahuan_keterampilan)) {
                            nilaiMapelInput($awk, $idsemester, $idmapelinduk, $idkompetensiinti);
                        } else {
                            $y++;
                        }
                    }
                } else {
                    if ($y == count($nilai_pengetahuan_keterampilan)) {
                        nilaiMapelInput($awk, $idsemester, $idmapelinduk, $idkompetensiinti);
                    } else {
                        $y++;
                    }
                }
            } else {
                if ($y == count($nilai_pengetahuan_keterampilan)) {
                    nilaiMapelInput($awk, $idsemester, $idmapelinduk, $idkompetensiinti);
                } else {
                    $y++;
                }
            }
        } else {
            if ($y == count($nilai_pengetahuan_keterampilan)) {
                nilaiMapelInput($awk, $idsemester, $idmapelinduk, $idkompetensiinti);
            } else {
                $y++;
            }
        }
    }
}

function nilaiMapelInputLooper($akses_wali_kelas, $nilai_pengetahuan_keterampilan, $idmapelinduk)
{
    for ($i = 1; $i <= 6; $i++) {
        $j = 1;
        foreach ($akses_wali_kelas as $awk) {
            if ((int)$awk["id_kelas"] >= $i * 4 - 3 && (int)$awk["id_kelas"] <= $i * 4) {
                if ($nilai_pengetahuan_keterampilan) {
                    inputKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, $awk, '1', '1');
                    inputKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, $awk, '1', '2');
                    inputKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, $awk, '2', '1');
                    inputKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, $awk, '2', '2');
                } else {
                    nilaiMapelInput($awk, '1', $idmapelinduk, '1');
                    nilaiMapelInput($awk, '1', $idmapelinduk, '2');
                    nilaiMapelInput($awk, '2', $idmapelinduk, '1');
                    nilaiMapelInput($awk, '2', $idmapelinduk, '2');
                }
                break;
            } else {
                if ($j == count($akses_wali_kelas)) {
                    if ($nilai_pengetahuan_keterampilan) {
                        nilaiKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, "1", "1");
                        nilaiKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, "1", "2");
                        nilaiKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, "2", "1");
                        nilaiKILooper($nilai_pengetahuan_keterampilan, $idmapelinduk, $i, "2", "2");
                    } else {
                        for ($v = 0; $v < 4; $v++) {
                            echo '<td class="align-middle tb-hidden" scope="col"></td>';
                        }
                    }
                } else {
                    $j++;
                }
            }
        }
    }
}

function nilaiMapelLooper($nilai_pengetahuan_keterampilan, $idmp)
{
    for ($i = 1; $i <= 6; $i++) {
        if ($nilai_pengetahuan_keterampilan) {
            nilaiKILooper($nilai_pengetahuan_keterampilan, $idmp, $i, '1', '1');
            nilaiKILooper($nilai_pengetahuan_keterampilan, $idmp, $i, '1', '2');
            nilaiKILooper($nilai_pengetahuan_keterampilan, $idmp, $i, '2', '1');
            nilaiKILooper($nilai_pengetahuan_keterampilan, $idmp, $i, '2', '2');
        } else {
            for ($x = 0; $x < 4; $x++) {
                echo '<td class="align-middle" scope="col"></td>';
            }
        }
    }
}

function inputNewEkskulLooper($akses_wali_kelas, $idsemester, $idekskul)
{
    for ($i = 1; $i <= 6; $i++) {
        $j = 1;
        foreach ($akses_wali_kelas as $awk) {
            if ((int)$awk["id_kelas"] >= $i * 4 - 3 && (int)$awk["id_kelas"] <= $i * 4) {
                if (explode('/', $awk["tahun"])[0] == date('Y') && (int)date('m') >= 7 && (int)date('m') <= 12 && $idsemester == '2') {
                    echo '<td class="align-middle"></td>';
                } else {
                    echo '<td class"align-middle" style="width:20px;height:-10px!important">
                    <div class="form-group align-middle text-center">
                    <input class="form-control align-middle ubah-nilai-ekstrakurikuler" maxlength="2" style="margin-bottom:-15px;" type="text" name="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $idekskul . '" id="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $idekskul . '"/>
                    </div>
                    </td>';
                }
                break;
            } else {
                if ($j == count($akses_wali_kelas)) {
                    echo "<td></td>";
                } else {
                    $j++;
                }
            }
        }
    }
}

function nilaiEkskulLooper($ekskul_terpilih, $nilai_ekskul, $idsemester)
{
    $thiz = get_instance();
    $SlctEks = [];
    if ($ekskul_terpilih && $nilai_ekskul) {
        $i = 1;
        foreach ($ekskul_terpilih as $et) {
            $j = 1;
            foreach ($nilai_ekskul as $ne1) {
                $selectedEkskul = $thiz->db->query('SELECT id_ekskul FROM nilai_ekskul WHERE id_siswa = ' . $ne1["id_siswa"] . ' AND id_semester=' . $idsemester)->result_array();
                foreach ($selectedEkskul as $se) {
                    if (!in_array($se["id_ekskul"], $SlctEks)) {
                        $SlctEks[] = $se["id_ekskul"];
                    }
                }
                if ($selectedEkskul) {
                    if ($et["id_ekskul"] == $ne1["id_ekskul"] && (int)$ne1["id_semester"] == $idsemester) {
                        echo '<tr>';
                        if ($i == 1) {
                            echo '<th class="align-middle" scope="row" id="smt' . $idsemester . '" rowspan="' . count($SlctEks) . '">Semester ';
                            echo ($idsemester == 1) ? 'I' : 'II';
                            echo '</th>';
                        }

                        echo '<td class="align-middle" style="text-align:left;padding-left:10px!important;" data-idekskul="' . $et["id_ekskul"] . '" >' . $i . '. ' . $et["ekskul"] . '</td>';
                        for ($classcounter = 1; $classcounter <= 6; $classcounter++) {
                            $j = 1;
                            foreach ($nilai_ekskul as $ne) {
                                if ((int)$ne["id_kelas"] >= $classcounter * 4 - 3 && (int)$ne["id_kelas"] <= $classcounter * 4) {
                                    if ($ne["id_semester"] == $idsemester && $ne["id_ekskul"] == $et["id_ekskul"]) {
                                        echo '<td class="align-middle">' . $ne["nilai"] . '</td>';
                                        break;
                                    } else {
                                        if ($j == count($nilai_ekskul)) {
                                            echo '<td class="align-middle"></td>';
                                        } else {
                                            $j++;
                                        }
                                    }
                                } else {
                                    if ($j == count($nilai_ekskul)) {
                                        echo '<td class="align-middle"></td>';
                                    } else {
                                        $j++;
                                    }
                                }
                            }
                        }
                        echo '</tr>';
                        $i++;
                        break;
                    }
                } else {
                    if ($j == count($nilai_ekskul)) {
                        if ($i == count($ekskul_terpilih)) {
                            echo '<tr>
                            <th class="align-middle" scope="row" rowspan="3">Semester ';
                            echo ($idsemester == 1) ? 'I' : 'II' . '</th>';
                            echo '<td class="align-middle" style="text-align:left;padding-left:10px!important;">1.</td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                        </tr>
                        <tr>
                            <td class="align-middle" scope="row" style="text-align:left;padding-left:10px!important;">2.</td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            </tr>
                            <tr>
                            <td class="align-middle" scope="row" style="text-align:left;padding-left:10px!important;">3.</td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            </tr>';
                        } else {
                            $i++;
                        }
                    } else {
                        $j++;
                    }
                }
            }
        }
    } else {
        echo '<tr>
                <th class="align-middle" scope="row" rowspan="3">Semester ';
        echo ($idsemester == 1) ? 'I' : 'II' . '</th>';
        echo '<td class="align-middle" style="text-align:left;padding-left:10px!important;" >1.</td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
            </tr>
            <tr>
                <td class="align-middle" scope="row" style="text-align:left;padding-left:10px!important;" >2.</td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
            </tr>
            <tr>
                <td class="align-middle" scope="row" style="text-align:left;padding-left:10px!important;">3.</td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
            </tr>';
    }
}

function inputEkskulLooper($total_ekskul, $ekskul_terpilih, $nilai_ekskul, $akses_wali_kelas, $idsemester)
{
    $thiz = get_instance();
    $SlctEks = [];
    if ($ekskul_terpilih && $nilai_ekskul) {
        $i = 1;
        foreach ($ekskul_terpilih as $et) {
            $j = 1;
            foreach ($nilai_ekskul as $ne) {
                $selectedEkskul = $thiz->db->query('SELECT * FROM nilai_ekskul WHERE id_siswa = ' . $ne["id_siswa"] . ' AND id_semester=' . $idsemester)->result_array();
                foreach ($selectedEkskul as $se) {
                    if (!in_array($se["id_ekskul"], $SlctEks)) {
                        $SlctEks[] = $se["id_ekskul"];
                    }
                }
                if ($selectedEkskul) {
                    if ($et["id_ekskul"] == $ne["id_ekskul"] && $ne["id_semester"] == $idsemester) {
                        echo '<tr>';
                        if ($i == 1) {
                            echo '<th class="align-middle" scope="row" id="smt' . $idsemester . '" rowspan="';
                            echo (count($SlctEks) < count($total_ekskul)) ? count($SlctEks) + 1 : count($SlctEks);
                            echo '">Semester ';
                            echo ($idsemester == 1) ? 'I' : 'II' . '</th>';
                        }
                        echo '<td class="align-middle ekskul-' . $idsemester . '" style="text-align:left;padding-left:10px!important;" data-idekskul="' . $et["id_ekskul"] . '" data-idsmt="' . $idsemester . '">' . $i . '. ' . $et["ekskul"] . '</td>';
                        for ($k = 1; $k <= 6; $k++) {
                            $l = 1;
                            foreach ($akses_wali_kelas as $awk) {
                                if ((int)$awk["id_kelas"] >= $k * 4 - 3 && (int)$awk["id_kelas"] <= $k * 4) {
                                    $n = 1;
                                    foreach ($nilai_ekskul as $ne3) {
                                        if (explode('/', $awk["tahun"])[0] == date('Y') && (int)date('m') >= 7 && (int)date('m') <= 12 && $idsemester == '2') {
                                            echo '<td class="align-middle"></td>';
                                            break;
                                        } else {
                                            if ($ne3["id_kelas"] == $awk["id_kelas"] && $ne3["id_semester"] == $idsemester && $ne3["id_ekskul"] == $et["id_ekskul"]) {
                                                echo '<td class"align-middle" style="width:20px;height:-10px!important">
                                                    <div class="form-group align-middle">
                                                    <input class="form-control align-middle ubah-nilai-ekstrakurikuler" style="margin-bottom:-15px; type="text" name="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $et["id_ekskul"] . '" id="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $et["id_ekskul"] . '" value="' . $ne3["nilai"] . '" maxlength="2" />
                                                    </div>
                                                    </td>';
                                                break;
                                            } else {
                                                if ($n == count($nilai_ekskul)) {
                                                    echo '<td class"align-middle" style="width:20px;height:-10px!important">
                                                            <div class="form-group align-middle">
                                                            <input class="form-control align-middle ubah-nilai-ekstrakurikuler" style="margin-bottom:-15px; type="text" name="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $et["id_ekskul"] . '" id="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $et["id_ekskul"] . '" maxlength="2"/>
                                                            </div>
                                                            </td>';
                                                } else {
                                                    $n++;
                                                }
                                            }
                                        }
                                    }
                                    break;
                                } else {
                                    if ($l == count($akses_wali_kelas)) {
                                        $m = 1;
                                        foreach ($nilai_ekskul as $ne2) {
                                            if ((int)$ne2["id_kelas"] >= $k * 4 - 3 && (int)$ne2["id_kelas"] <= $k * 4) {
                                                if ($ne2["id_semester"] == $idsemester && $ne2["id_ekskul"] == $et["id_ekskul"]) {
                                                    echo '<td class="align-middle">' . $ne2["nilai"] . '</td>';
                                                    break;
                                                } else {
                                                    if ($m == count($nilai_ekskul)) {
                                                        echo '<td class="align-middle"></td>';
                                                    } else {
                                                        $m++;
                                                    }
                                                }
                                            } else {
                                                if ($m == count($nilai_ekskul)) {
                                                    echo '<td class="align-middle"></td>';
                                                } else {
                                                    $m++;
                                                }
                                            }
                                        }
                                    } else {
                                        $l++;
                                    }
                                }
                            }
                        }
                        echo '</tr>';
                        if ($i == count($SlctEks) && count($SlctEks) < count($total_ekskul)) {
                            echo '<tr>
                        <td class="align-middle btn-success tambah-ekskul" id="tambah-ekskul-s' . $idsemester . '">Tambah Ekstrakurikuler</td>
                        <td class="align-middle" colspan="6"></td>
                        </tr>';
                        }
                        $i++;
                        break;
                    }
                } else {
                    if ($j == count($nilai_ekskul)) {
                        if ($i == count($ekskul_terpilih)) {
                            echo '<tr>
                                    <th class="align-middle" id="smt' . $idsemester . '" rowspan="1">Semester ';
                            echo ($idsemester == '1') ? 'I' : 'II';
                            echo '</th>
                                    <td class="align-middle btn-success tambah-ekskul" id="tambah-ekskul-s' . $idsemester . '">Tambah Ekstrakurikuler</td>
                                    <td class="align-middle" colspan="6"></td>
                                    </tr>';
                        } else {
                            $i++;
                        }
                    } else {
                        $j++;
                    }
                }
            }
        }
    } else {
        echo '<tr>
        <th class="align-middle" id="smt' . $idsemester . '" rowspan="1">Semester ';
        echo ($idsemester == '1') ? 'I' : 'II';
        echo '</th>
        <td class="align-middle btn-success tambah-ekskul" id="tambah-ekskul-s' . $idsemester . '">Tambah Ekstrakurikuler</td>
        <td class="align-middle" colspan="6"></td>
        </tr>';
    }
}

function jmlAbsensiSmtLooper($jumlah_ketidakhadiran, $i, $idsemester, $idketidakhadiran)
{
    $j = 1;
    foreach ($jumlah_ketidakhadiran as $jk) {
        if ((int)$jk["id_kelas"] >= $i * 4 - 3 && (int)$jk["id_kelas"] <= $i * 4 && $jk["id_semester"] == $idsemester && $jk["id_ketidakhadiran"] == $idketidakhadiran) {
            echo '<td class="align-middle" scope="col">' . $jk["jumlah"] . '</td>';
        } else {
            if ($j == count($jumlah_ketidakhadiran)) {
                echo '<td class="align-middle" scope="col"></td>';
            } else {
                $j++;
            }
        }
    }
}

function inputKHSmtLooper($k, $i, $awk, $idsemester, $jumlah_ketidakhadiran = NULL)
{
    if ($jumlah_ketidakhadiran) {
        if (explode('/', $awk["tahun"])[0] == date('Y') && (int)date('m') >= 7 && (int)date('m') <= 12 && $idsemester == '2') {
            echo '<td class="align-middle" scope="col"></td>';
        } else {
            $j = 1;
            foreach ($jumlah_ketidakhadiran as $jk) {
                if ((int)$jk["id_kelas"] >= $i * 4 - 3 && (int)$jk["id_kelas"] <= $i * 4 && $jk["id_ketidakhadiran"] == $k["id"] && $jk["id_semester"] == $idsemester) {
                    echo '<td class"align-middle" style="width:65px;height:-10px!important">
                <div class="form-group align-middle">
                <input class="form-control align-middle ubah-jumlah-absensi" type="text" style="width:55px;padding:10px;margin-bottom:-15px;height:-10px!important" name="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $k["id"] . '" id="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $k["id"] . '" maxlength="2" value="' . $jk["jumlah"] . '"/>
        </div>
        </td>';
                } else {
                    if ($j == count($jumlah_ketidakhadiran)) {
                        echo '<td class"align-middle" style="width:65px;height:-10px!important">
            <div class="form-group align-middle">
            <input class="form-control align-middle ubah-jumlah-absensi" type="text" style="width:55px;padding:10px;margin-bottom:-15px;height:-10px!important" name="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $k["id"] . '" id="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $k["id"] . '" maxlength="2"/>
            </div>
            </td>';
                    } else {
                        $j++;
                    }
                }
            }
        }
    } else {
        if (explode('/', $awk["tahun"])[0] == date('Y') && (int)date('m') >= 7 && (int)date('m') <= 12 && $idsemester == '2') {
            echo '<td class="align-middle" scope="col"></td>';
        } else {
            echo '<td class"align-middle" style="width:70px;height:-10px!important">
            <div class="form-group align-middle d-flex justify-content-center">
            <input class="form-control align-middle ubah-jumlah-absensi" type="text" style="margin-bottom:-15px;width:40px;height:-10px!important" name="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $k["id"] . '" id="' . $awk["id_siswa"] . '_' . $awk["id"] . '_' . $idsemester . '_' . $k["id"] . '" maxlength="2"/>
            </div>
            </td>';
        }
    }
}

function jumlahKetidakhadiranInputLooper($akses_wali_kelas, $ketidakhadiran, $jumlah_ketidakhadiran)
{
    foreach ($ketidakhadiran as $k) {
        echo '<tr style="height:0px">
                <td class="align-middle" style="height:0px" scope="col">' . $k["ketidakhadiran"] . '</td>';
        for ($i = 1; $i <= 6; $i++) {
            $j = 1;
            foreach ($akses_wali_kelas as $awk) {
                if ((int)$awk["id_kelas"] >= $i * 4 - 3 && (int)$awk["id_kelas"] <= $i * 4) {
                    if ($jumlah_ketidakhadiran) {
                        inputKHSmtLooper($k, $i, $awk, '1', $jumlah_ketidakhadiran);
                        inputKHSmtLooper($k, $i, $awk, '2', $jumlah_ketidakhadiran);
                    } else {
                        inputKHSmtLooper($k, $i, $awk, '1');
                        inputKHSmtLooper($k, $i, $awk, '2');
                    }
                } else {
                    if ($j == count($akses_wali_kelas)) {
                        if ($jumlah_ketidakhadiran) {
                            jmlAbsensiSmtLooper($jumlah_ketidakhadiran, $i, '1', $k["id"]);
                            jmlAbsensiSmtLooper($jumlah_ketidakhadiran, $i, '2', $k["id"]);
                        } else {
                            echo '<td class="align-middle" style="height:0px" scope="col"></td>
                                <td class="align-middle" style="height:0px" scope="col"></td>';
                        }
                    } else {
                        $j++;
                    }
                }
            }
        }
        echo '</tr>';
    }
}

function jmlKHLooper($k, $i, $jumlah_ketidakhadiran, $idsemester)
{
    $j = 1;
    foreach ($jumlah_ketidakhadiran as $jk) {
        if ((int)$jk["id_kelas"] >= $i * 4 - 3 && (int)$jk["id_kelas"] <= $i * 4 && $jk["id_ketidakhadiran"] == $k["id"] && $jk["id_semester"] == $idsemester) {
            echo '<td class="align-middle" scope="col">' . $jk["jumlah"] . '</td>';
        } else {
            if ($j == count($jumlah_ketidakhadiran)) {
                echo '<td class="align-middle" scope="col"></td>';
            } else {
                $j++;
            }
        }
    }
}

function jumlahKetidakhadiranLooper($ketidakhadiran, $jumlah_ketidakhadiran)
{
    foreach ($ketidakhadiran as $k) {
        echo '<tr>
                <td class="align-middle" scope="col">' . $k["ketidakhadiran"] . '</td>';
        for ($i = 1; $i <= 6; $i++) {
            if ($jumlah_ketidakhadiran) {
                jmlKHLooper($k, $i, $jumlah_ketidakhadiran, '1');
                jmlKHLooper($k, $i, $jumlah_ketidakhadiran, '2');
            } else {
                echo '<td class="align-middle" scope="col"></td>
                <td class="align-middle" scope="col"></td>';
            }
        }
        echo '</tr>';
    }
}

function cekKelulusan($kelas_siswa)
{
    if ((int)date('m') >= 7 && (int)date('m') <= 12) {
        $thSkrg = (int)date('Y');
    } else {
        $thSkrg = (int)date('Y') - 1;
    }

    $sixthGradeYr = NULL;
    foreach ($kelas_siswa as $ks) {
        if ((int)$ks["id_kelas"] >= 21 && (int)$ks["id_kelas"] <= 24) {
            $sixthGradeYr = (int)explode('/', $ks["tahun"])[0];
            break;
        }
    }
    if ($sixthGradeYr !== NULL && $sixthGradeYr < $thSkrg) {
        return "<td>Lulus/<strike>Tidak Lulus</strike></td>";
    } else {
        return "<td>Lulus/Tidak Lulus</td>";
    }
}

function cekWaliKelas($idkelas, $tahunajar)
{
    $thiz = get_instance();
    $waliKelas = $thiz->db->query('SELECT wali_kelas.id_staff, wali_kelas.id_kelas, wali_kelas.tahun, staff.nama FROM wali_kelas JOIN staff ON wali_kelas.id_staff = staff.id WHERE wali_kelas.id_kelas ="' . $idkelas . '" AND wali_kelas.tahun="' . $tahunajar . '"')->row_array();
    return ($waliKelas) ? $waliKelas["nama"] : '-';
}

function cwkAction($idkelas, $tahunajar, $k)
{
    $thiz = get_instance();
    $waliKelas = $thiz->db->query('SELECT wali_kelas.id_staff, wali_kelas.id_kelas, wali_kelas.tahun, staff.nama FROM wali_kelas JOIN staff ON wali_kelas.id_staff = staff.id WHERE wali_kelas.id_kelas ="' . $idkelas . '" AND wali_kelas.tahun="' . $tahunajar . '"')->row_array();
    echo '<a href="' . base_url('admin/daftarsiswa/' . $k["id"]) . "/" . $thiz->session->userdata('tahun') . '" class="py-1 px-2 badge badge-success mr-1">Lihat</a>';
    if ($waliKelas) {
        echo '<a href="' . base_url('admin/hapuswalikelas/' . $k["id"]) . "/" . $thiz->session->userdata('tahun') . '/' . $waliKelas["id_staff"] . '" class="py-1 px-2 badge badge-danger hps-wali-kelas" data-judul="' . $waliKelas["nama"] . '">Hapus Wali Kelas</a>';
    } else {
        echo '<a href="' . base_url('admin/mksiswa/' . $k["id"]) . "/" . $thiz->session->userdata('tahun') . '" class="py-1 px-2 badge badge-primary tb-wali-kelas">Pilih Wali Kelas</a>';
    }
}

function rupiah($nominal)
{
    if ($nominal !== "0") {
        return "Rp" . number_format($nominal, 0, ',', '.') . ",-";
    } else {
        return "Gratis";
    }
}

function selectedNominal($id, $selected)
{
    if ($id == $selected) {
        return "selected";
    }
}

function tabelSPPLooper($siswa, $kelas, $bulan_akademik, $spp)
{
    $thiz = get_instance();
    $idbulanini = (int)$thiz->db->query("SELECT id FROM bulan_akademik WHERE angka_bulan=" . date('m'))->row_array()["id"];
    $i = 1;
    foreach ($siswa as $s) {
        if ($s["id_detail_status_spp"]) {
            $s["nominal"] = $thiz->db->query("SELECT nominal FROM detail_status_spp_siswa WHERE id=" . $s["id_detail_status_spp"])->row_array()["nominal"];
        } else {
            $s["nominal"] = null;
        }
        echo '<tr>';
        echo '<td class="align-middle pl-3" scope="row">' . $i . '</td>
                <td class="align-middle text-left pr-2" style="padding-left:10px">' . $s["nama"] . '</td>';
        foreach ($bulan_akademik as $ba) {
            echo '<td class="align-middle">';
            if ($spp) {
                $sppCounter = 1;
                foreach ($spp as $sp) {
                    if ($sp["tahun_ajaran"] == $s["tahun"] && $sp["id_siswa"] == $s["id_siswa"] && $sp["id_kelas_siswa"] == $s["id_kelas_siswa"] && $sp["bulan"] == $ba["id"]) {
                        echo '<a href="" class="badge badge-pill text-secondary paid-off-spp-badge" data-idtrspp="' . $sp['id'] . '" data-toggle="modal" data-target="#paidOffModal">' . rupiah($sp["nominal"]) . '</a>';
                        break;
                    } else {
                        if ($sppCounter == count($spp)) {
                            if ($s["nominal"] !== "1") {
                                if ((int)$ba["id"] == $idbulanini) {
                                    echo '<a href="" class="badge badge-pill badge-primary spp-payment" data-idsiswa="' . $s['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Bayar</a>';
                                } elseif ((int)$ba["id"] < $idbulanini) {
                                    echo '<a href="" class="badge badge-pill badge-warning spp-payment" data-idsiswa="' . $s['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Bayar</a>';
                                } else {
                                    // echo '<strong>-</strong>';
                                    echo '<a href="" class="badge badge-pill badge-primary spp-payment" data-idsiswa="' . $s['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment" style="background-color:lightblue">Bayar</a>';
                                }
                            } else {
                                if ((int)$ba["id"] <= $idbulanini) {
                                    echo '<a href="" class="badge badge-pill badge-info free-charged-spp-change-status" data-idsiswa="' . $s['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Ubah Status</a>';
                                } else {
                                    echo '<strong>-</strong>';
                                }
                            }
                        } else {
                            $sppCounter++;
                        }
                    }
                }
            } else {
                if ((int)$ba["id"] == $idbulanini) {
                    echo '<a href="" class="badge badge-pill badge-primary spp-payment" data-idsiswa="' . $s['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Bayar</a>';
                } elseif ((int)$ba["id"] < $idbulanini) {
                    echo '<a href="" class="badge badge-pill badge-warning spp-payment" data-idsiswa="' . $s['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Bayar</a>';
                } else {
                    echo '<a href="" class="badge badge-pill badge-primary spp-payment" data-idsiswa="' . $s['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment" style="background-color:lightblue">Bayar</a>';
                }
            }
            echo '</td>';
        }
        echo '</tr>';
        $i++;
    }
}

function tabelSppOneStudentLooperCore($sppSiswa, $siswa, $kelas, $ba, $time)
{
    if ($sppSiswa) {
        $i = 1;
        foreach ($sppSiswa as $s) {
            if ($s["bulan"] == $ba["id"]) {
                echo '<td class="text-left pl-2"><a href="" class="badge badge-pill text-secondary paid-off-spp-badge" data-idtrspp="' . $s['id'] . '" data-toggle="modal" data-target="#paidOffModal">' . rupiah($s["nominal"]) . '</a></td>';
                break;
            } else {
                if (count($sppSiswa) == $i) {
                    if ($siswa["nominal"] !== '1') {
                        switch ($time) {
                            case "now":
                                echo '<td class="text-left pl-3"><a href="" class="badge badge-pill badge-primary spp-payment" style="padding-bottom:4px" data-idsiswa="' . $siswa['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Bayar</a></td>';
                                break;
                            case "prev":
                                echo '<td class="text-left pl-3"><a href="" class="badge badge-pill badge-warning spp-payment" style="padding-bottom:4px" data-idsiswa="' . $siswa['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Bayar</a></td>';
                                break;
                            case "next":
                                echo '<td class="text-left pl-3"><a href="" class="badge badge-pill badge-primary spp-payment" style="padding-bottom:4px;background-color:lightblue" data-idsiswa="' . $siswa['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment" style="background-color:lightgreen">Bayar</a></td>';
                                break;
                        }
                    } else {
                        if ($time !== "next") {
                            echo '<td class="text-left pl-3"><a href="" class="badge badge-pill badge-info free-charged-spp-change-status" style="padding-bottom:2px" data-idsiswa="' . $s['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Ubah Status</a></td>';
                        } else {
                            echo '<td class="text-left" style="padding-left:49px"><strong>-</strong></td>';
                        }
                    }
                } else {
                    $i++;
                }
            }
        }
    } else {
        switch ($time) {
            case "now":
                echo '<td class="text-left pl-3"><a href="" class="badge badge-pill badge-primary spp-payment" style="padding-bottom:4px" data-idsiswa="' . $siswa['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Bayar</a></td>';
                break;
            case "prev":
                echo '<td class="text-left pl-3"><a href="" class="badge badge-pill badge-warning spp-payment" style="padding-bottom:4px" data-idsiswa="' . $siswa['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment">Bayar</a></td>';
                break;
            case "next":
                echo '<td class="text-left pl-3"><a href="" class="badge badge-pill badge-primary spp-payment" style="padding-bottom:4px;background-color:lightblue" data-idsiswa="' . $siswa['id_siswa'] . '" data-idbulan="' . $ba["id"] . '" data-idkelas="' . $kelas["id_kelas"] . '" data-tahun="' . $kelas["tahun"] . '" data-toggle="modal" data-target="#ModalForPayment" style="background-color:lightgreen">Bayar</a></td>';
                break;
        }
    }
}

function tabelSppOneStudentLooper($siswa, $kelas, $bulan_akademik, $tahun)
{
    $thiz = get_instance();
    $idbulanini = (int)$thiz->db->query("SELECT id FROM bulan_akademik WHERE angka_bulan=" . date('m'))->row_array()["id"];
    $sppSiswa = $thiz->db->query("SELECT * FROM spp WHERE id_siswa=" . $siswa["id_siswa"] . " AND tahun_ajaran='" . $tahun . "'")->result_array();
    if ($siswa["id_detail_status_spp"]) {
        $siswa["nominal"] = $thiz->db->query("SELECT nominal FROM detail_status_spp_siswa WHERE id=" . $siswa["id_detail_status_spp"])->row_array()["nominal"];
    } else {
        $siswa["nominal"] = null;
    }
    foreach ($bulan_akademik as $ba) {
        echo '<tr scope="col">
                <td class="text-right pr-4">' . $ba["nama_bulan"] . '</td>';
        if ($tahun == $thiz->tahunAjar) {
            if ((int)$ba["id"] == $idbulanini) {
                tabelSppOneStudentLooperCore($sppSiswa, $siswa, $kelas, $ba, 'now');
            } elseif ((int)$ba["id"] < $idbulanini) {
                tabelSppOneStudentLooperCore($sppSiswa, $siswa, $kelas, $ba, 'prev');
            } else {
                tabelSppOneStudentLooperCore($sppSiswa, $siswa, $kelas, $ba, 'next');
            }
        } else {
            tabelSppOneStudentLooperCore($sppSiswa, $siswa, $kelas, $ba, 'prev');
        }
        echo '</tr>';
    }
}

function tagihanSiswaPerbulan($idsiswa, $tagihankelas)
{
    $thiz = get_instance();
    $status = $thiz->db->query("SELECT status_spp,id_detail_status_spp FROM siswa WHERE id=" . $idsiswa)->row_array()["status_spp"];
    $nominalkelas = $thiz->db->query("SELECT nominal FROM nominal_spp WHERE id=" . $tagihankelas["id_nominal_spp"])->row_array()["nominal"];
    if ($status == "1") {
        return $nominalkelas;
    } else {
        return $thiz->db->query('SELECT siswa.id_detail_status_spp, detail_status_spp_siswa.nominal, nominal_spp.nominal as nominal_spp FROM siswa JOIN detail_status_spp_siswa ON siswa.id_detail_status_spp = detail_status_spp_siswa.id JOIN nominal_spp ON detail_status_spp_siswa.nominal = nominal_spp.id WHERE detail_status_spp_siswa.id_siswa=' . $idsiswa)->row_array()['nominal_spp'];
    }
}

function tagihanSiswa($status_spp, $id_kelas, $tahun, $idnominal, $idDetailStatusSpp)
{
    $thiz = get_instance();
    if ($status_spp == '1') {
        $nominal = $thiz->db->query("SELECT id_nominal_spp FROM nominal_spp_per_tingkat WHERE id_kelas=" . $id_kelas . " AND tahun_ajaran='" . $tahun . "'")->row_array();
        if ($nominal["id_nominal_spp"] == $idnominal) {
            return 'selected';
        }
    } else {
        $nominal = $thiz->db->query("SELECT nominal FROM detail_status_spp_siswa WHERE id =" . $idDetailStatusSpp)->row_array();
        if ($nominal["nominal"] == $idnominal) {
            return 'selected';
        }
    }
}

function keteranganStatusSpp($idDetailStatusSpp)
{
    $thiz = get_instance();
    if ($idDetailStatusSpp) {
        return $thiz->db->query("SELECT keterangan FROM detail_status_spp_siswa WHERE id=" . $idDetailStatusSpp)->row_array()["keterangan"];
    }
}

function ket_status_spp_siswa_cetak($idsiswa)
{
    $thiz = get_instance();
    $keterangan = $thiz->db->query("SELECT siswa.id_detail_status_spp,detail_status_spp_siswa.keterangan FROM siswa JOIN detail_status_spp_siswa ON siswa.id_detail_status_spp = detail_status_spp_siswa.id WHERE siswa.id =" . $idsiswa)->row_array();
    return ($keterangan) ? $keterangan["keterangan"] : '';
}

function selectedAcademicMonth($monthNumber)
{
    return ((int)$monthNumber == (int)date('m')) ? "selected" : '';
}

function getStudentsClass($idKS)
{
    $thiz = get_instance();
    $kelas = $thiz->db->query("SELECT kelas_siswa.*, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id=" . $idKS)->row_array();
    return ($kelas) ? $kelas["class"] : ' - ';
}
