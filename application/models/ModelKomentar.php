<?php

class ModelKomentar extends CI_Model
{
    public function getAllComment()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('komentar')->result_array();
    }
    public function postComment($data)
    {
        $fields = [
            'nama' => $data["comment_name"],
            'email' => $data["comment_email"],
            'komentar' => $data["comment"],
            'tanggal' => $data["datetime"],
        ];
        $this->db->insert('komentar',$fields);
    }
}
