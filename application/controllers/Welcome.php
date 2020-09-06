<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelPendaftaran', 'Pendaftaran');
		$this->load->model('ModelKomentar', 'Komentar');
		$this->csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
	}

	private function _validate_comments()
	{
		$this->form_validation->set_rules('comment_name', 'comment_name', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[20]', ['required' => 'nama wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 20 huruf']);
		$this->form_validation->set_rules('comment_email', 'comment_email', 'regex_match[/^[a-z\d_.]+@[a-z]+.[a-z]+$/mi]', ['regex_match' => 'email tidak valid']);
		$this->form_validation->set_rules('comment', 'comment', 'required|regex_match[/^(?!.*^or\s.+=.+$).*$/mi]', ['required' => 'Silahkan tinggalkan komentar', 'regex_match' => 'komentar tidak valid']);
	}

	public function index()
	{
		netralize();
		$data["csrf"] = $this->csrf;
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = 'Halaman Utama';
		$data['description'] = 'SD Islam Al-Khairiyah adalah sekolah yang melayani pengajaran jenjang pendidikan dasar di Kabupaten Banyuwangi yang mengajarkan semua mata pelajaran wajib sesuai kurikulum yang berlaku disertai tambahan nilai-nilai agama Islam.';
		$this->db->order_by('id', 'DESC');
		$data['berita'] = $this->db->get('berita')->result_array();
		for ($i = 0; $i < count($data['berita']); $i++) {
			$konten = $data['berita'][$i]['content'];
			$a = substr($konten, strpos($konten, "ckfinder"));
			$b = substr($a, strpos($a, "g\">") + 3);
			$c = substr($konten, strpos($konten, "<p>") + 3);
			$lengtha = strlen($b);
			$length = strlen(substr($konten, strpos($konten, "<p>") + 3));
			$lengthprev = strlen(substr($konten, strpos($konten, ".") + 11));
			$data['berita'][$i]['title'] = strip_tags(substr($konten, 0, -$length));
			$data['berita'][$i]['image'] = strip_tags(substr($a, 0, - ($lengtha + 2)));
			$data['berita'][$i]['prev'] = strip_tags(substr($c, 0, - ($lengthprev + 10)));;
		}
		$data['dakwah'] = $this->db->get('dakwah')->result_array();
		if (isset($_POST["submit"])) {
			$this->_validate_comments();
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('scroll', 'true');
				$this->session->set_userdata('comment_name', $this->input->post('comment_name'));
				$this->session->set_userdata('comment_email', $this->input->post('comment_email'));
				$this->session->set_userdata('comment', $this->input->post('comment'));
			} else {
				$this->session->unset_userdata('comment_name');
				$this->session->unset_userdata('comment_email');
				$this->session->unset_userdata('comment');
				$this->Komentar->postComment($this->input->post());
				$this->session->set_flashdata('success', 'Komentar berhasil ditambahkan!');
			}
		}
		$data["comments"] = $this->Komentar->getAllComment();
		$this->load->view('templates/header', $data);
		$this->load->view('home/index');
		$this->load->view('templates/footer');
	}
}
