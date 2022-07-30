<?php

class ModelAdmin extends CI_Model
{
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
        ];
        $this->db->insert('siswa', $mapped);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Artikel baru berhasil diposting!');
        }
    }

    public function masukkankelas($idsiswa, $idkelas, $tahun, $th)
    {
        $tahunajar = $tahun . "/" . $th;
        $mapped = [
            "tahun" => $tahunajar,
            "id_siswa" => $idsiswa,
            "id_kelas" => $idkelas,
            "insert_by" => $this->session->userdata('id_staff')
        ];

        $cekKelas = $this->db->query('SELECT * FROM kelas_siswa WHERE id_siswa ="' . $idsiswa . '" AND tahun = "' . $tahunajar . '"')->row_array();

        if ($cekKelas) {
            $this->db->where("id_siswa", $idsiswa);
            $this->db->where("tahun", $tahunajar);
            $this->db->update('kelas_siswa', $mapped);
        } else {
            $this->db->insert('kelas_siswa', $mapped);
        }
        if ($this->db->affected_rows() > 0) {
            redirect('admin/daftarsiswa/' . $idkelas . "/" . $tahunajar);
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
        if($cekKelas){
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
}

