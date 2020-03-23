<?php

class ModelAdmin extends CI_Model{
    public function postDakwah($content){
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
}