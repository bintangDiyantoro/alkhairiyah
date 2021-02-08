<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAdmin', 'Admin');
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
                    $this->session->unset_userdata('error');
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_userdata('error', 'Akun belum diverifikasi, silahkan hubungi Ust. Arif Isnandi!');
                    redirect('admin');
                }
            } else {
                $this->session->set_userdata('error', 'Nama atau kata sandi salah!');
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
            redirect('admin/dashboard');
        } else {
            // redirect('admin/login');
            redirect('admin/login');
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
                $this->session->set_flashdata('success', 'Registrasi sukses! Silahkan hubungi Ust. Arif Isnandi untuk verifikasi');
                redirect('admin');
            }
        }
    }

    public function dashboard()
    {
        netralize();
        netralize3();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data['title'] = 'Dashboard';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/dashboard');
            $this->load->view('admin/footer');
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
            $data['materi'] = $this->db->query("SELECT materi.id, kelas.class, mapel.nama_mapel, materi.chapter, materi.material, materi.date FROM materi JOIN kelas ON kelas.id = materi.class_id JOIN mapel ON mapel.id = materi.subject ORDER BY materi.id DESC LIMIT 15")->result_array();

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
            $this->db->where('id',$id);
            $this->db->delete('materi');
            redirect('admin/materi');
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
