<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelPendaftaran', 'Pendaftaran');
	}
	
	public function index()
	{
		netralize();
		$id = $this->session->userdata('id_calon_siswa');
		$data['calon_siswa'] = $this->Pendaftaran->getCalonSiswa($id);
		$data['title'] = 'Halaman Utama';
		$this->db->order_by('id','DESC');
		$data['berita'] = $this->db->get('berita')->result_array();
		for($i=0;$i<count($data['berita']);$i++){
			$konten = $data['berita'][$i]['content'];
			$a = substr($konten, strpos($konten, "ckfinder"));
			$b = substr($a, strpos($a, "g\">") + 3);
			$c = substr($konten, strpos($konten, "<p>") + 3);
			$lengtha = strlen($b);
			$length = strlen(substr($konten, strpos($konten, "<p>") + 3));
			$lengthprev = strlen(substr($konten, strpos($konten, ".")+11));
			$data['berita'][$i]['title'] = strip_tags(substr($konten, 0, -$length));
			$data['berita'][$i]['image'] = strip_tags(substr($a, 0, -($lengtha+2)));
			$data['berita'][$i]['prev'] = strip_tags(substr($c, 0, - ($lengthprev+10)));;
		}
		$data['dakwah'] = $this->db->get('dakwah')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('home/index');
		$this->load->view('templates/footer');
	}
}
