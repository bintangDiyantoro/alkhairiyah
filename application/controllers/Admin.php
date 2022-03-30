<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAdmin', 'Admin');
        $this->load->model('ModelPendaftaran', 'Pendaftaran');
        $this->csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
    }

    public function login()
    {
        netralize();
        netralize3();

        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'Nama admin wajib diisi', 'regex_match' => 'Nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'Nama maksimal 50 huruf']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'required' => 'Password wajib diisi',
            'min_length' => 'Password minimal 3 karakter!'
        ]);

        $data['csrf'] = $this->csrf;
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login';
            $this->load->view('admin/login', $data);
            $this->session->unset_userdata('error');
        } else {
            $this->db->where('name', $this->input->post('name'));
            $this->db->from('admin');
            $query = $this->db->get()->row_array();
            if ($query != NULL && password_verify($this->input->post('password'), $query['password']) == TRUE) {
                if ($query['verified'] == 1) {
                    $this->session->set_userdata('admin', $this->input->post('name'));
                    $this->session->set_userdata('role', $query['role']);
                    $this->session->unset_userdata('error');
                    redirect('admin');
                } else {
                    $this->session->set_userdata('error', 'Akun belum diverifikasi, silahkan hubungi Operator Yayasan!');
                    redirect('admin');
                }
            } else {
                $this->session->set_userdata('error', 'Nama atau kata sandi salah!');
                redirect('admin');
            }
        }
    }


    public function register()
    {
        netralize();
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama admin wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Password wajib diisi',
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password minimal 3 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        $data['csrf'] = $this->csrf;

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Registrasi';
            $this->load->view('admin/register', $data);
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'verified' => 0
            ];
            $this->db->insert('admin', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Registrasi sukses! Silahkan hubungi Operator Yayasan untuk verifikasi');
                redirect('admin');
            }
        }
    }

    public function index()
    {
        netralize();
        netralize3();
        if ($this->session->userdata('admin')) {
            $this->session->unset_userdata('error');
            $data['title'] = 'Dashboard';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/dashboard');
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function notfound()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Not Found';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/404');
            $this->load->view('admin/footer');
        }
    }

    public function adminManagement()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data["title"] = 'Admin Management';
            $this->db->where('role !=', "9");
            $data["admin"] = $this->db->get('admin')->result_array();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/adminmanagementtop');
            $this->load->view('admin/adminmanagement');
            $this->load->view('admin/adminmanagementbtm');
            $this->load->view('admin/footer');
        }
    }

    public function aktivasiadmin($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $this->db->where('id', $id);
            $verified = $this->db->get('admin')->row_array()["verified"];
            if ($verified == "0") {
                $this->db->set('verified', "1");
                $this->db->where('id', $id);
                $this->db->update('admin');
            } elseif ($verified == "1") {
                $this->db->set('verified', "0");
                $this->db->where('id', $id);
                $this->db->update('admin');
            }
        }
        redirect('admin/adminmanagement');
    }

    public function ubahadmin($id)
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['csrf'] = $this->csrf;
            $this->db->where('id', $id);
            $data['admin'] = $this->db->get('admin')->row_array();
            $data['title'] = 'Ubah Data Admin ' . $data['admin']['name'];
            $slcTch = $this->db->query('SELECT id_guru from admin')->result_array();
            $allTch = $this->db->get('guru')->result_array();
            $stId = [];
            $data['guru'] = [];

            foreach ($slcTch as $st) {
                $stId[] = $st["id_guru"];
            }

            foreach ($allTch as $at) {
                if (!in_array($at['id'], $stId)) {
                    $data['guru'][] = $at;
                }
            }

            if ($data['admin']['id_guru']) {
                $data['admin'] = $this->db->query("SELECT admin.id,admin.name,admin.role,admin.id_guru,guru.NIY,guru.nama FROM admin JOIN guru ON admin.id_guru = guru.id WHERE admin.id = " . $data['admin']['id'])->row_array();
            }

            if (isset($_POST["submit"]) && $this->input->post('id_guru') !== NULL) {
                if ($this->input->post('id_guru') == "") {
                    $this->db->set('id_guru', NULL);
                } else {
                    $this->db->set('id_guru', $this->input->post('id_guru'));
                }

                $this->db->where('id', $id);
                $this->db->update('admin');

                redirect('admin/adminmanagement');
            } else {
                $this->load->view('admin/header', $data);
                $this->load->view('admin/editadmin');
                $this->load->view('admin/footer');
            }
        }
    }

    public function hapusadmin($id)
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Detail Materi';
            $this->db->where('id', $id);
            $this->db->delete('admin');
            redirect('admin/adminmanagement');
        }
    }

    public function ajaxadminvrf()
    {
        $this->db->where('role !=', "9");
        $data["admin"] = $this->db->get('admin')->result_array();
        $this->load->view('admin/adminmanagement', $data);
    }

    public function teachersmanagement()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data["title"] = 'Teachers Management';
            $data["csrf"] = $this->csrf;
            $data["teachers"] = $this->db->get('guru')->result_array();

            if (isset($_POST['submit'])) {
                if ($this->input->post("nama") && $this->input->post('NIY') && $this->input->post('jenis_kelamin')) {
                    $guru = [
                        'nama' => $this->input->post('nama'),
                        'NIY' => $this->input->post('NIY'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin')
                    ];
                    $this->db->insert('guru', $guru);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/teachersmanagement');
                    }
                }
            }

            $this->load->view('admin/header', $data);
            $this->load->view('admin/teachersmanagement');
            $this->load->view('admin/footer');
        }
    }

    public function ubahguru($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $this->db->where('id', $id);
            $data["guru"] = $this->db->get('guru')->row_array();
            $data["title"] = "Ubah Data " . $data["guru"]["nama"];
            $data["csrf"] = $this->csrf;

            $this->load->view('admin/header', $data);
            $this->load->view('admin/editguru');
            $this->load->view('admin/footer');
        }
    }

    public function hapusguru($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $this->db->where('id', $id);
            $this->db->delete('guru');
            if ($this->db->affected_rows() > 0) {
                redirect('/admin/teachersmanagement');
            }
        }
    }

    public function bukuinduk()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data["title"] = "Buku Induk Siswa";
            $data["csrf"] = $this->csrf;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/bukuinduk');
            $this->load->view('admin/footer');
        }
    }

    public function postDakwah()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Buat Artikel Dakwah';
            $data['csrf'] = $this->csrf;

            $this->load->view('admin/header', $data);
            $this->load->view('admin/postdakwah');
            $this->load->view('admin/footer');

            if (isset($_POST['submit'])) {
                $content = $this->input->post('content');
                $this->Admin->postDakwah($content);
            }
        }
    }

    public function dakwah()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Dakwah';
            $data['dakwah'] = $this->db->get('dakwah')->result_array();

            $this->load->view('admin/header', $data);
            $this->load->view('admin/dakwah');
            $this->load->view('admin/footer');
        }
    }

    public function detailDakwah($index)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Dakwah';
            $data['dakwah'] = $this->db->get('dakwah')->result_array();
            $data['detail'] = $data['dakwah'][$index];
            $this->load->view('admin/header', $data);
            $this->load->view('admin/detaildakwah');
            $this->load->view('admin/footer');
        }
    }

    public function editDakwah($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Edit Artikel Dakwah';
            $data['dakwah'] = $this->db->get('dakwah')->result_array();
            $data['detail'] = $data['dakwah'][(int)$id - 1];
            $data['csrf'] = $this->csrf;

            $this->load->view('admin/header', $data);
            $this->load->view('admin/editdakwah');
            $this->load->view('admin/footer');

            if (isset($_POST['submit'])) {
                $content = $this->input->post('content');
                $this->Admin->updateDakwah($content, $id);
            }
        }
    }

    public function hapusDakwah($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $this->db->where('id', $id);
            $this->db->delete('dakwah');
            if ($this->db->affected_rows() > 0) {
                redirect('/admin/dakwah');
            }
        }
    }

    public function postBerita()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Buat Berita Baru';
            $data['csrf'] = $this->csrf;

            $this->load->view('admin/header', $data);
            $this->load->view('admin/postberita');
            $this->load->view('admin/footer');

            if (isset($_POST['submit'])) {
                $content = $this->input->post('content');
                $this->Admin->postBerita($content);
            }
        }
    }

    public function berita()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Berita';
            $data['berita'] = $this->db->get('berita')->result_array();

            $this->load->view('admin/header', $data);
            $this->load->view('admin/berita');
            $this->load->view('admin/footer');
        }
    }

    public function detailBerita($index)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Berita';
            $data['berita'] = $this->db->get('berita')->result_array();
            $data['detail'] = $data['berita'][$index];
            $this->load->view('admin/header', $data);
            $this->load->view('admin/detailberita');
            $this->load->view('admin/footer');
        }
    }

    public function editBerita($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {

            $data['title'] = 'Edi Artikel Berita';
            $data['berita'] = $this->db->get('berita')->result_array();
            $data['detail'] = $data['berita'][(int)$id - 1];
            $data['csrf'] = $this->csrf;

            $this->load->view('admin/header', $data);
            $this->load->view('admin/editberita');
            $this->load->view('admin/footer');

            if (isset($_POST['submit'])) {
                $content = $this->input->post('content');
                $this->Admin->updateBerita($content, $id);
            }
        }
    }

    public function hapusBerita($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $this->db->where('id', $id);
            $this->db->delete('berita');
            if ($this->db->affected_rows() > 0) {
                redirect('/admin/berita');
            }
        }
    }


    public function buatMateri()
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Buat Materi Baru';
            $data['csrf'] = $this->csrf;
            $data['kelas'] = $this->db->get('kelas')->result_array();
            $data['mapel'] = $this->db->get('mapel')->result_array();
            $data["month"] = date('Y-m');

            $this->form_validation->set_rules('class_id', 'Kelas', 'required', ['required' => 'Kelas wajib dipilih']);
            $this->form_validation->set_rules('subject', 'Mata Pelajaran', 'required', ['required' => 'Mata pelajaran wajib dipilih']);
            $this->form_validation->set_rules('chapter', 'Bab / Judul Materi', 'required', ['required' => 'Bab / judul materi wajib diisi']);
            $this->form_validation->set_rules('material', 'Materi', 'required', ['required' => 'Materi wajib diisi']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('material', $this->input->post('material'));
                $this->session->set_flashdata('questions', $this->input->post('questions'));
                $this->load->view('admin/header', $data);
                $this->load->view('admin/buatmateri');
                $this->load->view('admin/footer');
            } else {
                $allowed_format = ["jpg", "jpeg", "png", "bmp", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pptm", "odp"];
                $counter = 0;
                foreach ($_FILES as $file) {
                    $tmp = explode('.', $file["name"]);
                    $format = strtolower(end($tmp));
                    if ($file["name"] && !in_array($format, $allowed_format)) {
                        $counter += 1;
                    }
                }
                if ($counter == 0) {
                    $content = [$_FILES, $this->input->post()];
                    $this->Admin->buatMateri($content);
                    $this->session->unset_userdata('material');
                } else {
                    $this->session->set_flashdata('material', $this->input->post('material'));
                    $this->session->set_flashdata('questions', $this->input->post('questions'));
                    $this->session->set_flashdata('alert', 'Gagal');
                }
                $this->load->view('admin/header', $data);
                $this->load->view('admin/buatmateri');
                $this->load->view('admin/footer');
            }
        }
    }

    public function materi()
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Materi Terbaru';
            $data['materi'] = $this->db->query("SELECT materi.id, kelas.class, mapel.nama_mapel, materi.chapter, materi.material, materi.date FROM materi JOIN kelas ON kelas.id = materi.class_id JOIN mapel ON mapel.id = materi.subject ORDER BY materi.id DESC LIMIT 35")->result_array();

            $this->load->view('admin/header', $data);
            $this->load->view('admin/materi');
            $this->load->view('admin/footer');
        }
    }

    public function detailmateri($id)
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Detail Materi';

            $query = 'SELECT materi.id, materi.class_id, kelas.class, materi.subject, 
                    mapel.nama_mapel, materi.chapter, materi.material, 
                    materi.attachment_1, materi.attachment_2, materi.attachment_3,
                    materi.attachment_4, materi.attachment_5, materi.questions, materi.date 
                    FROM ((materi JOIN kelas ON materi.class_id = kelas.id) 
                    JOIN mapel ON materi.subject = mapel.id) WHERE materi.id =' . $id;

            $data["materi"] = $this->db->query($query)->row_array();

            $this->load->view('admin/header', $data);
            $this->load->view('admin/detailmateri');
            $this->load->view('admin/footer');
        }
    }

    public function ubahmateri($id)
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {

            $query = 'SELECT materi.id, materi.class_id, kelas.class, materi.subject, 
                    mapel.nama_mapel, materi.chapter, materi.material, 
                    materi.attachment_1, materi.attachment_2, materi.attachment_3,
                    materi.attachment_4, materi.attachment_5, materi.questions, materi.date 
                    FROM ((materi JOIN kelas ON materi.class_id = kelas.id) 
                    JOIN mapel ON materi.subject = mapel.id) WHERE materi.id =' . $id;

            $data["materi"] = $this->db->query($query)->row_array();
            $data['title'] = 'Ubah Materi';
            $data['csrf'] = $this->csrf;
            $data['kelas'] = $this->db->get('kelas')->result_array();
            $data['mapel'] = $this->db->get('mapel')->result_array();
            $data["month"] = date('Y-m');

            $this->form_validation->set_rules('class_id', 'Kelas', 'required', ['required' => 'Kelas wajib dipilih']);
            $this->form_validation->set_rules('subject', 'Mata Pelajaran', 'required', ['required' => 'Mata pelajaran wajib dipilih']);
            $this->form_validation->set_rules('chapter', 'Bab / Judul Materi', 'required', ['required' => 'Bab / judul materi wajib diisi']);
            $this->form_validation->set_rules('material', 'Materi', 'required', ['required' => 'Materi wajib diisi']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('material', $this->input->post('material'));
                $this->session->set_flashdata('questions', $this->input->post('questions'));
                $this->load->view('admin/header', $data);
                $this->load->view('admin/editmateri');
                $this->load->view('admin/footer');
            } else {
                $allowed_format = ["jpg", "jpeg", "png", "bmp", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pptm", "odp"];
                $counter = 0;
                foreach ($_FILES as $file) {
                    $tmp = explode('.', $file["name"]);
                    $format = strtolower(end($tmp));
                    if ($file["name"] && !in_array($format, $allowed_format)) {
                        $counter += 1;
                    }
                }
                if ($counter == 0) {
                    $content = [$_FILES, $this->input->post()];
                    $this->Admin->editMateri($content, $id);
                    redirect('admin/materi');
                    $this->session->unset_userdata('material');
                } else {
                    $this->session->set_flashdata('material', $this->input->post('material'));
                    $this->session->set_flashdata('questions', $this->input->post('questions'));
                    $this->session->set_flashdata('alert', 'Gagal');
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editmateri');
                $this->load->view('admin/footer');
            }
        }
    }

    public function hapusmateri($id)
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Detail Materi';
            $this->db->where('id', $id);
            $this->db->delete('materi');
            redirect('admin/materi');
        }
    }

    //-------------------- Pendaftaran ------------------------------------------

    private function _regex()
    {
        $birthyear = (int)date('Y') - 6;
        $string = "/^" . "((0[1-9]|[1-2][\d]|3[0-1])-(0[1-9]|1[0-2])-201[0-4]|((0[1-9]|[1-2][\d]|3[0-1])-0[1-6]|01-07)-" . $birthyear . ")$/";
        if (preg_match($string, $this->input->post('tgl_lahir'))) {
            return 1;
        } else {
            return 0;
        }
    }

    private function _fillTheForm()
    {
        $data['csrf'] = $this->csrf;
        $data['title'] = 'Pendaftaran';
        $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('admin/header', $data);

        // if ((int)date('mdHi') >= 3141700 && (int)date('mdHi') < 3181700) {
        $this->load->view('admin/pendaftaran');
        // } elseif ((int)date('mdHi') < 3141700) {
        // $this->load->view('admin/sabar');
        // } else {
        // $this->load->view('admin/tutup');
        // }
        $this->load->view('admin/footer');
    }

    private function _validateFormOrtu()
    {
        $this->form_validation->set_rules('nama_ayah', 'nama_ayah', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama ayah wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_ayah', 'alamat_ayah', 'required|regex_match[/^[a-z0-9,.\/":&-()\s\']+$/i]|max_length[255]', ['required' => 'alamat ayah wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pekerjaan_ayah', 'pekerjaan_ayah', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_ayah', 'pendterakhir_ayah', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir ayah tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('keterangan_ayah', 'keterangan_ayah', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'keterangan tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('nohape_ayah', 'nohape_ayah', 'numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
        $this->form_validation->set_rules('nama_ibu', 'nama_ibu', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama ibu wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_ibu', 'alamat_ibu', 'required|regex_match[/^[a-z0-9,.\/":&-()\s\']+$/i]|max_length[255]', ['required' => 'alamat ibu wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pekerjaan_ibu', 'pekerjaan_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_ibu', 'pendterakhir_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir ibu tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('keterangan_ibu', 'keterangan_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'keterangan tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('nohape_ibu', 'nohape_ibu', 'numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
        $this->form_validation->set_rules('wali', 'wali', 'required|in_list[Ayah,Ibu,Lainnya]', ['required' => 'Setiap siswa harus memiliki wali murid, silahkan pilih wali murid terlebih dahulu!']);
    }

    private function _validateFormWali()
    {
        $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama wali wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_wali', 'alamat_wali', 'required|regex_match[/^[a-z0-9,.\/":&-()\s\']+$/i]|max_length[255]', ['required' => 'alamat wali wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('status_wali', 'status_wali', 'required|regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['required' => 'status wali wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'status tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('pekerjaan_wali', 'pekerjaan_wali', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_wali', 'pendterakhir_wali', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir wali tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('nohape_wali', 'nohape_wali', 'required|numeric|min_length[11]|max_length[15]', ['required' => 'nomor hp wali tidak boleh kosong', 'numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
    }

    private function _validateFormCalonSiswa()
    {
        $this->form_validation->set_rules('nama_calon_siswa', 'nama_calon_siswa', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama wali wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required|in_list[L,P]', ['required' => 'jenis kelamin wajib dipilih']);
        $this->form_validation->set_rules('tgl_lahir2', 'tgl_lahir2', 'require', ['require' => 'tanggal lahir wajib diisi']);
        $this->form_validation->set_rules('asal_tk', 'asal_tk', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'asal tk tidak boleh lebih dari 50 karakter']);
    }

    private function _dataOrtu($data_ortu)
    {
        $this->Pendaftaran->inputDataOrtu($data_ortu);
    }

    private function _dataWali($data_wali)
    {
        $this->Pendaftaran->inputDataWali($data_wali);
    }

    public function pendaftaran()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {


            $this->session->unset_userdata('error');
            $this->session->unset_userdata('search');
            if ($this->session->userdata('stwali') == 'valid' || $this->session->userdata('wali') == 'Lainnya') {
                $this->session->unset_userdata('first');
            } else {
                $this->session->set_userdata('first', 'ok');
            }
            $this->_validateFormOrtu();

            if ($this->input->post('wali') == 'Ayah') {
                $this->form_validation->set_rules(
                    'nohape_ayah',
                    'nohape_ayah',
                    'numeric|required|min_length[11]|max_length[15]',
                    ['numeric' => 'nomor hp tidak valid', 'required' => 'nomor hp wali tidak boleh kosong', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']
                );
                $this->session->set_userdata('wali', 'Ayah');
            } elseif ($this->input->post('wali') == 'Ibu') {
                $this->form_validation->set_rules(
                    'nohape_ibu',
                    'nohape_ibu',
                    'numeric|required|min_length[11]|max_length[15]',
                    ['numeric' => 'nomor hp tidak valid', 'required' => 'nomor hp wali tidak boleh kosong', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']
                );
                $this->session->set_userdata('wali', 'Ibu');
            } elseif ($this->input->post('wali') == 'Lainnya') {
                $this->session->set_userdata('wali', 'Lainnya');
            }

            if ($this->form_validation->run() == FALSE) {

                if (isset($_POST['submit'])) {
                    $this->session->unset_userdata('first');
                    $this->session->set_userdata('error', 'error');
                    $this->_dataOrtu($this->security->xss_clean($this->input->post()));
                }
                $this->_fillTheForm();
            } elseif ($this->input->post('wali') == 'Ayah' || $this->input->post('wali') == 'Ibu') {
                $this->session->set_userdata('stwali', 'valid');
                $this->session->unset_userdata('error');
                $this->_dataOrtu($this->security->xss_clean($this->input->post()));
                redirect('admin/calonsiswa');
            } elseif ($this->input->post('wali') == 'Lainnya') {
                $this->session->unset_userdata('error');
                $this->_dataOrtu($this->security->xss_clean($this->input->post()));
                redirect('admin/wali');
            }
        }
    }

    public function wali()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('wali') == 'Lainnya' && $this->csrf['name'] == $this->security->get_csrf_token_name() && $this->csrf['hash'] == $this->security->get_csrf_hash()) {
                $this->_validateFormWali();
                if ($this->form_validation->run() == FALSE) {
                    if (isset($_POST['submit'])) {
                        $this->session->set_userdata('error', 'error');
                        $this->_dataWali($this->security->xss_clean($this->input->post()));
                    }
                    $data['title'] = 'Pendaftaran';
                    $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
                    $data['csrf'] = $this->csrf;
                    $this->load->view('admin/header', $data);
                    $this->load->view('admin/wali');
                    $this->load->view('admin/footer');
                } else {
                    $this->session->set_userdata('stwali', 'valid');
                    $this->session->unset_userdata('error');
                    $this->_dataWali($this->security->xss_clean($this->input->post()));
                    redirect('admin/calonsiswa');
                }
            } else {
                redirect('pendaftaran');
            }
        }
    }

    public function calonsiswa()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('stwali') == 'valid' && $this->csrf['name'] == $this->security->get_csrf_token_name() && $this->csrf['hash'] == $this->security->get_csrf_hash()) {

                if ($this->input->post('jenis_kelamin') == 'L') {
                    $this->session->set_userdata('jenis_kelamin', 'L');
                } elseif ($this->input->post('jenis_kelamin') == 'P') {
                    $this->session->set_userdata('jenis_kelamin', 'P');
                } else {
                    $this->session->set_userdata('jenis_kelamin', null);
                }

                $this->_validateFormCalonSiswa();
                $this->_regex();

                if ($this->form_validation->run() == FALSE || $this->_regex() == 0) {
                    if (isset($_POST['submit'])) {
                        $this->session->set_userdata('error', 'error');
                        $this->session->set_userdata('tgl_lahir', $this->input->post('tgl_lahir'));
                        $this->session->set_flashdata('regex', 'Usia minimal 6 tahun per 1 Juli ' . date('Y'));
                    }
                    $data['title'] = 'Pendaftaran';
                    $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
                    $data['csrf'] = $this->csrf;
                    $this->load->view('admin/header', $data);
                    $this->load->view('admin/calonsiswa');
                    $this->load->view('admin/footer');
                } else {
                    if ($this->session->userdata('wali') == 'Ayah' || $this->session->userdata('wali') == 'Ibu') {
                        $this->session->unset_userdata('nama_wali');
                        $this->session->unset_userdata('alamat_wali');
                        $this->session->unset_userdata('status_wali');
                        $this->session->unset_userdata('pekerjaan_wali');
                        $this->session->unset_userdata('pendterakhir_wali');
                        $this->session->unset_userdata('nohape_wali');
                    }
                    $this->session->unset_userdata('error');
                    $this->session->unset_userdata('tgl_lahir');
                    $data_calon_siswa = $this->security->xss_clean($this->input->post());
                    $this->Pendaftaran->inputDataCalonSiswa($data_calon_siswa);
                }
            } else {
                if ($this->session->userdata('wali') == 'Lainnya') {
                    redirect('admin/wali');
                } else {
                    redirect('pendaftaran');
                }
            }
        }
    }

    public function pendaftartersimpan()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            netralize2();
            $data['title'] = 'Pendaftaran';
            $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
            $data['csrf'] = $this->csrf;
            if ($this->input->post('search') || isset($_POST['search'])) {
                $keyword = $this->input->post('search');
                $this->session->set_userdata('search', $this->input->post('search'));
                $data['start'] = NULL;
                $result = $this->db->query("SELECT * FROM calon_siswa WHERE nama LIKE '%" . $keyword . "%' AND tahun = " . date('Y'))->num_rows();
            } else {
                $keyword = $this->session->userdata('search');
                $data['start'] = (int)$this->uri->segment(3);
                $result = $this->db->query("SELECT * FROM calon_siswa WHERE tahun = " . date('Y'))->num_rows();
            }

            $config['base_url'] = base_url() . 'admin/pendaftartersimpan';
            $config['total_rows'] = $result;
            $config['per_page'] = 10;
            $config['full_tag_open'] = '<nav><ul class="pagination">';
            $config['full_tag_close'] = '</ul></nav>';
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = '<li class="page-item"><span aria-hidden="true">&laquo;</span></li>';
            $config['next_link'] = '<li class="page-item"><span aria-hidden="true">&raquo;</span></li>';
            $config['num_tag_open'] = '<li class="page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['attributes'] = array('class' => 'page-link');
            $this->pagination->initialize($config);

            if ($keyword) {
                if ($data["start"]) {
                    $data['calon_siswa'] = $this->db->query("SELECT * FROM calon_siswa WHERE tahun = " . date('Y') . " AND nama LIKE '%" . $keyword . "%' LIMIT " . $config["per_page"] . " OFFSET " . $data["start"])->result_array();
                } else {
                    $data['calon_siswa'] = $this->db->query("SELECT * FROM calon_siswa WHERE tahun = " . date('Y') . " AND nama LIKE '%" . $keyword . "%' LIMIT " . $config["per_page"] . "")->result_array();
                }
            } else {
                if ($data["start"]) {
                    $data['calon_siswa'] = $this->db->query("SELECT * FROM calon_siswa WHERE tahun = " . date('Y') . " LIMIT " . $config["per_page"] . " OFFSET " . $data["start"])->result_array();
                } else {
                    $data['calon_siswa'] = $this->db->query("SELECT * FROM calon_siswa WHERE tahun = " . date('Y') . " LIMIT " . $config["per_page"] . "")->result_array();
                }
            }

            $this->load->view('admin/header', $data);
            $this->load->view('admin/tersimpan');
            $this->load->view('admin/footer');
        }
    }

    public function daftar($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            netralize();
            $this->session->unset_userdata('sukses');
            $data['title'] = 'Berhasil';
            $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
            $data['id'] = $id;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sukses');
            $this->load->view('admin/footer');
        }
    }

    public function detailpendaftar($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            netralize();
            $data['calon_siswa'] = $this->Pendaftaran->detail($id);
            $data['title'] = 'Pendaftaran';
            $data['description'] = 'Detail calon siswa of SDI Al-Khairiyah Banyuwangi';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/detailpendaftar');
            $this->load->view('admin/footer');
        }
    }

    public function cetak($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [160, 165]]);
            $calon_siswa = $this->Pendaftaran->getCalonSiswa($id);
            $tgl_lahir = explode('-', $calon_siswa['tgl_lahir']);
            $tgl_lahir = $tgl_lahir[2] . '-' . $tgl_lahir[1] . '-' . $tgl_lahir[0];
            $html = '<div style="display:flex;justify-content:space-between">
            <div style="width:400px;float:left;line-height:0.3">
            <h1>BUKTI PENDAFTARAN</h1><h2>PPDB Online ' . date('Y') . '</h2> <h2>SDI AL-Khairiyah Banyuwangi</h2>
            </div>
            <div style="margin-right:0px">
            <img src="' . base_url() . 'assets/img/alkhairiyah.png" width="100px" height="100px" style="margin-top:-10px"></img>
            </div>
            </div>
            <hr/>
            <div style="margin-top:20px">
            <div style="width:102px;float:left;line-height:2;">
            ID pendaftaran<br/>
            Nama<br/>
            Jenis kelamin<br/>
            Tanggal Lahir<br/>
            TK Asal<br/>
            Nama Wali<br/>
            </div>
            
            <div style="position:absolute;width:388px;float:right; top:-176px;right:10px;line-height:2;">
            <strong>
            : ' . $calon_siswa['id'] . ' <br></strong>
            : ' . $calon_siswa['nama'] . ' <br> 
            : ' . $calon_siswa['jenis_kelamin'] . ' <br>
            : ' . $tgl_lahir . ' <br> 
            : ' . $calon_siswa['asal_tk'] . '<br>
            : ' . $calon_siswa['namawali'] . '<br>
            </div>
            </div>
            <br/>
            Pengumuman jadwal verifikasi offline dapat dilihat melalui link: <div style="color:blue"><i>https://chat.whatsapp.com/By5MA5f5wQyL4rkD6yhjDw</i><br/></div><br>
                atau silahkan kembali ke: <div style="color:blue"><i>' . base_url('admin/daftar/') . $id . '</i><br/></div>
                <script>
                alert(\'ok\');
                </script>';
            $nextyear = (int)date('Y') + 1;
            $mpdf->writeHTML($html);
            $mpdf->Output('Bukti Pendaftaran PPDB Online SD Islam Al-Khairiyah Tahun Ajaran ' . date('Y') . '-' . $nextyear . '.pdf', 'I');
        }
    }

    public function cetakexcell()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $query = $this->db->query("SELECT calon_siswa.id_cs,calon_siswa.nama,calon_siswa.jenis_kelamin,calon_siswa.tgl_lahir,calon_siswa.asal_TK,calon_siswa.wali,wali.nama_ayah,wali.alamat_ayah,wali.pekerjaan_ayah,wali.pendterakhir_ayah,wali.keterangan_ayah,wali.nohape_ayah,wali.nama_ibu,wali.alamat_ibu,wali.pekerjaan_ibu,wali.pendterakhir_ibu,wali.keterangan_ibu,wali.nohape_ibu,wali.nama_wali,wali.alamat_wali,wali.status_wali,wali.pekerjaan_wali,wali.pendterakhir_wali,wali.nohape_wali,pendaftaran.tanggal,pendaftaran.jam FROM calon_siswa JOIN wali ON calon_siswa.id_wali = wali.id_wali JOIN pendaftaran ON calon_siswa.id_dftr = pendaftaran.id_dftr WHERE calon_siswa.tahun = '" . date('Y') . "'")->result_array();

            $sheet = new Spreadsheet();

            $arrayData = [
                ["No", "ID Pendaftar", "Nama Pendaftar", "Jns Kelamin", "Tgl Lahir", "Asal TK", "Wali", "Nama Ayah", "Alamat Ayah", "Pekerjaan Ayah", "Pend. Terakhir Ayah", "Ket. Ayah", "No. HP Ayah", "Nama Ibu", "Alamat Ibu", "Pekerjaan Ibu", "Pend. Terakhir Ibu", "Ket. Ibu", "No. HP Ibu", "Wali selain ayah & ibu", "Alamat Wali", "Status wali", "Pekerjaan Wali", "Pend. Terakhir Wali", "No Hp Wali", "Tanggal Pendaftaran", "Jam Pendaftaran"],
            ];
            $counter = 1;

            foreach ($query as $q) {
                $p["No"] = $counter;
                $r = array_merge($p, $q);
                $arrayData[] = $r;
                $counter++;
            }

            $sheet->getActiveSheet()
                ->fromArray(
                    $arrayData,  // The data to set
                    NULL,        // Array values with this value will not be set
                    'A1'         // Top left coordinate of the worksheet range where
                    //    we want to set these values (default is A1)
                )->getStyle("A1:AA1")->getFont()->setBold(true);

            $writer = new Xlsx($sheet);
            $writer->save('Data excel PPDB ' . date('Y') . '.xlsx');
            redirect('/Data excel PPDB ' . date('Y') . '.xlsx');
        }
    }

    public function registerduplication()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            netralize();
            $data['title'] = 'Pendaftaran';
            $data['description'] = 'Detail calon siswa of SDI Al-Khairiyah Banyuwangi';

            $all = $this->db->query("SELECT nama FROM calon_siswa WHERE tahun=" . date('Y'))->result_array();
            $seen = [];
            $duplicates = [];
            foreach ($all as $a) {
                $lower_a = strtolower($a["nama"]);
                $match = $this->db->query("SELECT nama FROM calon_siswa WHERE nama LIKE '" . $lower_a . "' AND tahun=" . date('Y'))->num_rows();
                if ($match > 1 && !in_array($lower_a, $seen)) {
                    $duplicates[] = $lower_a . " " . "(duplikat)";
                    $seen[] = $lower_a;
                } else {
                    foreach ($all as $b) {
                        $lower_b = strtolower($b["nama"]);
                        $lev = levenshtein($lower_a, $lower_b);
                        if ($lev < 5 && $lower_a !== $lower_b && !in_array($lower_a, $seen)) {
                            $duplicates[] = $lower_a . " - " . $lower_b . " " . "(mirip)";
                            $seen[] = $lower_a;
                            $seen[] = $lower_b;
                        }
                    }
                }
            }

            $data['duplikat'] = $duplicates;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/duplikasipendaftar');
            $this->load->view('admin/footer');
        }
    }

    //-------------------- Akhir Pendaftaran ------------------------------

    public function uploadmediatk()
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Upload Media TK';
            $data['csrf'] = $this->csrf;
            $data['kegiatan'] = $this->db->get('kegiatantk')->result_array();

            $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required', ['required' => 'Kegiatan wajib dipilih']);

            if ($this->form_validation->run() == FALSE) {
                // $this->session->set_flashdata('material', $this->input->post('material'));
                $this->load->view('admin/header', $data);
                $this->load->view('admin/uploadmediatk');
                $this->load->view('admin/footer');
            } else {
                $allowed_format = ["jpg", "jpeg", "mp4"];
                $counter = 0;
                foreach ($_FILES as $file) {
                    $tmp = explode('.', $file["name"]);
                    $format = strtolower(end($tmp));
                    if ($file["name"] && !in_array($format, $allowed_format)) {
                        $counter += 1;
                    }
                }
                if ($counter == 0) {
                    $content = [$_FILES, $this->input->post()];
                    $this->Admin->uploadmediatk($content);
                    // $this->session->unset_userdata('material');
                } else {
                    // $this->session->set_flashdata('material', $this->input->post('material'));
                    // $this->session->set_flashdata('questions', $this->input->post('questions'));
                    $this->session->set_flashdata('alert', 'Gagal');
                }
                $this->load->view('admin/header', $data);
                $this->load->view('admin/uploadmediatk');
                $this->load->view('admin/footer');
            }
        }
    }

    public function newattach()
    {
        $this->load->view('admin/newattach');
    }

    public function logout()
    {
        netralize();
        $this->session->unset_userdata('admin');
        redirect('admin');
    }
}
