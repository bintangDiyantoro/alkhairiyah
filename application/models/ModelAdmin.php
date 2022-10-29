<?php

class ModelAdmin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        if ((int)date('m') >= 1 && (int)date('m') <= 6) {
            $tahun = (int)date('Y') - 1;
            $slash = (int)date('y');
            $this->tahunAjar = (string)$tahun . "/" . (string)$slash;
        } else {
            $tahun = (int)date('Y');
            $slash = (int)date('y') + 1;
            $this->tahunAjar = (string)$tahun . "/" . (string)$slash;
        }
    }

    public function postDakwah($content)
    {
        $expl = explode(" ", date(DATE_RFC822));
        if ($expl[0] == 'Sun,') {
            $day = 'Ahad';
        } elseif ($expl[0] == 'Mon,') {
            $day = 'Senin';
        } elseif ($expl[0] == 'Tue,') {
            $day = 'Selasa';
        } elseif ($expl[0] == 'Wed,') {
            $day = 'Rabu';
        } elseif ($expl[0] == 'Thu,') {
            $day = 'Kamis';
        } elseif ($expl[0] == 'Fri,') {
            $day = 'Jumat';
        } elseif ($expl[0] == 'Sat,') {
            $day = 'Sabtu';
        }

        $date = $day . ", " . $expl[1] . " " . $expl[2] . " " . $expl[3];

        $dataInput = [
            'content' => $content,
            'date' => $date,
            'admin' => $this->session->userdata('admin')
        ];

        $this->db->insert('dakwah', $dataInput);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Artikel baru berhasil diposting!');
            redirect('admin/dakwah');
        }
    }

    public function updateDakwah($content, $id)
    {
        $expl = explode(" ", date(DATE_RFC822));
        if ($expl[0] == 'Sun,') {
            $day = 'Ahad';
        } elseif ($expl[0] == 'Mon,') {
            $day = 'Senin';
        } elseif ($expl[0] == 'Tue,') {
            $day = 'Selasa';
        } elseif ($expl[0] == 'Wed,') {
            $day = 'Rabu';
        } elseif ($expl[0] == 'Thu,') {
            $day = 'Kamis';
        } elseif ($expl[0] == 'Fri,') {
            $day = 'Jumat';
        } elseif ($expl[0] == 'Sat,') {
            $day = 'Sabtu';
        }

        $date = $day . ", " . $expl[1] . " " . $expl[2] . " " . $expl[3];

        $dataInput = [
            'content' => $content,
            'date' => $date,
            'admin' => $this->session->userdata('admin')
        ];

        $this->db->where('id', $id);
        $this->db->update('dakwah', $dataInput);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Artikel berhasil diupdate!');
            redirect('admin/dakwah');
        }
    }

    public function postBerita($content)
    {
        $expl = explode(" ", date(DATE_RFC822));
        if ($expl[0] == 'Sun,') {
            $day = 'Ahad';
        } elseif ($expl[0] == 'Mon,') {
            $day = 'Senin';
        } elseif ($expl[0] == 'Tue,') {
            $day = 'Selasa';
        } elseif ($expl[0] == 'Wed,') {
            $day = 'Rabu';
        } elseif ($expl[0] == 'Thu,') {
            $day = 'Kamis';
        } elseif ($expl[0] == 'Fri,') {
            $day = 'Jumat';
        } elseif ($expl[0] == 'Sat,') {
            $day = 'Sabtu';
        }

        $date = $day . ", " . $expl[1] . " " . $expl[2] . " " . $expl[3];

        $dataInput = [
            'content' => $content,
            'date' => $date,
            'admin' => $this->session->userdata('admin')
        ];

        $this->db->insert('berita', $dataInput);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Artikel baru berhasil diposting!');
            redirect('admin/berita');
        }
    }

    public function updateBerita($content, $id)
    {
        $expl = explode(" ", date(DATE_RFC822));
        if ($expl[0] == 'Sun,') {
            $day = 'Ahad';
        } elseif ($expl[0] == 'Mon,') {
            $day = 'Senin';
        } elseif ($expl[0] == 'Tue,') {
            $day = 'Selasa';
        } elseif ($expl[0] == 'Wed,') {
            $day = 'Rabu';
        } elseif ($expl[0] == 'Thu,') {
            $day = 'Kamis';
        } elseif ($expl[0] == 'Fri,') {
            $day = 'Jumat';
        } elseif ($expl[0] == 'Sat,') {
            $day = 'Sabtu';
        }

        $date = $day . ", " . $expl[1] . " " . $expl[2] . " " . $expl[3];

        $dataInput = [
            'content' => $content,
            'date' => $date,
            'admin' => $this->session->userdata('admin')
        ];

        $this->db->where('id', $id);
        $this->db->update('berita', $dataInput);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Artikel berhasil diupdate!');
            redirect('admin/berita');
        }
    }

    public function buatMateri($content)
    {
        $counter = 0;
        foreach ($content[0] as $file) {
            if ($file["name"]) {
                $counter += 1;
                $newname = "assets/lib/" . uniqid() . "." . pathinfo($file["name"])["extension"];
                $content[1]["attachment_" . (string)$counter] = $newname;
                move_uploaded_file($file["tmp_name"], $newname);
            }
        }
        $this->db->insert('materi', $content[1]);
        $this->session->set_flashdata('alert', 'Berhasil');
    }

    public function editMateri($content, $id)
    {
        if ($content[0]["attachment1"]) {
            $counter = 1;
        } elseif ($content[0]["attachment1"] && $content[0]["attachment2"]) {
            $counter = 2;
        } elseif ($content[0]["attachment1"] && $content[0]["attachment2"] && $content[0]["attachment3"]) {
            $counter = 3;
        } elseif ($content[0]["attachment1"] && $content[0]["attachment2"] && $content[0]["attachment3"] && $content[0]["attachment4"]) {
            $counter = 4;
        } else {
            $counter = 0;
        }
        foreach ($content[0] as $file) {
            if ($file["name"]) {
                $counter += 1;
                $newname = "assets/lib/" . uniqid() . "." . pathinfo($file["name"])["extension"];
                $content[1]["attachment_" . (string)$counter] = $newname;
                move_uploaded_file($file["tmp_name"], $newname);
            }
        }
        $this->db->where('id', $id);
        $this->db->update('materi', $content[1]);
        $this->session->set_flashdata('alert', 'Berhasil');
    }

    public function uploadmediatk($content)
    {
        $counter = 0;
        foreach ($content[0] as $file) {
            if ($file["name"]) {
                $counter += 1;
                $newname = "assets/mediatk/" . uniqid() . "." . pathinfo($file["name"])["extension"];
                $content[1]["file"] = $newname;
                $data = ["id_kegiatan" => $content[1]["kegiatan"], "file" => $content[1]["file"]];
                move_uploaded_file($file["tmp_name"], $newname);
                $this->db->insert('mediatk', $data);
            }
        }
        $this->session->set_flashdata('alert', 'Berhasil');
    }

    public function tambahSiswa($data)
    {
        $mapped = [
            'nomor_induk' => $data["nomor_induk"],
            'nisn' => $data["nisn"],
            'nama' => $data["nama"],
            'ttl' => $data["ttl"],
            'jenis_kelamin' => $data["jenis_kelamin"],
            'agama' => $data["agama"],
            'pendidikan_sebelumnya' => $data["pendidikan_sebelumnya"],
            'alamat' => $data["alamat"],
            'nama_ayah' => $data["nama_ayah"],
            'nama_ibu' => $data["nama_ibu"],
            'alamat_ortu' => $data["alamat_ortu"],
            'nama_wali' => $data["nama_wali"],
            'pekerjaan_wali' => $data["pekerjaan_wali"],
            'alamat_wali' => $data["alamat_wali"],
            'no_hp_ortu' => $data["no_hp_ortu"],
            'pekerjaan_ayah' => $data["pekerjaan_ayah"],
            'pekerjaan_ibu' => $data["pekerjaan_ibu"],
            'updated_by' => $this->session->userdata('id_staff'),
        ];
        $this->db->insert('siswa', $mapped);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Artikel baru berhasil diposting!');
        }
    }

    public function masukkankelasCore($idsiswa, $idkelas, $tahunajaran)
    {
        $mapped = [
            "tahun" => $tahunajaran,
            "id_siswa" => $idsiswa,
            "id_kelas" => $idkelas,
            "insert_by" => $this->session->userdata('id_staff')
        ];

        $cekKelas = $this->db->query('SELECT * FROM kelas_siswa WHERE id_siswa ="' . $idsiswa . '" AND tahun = "' . $tahunajaran . '"')->row_array();

        if ($cekKelas) {
            $this->db->where("id_siswa", $idsiswa);
            $this->db->where("tahun", $tahunajaran);
            $this->db->update('kelas_siswa', $mapped);
        } else {
            $this->db->insert('kelas_siswa', $mapped);
        }
    }

    public function keluarkansiswa($idsiswa, $idkelas, $tahun, $th)
    {
        $tahunajar = $tahun . "/" . $th;
        $mapped = [
            "tahun" => $tahunajar,
            "id_siswa" => $idsiswa,
            "id_kelas" => NULL
        ];
        $cekKelas = $this->db->query('SELECT * FROM kelas_siswa WHERE id_siswa ="' . $idsiswa . '" AND tahun = "' . $tahunajar . '"')->row_array();
        if ($cekKelas) {
            $this->db->where("id_siswa", $idsiswa);
            $this->db->where("tahun", $tahunajar);
            $this->db->update('kelas_siswa', $mapped);
        }
        if ($this->db->affected_rows() > 0) {
            redirect('admin/daftarsiswa/' . $idkelas . "/" . $tahunajar);
        }
    }
    public function ubahbiodata($data)
    {
        $mapped = [
            "nomor_induk" => $data["nomor_induk"],
            "nisn" => $data["nisn"],
            "nama" => $data["nama"],
            "ttl" => $data["ttl"],
            "jenis_kelamin" => $data["jenis_kelamin"],
            "agama" => $data["agama"],
            "pendidikan_sebelumnya" => $data["pendidikan_sebelumnya"],
            "alamat" => $data["alamat"],
            "nama_ayah" => $data["nama_ayah"],
            "pekerjaan_ayah" => $data["pekerjaan_ayah"],
            "nama_ibu" => $data["nama_ibu"],
            "pekerjaan_ibu" => $data["pekerjaan_ibu"],
            "alamat_ortu" => $data["alamat_ortu"],
            "nama_wali" => $data["nama_wali"],
            "pekerjaan_wali" => $data["pekerjaan_wali"],
            "alamat_wali" => $data["alamat_wali"],
            "no_hp_ortu" => $data["no_hp_ortu"],
            "updated_by" => $this->session->userdata("id_staff"),
        ];
        $this->db->where('id', $data["id"]);
        $this->db->update('siswa', $mapped);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata("editBiodataAlert", "Berhasil");
            redirect('admin/biodatasiswa/' . $data["id"]);
        } else {
            $this->session->set_flashdata("editBiodataAlert", "Gagal");
        }
    }

    public function ubahNilaiSikap($data)
    {
        $keys = array_keys($data);

        $counter = 0;
        foreach ($data as $d) {
            if ($keys[$counter] !== "submit") {
                $input = explode('_', $keys[$counter]);

                $checkData = $this->db->query("SELECT * FROM nilai_sikap WHERE id_siswa=" . $input[0] . " AND id_kelas_siswa=" . $input[1] . " AND id_semester=" . $input[2] . " AND id_sikap=" . $input[3])->row_array();
                $mapped = [
                    'id_siswa' => $input[0],
                    'id_kelas_siswa' => $input[1],
                    'id_semester' => $input[2],
                    'id_sikap' => $input[3],
                    'nilai' => $d
                ];

                if ($checkData) {
                    $this->db->where('id_siswa', $input[0]);
                    $this->db->where('id_kelas_siswa', $input[1]);
                    $this->db->where('id_semester', $input[2]);
                    $this->db->where('id_sikap', $input[3]);
                    $this->db->update('nilai_sikap', $mapped);
                } else {
                    $this->db->insert('nilai_sikap', $mapped);
                }
                $counter++;
            }
        }
    }

    public function ubahNilaiPengetahuanKeterampilan($data)
    {
        $keys = array_keys($data);

        $counter = 0;
        foreach ($data as $d) {
            if ($keys[$counter] !== "submit") {
                $input = explode('_', $keys[$counter]);

                if ($input[0] == 'kkm') {
                    $checkDataKKM = $this->db->query("SELECT * FROM kkm WHERE id_siswa=" . $input[1] . " AND id_kelas_siswa=" . $input[2] . " AND id_semester=" . $input[3])->row_array();

                    $mapped = [
                        'id_siswa' => $input[1],
                        'id_kelas_siswa' => $input[2],
                        'id_semester' => $input[3],
                        'kkm' => $d
                    ];

                    if ($checkDataKKM) {
                        $this->db->where('id_siswa', $input[1]);
                        $this->db->where('id_kelas_siswa', $input[2]);
                        $this->db->where('id_semester', $input[3]);
                        $this->db->update('kkm', $mapped);
                    } else {
                        $this->db->insert('kkm', $mapped);
                    }
                } else {
                    $checkDataMapel = $this->db->query("SELECT * FROM nilai_mapel WHERE id_siswa=" . $input[0] . " AND id_kelas_siswa=" . $input[1] . " AND id_semester=" . $input[2] . " AND id_mapel_induk=" . $input[3] . " AND id_kompetensi_inti=" . $input[4])->row_array();

                    $mapped = [
                        'id_siswa' => $input[0],
                        'id_kelas_siswa' => $input[1],
                        'id_semester' => $input[2],
                        'id_mapel_induk' => $input[3],
                        'id_kompetensi_inti' => $input[4],
                        'nilai' => $d
                    ];

                    if ($checkDataMapel) {
                        $this->db->where('id_siswa', $input[0]);
                        $this->db->where('id_kelas_siswa', $input[1]);
                        $this->db->where('id_semester', $input[2]);
                        $this->db->where('id_mapel_induk', $input[3]);
                        $this->db->where('id_kompetensi_inti', $input[4]);
                        $this->db->update('nilai_mapel', $mapped);
                    } else {
                        $this->db->insert('nilai_mapel', $mapped);
                    }
                }
            }
            $counter++;
        }
    }
    public function ubahNilaiEkstrakurikuler($data)
    {
        $keys = array_keys($data);

        $counter = 0;
        foreach ($data as $d) {
            if ($keys[$counter] !== "submit") {
                $input = explode('_', $keys[$counter]);

                $checkData = $this->db->query("SELECT * FROM nilai_ekskul WHERE id_siswa=" . $input[0] . " AND id_kelas_siswa=" . $input[1] . " AND id_semester=" . $input[2] . " AND id_ekskul=" . $input[3])->row_array();
                $mapped = [
                    'id_siswa' => $input[0],
                    'id_kelas_siswa' => $input[1],
                    'id_semester' => $input[2],
                    'id_ekskul' => $input[3],
                    'nilai' => $d
                ];

                if ($checkData) {
                    $this->db->where('id_siswa', $input[0]);
                    $this->db->where('id_kelas_siswa', $input[1]);
                    $this->db->where('id_semester', $input[2]);
                    $this->db->where('id_ekskul', $input[3]);
                    $this->db->update('nilai_ekskul', $mapped);
                } else {
                    $this->db->insert('nilai_ekskul', $mapped);
                }
                $counter++;
            }
        }
    }
    public function ubahJumlahAbsensi($data)
    {
        $keys = array_keys($data);

        $counter = 0;
        foreach ($data as $d) {
            if ($keys[$counter] !== "submit") {
                $input = explode('_', $keys[$counter]);

                $checkData = $this->db->query("SELECT * FROM jumlah_ketidakhadiran WHERE id_siswa=" . $input[0] . " AND id_kelas_siswa=" . $input[1] . " AND id_semester=" . $input[2] . " AND id_ketidakhadiran=" . $input[3])->row_array();
                $mapped = [
                    'id_siswa' => $input[0],
                    'id_kelas_siswa' => $input[1],
                    'id_semester' => $input[2],
                    'id_ketidakhadiran' => $input[3],
                    'jumlah' => $d
                ];

                if ($checkData) {
                    $this->db->where('id_siswa', $input[0]);
                    $this->db->where('id_kelas_siswa', $input[1]);
                    $this->db->where('id_semester', $input[2]);
                    $this->db->where('id_ketidakhadiran', $input[3]);
                    $this->db->update('jumlah_ketidakhadiran', $mapped);
                } else {
                    $this->db->insert('jumlah_ketidakhadiran', $mapped);
                }
                $counter++;
            }
        }
    }

    public function pilihWaliKelas($mapped)
    {
        $checkWaliKelas = $this->db->query('SELECT * FROM wali_kelas WHERE tahun ="' . $mapped["tahun"] . '" AND id_kelas ="' . $mapped["id_kelas"] . '"')->row_array();
        if ($checkWaliKelas) {
            $this->db->where('tahun', $mapped["tahun"]);
            $this->db->where('id_kelas', $mapped["id_kelas"]);
            $this->db->update('wali_kelas', $mapped);
        } else {
            $this->db->insert('wali_kelas', $mapped);
        }
    }

    private function _getNominalQuery($tahun, $idkelas)
    {
        $result = $this->db->query("SELECT * FROM nominal_spp_per_tingkat WHERE id_kelas = " . $idkelas . " AND tahun_ajaran = '" . $tahun . "'")->row_array();
        return ($result) ? $result["id_nominal_spp"] : "0";
    }

    public function getNominalPertingkat($tahun)
    {
        $kls1A = $this->_getNominalQuery($tahun, '1');
        $kls1B = $this->_getNominalQuery($tahun, '2');
        $kls1C = $this->_getNominalQuery($tahun, '3');
        $kls1D = $this->_getNominalQuery($tahun, '4');
        $kls2A = $this->_getNominalQuery($tahun, '5');
        $kls2B = $this->_getNominalQuery($tahun, '6');
        $kls2C = $this->_getNominalQuery($tahun, '7');
        $kls2D = $this->_getNominalQuery($tahun, '8');
        $kls3A = $this->_getNominalQuery($tahun, '9');
        $kls3B = $this->_getNominalQuery($tahun, '10');
        $kls3C = $this->_getNominalQuery($tahun, '11');
        $kls3D = $this->_getNominalQuery($tahun, '12');
        $kls4A = $this->_getNominalQuery($tahun, '13');
        $kls4B = $this->_getNominalQuery($tahun, '14');
        $kls4C = $this->_getNominalQuery($tahun, '15');
        $kls4D = $this->_getNominalQuery($tahun, '16');
        $kls5A = $this->_getNominalQuery($tahun, '17');
        $kls5B = $this->_getNominalQuery($tahun, '18');
        $kls5C = $this->_getNominalQuery($tahun, '19');
        $kls5D = $this->_getNominalQuery($tahun, '20');
        $kls6A = $this->_getNominalQuery($tahun, '21');
        $kls6B = $this->_getNominalQuery($tahun, '22');
        $kls6C = $this->_getNominalQuery($tahun, '23');
        $kls6D = $this->_getNominalQuery($tahun, '24');
        $kls1 = ($kls1A === $kls1B && $kls1B === $kls1C && $kls1C === $kls1D) ? $kls1A : "0";
        $kls2 = ($kls2A === $kls2B && $kls2B === $kls2C && $kls2C === $kls2D) ? $kls2A : "0";
        $kls3 = ($kls3A === $kls3B && $kls3B === $kls3C && $kls3C === $kls3D) ? $kls3A : "0";
        $kls4 = ($kls4A === $kls4B && $kls4B === $kls4C && $kls4C === $kls4D) ? $kls4A : "0";
        $kls5 = ($kls5A === $kls5B && $kls5B === $kls5C && $kls5C === $kls5D) ? $kls5A : "0";
        $kls6 = ($kls6A === $kls6B && $kls6B === $kls6C && $kls6C === $kls6D) ? $kls6A : "0";
        $nominal = [
            "kls1" => $kls1,
            "kls2" => $kls2,
            "kls3" => $kls3,
            "kls4" => $kls4,
            "kls5" => $kls5,
            "kls6" => $kls6,
        ];
        return $nominal;
    }

    private function _setNominalSpp($idKelas, $data, $tahunAjar)
    {
        $mapped = [
            'tahun_ajaran' => $tahunAjar,
            'id_kelas' => $idKelas,
            'id_nominal_spp' => $data
        ];

        if ($mapped["id_nominal_spp"] !== "1") {
            if ($this->_getNominalQuery($tahunAjar, $idKelas) == "0") {
                $this->db->insert('nominal_spp_per_tingkat', $mapped);
            } else {
                $this->db->where('tahun_ajaran', $tahunAjar);
                $this->db->where('id_kelas', $idKelas);
                $this->db->update('nominal_spp_per_tingkat', $mapped);
            }
        }
    }

    public function setNominalPerTingkat($tahunAjar, $data)
    {
        for ($i = 1; $i <= 24; $i++) {
            switch ($i) {
                case $i <= 4:
                    $j = '1';
                    break;
                case $i <= 8:
                    $j = '2';
                    break;
                case $i <= 12:
                    $j = '3';
                    break;
                case $i <= 16:
                    $j = '4';
                    break;
                case $i <= 20:
                    $j = '5';
                    break;
                case $i <= 24:
                    $j = '6';
                    break;
            }
            $this->_setNominalSpp($i, $data["sppkelas" . $j], $tahunAjar);
        }
    }
    public function postSPP($data)
    {
        $mapped = [
            "id_siswa" => $data["id_siswa"],
            "id_kelas_siswa" => $data["id_kelas_siswa"],
            "id_detail_status_spp" => $data["id_detail_status_spp"],
            "bulan" => $data["bulan"],
            "tahun_ajaran" => $data["tahun_ajaran"],
            "nominal" => $data["nominal"],
            "tanggal" => $data["tanggal"],
            "metode_bayar" => $data["metode_bayar"],
            "bukti_transfer" => $data["bukti_transfer"],
            "id_staff" => $data["id_staff"],
        ];

        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('id_kelas_siswa', $data["id_kelas_siswa"]);
        $this->db->where('bulan', $data["bulan"]);
        $this->db->where('tahun_ajaran', $data["tahun_ajaran"]);
        $check = $this->db->get('spp')->row_array();
        if (!$check) {
            $this->db->insert('spp', $mapped);
        }
        if ($this->db->affected_rows() > 0) {
            $this->db->where('id_siswa', $data["id_siswa"]);
            $this->db->where('id_kelas_siswa', $data["id_kelas_siswa"]);
            $this->db->where('bulan', $data["bulan"]);
            $this->db->where('tahun_ajaran', $data["tahun_ajaran"]);
            $this->db->select('id');
            $data["idtransaksi"] = $this->db->get('spp')->row_array()["id"];
            echo json_encode($data);
        }
    }

    public function getSppPaymentDetail($idtr)
    {
        return $this->db->query("SELECT siswa.nama, siswa.nomor_induk, kelas_siswa.id_kelas, kelas.class, bulan_akademik.nama_bulan, spp.tahun_ajaran, spp.nominal, spp.tanggal, metode_bayar_spp.metode, spp.bukti_transfer, staff.nama AS nama_admin FROM spp JOIN siswa ON spp.id_siswa = siswa.id JOIN kelas_siswa ON spp.id_kelas_siswa = kelas_siswa.id JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN bulan_akademik ON spp.bulan = bulan_akademik.id JOIN metode_bayar_spp ON spp.metode_bayar = metode_bayar_spp.id JOIN staff ON spp.id_staff = staff.id WHERE spp.id =" . $idtr)->row_array();
    }

    public function ubahStatusSpp($data)
    {
        $mapped = [
            'id_siswa' => $data["id_siswa"],
            'id_status_spp' => $data["id_status_spp"],
            'nominal' => $data["nominal"],
            'keterangan' => $data["keterangan"],
        ];

        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('id_status_spp', $data["id_status_spp"]);
        $this->db->where('nominal', $data["nominal"]);
        $check = $this->db->get('detail_status_spp_siswa')->row_array();
        if (!$check) {
            $this->db->insert('detail_status_spp_siswa', $mapped);
        } else {
            $this->db->where('id_siswa', $data["id_siswa"]);
            $this->db->where('id_status_spp', $data["id_status_spp"]);
            $this->db->where('nominal', $data["nominal"]);
            $this->db->update('detail_status_spp_siswa', $mapped);
        }
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('id_status_spp', $data["id_status_spp"]);
        $this->db->where('nominal', $data["nominal"]);
        $id_detail_status_spp = $this->db->get('detail_status_spp_siswa')->row_array()["id"];
        $this->db->query('UPDATE siswa SET status_spp = ' . $data["id_status_spp"] . ', id_detail_status_spp=' . $id_detail_status_spp . ' WHERE id=' . $data["id_siswa"]);
        $this->SppFreeCharge($this->tahunAjar);
        return "success";
    }

    public function SppFreeCharge($tahunAjar)
    {
        $thisMonthId = (int)$this->db->query("SELECT id FROM bulan_akademik WHERE angka_bulan=" . date('m'))->row_array()["id"];
        $AllFreeSppChargeStudents = $this->db->query("SELECT id,id_siswa FROM detail_status_spp_siswa WHERE nominal=1")->result_array();
        foreach ($AllFreeSppChargeStudents as $a) {
            $mapped = [
                'id_siswa' => $a["id_siswa"],
                'id_detail_status_spp' => $a["id"],
                'nominal' => '0',
                'metode_bayar' => '1',
                'bukti_transfer' => '',
                'id_staff' => $this->session->userdata('id_staff'),
            ];
            if ($thisMonthId == 1) {
                $tahunAjar = (string)((int)date('Y') - 1) . "/" . date('y');
                $checkSPP = $this->db->query("SELECT * FROM spp WHERE id_siswa=" . $a["id_siswa"] . " AND tahun_ajaran='" . $tahunAjar . "' AND bulan=12")->row_array();
                $idKelasSiswa = $this->db->query("SELECT id FROM kelas_siswa WHERE id_siswa=" . $a["id_siswa"] . " AND tahun='" . $tahunAjar . "'")->row_array();
                if ($idKelasSiswa) {
                    $mapped['id_kelas_siswa'] = $idKelasSiswa["id"];
                    $mapped['bulan'] = '12';
                    $mapped['tahun_ajaran'] = $tahunAjar;
                    $mapped['tanggal'] = date('01-') . "06" . date('-Y');
                    if (!$checkSPP) {
                        $this->db->insert('spp', $mapped);
                    }
                }
            } else {
                for ($i = 1; $i < $thisMonthId; $i++) {
                    $checkSPP = $this->db->query("SELECT * FROM spp WHERE id_siswa=" . $a["id_siswa"] . " AND tahun_ajaran='" . $tahunAjar . "' AND bulan=" . $i)->row_array();
                    $angkaBulan = $this->db->query("SELECT angka_bulan FROM bulan_akademik WHERE id=" . $i)->row_array()["angka_bulan"];
                    if (strlen($angkaBulan) == 1) {
                        $angkaBulan = '0' . $angkaBulan;
                    }
                    $idKelasSiswa = $this->db->query("SELECT id FROM kelas_siswa WHERE id_siswa=" . $a["id_siswa"] . " AND tahun='" . $tahunAjar . "'")->row_array();
                    if ($idKelasSiswa) {
                        $mapped['id_kelas_siswa'] = $idKelasSiswa["id"];
                        $mapped['bulan'] = (string)$i;
                        $mapped['tahun_ajaran'] = $tahunAjar;
                        $mapped['tanggal'] = date('01-') . $angkaBulan . date('-Y');
                        if (!$checkSPP) {
                            $this->db->insert('spp', $mapped);
                        }
                    }
                }
            }
        }
    }

    public function masukkanKelas($idsiswa, $idkelas, $tahunajaran)
    {
        $this->masukkankelasCore($idsiswa, $idkelas, $tahunajaran);
        if ($this->db->affected_rows() > 0) {
            return "success";
        } else {
            return null;
        }
    }
}
