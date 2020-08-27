<?php

class Materi extends CI_Controller
{
    public function index($id)
    {
        $data["title"] = "Materi";
        $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id =" . $id)->row_array();
        $data["materi"] = $this->db->query("SELECT materi.subject, mapel.nama_mapel FROM materi JOIN mapel ON materi.subject = mapel.id WHERE materi.class_id =" . $id . " GROUP BY materi.subject")->result_array();
        $data['description'] = 'Index materi of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/kelas');
        $this->load->view('templates/footer');
    }
    public function mapel($class, $subject)
    {
        $data["title"] = "Materi";
        $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id =" . $class)->row_array();
        $data["mapel"] = $this->db->query("SELECT materi.id, mapel.nama_mapel, materi.chapter  FROM materi JOIN mapel ON materi.subject = mapel.id WHERE class_id = " . $class . " AND materi.subject = " . $subject)->result_array();
        $data['description'] = 'Mapel of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/mapel');
        $this->load->view('templates/footer');
    }
    public function detail($id)
    {
        $data["title"] = "Materi";

        $query = 'SELECT materi.id, materi.class_id, kelas.class, materi.subject, 
                    mapel.nama_mapel, materi.chapter, materi.material, 
                    materi.attachment_1, materi.attachment_2, materi.attachment_3,
                    materi.attachment_4, materi.attachment_5, materi.questions 
                    FROM ((materi JOIN kelas ON materi.class_id = kelas.id) 
                    JOIN mapel ON materi.subject = mapel.id) WHERE materi.id =' . $id;

        $data["materi"] = $this->db->query($query)->row_array();
        $data['description'] = 'Materi detail of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/detail');
        $this->load->view('templates/footer');
    }
}
