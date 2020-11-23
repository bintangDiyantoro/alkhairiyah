<?php

class ModelPendaftaran extends CI_Model{
    private function _datawali(){
        return [
            'nama_ayah' => $this->session->userdata('nama_ayah'),
            'alamat_ayah' => $this->session->userdata('alamat_ayah'),
            'pekerjaan_ayah' => $this->session->userdata('pekerjaan_ayah'),
            'pendterakhir_ayah' => $this->session->userdata('pendterakhir_ayah'),
            'keterangan_ayah' => $this->session->userdata('keterangan_ayah'),
            'nohape_ayah' => $this->session->userdata('nohape_ayah'),
            'nama_ibu' => $this->session->userdata('nama_ibu'),
            'alamat_ibu' => $this->session->userdata('alamat_ibu'),
            'pekerjaan_ibu' => $this->session->userdata('pekerjaan_ibu'),
            'pendterakhir_ibu' => $this->session->userdata('pendterakhir_ibu'),
            'keterangan_ibu' => $this->session->userdata('keterangan_ibu'),
            'nohape_ibu' => $this->session->userdata('nohape_ibu'),
            'nama_wali' => $this->session->userdata('nama_wali'),
            'alamat_wali' => $this->session->userdata('alamat_wali'),
            'status_wali' => $this->session->userdata('status_wali'),
            'pekerjaan_wali' => $this->session->userdata('pekerjaan_wali'),
            'pendterakhir_wali' => $this->session->userdata('pendterakhir_wali'),
            'nohape_wali' => $this->session->userdata('nohape_wali')
        ];
    }
    public function inputDataOrtu($data){
        $this->session->set_userdata('nama_ayah',$data["nama_ayah"]);
        $this->session->set_userdata('alamat_ayah', $data["alamat_ayah"]);
        $this->session->set_userdata('pekerjaan_ayah', $data["pekerjaan_ayah"]);
        $this->session->set_userdata('pendterakhir_ayah', $data["pendterakhir_ayah"]);
        $this->session->set_userdata('keterangan_ayah', $data["keterangan_ayah"]);
        $this->session->set_userdata('nohape_ayah', $data["nohape_ayah"]);
        $this->session->set_userdata('nama_ibu', $data["nama_ibu"]);
        $this->session->set_userdata('alamat_ibu', $data["alamat_ibu"]);
        $this->session->set_userdata('pekerjaan_ibu', $data["pekerjaan_ibu"]);
        $this->session->set_userdata('pendterakhir_ibu', $data["pendterakhir_ibu"]);
        $this->session->set_userdata('keterangan_ibu', $data["keterangan_ibu"]);
        $this->session->set_userdata('nohape_ibu', $data["nohape_ibu"]);
    }
    public function inputDataWali($data){
        $this->session->set_userdata('nama_wali', $data["nama_wali"]);
        $this->session->set_userdata('alamat_wali', $data["alamat_wali"]);
        $this->session->set_userdata('status_wali', $data["status_wali"]);
        $this->session->set_userdata('pekerjaan_wali', $data["pekerjaan_wali"]);
        $this->session->set_userdata('pendterakhir_wali', $data["pendterakhir_wali"]);
        $this->session->set_userdata('nohape_wali', $data["nohape_wali"]);
    }
    public function inputDataCalonSiswa($data){
        $expl = explode(" ", date(DATE_RFC822));

        if($expl[0]=='Sun,'){
            $hari = 'Ahad';
        } elseif($expl[0]=='Mon,'){
            $hari = 'Senin';
        } elseif ($expl[0] == 'Tue,') {
            $hari = 'Selasa';
        } elseif ($expl[0] == 'Wed,') {
            $hari = 'Rabu';
        } elseif ($expl[0] == 'Thu,') {
            $hari = 'Kamis';
        } elseif ($expl[0] == 'Fri,') {
            $hari = 'Jumat';
        } elseif ($expl[0] == 'Sat,') {
            $hari = 'Sabtu';
        }

        $jam = substr($expl[4],0,5);
        $tanggal = $hari.", " . $expl[1] . " " . $expl[2] . " " . $expl[3];

        $yyyy = explode('-', $data['tgl_lahir'])[2];
        $mm = explode('-', $data['tgl_lahir'])[1];
        $dd = explode('-', $data['tgl_lahir'])[0];
        $tgl_lahir = $yyyy."-".$mm."-".$dd;

        $this->db->select_max('id_wali');
        $idWali = (int) $this->db->get('wali')->result_array()[0]['id_wali'] + 1;
        $this->db->select_max('id_dftr');
        $idDftr = (int) $this->db->get('pendaftaran')->result_array()[0]['id_dftr'] + 1;

        $zeroes = '000';
        $idCS = (string) $idDftr;
        $idCS = 'CS-' . substr($zeroes . $idCS, -4, 4);
        

        $dataCalonSiswa = [
            'nama' => $data['nama_calon_siswa'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tgl_lahir' => $tgl_lahir,
            'asal_tk' => $data['asal_tk'],
            // 'titipan' => 0,
            'wali' => $this->session->userdata('wali'),
            'id_wali' => $idWali,
            'id_dftr' => $idDftr,
            'id_cs' => $idCS,
        ];

        $dataDftr = [
            'nama_siswa' => $data['nama_calon_siswa'],
            'tanggal' => $tanggal,
            'jam' => $jam
        ];

        $this->db->insert('calon_siswa', $dataCalonSiswa);
        $this->db->insert('wali', $this->_datawali());
        $this->db->insert('pendaftaran', $dataDftr);

        if($this->db->affected_rows() > 0){
            $this->db->where('id_wali', $dataCalonSiswa['id_wali']);
            $id = $this->db->get('calon_siswa')->row_array()['id'];
            $this->session->set_userdata('id_calon_siswa',$id);
            $this->session->set_userdata('sukses', 'ok');
            redirect('pendaftaran/cetak/'.$idDftr);
        }else{
            echo $this->db->error();
        }
    }
    public function getCalonSiswa($id){
        $this->db->where('id', $id);
        $siswa = $this->db->get('calon_siswa')->row_array();
        if($siswa['wali'] =='Ayah'){
            $this->db->where('id_wali', $id);
            $namawali = $this->db->get('wali')->row_array()['nama_ayah'];
        }elseif ($siswa['wali'] == 'Ibu') {
            $this->db->where('id_wali', $id);
            $namawali = $this->db->get('wali')->row_array()['nama_ibu'];
        }elseif ($siswa['wali'] == 'Lainnya') {
            $this->db->where('id_wali', $id);
            $namawali = $this->db->get('wali')->row_array()['nama_wali'];
        }else{
            $namawali = "";
        }
        
        if($siswa['jenis_kelamin']=='L'){
            $siswa['jenis_kelamin'] = 'Laki-laki';
        }elseif($siswa['jenis_kelamin'] == 'P'){
            $siswa['jenis_kelamin'] = 'Perempuan';
        }
        $zeroes = '000';
        $siswa['id_asli'] = $siswa['id'];
        $siswa['id'] = (string)$siswa['id'];
        $siswa['id'] = 'CS-'.substr($zeroes.$siswa['id'],-4,4);
        $siswa['namawali'] = $namawali;
        return $siswa;
    }
    public function detail($id){

        $data = $this->db->query('SELECT calon_siswa.id, calon_siswa.nama, calon_siswa.jenis_kelamin,
                calon_siswa.tgl_lahir, calon_siswa.asal_tk, calon_siswa.wali, pendaftaran.tanggal, pendaftaran.jam 
                FROM calon_siswa JOIN pendaftaran 
                ON calon_siswa.id_dftr = pendaftaran.id_dftr 
                WHERE calon_siswa.id = '.$id)->row_array();

        if ($data['jenis_kelamin'] == 'L') {
            $data['jenis_kelamin'] = 'Laki-laki';
        } elseif ($data['jenis_kelamin'] == 'P') {
            $data['jenis_kelamin'] = 'Perempuan';
        }

        if ($data['wali'] == 'Ayah') {
            $this->db->where('id_wali', $id);
            $namawali = $this->db->get('wali')->row_array()['nama_ayah'];
        } elseif ($data['wali'] == 'Ibu') {
            $this->db->where('id_wali', $id);
            $namawali = $this->db->get('wali')->row_array()['nama_ibu'];
        } elseif ($data['wali'] == 'Lainnya') {
            $this->db->where('id_wali', $id);
            $namawali = $this->db->get('wali')->row_array()['nama_wali'];
        } else {
            $namawali = "";
        }

        $zeroes = '000';
        $data['id'] = (string) $data['id'];
        $data['id'] = 'CS-' . substr($zeroes . $data['id'], -4, 4);
        $data['namawali'] = $namawali;

        return $data;
    }
}