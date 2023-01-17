<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Stichoza\GoogleTranslate\GoogleTranslate;

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

    public function login()
    {
        netralize();

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
                    if ($query["id_staff"]) {
                        $this->session->set_userdata('id_staff', $query["id_staff"]);
                    }
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
                $this->session->set_flashdata('registrasisuccess', 'Silahkan hubungi Operator Yayasan untuk verifikasi dan aktivasi akun.');
                redirect('admin/login');
            }
        }
    }

    private function _fetchAPI($url)
    {
        $ch = curl_init($url);
        curl_setopt(
            $ch,
            CURLOPT_HTTPGET,
            true
        );
        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            true
        );
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    public function index()
    {
        netralize();
        if ($this->session->userdata('admin')) {
            $this->session->unset_userdata('error');
            $data['title'] = 'Dashboard';
            $this->db->where('id', $this->session->userdata("id_staff"));
            $data["staff"] = $this->db->get('staff')->row_array();
            $data["jokes"] = $this->_fetchAPI('https://candaan-api.vercel.app/api/text/random')["data"];
            $haditsLib = $this->_fetchAPI('https://hadis-api-id.vercel.app/hadith');
            $haditsIndex = $haditsLib[rand(0, 8)];
            $haditsBook = $haditsIndex["slug"];
            $haditsMaxIndex = $haditsIndex["total"];
            $data["hadits"] = $this->_fetchAPI('https://hadis-api-id.vercel.app/hadith/' . $haditsBook . '/' . rand(0, $haditsMaxIndex - 1));
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
            if ($this->session->userdata('role') == '9') {
                $data["title"] = 'Admins Management';
                $data["admin"] = $this->db->query('SELECT admin.id, admin.name, admin.password, admin.verified,admin.id_staff, role.role FROM admin JOIN role ON admin.role = role.role_id WHERE admin.role !=9')->result_array();
                $this->load->view('admin/header', $data);
                $this->load->view('admin/adminmanagementtop');
                $this->load->view('admin/adminmanagement');
                $this->load->view('admin/adminmanagementbtm');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function aktivasiadmin($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == '9') {
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
            } else {
                redirect('admin');
            }
        }
        redirect('admin/adminmanagement');
    }

    public function ubahadmin($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == '9') {
                $data['csrf'] = $this->csrf;
                $this->db->where('id', $id);
                $data['admin'] = $this->db->get('admin')->row_array();

                if ($data['admin']['id_staff']) {
                    $data['admin']['nama'] = $this->db->query("SELECT nama FROM staff WHERE id='" . $data['admin']['id_staff'] . "'")->row_array();
                }
                $data["admin"]["slctdrole"] =
                    $this->db->query("SELECT role_id, role FROM role WHERE role_id ='" . $data["admin"]["role"] . "'")->row_array();
                $data["admin"]["role"] = $this->db->query("SELECT role_id, role FROM role")->result_array();
                $data['title'] = 'Admins Management';
                $slctdStffAss = $this->db->query('SELECT id_staff from admin WHERE id_staff != "NULL"')->result_array();

                $slctdStff = [];

                foreach ($slctdStffAss as $s) {
                    $slctdStff[] = $s["id_staff"];
                }

                $allStffsAss = $this->db->query("SELECT id FROM staff")->result_array();

                $allStffs = [];
                foreach ($allStffsAss as $a) {
                    $allStffs[] = $a["id"];
                }

                $NotSelectedStaffId = [];
                foreach ($allStffs as $a) {
                    if (!in_array($a, $slctdStff)) {
                        $NotSelectedStaffId[] = $a;
                    }
                }

                $data["staff"] = [];
                foreach ($NotSelectedStaffId as $n) {
                    $data["staff"][] = $this->db->query('SELECT * FROM staff WHERE id ="' . $n . '"')->row_array();
                }

                if (isset($_POST["submit"])) {
                    // var_dump($this->input->post());die;
                    if ($this->input->post('id_staff') == "") {
                        $this->db->set('id_staff', NULL);
                        $this->db->set('role', $this->input->post('role'));
                    } else {
                        $this->db->set('id_staff', $this->input->post('id_staff'));
                        $this->db->set('role', $this->input->post('role'));
                    }

                    $this->db->where('id', $id);
                    $this->db->update('admin');

                    redirect('admin/adminmanagement');
                } else {
                    $this->load->view('admin/header', $data);
                    $this->load->view('admin/editadmin');
                    $this->load->view('admin/footer');
                }
            } else {
                redirect('admin');
            }
        }
    }

    public function hapusadmin($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == '9') {
                $data['title'] = 'Detail Materi';
                $this->db->where('id', $id);
                $this->db->delete('admin');
                redirect('admin/adminmanagement');
            } else {
                redirect('admin');
            }
        }
    }

    public function ajaxadminvrf()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == '9') {
                $data["admin"] = $this->db->query('SELECT admin.id, admin.name, admin.password, admin.verified,admin.id_staff, role.role FROM admin JOIN role ON admin.role = role.role_id WHERE admin.role !=9')->result_array();
                $this->load->view('admin/adminmanagement', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function staffsmanagement()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Staffs Management';
                $data["csrf"] = $this->csrf;
                $data["staffs"] = $this->db->get('staff')->result_array();

                if (isset($_POST['submit'])) {
                    if ($this->input->post("nama") && $this->input->post('NIY') && $this->input->post('jenis_kelamin')) {
                        $staff = [
                            'nama' => $this->input->post('nama'),
                            'NIY' => $this->input->post('NIY'),
                            'jenis_kelamin' => $this->input->post('jenis_kelamin')
                        ];
                        $this->db->insert('staff', $staff);
                        if ($this->db->affected_rows() > 0) {
                            redirect('admin/staffsmanagement');
                        }
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/staffsmanagement');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahstaff($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["staff"] = $this->db->get('staff')->row_array();
                $data["title"] = "Staffs Management";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE staff SET nama='" . $this->input->post('nama') . "',NIY='" . $this->input->post('NIY') . "',jenis_kelamin='" . $this->input->post('jenis_kelamin') . "',status=" . $this->input->post('status') . " WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/staffsmanagement');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editstaff');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function rolesmanagement()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Roles Management';
                $data["csrf"] = $this->csrf;
                $data["roles"] = $this->db->get('role')->result_array();

                if (isset($_POST['submit'])) {
                    if ($this->input->post("role")) {
                        $role = [
                            "role_id" => $this->input->post('role_id'),
                            "role" => $this->input->post('role'),
                        ];
                        $this->db->insert('role', $role);
                        if ($this->db->affected_rows() > 0) {
                            redirect('admin/rolesmanagement');
                        }
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/rolesmanagement');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahrole($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["role"] = $this->db->get('role')->row_array();
                $data["title"] = "Roles Management";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE role SET role_id='" . $this->input->post('role_id') .  "', role ='" . $this->input->post('role') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/rolesmanagement');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editrole');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function bukuinduk()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                $data["title"] = "Buku Induk Siswa";
                $data["csrf"] = $this->csrf;
                $this->db->where('id', $this->session->userdata("id_staff"));
                $data["staff"] = $this->db->get('staff')->row_array();

                //cek kelas tahun ajar
                if ($this->session->userdata('role') !== "9") {
                    $data["staff"]["kelastahunini"] = $this->db->query('SELECT wali_kelas.id_kelas, kelas.class, wali_kelas.id_staff, wali_kelas.tahun FROM wali_kelas JOIN kelas ON wali_kelas.id_kelas = kelas.id WHERE id_staff=' . $data["staff"]["id"] . " AND tahun='" . $this->tahunAjar . "'")->result_array();
                    $data["staff"]["semuakelas"] = $this->db->query('SELECT wali_kelas.id_kelas, kelas.class, wali_kelas.id_staff, wali_kelas.tahun FROM wali_kelas JOIN kelas ON wali_kelas.id_kelas = kelas.id WHERE id_staff=' . $data["staff"]["id"] . " ORDER BY tahun DESC")->result_array();
                } else {
                    $data["staff"]["kelas"] = "superuser";
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/bukuinduk');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function pilihkelas($idstaff, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                $data["csrf"] = $this->csrf;
                $data["title"] = "Buku Induk Siswa";
                $kelas = $this->db->get('kelas')->result_array();
                $Kelas2terpilih = $this->db->query('SELECT id_kelas FROM wali_kelas WHERE tahun="' . $tahun . "/" . $th . '"')->result_array();
                $idKlsBlmTrplh = [];
                foreach ($Kelas2terpilih as $kt) {
                    $idKlsBlmTrplh[] = $kt["id_kelas"];
                }

                if ($Kelas2terpilih) {
                    $kelasBelumTerpilih = [];
                    foreach ($kelas as $k) {
                        if (!in_array($k["id"], $idKlsBlmTrplh)) {
                            $kelasBelumTerpilih[] = $k;
                        }
                    }
                    $data["kelas"] = $kelasBelumTerpilih;
                } else {
                    $data["kelas"] = $kelas;
                }

                if (isset($_POST["pilihkelas"])) {
                    $insert = [
                        "tahun" => $tahun . "/" . $th,
                        "id_staff" => $idstaff,
                        "id_kelas" => $this->input->post('pilihkelas')
                    ];
                    $this->db->insert('wali_kelas', $insert);
                    $this->session->set_flashdata('suksestambahkelas', 'sukses');
                    redirect('admin/bukuinduk');
                }
                $data["tahun"] = $tahun . "/" . $th;

                $this->load->view('admin/pilihkelas', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function pilihkelas2($idstaff, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1" || $this->session->userdata("role") == "4") {
                $tahunajar = $tahun . '/' . $th;
                $data["csrf"] = $this->csrf;
                $data["tahun"] = $tahunajar;
                $kelas = $this->db->get('kelas')->result_array();
                $Kelas2terpilih = $this->db->query('SELECT id_kelas FROM wali_kelas WHERE tahun="' . $tahunajar . '"')->result_array();
                $idKlsBlmTrplh = [];
                foreach ($Kelas2terpilih as $kt) {
                    $idKlsBlmTrplh[] = $kt["id_kelas"];
                }

                if ($Kelas2terpilih) {
                    $kelasBelumTerpilih = [];
                    foreach ($kelas as $k) {
                        if (!in_array($k["id"], $idKlsBlmTrplh)) {
                            $kelasBelumTerpilih[] = $k;
                        }
                    }
                    $data["kelas"] = $kelasBelumTerpilih;
                } else {
                    $data["kelas"] = $kelas;
                }

                if (isset($_POST["pilihkelas"])) {
                    $insert = [
                        "tahun" => $tahunajar,
                        "id_staff" => $idstaff,
                        "id_kelas" => $this->input->post('pilihkelas')
                    ];
                    $this->db->insert('wali_kelas', $insert);
                    $this->session->set_flashdata('suksestambahkelas', 'sukses');
                    redirect('admin/bukuinduk');
                }
                $this->load->view('admin/pilihkelas2', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function daftarsiswa($idkelas, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1" | $this->session->userdata('role') == "4") {
                $tahunkelas = $tahun . "/" . $th;
                if ($this->session->userdata('role') == "4") {
                    $data["title"] = "Manajemen Kelas";
                } elseif ($this->session->userdata('role') == "1") {
                    $data["title"] = "Buku Induk Siswa";
                }
                $data["csrf"] = $this->csrf;
                $data["kelas"] = $this->db->query("select class from kelas where id=" . $idkelas)->row_array();
                $data["tahun"] = $tahunkelas;
                $data["semua_siswa"] = $this->db->query("SELECT kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.tahun, kelas_siswa.insert_by, kelas.class, siswa.id, siswa.nisn, siswa.nomor_induk, siswa.nama, siswa.jenis_kelamin, staff.nama AS nama_staff FROM kelas_siswa JOIN siswa ON kelas_siswa.id_siswa = siswa.id JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN staff ON kelas_siswa.insert_by = staff.id WHERE kelas_siswa.id_kelas='" . $idkelas . "' AND kelas_siswa.tahun ='" . $tahunkelas . "' ORDER BY siswa.nama")->result_array();
                $this->session->set_userdata(["id_kelas" => $idkelas, "tahun" => $tahunkelas]);
                $data["error"] = NULL;
                if (isset($_POST["submit"])) {
                    $tr = new GoogleTranslate();
                    $tr->setSource('en');
                    $tr->setTarget('id');
                    $config['upload_path'] = 'assets/sheets/';
                    $config['allowed_types'] = 'xls|xlsx';
                    $config['max_size']     = '1000'; //kb
                    $config["overwrite"] = true;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('fileexcel')) {
                        $data["error"] = $tr->translate(strip_tags($this->upload->display_errors()));
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $refName = './assets/sheets/' . $this->upload->data()["file_name"];
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        $spreadsheet = $reader->load($refName);
                        $worksheet = $spreadsheet->getActiveSheet();
                        $rowItterator = $worksheet->getRowIterator();

                        $dataCol = [];
                        $i = 1;
                        foreach ($rowItterator as $row) {
                            $cellIterator = $row->getCellIterator();
                            $cellIterator->setIterateOnlyExistingCells(FALSE);
                            $dataRow = [];
                            if ($i > 6) {
                                foreach ($cellIterator as $cell) {
                                    $dataRow[] = $cell->getValue();
                                }
                                $dataCol[] = $dataRow;
                            }
                            $i++;
                        }


                        foreach ($dataCol as $dc) {
                            // var_dump($dc);
                            $this->Admin->insertFetchedStudentData($dc);
                            $idsiswa = $this->db->query("SELECT id FROM siswa WHERE nomor_induk=" . $dc[2])->row_array()["id"];
                            $this->Admin->masukkankelasCore($idsiswa, $idkelas, $tahunkelas);
                            // var_dump($this->_sppStudentSearch($idsiswa, $tahun, $th)["reason"]);
                            // echo '<hr>';
                        }

                        redirect('admin/daftarsiswa/' . $idkelas . '/' . $tahun . '/' . $th);
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/siswakelas');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function startsearchingstudent()
    {
        netralize();
        if ($this->session->userdata('admin')) {
            $this->load->view('admin/startsearchingstudent');
        } else {
            redirect('admin/login');
        }
    }

    public function carisiswa()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "2" || $this->session->userdata('role') == "1" || $this->session->userdata('role') == "4") {
                $data["csrf"] = $this->csrf;
                if (isset($_GET["submit"])) {
                    $thnsebelumnya = (int)explode('/', $this->session->userdata('tahun'))[0] - 1;
                    $thnsblmny =  (int)explode('/', $this->session->userdata('tahun'))[1] - 1;
                    $tahunsebelumnya = (string)$thnsebelumnya . "/" . (string)$thnsblmny;
                    $duathnsebelumnya = (int)explode('/', $this->session->userdata('tahun'))[0] - 2;
                    $duathnsblmny =  (int)explode('/', $this->session->userdata('tahun'))[1] - 2;
                    $duatahunsebelumnya = (string)$duathnsebelumnya . "/" . (string)$duathnsblmny;
                    $tigathnsebelumnya = (int)explode('/', $this->session->userdata('tahun'))[0] - 3;
                    $tigathnsblmny =  (int)explode('/', $this->session->userdata('tahun'))[1] - 3;
                    $tigatahunsebelumnya = (string)$tigathnsebelumnya . "/" . (string)$tigathnsblmny;
                    $empatthnsebelumnya = (int)explode('/', $this->session->userdata('tahun'))[0] - 4;
                    $empatthnsblmny =  (int)explode('/', $this->session->userdata('tahun'))[1] - 4;
                    $empattahunsebelumnya = (string)$empatthnsebelumnya . "/" . (string)$empatthnsblmny;
                    $limathnsebelumnya = (int)explode('/', $this->session->userdata('tahun'))[0] - 5;
                    $limathnsblmny =  (int)explode('/', $this->session->userdata('tahun'))[1] - 5;
                    $limatahunsebelumnya = (string)$limathnsebelumnya . "/" . (string)$limathnsblmny;
                    $enamthnsebelumnya = (int)explode('/', $this->session->userdata('tahun'))[0] - 6;
                    $enamthnsblmny =  (int)explode('/', $this->session->userdata('tahun'))[1] - 6;
                    $enamtahunsebelumnya = (string)$enamthnsebelumnya . "/" . (string)$enamthnsblmny;
                    $thnsetelahnya = (int)explode('/', $this->session->userdata('tahun'))[0] + 1;
                    $thnstlhny =  (int)explode('/', $this->session->userdata('tahun'))[1] + 1;
                    $tahunsetelahnya = (string)$thnsetelahnya . "/" . (string)$thnstlhny;
                    $duathnsetelahnya = (int)explode('/', $this->session->userdata('tahun'))[0] + 2;
                    $duathnstlhny =  (int)explode('/', $this->session->userdata('tahun'))[1] + 2;
                    $duatahunsetelahnya = (string)$duathnsetelahnya . "/" . (string)$duathnstlhny;
                    $tigathnsetelahnya = (int)explode('/', $this->session->userdata('tahun'))[0] + 3;
                    $tigathnstlhny =  (int)explode('/', $this->session->userdata('tahun'))[1] + 3;
                    $tigatahunsetelahnya = (string)$tigathnsetelahnya . "/" . (string)$tigathnstlhny;
                    $empatthnsetelahnya = (int)explode('/', $this->session->userdata('tahun'))[0] + 4;
                    $empatthnstlhny =  (int)explode('/', $this->session->userdata('tahun'))[1] + 4;
                    $empattahunsetelahnya = (string)$empatthnsetelahnya . "/" . (string)$empatthnstlhny;
                    $limathnsetelahnya = (int)explode('/', $this->session->userdata('tahun'))[0] + 5;
                    $limathnstlhny =  (int)explode('/', $this->session->userdata('tahun'))[1] + 5;
                    $limatahunsetelahnya = (string)$limathnsetelahnya . "/" . (string)$limathnstlhny;
                    $enamthnsetelahnya = (int)explode('/', $this->session->userdata('tahun'))[0] + 6;
                    $enamthnstlhny =  (int)explode('/', $this->session->userdata('tahun'))[1] + 6;
                    $enamtahunsetelahnya = (string)$enamthnsetelahnya . "/" . (string)$enamthnstlhny;

                    $query = $this->db->query("SELECT * FROM siswa WHERE nama LIKE '%" . $this->input->get('keyword') . "%' OR nisn LIKE '%" . $this->input->get('keyword') . "%' OR nomor_induk LIKE '%" . $this->input->get('keyword') . "%'")->result_array();

                    if ($query) {
                        $classTemp = [];

                        foreach ($query as $q) {
                            $checkTahunsebelumnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $tahunsebelumnya . "'")->row_array();

                            $checkDuaTahunsebelumnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $duatahunsebelumnya . "'")->row_array();

                            $checkTigaTahunsebelumnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $tigatahunsebelumnya . "'")->row_array();

                            $checkEmpatTahunsebelumnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $empattahunsebelumnya . "'")->row_array();

                            $checkLimaTahunsebelumnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $limatahunsebelumnya . "'")->row_array();

                            $checkEnamTahunsebelumnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $enamtahunsebelumnya . "'")->row_array();

                            $checkTahunsetelahnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $tahunsetelahnya . "'")->row_array();

                            $checkDuaTahunsetelahnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $duatahunsetelahnya . "'")->row_array();

                            $checkTigaTahunsetelahnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $tigatahunsetelahnya . "'")->row_array();

                            $checkEmpatTahunsetelahnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $empattahunsetelahnya . "'")->row_array();

                            $checkLimaTahunsetelahnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $limatahunsetelahnya . "'")->row_array();

                            $checkEnamTahunsetelahnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " AND kelas_siswa.tahun='" . $enamtahunsetelahnya . "'")->row_array();

                            $checkTahunLainSetelahnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas_siswa.tahun , kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " ORDER BY kelas_siswa.tahun ASC")->row_array();

                            $checkTahunLainSebelumnya = $this->db->query("SELECT kelas_siswa.id_kelas, kelas_siswa.tahun , kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE kelas_siswa.id_siswa =" . $q["id"] . " ORDER BY kelas_siswa.tahun DESC")->row_array();

                            $classCheck = $this->db->query("SELECT class FROM kelas JOIN kelas_siswa ON kelas.id = kelas_siswa.id_kelas WHERE kelas_siswa.id_siswa = '" . $q["id"] . "' AND kelas_siswa.tahun='" . $this->session->userdata("tahun") . "'")->row_array();
                            if ($classCheck) {
                                $q["class"] = $classCheck["class"];
                            } else {
                                if ($checkTahunsebelumnya) {
                                    if ((int)$checkTahunsebelumnya["id_kelas"] >= 1 && (int)$checkTahunsebelumnya["id_kelas"] <= 4) {
                                        if ((int)$this->session->userdata("id_kelas") > 4 && (int)$this->session->userdata("id_kelas") <= 8) {
                                            $q["class"] = "-";
                                        } else {
                                            $q["class"] = $checkTahunsebelumnya["class"] . " - " . $tahunsebelumnya;
                                        }
                                    } elseif ((int)$checkTahunsebelumnya["id_kelas"] >= 5 && (int)$checkTahunsebelumnya["id_kelas"] <= 8) {
                                        if ((int)$this->session->userdata("id_kelas") > 8 && (int)$this->session->userdata("id_kelas") <= 12) {
                                            $q["class"] = "-";
                                        } else {
                                            $q["class"] = $checkTahunsebelumnya["class"] . " - " . $tahunsebelumnya;
                                        }
                                    } elseif ((int)$checkTahunsebelumnya["id_kelas"] >= 9 && (int)$checkTahunsebelumnya["id_kelas"] <= 12) {
                                        if ((int)$this->session->userdata("id_kelas") > 12 && (int)$this->session->userdata("id_kelas") <= 16) {
                                            $q["class"] = "-";
                                        } else {
                                            $q["class"] = $checkTahunsebelumnya["class"] . " - " . $tahunsebelumnya;
                                        }
                                    } elseif ((int)$checkTahunsebelumnya["id_kelas"] >= 13 && (int)$checkTahunsebelumnya["id_kelas"] <= 16) {
                                        if ((int)$this->session->userdata("id_kelas") > 16 && (int)$this->session->userdata("id_kelas") <= 20) {
                                            $q["class"] = "-";
                                        } else {
                                            $q["class"] = $checkTahunsebelumnya["class"] . " - " . $tahunsebelumnya;
                                        }
                                    } elseif ((int)$checkTahunsebelumnya["id_kelas"] >= 17 && (int)$checkTahunsebelumnya["id_kelas"] <= 20) {
                                        if ((int)$this->session->userdata("id_kelas") > 20 && (int)$this->session->userdata("id_kelas") <= 24) {
                                            $q["class"] = "-";
                                        } else {
                                            $q["class"] = $checkTahunsebelumnya["class"] . " - " . $tahunsebelumnya;
                                        }
                                    } elseif ((int)$checkTahunsebelumnya["id_kelas"] >= 21 && (int)$checkTahunsebelumnya["id_kelas"] <= 24) {
                                        $q["class"] = "lulus";
                                    }
                                } else {
                                    if ($checkDuaTahunsebelumnya) {
                                        if ((int)$checkDuaTahunsebelumnya["id_kelas"] >= 1 && (int)$checkDuaTahunsebelumnya["id_kelas"] <= 4) {
                                            if ((int)$this->session->userdata("id_kelas") > 8 && (int)$this->session->userdata("id_kelas") <= 12) {
                                                $q["class"] = "-";
                                            } else {
                                                $q["class"] = $checkDuaTahunsebelumnya["class"] . " - " . $duatahunsebelumnya;
                                            }
                                        } elseif ((int)$checkDuaTahunsebelumnya["id_kelas"] >= 5 && (int)$checkDuaTahunsebelumnya["id_kelas"] <= 8) {
                                            if ((int)$this->session->userdata("id_kelas") > 12 && (int)$this->session->userdata("id_kelas") <= 16) {
                                                $q["class"] = "-";
                                            } else {
                                                $q["class"] = $checkDuaTahunsebelumnya["class"] . " - " . $duatahunsebelumnya;
                                            }
                                        } elseif ((int)$checkDuaTahunsebelumnya["id_kelas"] >= 9 && (int)$checkDuaTahunsebelumnya["id_kelas"] <= 12) {
                                            if ((int)$this->session->userdata("id_kelas") > 16 && (int)$this->session->userdata("id_kelas") <= 20) {
                                                $q["class"] = "-";
                                            } else {
                                                $q["class"] = $checkDuaTahunsebelumnya["class"] . " - " . $duatahunsebelumnya;
                                            }
                                        } elseif ((int)$checkDuaTahunsebelumnya["id_kelas"] >= 13 && (int)$checkDuaTahunsebelumnya["id_kelas"] <= 16) {
                                            if ((int)$this->session->userdata("id_kelas") > 21 && (int)$this->session->userdata("id_kelas") <= 24) {
                                                $q["class"] = "-";
                                            } else {
                                                $q["class"] = $checkDuaTahunsebelumnya["class"] . " - " . $duatahunsebelumnya;
                                            }
                                        } elseif ((int)$checkDuaTahunsebelumnya["id_kelas"] >= 17 && (int)$checkDuaTahunsebelumnya["id_kelas"] <= 24) {
                                            $q["class"] = "lulus";
                                        }
                                    } else {
                                        if ($checkTigaTahunsebelumnya) {
                                            if (
                                                (int)$checkTigaTahunsebelumnya["id_kelas"] >= 1
                                                && (int)$checkTigaTahunsebelumnya["id_kelas"] <= 4
                                            ) {
                                                if (
                                                    (int)$this->session->userdata("id_kelas") > 12
                                                    && (int)$this->session->userdata("id_kelas") <= 16
                                                ) {
                                                    $q["class"] = "-";
                                                } else {
                                                    $q["class"] = $checkTigaTahunsebelumnya["class"] . " - " . $tigatahunsebelumnya;
                                                }
                                            } elseif (
                                                (int)$checkTigaTahunsebelumnya["id_kelas"] >= 5
                                                && (int)$checkTigaTahunsebelumnya["id_kelas"] <= 8
                                            ) {
                                                if (
                                                    (int)$this->session->userdata("id_kelas") > 16
                                                    && (int)$this->session->userdata("id_kelas") <= 20
                                                ) {
                                                    $q["class"] = "-";
                                                } else {
                                                    $q["class"] = $checkTigaTahunsebelumnya["class"] . " - " . $tigatahunsebelumnya;
                                                }
                                            } elseif (
                                                (int)$checkTigaTahunsebelumnya["id_kelas"] >= 9
                                                && (int)$checkTigaTahunsebelumnya["id_kelas"] <= 12
                                            ) {
                                                if (
                                                    (int)$this->session->userdata("id_kelas") > 20
                                                    && (int)$this->session->userdata("id_kelas") <= 24
                                                ) {
                                                    $q["class"] = "-";
                                                } else {
                                                    $q["class"] = $checkTigaTahunsebelumnya["class"] . " - " . $tigatahunsebelumnya;
                                                }
                                            } elseif (
                                                (int)$checkTigaTahunsebelumnya["id_kelas"] >= 13
                                                && (int)$checkTigaTahunsebelumnya["id_kelas"] <= 24
                                            ) {
                                                $q["class"] = "lulus";
                                            }
                                        } else {
                                            if ($checkEmpatTahunsebelumnya) {
                                                if (
                                                    (int)$checkEmpatTahunsebelumnya["id_kelas"] >= 1
                                                    && (int)$checkEmpatTahunsebelumnya["id_kelas"] <= 4
                                                ) {
                                                    if (
                                                        (int)$this->session->userdata("id_kelas") > 16
                                                        && (int)$this->session->userdata("id_kelas") <= 20
                                                    ) {
                                                        $q["class"] = "-";
                                                    } else {
                                                        $q["class"] = $checkEmpatTahunsebelumnya["class"] . " - " . $empattahunsebelumnya;
                                                    }
                                                } elseif (
                                                    (int)$checkEmpatTahunsebelumnya["id_kelas"] >= 5
                                                    && (int)$checkEmpatTahunsebelumnya["id_kelas"] <= 8
                                                ) {
                                                    if (
                                                        (int)$this->session->userdata("id_kelas") > 20
                                                        && (int)$this->session->userdata("id_kelas") <= 24
                                                    ) {
                                                        $q["class"] = "-";
                                                    } else {
                                                        $q["class"] = $checkEmpatTahunsebelumnya["class"] . " - " . $empattahunsebelumnya;
                                                    }
                                                } elseif (
                                                    (int)$checkEmpatTahunsebelumnya["id_kelas"] >= 9
                                                    && (int)$checkEmpatTahunsebelumnya["id_kelas"] <= 24
                                                ) {
                                                    $q["class"] = "lulus";
                                                }
                                            } else {
                                                if ($checkLimaTahunsebelumnya) {
                                                    if (
                                                        (int)$checkLimaTahunsebelumnya["id_kelas"] >= 1
                                                        && (int)$checkLimaTahunsebelumnya["id_kelas"] <= 4
                                                    ) {
                                                        if (
                                                            (int)$this->session->userdata("id_kelas") > 20
                                                            && (int)$this->session->userdata("id_kelas") <= 24
                                                        ) {
                                                            $q["class"] = "-";
                                                        } else {
                                                            $q["class"] = $checkLimaTahunsebelumnya["class"] . " - " . $limatahunsebelumnya;
                                                        }
                                                    } elseif (
                                                        (int)$checkLimaTahunsebelumnya["id_kelas"] >= 5
                                                        && (int)$checkLimaTahunsebelumnya["id_kelas"] <= 24
                                                    ) {
                                                        $q["class"] = "lulus";
                                                    }
                                                } else {
                                                    if ($checkEnamTahunsebelumnya) {
                                                        if (
                                                            (int)$checkEnamTahunsebelumnya["id_kelas"] >= 1
                                                            && (int)$checkEnamTahunsebelumnya["id_kelas"] <= 24
                                                        ) {
                                                            $q["class"] = "lulus";
                                                        }
                                                    } else {
                                                        if ($checkTahunsetelahnya) {
                                                            if ((int)$checkTahunsetelahnya["id_kelas"] >= 21 && (int)$checkTahunsetelahnya["id_kelas"] <= 24) {
                                                                if ((int)$this->session->userdata("id_kelas") > 16 && (int)$this->session->userdata("id_kelas") <= 20) {
                                                                    $q["class"] = "-";
                                                                } else {
                                                                    $q["class"] = $checkTahunsetelahnya["class"] . " - " . $tahunsetelahnya;
                                                                }
                                                            } elseif ((int)$checkTahunsetelahnya["id_kelas"] >= 17 && (int)$checkTahunsetelahnya["id_kelas"] <= 20) {
                                                                if ((int)$this->session->userdata("id_kelas") > 12 && (int)$this->session->userdata("id_kelas") <= 16) {
                                                                    $q["class"] = "-";
                                                                } else {
                                                                    $q["class"] = $checkTahunsetelahnya["class"] . " - " . $tahunsetelahnya;
                                                                }
                                                            } elseif ((int)$checkTahunsetelahnya["id_kelas"] >= 13 && (int)$checkTahunsetelahnya["id_kelas"] <= 16) {
                                                                if ((int)$this->session->userdata("id_kelas") > 8 && (int)$this->session->userdata("id_kelas") <= 12) {
                                                                    $q["class"] = "-";
                                                                } else {
                                                                    $q["class"] = $checkTahunsetelahnya["class"] . " - " . $tahunsetelahnya;
                                                                }
                                                            } elseif ((int)$checkTahunsetelahnya["id_kelas"] >= 9 && (int)$checkTahunsetelahnya["id_kelas"] <= 12) {
                                                                if ((int)$this->session->userdata("id_kelas") > 4 && (int)$this->session->userdata("id_kelas") <= 8) {
                                                                    $q["class"] = "-";
                                                                } else {
                                                                    $q["class"] = $checkTahunsetelahnya["class"] . " - " . $tahunsetelahnya;
                                                                }
                                                            } elseif ((int)$checkTahunsetelahnya["id_kelas"] >= 5 && (int)$checkTahunsetelahnya["id_kelas"] <= 8) {
                                                                if ((int)$this->session->userdata("id_kelas") > 0 && (int)$this->session->userdata("id_kelas") <= 4) {
                                                                    $q["class"] = "-";
                                                                } else {
                                                                    $q["class"] = $checkTahunsetelahnya["class"] . " - " . $tahunsetelahnya;
                                                                }
                                                            } elseif ((int)$checkTahunsetelahnya["id_kelas"] >= 1 && (int)$checkTahunsetelahnya["id_kelas"] <= 4) {
                                                                $q["class"] = "belum daftar";
                                                            }
                                                        } else {
                                                            if ($checkDuaTahunsetelahnya) {
                                                                if ((int)$checkDuaTahunsetelahnya["id_kelas"] >= 21 && (int)$checkDuaTahunsetelahnya["id_kelas"] <= 24) {
                                                                    if ((int)$this->session->userdata("id_kelas") > 12 && (int)$this->session->userdata("id_kelas") <= 16) {
                                                                        $q["class"] = "-";
                                                                    } else {
                                                                        $q["class"] = $checkDuaTahunsetelahnya["class"] . " - " . $duatahunsetelahnya;
                                                                    }
                                                                } elseif ((int)$checkDuaTahunsetelahnya["id_kelas"] >= 17 && (int)$checkDuaTahunsetelahnya["id_kelas"] <= 20) {
                                                                    if ((int)$this->session->userdata("id_kelas") > 8 && (int)$this->session->userdata("id_kelas") <= 12) {
                                                                        $q["class"] = "-";
                                                                    } else {
                                                                        $q["class"] = $checkDuaTahunsetelahnya["class"] . " - " . $duatahunsetelahnya;
                                                                    }
                                                                } elseif ((int)$checkDuaTahunsetelahnya["id_kelas"] >= 13 && (int)$checkDuaTahunsetelahnya["id_kelas"] <= 16) {
                                                                    if ((int)$this->session->userdata("id_kelas") > 4 && (int)$this->session->userdata("id_kelas") <= 8) {
                                                                        $q["class"] = "-";
                                                                    } else {
                                                                        $q["class"] = $checkDuaTahunsetelahnya["class"] . " - " . $duatahunsetelahnya;
                                                                    }
                                                                } elseif ((int)$checkDuaTahunsetelahnya["id_kelas"] >= 9 && (int)$checkDuaTahunsetelahnya["id_kelas"] <= 12) {
                                                                    if ((int)$this->session->userdata("id_kelas") > 0 && (int)$this->session->userdata("id_kelas") <= 4) {
                                                                        $q["class"] = "-";
                                                                    } else {
                                                                        $q["class"] = $checkDuaTahunsetelahnya["class"] . " - " . $duatahunsetelahnya;
                                                                    }
                                                                } elseif ((int)$checkDuaTahunsetelahnya["id_kelas"] >= 1 && (int)$checkDuaTahunsetelahnya["id_kelas"] <= 8) {
                                                                    $q["class"] = "belum daftar";
                                                                }
                                                            } else {
                                                                if ($checkTigaTahunsetelahnya) {
                                                                    if ((int)$checkTigaTahunsetelahnya["id_kelas"] >= 21 && (int)$checkTigaTahunsetelahnya["id_kelas"] <= 24) {
                                                                        if ((int)$this->session->userdata("id_kelas") > 8 && (int)$this->session->userdata("id_kelas") <= 12) {
                                                                            $q["class"] = "-";
                                                                        } else {
                                                                            $q["class"] = $checkTigaTahunsetelahnya["class"] . " - " . $tigatahunsetelahnya;
                                                                        }
                                                                    } elseif ((int)$checkTigaTahunsetelahnya["id_kelas"] >= 17 && (int)$checkTigaTahunsetelahnya["id_kelas"] <= 20) {
                                                                        if ((int)$this->session->userdata("id_kelas") > 4 && (int)$this->session->userdata("id_kelas") <= 8) {
                                                                            $q["class"] = "-";
                                                                        } else {
                                                                            $q["class"] = $checkTigaTahunsetelahnya["class"] . " - " . $tigatahunsetelahnya;
                                                                        }
                                                                    } elseif ((int)$checkTigaTahunsetelahnya["id_kelas"] >= 13 && (int)$checkTigaTahunsetelahnya["id_kelas"] <= 16) {
                                                                        if ((int)$this->session->userdata("id_kelas") > 0 && (int)$this->session->userdata("id_kelas") <= 4) {
                                                                            $q["class"] = "-";
                                                                        } else {
                                                                            $q["class"] = $checkTigaTahunsetelahnya["class"] . " - " . $tigatahunsetelahnya;
                                                                        }
                                                                    } elseif ((int)$checkTigaTahunsetelahnya["id_kelas"] >= 1 && (int)$checkTigaTahunsetelahnya["id_kelas"] <= 12) {
                                                                        $q["class"] = "belum daftar";
                                                                    }
                                                                } else {
                                                                    if ($checkEmpatTahunsetelahnya) {
                                                                        if ((int)$checkEmpatTahunsetelahnya["id_kelas"] >= 21 && (int)$checkEmpatTahunsetelahnya["id_kelas"] <= 24) {
                                                                            if ((int)$this->session->userdata("id_kelas") > 4 && (int)$this->session->userdata("id_kelas") <= 8) {
                                                                                $q["class"] = "-";
                                                                            } else {
                                                                                $q["class"] = $checkEmpatTahunsetelahnya["class"] . " - " . $empattahunsetelahnya;
                                                                            }
                                                                        } elseif ((int)$checkEmpatTahunsetelahnya["id_kelas"] >= 17 && (int)$checkEmpatTahunsetelahnya["id_kelas"] <= 20) {
                                                                            if ((int)$this->session->userdata("id_kelas") > 0 && (int)$this->session->userdata("id_kelas") <= 4) {
                                                                                $q["class"] = "-";
                                                                            } else {
                                                                                $q["class"] = $checkEmpatTahunsetelahnya["class"] . " - " . $empattahunsetelahnya;
                                                                            }
                                                                        } elseif ((int)$checkEmpatTahunsetelahnya["id_kelas"] >= 1 && (int)$checkEmpatTahunsetelahnya["id_kelas"] <= 16) {
                                                                            $q["class"] = "belum daftar";
                                                                        }
                                                                    } else {
                                                                        if ($checkLimaTahunsetelahnya) {
                                                                            if ((int)$checkLimaTahunsetelahnya["id_kelas"] >= 21 && (int)$checkLimaTahunsetelahnya["id_kelas"] <= 24) {
                                                                                if ((int)$this->session->userdata("id_kelas") > 0 && (int)$this->session->userdata("id_kelas") <= 4) {
                                                                                    $q["class"] = "-";
                                                                                } else {
                                                                                    $q["class"] = $checkLimaTahunsetelahnya["class"] . " - " . $limatahunsetelahnya;
                                                                                }
                                                                            } elseif ((int)$checkLimaTahunsetelahnya["id_kelas"] >= 1 && (int)$checkLimaTahunsetelahnya["id_kelas"] <= 20) {
                                                                                $q["class"] = "belum daftar";
                                                                            }
                                                                        } else {
                                                                            if ($checkEnamTahunsetelahnya) {
                                                                                if ((int)$checkEnamTahunsetelahnya["id_kelas"] >= 1 && (int)$checkEnamTahunsetelahnya["id_kelas"] <= 24) {
                                                                                    $q["class"] = "belum daftar";
                                                                                }
                                                                            } else {
                                                                                if ($checkTahunLainSetelahnya) {
                                                                                    $tahunLainSetelahnya = explode('/', $checkTahunLainSetelahnya["tahun"])[0];
                                                                                    if ((int)$tahunLainSetelahnya > (int)explode('/', $this->session->userdata('tahun'))[0] + 6) {
                                                                                        $q["class"] = "belum daftar";
                                                                                    }
                                                                                } else {
                                                                                    $q["class"] = "-";
                                                                                }
                                                                                if ($checkTahunLainSebelumnya) {
                                                                                    $tahunLainSebelumnya = explode('/', $checkTahunLainSebelumnya["tahun"])[0];
                                                                                    if ((int)$tahunLainSebelumnya < (int)explode('/', $this->session->userdata('tahun'))[0] - 6) {
                                                                                        $q["class"] = "lulus";
                                                                                    }
                                                                                } else {
                                                                                    $q["class"] = "-";
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            $classTemp[] = $q;
                        }
                        $data["query"] = $classTemp;
                    } else {
                        $data["query"] = $query;
                    }
                    $this->load->view('admin/hasilpencariansiswa', $data);
                } else {
                    $this->load->view('admin/ajaxcarisiswa', $data);
                }
            } else {
                redirect('admin');
            }
        }
    }

    private function _validasiTambahSiswa()
    {
        $this->form_validation->set_rules(
            'nomor_induk',
            'Nomor Induk',
            'required|regex_match[/^[0-9]+$/i]|exact_length[4]',
            [
                'required' => 'Nomor induk wajib diisi',
                'regex_match' => 'Nomor induk harus berupa angka',
                'exact_length' => 'Nomor induk harus 4 angka'
            ]
        );
        $this->form_validation->set_rules(
            'nisn',
            'NISN',
            'required|numeric|exact_length[10]',
            [
                'required' => 'NISN wajib diisi',
                'numeric' => 'NISN harus berupa angka',
                'exact_length' => 'NISN harus 10 angka'
            ]
        );
        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required|regex_match[/^[a-z-.\s\']+$/i]|max_length[50]',
            [
                'required' => 'Nama wajib diisi',
                'regex_match' => 'Nama harus berupa huruf, petik, titik atau strip',
                'max_length' => 'Nama maksimal 50 karakter'
            ]
        );
        $this->form_validation->set_rules(
            'ttl',
            'Tempat/tanggal lahir',
            'required|regex_match[/^([a-z.\s-]+,\s[0-3][0-9]-[0-1][0-9]-[1-2][0-9][0-9][0-9])*$/i]|max_length[62]',
            [
                'required' => 'Tempat/tanggal lahir wajib diisi',
                'regex_match' => 'Tempat & tanggal lahir tidak valid',
                'max_length' => 'Tempat & tanggal lahir maksimal 62 karakter'
            ]
        );
        $this->form_validation->set_rules(
            'jenis_kelamin',
            'Jenis Kelamin',
            'required|regex_match[/^[(L|P)]$/]',
            [
                'required' => 'Jenis Kelamin wajib diisi',
                'regex_match' => 'Jenis Kelamin tidak valid'
            ]
        );

        $this->form_validation->set_rules(
            'agama',
            'Agama',
            'required',
            [
                'required' => 'Agama wajib diisi'
            ]
        );

        $this->form_validation->set_rules(
            'pendidikan_sebelumnya',
            'Pendidikan Sebelumnya',
            'regex_match[/^[a-z0-9-\s,\']+$/i]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|regex_match[/^[a-z0-9-\s,.\/:]+$/i]',
            [
                'required' => 'Alamat wajib diisi',
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'nama_ayah',
            'Nama Ayah',
            'required|regex_match[/^[a-z-.,\s\']+$/i]|max_length[50]',
            [
                'required' => 'Nama Ayah wajib diisi',
                'regex_match' => 'Nama Ayah harus berupa huruf, petik, titik, koma atau strip',
                'max_length' => 'Nama Ayah maksimal 50 karakter'
            ]
        );
        $this->form_validation->set_rules(
            'pekerjaan_ayah',
            'Pekerjaan Ayah',
            'regex_match[/^[a-z\s]+$/i]|max_length[20]',
            [
                'regex_match' => 'Pekerjaan Ayah harus berupa huruf atau spasi',
                'max_length' => 'Pekerjaan Ayah maksimal 20 karakter'
            ]
        );
        $this->form_validation->set_rules(
            'nama_ibu',
            'Nama Ibu',
            'required|regex_match[/^[a-z-.,\s\']+$/i]|max_length[50]',
            [
                'required' => 'Nama Ibu wajib diisi',
                'regex_match' => 'Nama Ibu harus berupa huruf, petik, titik, koma atau strip',
                'max_length' => 'Nama Ibu maksimal 50 karakter'
            ]
        );
        $this->form_validation->set_rules(
            'pekerjaan_ibu',
            'Pekerjaan Ibu',
            'regex_match[/^[a-z\s]+$/i]|max_length[20]',
            [
                'regex_match' => 'Pekerjaan Ibu harus berupa huruf atau spasi',
                'max_length' => 'Pekerjaan Ibu maksimal 20 karakter'
            ]
        );
        $this->form_validation->set_rules(
            'provinsi_ortu',
            'Provinsi Ortu',
            'regex_match[/^[a-z\s]+$/i]|max_length[50]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'kabupaten_ortu',
            'Kabupaten Ortu',
            'regex_match[/^[a-z\s]+$/i]|max_length[50]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'kecamatan_ortu',
            'Kecamatan Ortu',
            'regex_match[/^[a-z\s]+$/i]|max_length[50]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'kelurahan_ortu',
            'Kelurahan Ortu',
            'regex_match[/^[a-z\s]+$/i]|max_length[50]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'alamat_ortu',
            'Alamat Ortu',
            'regex_match[/^[a-z0-9-\s,.\/:]+$/i]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'nama_wali',
            'Nama Wali',
            'regex_match[/^[a-z-.,\s\']+$/i]|max_length[50]',
            [
                'regex_match' => 'Nama Wali harus berupa huruf, petik, titik, koma atau strip',
                'max_length' => 'Nama Wali maksimal 50 karakter'
            ]
        );
        $this->form_validation->set_rules(
            'pekerjaan_wali',
            'Pekerjaan Wali',
            'regex_match[/^[a-z\s]+$/i]|max_length[20]',
            [
                'regex_match' => 'Pekerjaan Wali harus berupa huruf atau spasi',
                'max_length' => 'Pekerjaan Wali maksimal 20 karakter'
            ]
        );
        $this->form_validation->set_rules(
            'provinsi_wali',
            'Provinsi Wali',
            'regex_match[/^[a-z\s]+$/i]|max_length[50]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'kabupaten_wali',
            'Kabupaten Wali',
            'regex_match[/^[a-z\s]+$/i]|max_length[50]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'kecamatan_wali',
            'Kecamatan Wali',
            'regex_match[/^[a-z\s]+$/i]|max_length[50]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'kelurahan_wali',
            'Kelurahan Wali',
            'regex_match[/^[a-z\s]+$/i]|max_length[50]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'alamat_wali',
            'Alamat Wali',
            'regex_match[/^[a-z0-9-\s,.\/:]+$/i]',
            [
                'regex_match' => 'karakter tidak valid'
            ]
        );
        $this->form_validation->set_rules(
            'no_hp_ortu',
            'No HP Ortu',
            'regex_match[/^[0-9+]+$/]',
            [
                'regex_match' => 'No. HP tidak valid'
            ]
        );
    }

    private function _regexAgama()
    {
        $string = "/^" . "(Islam|Protestan|Katholik|Hindu|Buddha|Konghucu" . ")$/";
        if (preg_match($string, $this->input->post('agama'))) {
            return 1;
        } else {
            return 0;
        }
    }

    private function _cekNoInduk()
    {
        $query = $this->db->query("select * from siswa where nomor_induk = '" . $this->input->post('nomor_induk') . "'")->result_array();
        if ($query) {
            return 0;
        } else {
            return 1;
        }
    }

    private function _cekNISN()
    {
        $query = $this->db->query("select * from siswa where nisn = '" . $this->input->post('nisn') . "'")->result_array();
        if ($query) {
            return 0;
        } else {
            return 1;
        }
    }

    public function tambahsiswa()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if (
                $this->session->userdata('role') == "9" || $this->session->userdata('role') == "2" || $this->session->userdata('role') == "1" || $this->session->userdata('role') == "4"
            ) {
                if (isset($_POST["submit"])) {
                    $this->_validasiTambahSiswa();
                    $this->_regexAgama();
                    if ($this->form_validation->run() == FALSE || $this->_regexAgama() == 0 || $this->_cekNoInduk() == 0 || $this->_cekNISN() == 0) {
                        $data = [
                            "csrf" => $this->csrf["hash"],
                            "nama_error" => form_error('nama', '<small class="text-danger">', '</small>'),
                            "ttl_error" => form_error('ttl', '<small class="text-danger">', '</small>'),
                            "jenis_kelamin_error" => form_error('jenis_kelamin', '<small class="text-danger">', '</small>'),
                            "pendidikan_sebelumnya_error" => form_error('pendidikan_sebelumnya', '<small class="text-danger">', '</small>'),
                            "alamat_error" => form_error('alamat', '<small class="text-danger">', '</small>'),
                            "nama_ayah_error" => form_error('nama_ayah', '<small class="text-danger">', '</small>'),
                            "pekerjaan_ayah_error" => form_error('pekerjaan_ayah', '<small class="text-danger">', '</small>'),
                            "nama_ibu_error" => form_error('nama_ibu', '<small class="text-danger">', '</small>'),
                            "pekerjaan_ibu_error" => form_error('pekerjaan_ibu', '<small class="text-danger">', '</small>'),
                            "provinsi_ortu_error" => form_error('provinsi_ortu', '<small class="text-danger">', '</small>'),
                            "kabupaten_ortu_error" => form_error('kabupaten_ortu', '<small class="text-danger">', '</small>'),
                            "kecamatan_ortu_error" => form_error('kecamatan_ortu', '<small class="text-danger">', '</small>'),
                            "kelurahan_ortu_error" => form_error('kelurahan_ortu', '<small class="text-danger">', '</small>'),
                            "alamat_ortu_error" => form_error('alamat_ortu', '<small class="text-danger">', '</small>'),
                            "nama_wali_error" => form_error('nama_wali', '<small class="text-danger">', '</small>'),
                            "pekerjaan_wali_error" => form_error('pekerjaan_wali', '<small class="text-danger">', '</small>'),
                            "provinsi_wali_error" => form_error('provinsi_wali', '<small class="text-danger">', '</small>'),
                            "kabupaten_wali_error" => form_error('kabupaten_wali', '<small class="text-danger">', '</small>'),
                            "kecamatan_wali_error" => form_error('kecamatan_wali', '<small class="text-danger">', '</small>'),
                            "kelurahan_wali_error" => form_error('kelurahan_wali', '<small class="text-danger">', '</small>'),
                            "alamat_wali_error" => form_error('alamat_wali', '<small class="text-danger">', '</small>'),
                            "no_hp_ortu_error" => form_error('no_hp_ortu', '<small class="text-danger">', '</small>'),
                            "status" => "invalid"
                        ];

                        if ($this->_regexAgama() == 0) {
                            $this->session->set_flashdata('agama', '<small class="text-danger">agama tidak valid</small>');
                            $data["agama_error"] = $this->session->flashdata('agama');
                        } else {
                            $data["agama_error"] = form_error('agama', '<small class="text-danger">', '</small>');
                        }

                        if ($this->_cekNoInduk() == 0) {
                            $this->session->set_flashdata('nomor_induk', '<small class="text-danger">Nomor induk sudah terdaftar</small>');
                            $data["nomor_induk_error"] = $this->session->flashdata('nomor_induk');
                        } else {
                            $data["nomor_induk_error"] = form_error('nomor_induk', '<small class="text-danger">', '</small>');
                        }

                        if ($this->_cekNISN() == 0) {
                            $this->session->set_flashdata('nisn', '<small class="text-danger">NISN sudah terdaftar</small>');
                            $data["nisn_error"] = $this->session->flashdata('nisn');
                        } else {
                            $data["nisn_error"] = form_error('nisn', '<small class="text-danger">', '</small>');
                        }
                    } else {
                        $data["status"] = "valid";
                        $data["csrf"] = $this->csrf['hash'];
                        $data["keyword"] = $this->input->post('nama');
                        $this->Admin->tambahSiswa($this->input->post());
                    }
                    echo json_encode($data);
                }
                $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function masukkankelas()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1" || $this->session->userdata('role') == "4") {
                if (isset($_POST["submit"])) {
                    $idsiswa = $this->input->post('id_siswa');
                    $idkelas = $this->input->post('id_kelas');
                    $tahun = $this->input->post('tahun');
                    echo json_encode($this->Admin->masukkanKelas($idsiswa, $idkelas, $tahun));
                }
                $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function keluarkansiswa($idsiswa, $idkelas, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1" | $this->session->userdata("role") == "4") {
                $this->Admin->keluarkansiswa($idsiswa, $idkelas, $tahun, $th);
            } else {
                redirect('admin');
            }
        }
    }

    public function dftnilaisikap()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku Induk Siswa';
                $data["csrf"] = $this->csrf;
                $data["sikap"] = $this->db->get('sikap')->result_array();

                if (isset($_POST['submit'])) {
                    $sikap["sikap"] =  $this->input->post('sikap');
                    $this->db->insert('sikap', $sikap);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftnilaisikap');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/dftnilaisikap');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahsikap($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["sikap"] = $this->db->get('sikap')->row_array();
                $data["title"] = "Buku Induk Siswa";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE sikap SET sikap='" . $this->input->post('sikap') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftnilaisikap');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editsikap');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function dftmuatanpelajaran()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku Induk Siswa';
                $data["csrf"] = $this->csrf;
                $data["muatanpelajaran"] = $this->db->get('mapel_induk')->result_array();

                if (isset($_POST['submit'])) {
                    $muatanpelajaran["muatan_pelajaran"] =  $this->input->post('muatan_pelajaran');
                    $this->db->insert('mapel_induk', $muatanpelajaran);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftmuatanpelajaran');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/dftmuatanpelajaran');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahmuatanpelajaran($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["muatanpelajaran"] = $this->db->get('mapel_induk')->row_array();
                $data["title"] = "Buku Induk Siswa";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE mapel_induk SET muatan_pelajaran='" . $this->input->post('muatan_pelajaran') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftmuatanpelajaran');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editmuatanpelajaran');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function dftekstrakurikuler()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku Induk Siswa';
                $data["csrf"] = $this->csrf;
                $data["ekstrakurikuler"] = $this->db->get('ekskul')->result_array();

                if (isset($_POST['submit'])) {
                    $ekstrakurikuler["ekskul"] =  $this->input->post('ekskul');
                    $this->db->insert('ekskul', $ekstrakurikuler);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftekstrakurikuler');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/dftekstrakurikuler');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahekstrakurikuler($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["ekstrakurikuler"] = $this->db->get('ekskul')->row_array();
                $data["title"] = "Buku Induk Siswa";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE ekskul SET ekskul='" . $this->input->post('ekskul') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftekstrakurikuler');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editekstrakurikuler');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function dftketidakhadiran()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku Induk Siswa';
                $data["csrf"] = $this->csrf;
                $data["ketidakhadiran"] = $this->db->get('ketidakhadiran')->result_array();

                if (isset($_POST['submit'])) {
                    $ketidakhadiran["ketidakhadiran"] =  $this->input->post('ketidakhadiran');
                    $this->db->insert('ketidakhadiran', $ketidakhadiran);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftketidakhadiran');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/dftketidakhadiran');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahketidakhadiran($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["ketidakhadiran"] = $this->db->get('ketidakhadiran')->row_array();
                $data["title"] = "Buku Induk Siswa";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE ketidakhadiran SET ketidakhadiran='" . $this->input->post('ketidakhadiran') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftketidakhadiran');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editketidakhadiran');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function dftketnaiklulus()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku Induk Siswa';
                $data["csrf"] = $this->csrf;
                $data["ketnaiklulus"] = $this->db->get('naik_lulus')->result_array();

                if (isset($_POST['submit'])) {
                    $ketnaiklulus["keterangan"] =  $this->input->post('keterangan');
                    $this->db->insert('naik_lulus', $ketnaiklulus);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftketnaiklulus');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/dftketnaiklulus');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahketnaiklulus($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["ketnaiklulus"] = $this->db->get('naik_lulus')->row_array();
                $data["title"] = "Buku Induk Siswa";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE naik_lulus SET keterangan='" . $this->input->post('keterangan') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftketnaiklulus');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editketnaiklulus');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function dftsemester()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku Induk Siswa';
                $data["csrf"] = $this->csrf;
                $data["semester"] = $this->db->get('semester')->result_array();

                if (isset($_POST['submit'])) {
                    $semester["semester"] =  $this->input->post('semester');
                    $this->db->insert('semester', $semester);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftsemester');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/dftsemester');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahsemester($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["semester"] = $this->db->get('semester')->row_array();
                $data["title"] = "Buku Induk Siswa";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE semester SET semester='" . $this->input->post('semester') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftsemester');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editsemester');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function dftkompetensiinti()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku Induk Siswa';
                $data["csrf"] = $this->csrf;
                $data["kompetensi_inti"] = $this->db->get('kompetensi_inti')->result_array();

                if (isset($_POST['submit'])) {
                    $kompetensi_inti["kompetensi_inti"] =  $this->input->post('kompetensi_inti');
                    $this->db->insert('kompetensi_inti', $kompetensi_inti);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftkompetensiinti');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/dftkompetensiinti');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahkompetensiinti($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["kompetensi_inti"] = $this->db->get('kompetensi_inti')->row_array();
                $data["title"] = "Buku Induk Siswa";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE kompetensi_inti SET kompetensi_inti='" . $this->input->post('kompetensi_inti') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/dftkompetensiinti');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editkompetensiinti');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function biodatasiswa($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1" || $this->session->userdata('role') == "2" | $this->session->userdata('role') == "4") {
                $data['title'] = "Buku Induk Siswa";
                $data["biodata"] = $this->db->query("SELECT siswa.*, staff.nama as nama_staff FROM siswa JOIN staff ON siswa.updated_by = staff.id WHERE siswa.id =" . $id)->row_array();
                $this->load->view('admin/header', $data);
                $this->load->view('admin/biodatasiswa');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    private function _sessionUbahBiodata($data)
    {
        $this->session->set_userdata('id', $data["id"]);
        $this->session->set_userdata('nomor_induk', $data["nomor_induk"]);
        $this->session->set_userdata('nisn', $data["nisn"]);
        $this->session->set_userdata('nama', $data["nama"]);
        $this->session->set_userdata('tmp_lahir', $data["tmp_lahir"]);
        $this->session->set_userdata('tgl_lahir', $data["tgl_lahir"]);
        $this->session->set_userdata('ttl', $data["tmp_lahir"] . ", " . $data["tgl_lahir"]);
        $this->session->set_userdata('jenis_kelamin', $data["jenis_kelamin"]);
        $this->session->set_userdata('agama', $data["agama"]);
        $this->session->set_userdata('alamat', $data["alamat"]);
        $this->session->set_userdata('pendidikan_sebelumnya', $data["pendidikan_sebelumnya"]);
        $this->session->set_userdata('nama_ayah', $data["nama_ayah"]);
        $this->session->set_userdata('pekerjaan_ayah', $data["pekerjaan_ayah"]);
        $this->session->set_userdata('nama_ibu', $data["nama_ibu"]);
        $this->session->set_userdata('pekerjaan_ibu', $data["pekerjaan_ibu"]);
        $this->session->set_userdata('provinsi_ortu', $data["provinsi_ortu"]);
        $this->session->set_userdata('kabupaten_ortu', $data["kabupaten_ortu"]);
        $this->session->set_userdata('kecamatan_ortu', $data["kecamatan_ortu"]);
        $this->session->set_userdata('kelurahan_ortu', $data["kelurahan_ortu"]);
        $this->session->set_userdata('alamat_ortu', $data["alamat_ortu"]);
        $this->session->set_userdata('nama_wali', $data["nama_wali"]);
        $this->session->set_userdata('pekerjaan_wali', $data["pekerjaan_wali"]);
        $this->session->set_userdata('provinsi_wali', $data["provinsi_wali"]);
        $this->session->set_userdata('kabupaten_wali', $data["kabupaten_wali"]);
        $this->session->set_userdata('kecamatan_wali', $data["kecamatan_wali"]);
        $this->session->set_userdata('kelurahan_wali', $data["kelurahan_wali"]);
        $this->session->set_userdata('alamat_wali', $data["alamat_wali"]);
        $this->session->set_userdata('no_hp_ortu', $data["no_hp_ortu"]);
    }

    private function _cekNoIndukEdit($id_siswa)
    {
        $query = $this->db->query("select nomor_induk from siswa where nomor_induk = '" . $this->input->post('nomor_induk') . "'")->result_array();
        $self = $this->db->query("select nomor_induk from siswa where id=" . $id_siswa)->row_array();
        if ($query) {
            if ($query[0]["nomor_induk"] == $self["nomor_induk"]) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }

    private function _cekNISNEdit($id_siswa)
    {
        $query = $this->db->query("select nisn from siswa where nisn = '" . $this->input->post('nisn') . "'")->result_array();
        $self = $this->db->query("select nisn from siswa where id=" . $id_siswa)->row_array();
        if ($query) {
            if ($query[0]["nisn"] == $self["nisn"]) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }

    public function ubahbiodata($id)
    {
        netralize4();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1" || $this->session->userdata('role') == "2" | $this->session->userdata('role') == "4") {
                $data['title'] = "Buku Induk Siswa";
                $data["biodata"] = $this->db->query("SELECT * FROM siswa WHERE id =" . $id)->row_array();
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    echo '<div style="display:none">' . $this->_cekNoIndukEdit($id) . '</div>';
                    $this->_sessionUbahBiodata($this->input->post());
                    $_POST["ttl"] = $this->session->userdata("ttl");
                    $data["biodata"] = $this->input->post();
                    $this->_validasiTambahSiswa();
                    $this->_regexAgama();
                    if ($this->form_validation->run() == FALSE || $this->_regexAgama() == 0 || $this->_cekNoIndukEdit($id) == 0 || $this->_cekNISNEdit($id) == 0) {
                        if ($this->_regexAgama() == 0) {
                            $this->session->set_flashdata('agama_error', '<small class="text-danger">agama tidak valid</small>');
                        }

                        if ($this->_cekNoIndukEdit($id) == 0) {
                            $this->session->set_flashdata('nomor_induk_error', '<small class="text-danger">Nomor induk sudah terdaftar</small>');
                        }

                        if ($this->_cekNISNEdit($id) == 0) {
                            $this->session->set_flashdata('nisn_error', '<small class="text-danger">NISN sudah terdaftar</small>');
                        }
                        $this->session->set_flashdata("editBiodataAlert", "Gagal");
                    } else {
                        $this->Admin->ubahbiodata($this->input->post());
                    }
                }
                $this->load->view('admin/header', $data);
                $this->load->view('admin/editbiodata');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function cetakbiodatatemplate($idsiswa)
    {
        netralize();
        if ($this->session->userdata('admin')) {
            if ($this->session->userdata('role') == "1" || $this->session->userdata('role') == "4") {
                $this->db->where('id', $idsiswa);
                $data["biodata"] = $this->db->get('siswa')->row_array();
                $this->load->view('admin/cetakbiodatatemplate', $data);
            } else {
                redirect('admin/');
            }
        } else {
            redirect('admin/login');
        }
    }

    public function cetakbiodata($idsiswa)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "1" || $this->session->userdata('role') == '4') {
                $siswa = $this->db->query("SELECT nama FROM siswa WHERE id=" . $idsiswa)->row_array()["nama"];
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [215, 330]]);
                $mpdf->SetTitle('Biodata Siswa');
                $stylesheet = file_get_contents(base_url('assets/css/biodatacetak.css'));
                $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER['HTTP_COOKIE'] . "\r\n"));
                $context = stream_context_create($opts);
                session_write_close();
                $html = file_get_contents(base_url('admin/cetakbiodatatemplate/' . $idsiswa), false, $context);
                session_start();
                $mpdf->writeHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
                $mpdf->writeHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
                $mpdf->Output('Biodata ' . $siswa . '.pdf', 'D');
                // $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function kelolanilai($idsiswa, $idkelas, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                $tahunajar = $tahun . "/" . $th;
                $data = [
                    "tahun" => $tahunajar,
                    "id_siswa" => $idsiswa,
                    "id_kelas" => $idkelas,
                    "kelas" => $this->db->query("SELECT class FROM kelas WHERE id =" . $idkelas)->row_array(),
                    "siswa" => $this->db->query("SELECT * FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    "nilai_sikap" => $this->db->query("SELECT nilai_sikap.*,kelas_siswa.id_kelas FROM nilai_sikap JOIN kelas_siswa ON nilai_sikap.id_kelas_siswa = kelas_siswa.id WHERE nilai_sikap.id_siswa=" . $idsiswa)->result_array(),
                    "kkm" => $this->db->query("SELECT kkm.*,kelas_siswa.id_kelas FROM kkm JOIN kelas_siswa ON kkm.id_kelas_siswa = kelas_siswa.id WHERE kkm.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_pengetahuan_keterampilan" => $this->db->query("SELECT nilai_mapel.*,kelas_siswa.id_kelas FROM nilai_mapel JOIN kelas_siswa ON nilai_mapel.id_kelas_siswa = kelas_siswa.id WHERE nilai_mapel.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_ekskul" => $this->db->query("SELECT nilai_ekskul.*,kelas_siswa.id_kelas, ekskul.ekskul FROM nilai_ekskul JOIN kelas_siswa ON nilai_ekskul.id_kelas_siswa = kelas_siswa.id JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa=" . $idsiswa)->result_array(),
                    "ekskul_terpilih" => $this->db->query('SELECT nilai_ekskul.id_ekskul, ekskul.ekskul FROM nilai_ekskul JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa = ' . $idsiswa . ' GROUP BY nilai_ekskul.id_ekskul')->result_array(),
                    "jumlah_ketidakhadiran" =>
                    $this->db->query("SELECT jumlah_ketidakhadiran.*,kelas_siswa.id_kelas FROM jumlah_ketidakhadiran JOIN kelas_siswa ON jumlah_ketidakhadiran.id_kelas_siswa = kelas_siswa.id WHERE jumlah_ketidakhadiran.id_siswa=" . $idsiswa)->result_array(),
                ];
                $data['title'] = "Buku Induk Siswa";
                $data["kelas_siswa"] = $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array();
                $data["muatanpelajaran"] = $this->db->get('mapel_induk')->result_array();
                $data["ketidakhadiran"] = $this->db->get('ketidakhadiran')->result_array();

                $this->load->view('admin/header', $data);
                $this->load->view('admin/kelolanilai');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahnilaisikap($idsiswa, $idkelas, $tahun, $th)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                $tahunajar = $tahun . "/" . $th;
                $data = [
                    "csrf" => $this->csrf,
                    "tahun" => $tahunajar,
                    "id_siswa" => $idsiswa,
                    "id_kelas" => $idkelas,
                    "kelas" => $this->db->query("SELECT class FROM kelas WHERE id =" . $idkelas)->row_array(),
                    "siswa" => $this->db->query("SELECT * FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    "kelas_siswa" => $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "akses_wali_kelas" => $this->db->query("SELECT kelas_siswa.id, kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.tahun, wali_kelas.id_staff FROM kelas_siswa JOIN wali_kelas ON kelas_siswa.id_kelas = wali_kelas.id_kelas WHERE wali_kelas.id_staff ='" . $this->session->userdata('id_staff') . "' AND kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_sikap" =>
                    $this->db->query("SELECT nilai_sikap.*,kelas_siswa.id_kelas FROM nilai_sikap JOIN kelas_siswa ON nilai_sikap.id_kelas_siswa = kelas_siswa.id WHERE nilai_sikap.id_siswa=" . $idsiswa)->result_array(),
                ];
                $this->load->view('admin/ubahnilaisikap', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function simpannilaisikap($idsiswa)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                if (isset($_POST["submit"])) {
                    $sorted = $this->input->post();
                    ksort($sorted);
                    $this->Admin->ubahNilaiSikap($sorted);
                    $data = [
                        "kelas_siswa" =>
                        $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                        "nilai_sikap" =>
                        $this->db->query("SELECT nilai_sikap.*,kelas_siswa.id_kelas FROM nilai_sikap JOIN kelas_siswa ON nilai_sikap.id_kelas_siswa = kelas_siswa.id WHERE nilai_sikap.id_siswa=" . $idsiswa)->result_array(),
                        "siswa" =>
                        $this->db->query('SELECT * FROM siswa WHERE id=' . $idsiswa)->row_array()
                    ];
                    $this->load->view('admin/nilaisikaptersimpan', $data);
                }
            }
        }
    }

    public function cetaknilaisikaptemplate($idsiswa)
    {
        netralize();
        if ($this->session->userdata('admin')) {
            if ($this->session->userdata('role') == "1" || $this->session->userdata('role') == "4") {
                $data["kelas_siswa"] = $this->db->query("SELECT kelas_siswa.*, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array();
                $data["nilai_sikap"] = $this->db->query("SELECT nilai_sikap.*, kelas_siswa.id_kelas FROM nilai_sikap JOIN kelas_siswa ON nilai_sikap.id_kelas_siswa = kelas_siswa.id WHERE nilai_sikap.id_siswa=" . $idsiswa)->result_array();
                $this->load->view('admin/cetaknilaisikap', $data);
            } else {
                redirect('admin/');
            }
        } else {
            redirect('admin/login');
        }
    }

    public function cetaknilaisikap($idsiswa)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "1" || $this->session->userdata('role') == '4') {
                $siswa = $this->db->query('SELECT nama FROM siswa WHERE id=' . $idsiswa)->row_array();
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [330, 215]]);
                $mpdf->SetTitle('Nilai Sikap ' . $siswa["nama"]);
                $stylesheet = file_get_contents(base_url('assets/css/cetaknilaisikap.css'));
                $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER['HTTP_COOKIE'] . "\r\n"));
                $context = stream_context_create($opts);
                session_write_close();
                $html = file_get_contents(base_url('admin/cetaknilaisikaptemplate/' . $idsiswa), false, $context);
                session_start();
                $mpdf->writeHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
                $mpdf->writeHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
                $mpdf->Output('Nilai Sikap ' . $siswa["nama"] . '.pdf', 'D');
                // $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahnilaipengetahuanketerampilan($idsiswa, $idkelas, $tahun, $th)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                $tahunajar = $tahun . "/" . $th;
                $data = [
                    "csrf" => $this->csrf,
                    "tahun" => $tahunajar,
                    "id_siswa" => $idsiswa,
                    "id_kelas" => $idkelas,
                    "kelas" => $this->db->query("SELECT class FROM kelas WHERE id =" . $idkelas)->row_array(),
                    "siswa" => $this->db->query("SELECT * FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    "kelas_siswa" => $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "akses_wali_kelas" => $this->db->query("SELECT kelas_siswa.id, kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.tahun, wali_kelas.id_staff FROM kelas_siswa JOIN wali_kelas ON kelas_siswa.id_kelas = wali_kelas.id_kelas WHERE wali_kelas.id_staff ='" . $this->session->userdata('id_staff') . "' AND kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "kkm" => $this->db->query("SELECT kkm.*,kelas_siswa.id_kelas FROM kkm JOIN kelas_siswa ON kkm.id_kelas_siswa = kelas_siswa.id WHERE kkm.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_pengetahuan_keterampilan" => $this->db->query("SELECT nilai_mapel.*,kelas_siswa.id_kelas FROM nilai_mapel JOIN kelas_siswa ON nilai_mapel.id_kelas_siswa = kelas_siswa.id WHERE nilai_mapel.id_siswa=" . $idsiswa)->result_array(),
                    "muatanpelajaran" => $this->db->get('mapel_induk')->result_array(),
                ];
                $this->load->view('admin/ubahnilaipengetahuanketerampilan', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function simpannilaipengetahuanketerampilan($idsiswa)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                if (isset($_POST["submit"])) {
                    $sorted = $this->input->post();
                    ksort($sorted);
                    $this->Admin->ubahNilaiPengetahuanKeterampilan($sorted);

                    $data = [
                        "kelas_siswa" =>
                        $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                        "kkm" => $this->db->query("SELECT kkm.*,kelas_siswa.id_kelas FROM kkm JOIN kelas_siswa ON kkm.id_kelas_siswa = kelas_siswa.id WHERE kkm.id_siswa=" . $idsiswa)->result_array(),
                        "nilai_pengetahuan_keterampilan" => $this->db->query("SELECT nilai_mapel.*,kelas_siswa.id_kelas FROM nilai_mapel JOIN kelas_siswa ON nilai_mapel.id_kelas_siswa = kelas_siswa.id WHERE nilai_mapel.id_siswa=" . $idsiswa)->result_array(),
                        "muatanpelajaran" => $this->db->get('mapel_induk')->result_array(),
                        "siswa" => $this->db->query("SELECT * FROM siswa WHERE id = " . $idsiswa)->row_array(),
                    ];
                    $this->load->view('admin/nilaipengetahuanketerampilantersimpan', $data);
                }
            }
        }
    }

    public function ubahnilaiekstrakurikuler($idsiswa, $idkelas, $tahun, $th)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                $tahunajar = $tahun . "/" . $th;
                $data = [
                    "csrf" => $this->csrf,
                    "tahun" => $tahunajar,
                    "id_siswa" => $idsiswa,
                    "id_kelas" => $idkelas,
                    "kelas" => $this->db->query("SELECT class FROM kelas WHERE id =" . $idkelas)->row_array(),
                    "siswa" => $this->db->query("SELECT * FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    "kelas_siswa" => $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "akses_wali_kelas" => $this->db->query("SELECT kelas_siswa.id, kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.tahun, wali_kelas.id_staff FROM kelas_siswa JOIN wali_kelas ON kelas_siswa.id_kelas = wali_kelas.id_kelas WHERE wali_kelas.id_staff ='" . $this->session->userdata('id_staff') . "' AND kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_ekskul" => $this->db->query("SELECT nilai_ekskul.*,kelas_siswa.id_kelas FROM nilai_ekskul JOIN kelas_siswa ON nilai_ekskul.id_kelas_siswa = kelas_siswa.id WHERE nilai_ekskul.id_siswa=" . $idsiswa)->result_array(),
                    "ekskul" => $this->db->get('ekskul')->result_array(),
                    "ekskul_terpilih" => $this->db->query('SELECT nilai_ekskul.id_ekskul, ekskul.ekskul FROM nilai_ekskul JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa = ' . $idsiswa . ' GROUP BY nilai_ekskul.id_ekskul')->result_array(),
                ];
                $this->load->view('admin/ubahnilaiekstrakurikuler', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function simpannilaiekstrakurikuler($idsiswa)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                if (isset($_POST["submit"])) {
                    $sorted = $this->input->post();
                    ksort($sorted);
                    $this->Admin->ubahNilaiEkstrakurikuler($sorted);

                    $data = [
                        "kelas_siswa" =>
                        $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                        "nilai_ekskul" => $this->db->query("SELECT nilai_ekskul.*,kelas_siswa.id_kelas, ekskul.ekskul FROM nilai_ekskul JOIN kelas_siswa ON nilai_ekskul.id_kelas_siswa = kelas_siswa.id JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa=" . $idsiswa)->result_array(),
                        "ekskul_terpilih" => $this->db->query('SELECT nilai_ekskul.id_ekskul, ekskul.ekskul FROM nilai_ekskul JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa = ' . $idsiswa . ' GROUP BY nilai_ekskul.id_ekskul')->result_array(),
                        "siswa" => $this->db->query("SELECT * FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    ];
                    $this->load->view('admin/nilaiekstrakurikulertersimpan', $data);
                }
            }
        }
    }

    public function tambahekstrakurikuler($id = NULL)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                netralize();
                // var_dump($ekskulTerpilih);
                if ($id) {
                    $ekskul = [];
                    $chosen = explode('_', $id);
                    foreach ($this->db->get('ekskul')->result_array() as $e) {
                        if (!in_array($e["id"], $chosen)) {
                            $ekskul[] = $e;
                        }
                    }
                    $data["ekskul"] = $ekskul;
                } else {
                    $data["ekskul"] = $this->db->get('ekskul')->result_array();
                }
                $this->load->view('admin/tambahekstrakurikuler', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function getekstrakurikulerinputtr($idekskul, $idsiswa, $x, $semester)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                netralize();
                $this->db->where('id', $idekskul);
                $data = [
                    "x" => $x - 1,
                    "ekskul" => $this->db->get('ekskul')->row_array(),
                    "akses_wali_kelas" => $this->db->query("SELECT kelas_siswa.id, kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.tahun, wali_kelas.id_staff FROM kelas_siswa JOIN wali_kelas ON kelas_siswa.id_kelas = wali_kelas.id_kelas WHERE wali_kelas.id_staff ='" . $this->session->userdata('id_staff') . "' AND kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_ekskul" => $this->db->query("SELECT nilai_ekskul.*,kelas_siswa.id_kelas, ekskul.ekskul FROM nilai_ekskul JOIN kelas_siswa ON nilai_ekskul.id_kelas_siswa = kelas_siswa.id JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa=" . $idsiswa)->result_array(),
                    "ekskul_terpilih" => $this->db->query('SELECT nilai_ekskul.id_ekskul, ekskul.ekskul FROM nilai_ekskul JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa = ' . $idsiswa . ' GROUP BY nilai_ekskul.id_ekskul')->result_array(),
                    "semester" => $semester,
                ];
                $this->load->view("admin/ekstrakurikulerinputtr", $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function checkakseswalikelasekskul($idsiswa)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                netralize();
                $data["akses_wali_kelas"] = $this->db->query("SELECT kelas_siswa.id, kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.tahun, wali_kelas.id_staff FROM kelas_siswa JOIN wali_kelas ON kelas_siswa.id_kelas = wali_kelas.id_kelas WHERE wali_kelas.id_staff ='" . $this->session->userdata('id_staff') . "' AND kelas_siswa.id_siswa=" . $idsiswa)->result_array();
                $this->load->view('admin/checkakseswalikelasekskul', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahjumlahabsensi($idsiswa, $idkelas, $tahun, $th)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                $tahunajar = $tahun . "/" . $th;
                $data = [
                    "csrf" => $this->csrf,
                    "tahun" => $tahunajar,
                    "id_siswa" => $idsiswa,
                    "id_kelas" => $idkelas,
                    "kelas" => $this->db->query("SELECT class FROM kelas WHERE id =" . $idkelas)->row_array(),
                    "siswa" => $this->db->query("SELECT * FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    "kelas_siswa" => $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "akses_wali_kelas" => $this->db->query("SELECT kelas_siswa.id, kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.tahun, wali_kelas.id_staff FROM kelas_siswa JOIN wali_kelas ON kelas_siswa.id_kelas = wali_kelas.id_kelas WHERE wali_kelas.id_staff ='" . $this->session->userdata('id_staff') . "' AND kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "ketidakhadiran" => $this->db->get('ketidakhadiran')->result_array(),
                    "jumlah_ketidakhadiran" =>
                    $this->db->query("SELECT jumlah_ketidakhadiran.*,kelas_siswa.id_kelas FROM jumlah_ketidakhadiran JOIN kelas_siswa ON jumlah_ketidakhadiran.id_kelas_siswa = kelas_siswa.id WHERE jumlah_ketidakhadiran.id_siswa=" . $idsiswa)->result_array(),
                ];
                $this->load->view('admin/ubahjumlahabsensi', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function simpanjumlahabsensi($idsiswa)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
                if (isset($_POST["submit"])) {
                    $sorted = $this->input->post();
                    ksort($sorted);
                    $this->Admin->ubahJumlahAbsensi($sorted);
                    $data = [
                        "kelas_siswa" =>
                        $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                        "ketidakhadiran" => $this->db->get('ketidakhadiran')->result_array(),
                        "jumlah_ketidakhadiran" =>
                        $this->db->query("SELECT jumlah_ketidakhadiran.*,kelas_siswa.id_kelas FROM jumlah_ketidakhadiran JOIN kelas_siswa ON jumlah_ketidakhadiran.id_kelas_siswa = kelas_siswa.id WHERE jumlah_ketidakhadiran.id_siswa=" . $idsiswa)->result_array(),
                        "siswa" => $this->db->query("SELECT * FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    ];
                    $this->load->view('admin/jumlahabsensitersimpan', $data);
                }
            }
        }
    }

    public function cetaknilaiki3ki4template($idsiswa)
    {
        netralize();
        if ($this->session->userdata('admin')) {
            if ($this->session->userdata('role') == "1" || $this->session->userdata('role') == "4") {
                $data = [
                    "kelas_siswa" => $this->db->query("SELECT kelas_siswa.*, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa . " ORDER BY tahun")->result_array(),
                    "nilai_sikap" => $this->db->query("SELECT nilai_sikap.*, kelas_siswa.id_kelas FROM nilai_sikap JOIN kelas_siswa ON nilai_sikap.id_kelas_siswa = kelas_siswa.id WHERE nilai_sikap.id_siswa=" . $idsiswa)->result_array(),
                    "muatan_pelajaran" => $this->db->get("mapel_induk")->result_array(),
                    "kkm" => $this->db->query("SELECT kkm.*, kelas_siswa.id_kelas FROM kkm JOIN kelas_siswa ON kkm.id_kelas_siswa = kelas_siswa.id WHERE kkm.id_siswa=" . $idsiswa . " AND kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_mapel" => $this->db->query("SELECT nilai_mapel.*, kelas_siswa.id_kelas FROM nilai_mapel JOIN kelas_siswa ON nilai_mapel.id_kelas_siswa=kelas_siswa.id WHERE nilai_mapel.id_siswa=" . $idsiswa . " AND kelas_siswa.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_ekskul" => $this->db->query("SELECT nilai_ekskul.*, ekskul.ekskul, kelas_siswa.id_kelas FROM nilai_ekskul JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id JOIN kelas_siswa ON nilai_ekskul.id_kelas_siswa = kelas_siswa.id WHERE nilai_ekskul.id_siswa=" . $idsiswa . " AND kelas_siswa.id_siswa =" . $idsiswa)->result_array(),
                    "ketidakhadiran" => $this->db->get('ketidakhadiran')->result_array(),
                    "jumlah_absensi" => $this->db->query("SELECT jumlah_ketidakhadiran.*, kelas_siswa.id_kelas FROM jumlah_ketidakhadiran JOIN kelas_siswa ON jumlah_ketidakhadiran.id_kelas_siswa = kelas_siswa.id WHERE jumlah_ketidakhadiran.id_siswa=" . $idsiswa)->result_array(),
                ];
                $this->load->view('admin/cetaknilaiki3ki4', $data);
            } else {
                redirect('admin/');
            }
        } else {
            redirect('admin/login');
        }
    }

    public function cetaknilaiki3ki4($idsiswa)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "1" || $this->session->userdata('role') == '4') {
                // ini_set("memory_limit","1500000M");
                // ini_set("pcre.backtrack_limit","2000000");
                $siswa = $this->db->query('SELECT nama FROM siswa WHERE id=' . $idsiswa)->row_array();
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [330, 215]]);
                $mpdf->SetTitle('Nilai Ki3-Ki4 ' . $siswa["nama"]);
                $stylesheet = file_get_contents(base_url('assets/css/cetaknilaiki3ki4.css'));
                $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER['HTTP_COOKIE'] . "\r\n"));
                $context = stream_context_create($opts);
                session_write_close();
                $html = file_get_contents(base_url('admin/cetaknilaiki3ki4template/' . $idsiswa), false, $context);
                session_start();
                $mpdf->writeHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
                $mpdf->writeHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
                $mpdf->Output('Nilai KI3 KI4 ' . $siswa["nama"] . '.pdf', 'D');
                // $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function ksbukuinduk()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "3") {
                $data = ['bukuinduk' => $this->db->query('SELECT DISTINCT tahun FROM wali_kelas ORDER BY tahun DESC')->result_array()];
                $this->db->where('id', $this->session->userdata("id_staff"));
                $data["staff"] = $this->db->get('staff')->row_array();
                $data['title'] = "Buku Induk Siswa";
                $this->load->view('admin/header', $data);
                $this->load->view('admin/ksbukuinduk');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ksbikelas($tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "3") {
                $tahunAjar = $tahun . '/' . $th;
                $this->session->set_userdata('tahun', $tahunAjar);
                $data = ['bukuinduk' => $this->db->query('SELECT wali_kelas.tahun, wali_kelas.id_staff,wali_kelas.id_kelas, staff.nama, kelas.class FROM wali_kelas JOIN staff ON wali_kelas.id_staff = staff.id JOIN kelas ON wali_kelas.id_kelas = kelas.id  WHERE wali_kelas.tahun="' . $tahunAjar . '" ORDER BY kelas.class')->result_array()];
                $this->db->where('id', $this->session->userdata("id_staff"));
                $data["staff"] = $this->db->get('staff')->row_array();
                $data['title'] = "Buku Induk Siswa";
                $this->load->view('admin/header', $data);
                $this->load->view('admin/ksbikelas');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ksbisiswa($idkelas, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "3") {
                $tahunAjar = $tahun . '/' . $th;
                $data = ['bukuinduk' => $this->db->query('SELECT kelas_siswa.*,kelas.class,siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE id_kelas = "' . $idkelas . '" AND tahun="' . $tahunAjar . '"')->result_array()];
                $this->db->where('id', $this->session->userdata("id_staff"));
                $data["staff"] = $this->db->get('staff')->row_array();
                $data['title'] = "Buku Induk Siswa";
                $this->load->view('admin/header', $data);
                $this->load->view('admin/ksbisiswa');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ksbinilai($idsiswa, $idkelas, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "3") {
                $tahunajar = $tahun . "/" . $th;
                $data = [
                    "tahun" => $tahunajar,
                    "id_siswa" => $idsiswa,
                    "id_kelas" => $idkelas,
                    "kelas" => $this->db->query("SELECT class FROM kelas WHERE id =" . $idkelas)->row_array(),
                    "siswa" => $this->db->query("SELECT * FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    "nilai_sikap" => $this->db->query("SELECT nilai_sikap.*,kelas_siswa.id_kelas FROM nilai_sikap JOIN kelas_siswa ON nilai_sikap.id_kelas_siswa = kelas_siswa.id WHERE nilai_sikap.id_siswa=" . $idsiswa)->result_array(),
                    "kkm" => $this->db->query("SELECT kkm.*,kelas_siswa.id_kelas FROM kkm JOIN kelas_siswa ON kkm.id_kelas_siswa = kelas_siswa.id WHERE kkm.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_pengetahuan_keterampilan" => $this->db->query("SELECT nilai_mapel.*,kelas_siswa.id_kelas FROM nilai_mapel JOIN kelas_siswa ON nilai_mapel.id_kelas_siswa = kelas_siswa.id WHERE nilai_mapel.id_siswa=" . $idsiswa)->result_array(),
                    "nilai_ekskul" => $this->db->query("SELECT nilai_ekskul.*,kelas_siswa.id_kelas, ekskul.ekskul FROM nilai_ekskul JOIN kelas_siswa ON nilai_ekskul.id_kelas_siswa = kelas_siswa.id JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa=" . $idsiswa)->result_array(),
                    "ekskul_terpilih" => $this->db->query('SELECT nilai_ekskul.id_ekskul, ekskul.ekskul FROM nilai_ekskul JOIN ekskul ON nilai_ekskul.id_ekskul = ekskul.id WHERE nilai_ekskul.id_siswa = ' . $idsiswa . ' GROUP BY nilai_ekskul.id_ekskul')->result_array(),
                    "jumlah_ketidakhadiran" =>
                    $this->db->query("SELECT jumlah_ketidakhadiran.*,kelas_siswa.id_kelas FROM jumlah_ketidakhadiran JOIN kelas_siswa ON jumlah_ketidakhadiran.id_kelas_siswa = kelas_siswa.id WHERE jumlah_ketidakhadiran.id_siswa=" . $idsiswa)->result_array(),
                ];
                $data['title'] = "Buku Induk Siswa";
                $data["kelas_siswa"] = $this->db->query("SELECT kelas_siswa.tahun, kelas_siswa.id_kelas, kelas.class FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.id_siswa=" . $idsiswa)->result_array();
                $data["muatanpelajaran"] = $this->db->get('mapel_induk')->result_array();
                $data["ketidakhadiran"] = $this->db->get('ketidakhadiran')->result_array();

                $this->load->view('admin/header', $data);
                $this->load->view('admin/ksbinilai');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function classesmanagement()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "4") {
                $data["csrf"] = $this->csrf;
                $data['kelas_siswa'] = $this->db->query('SELECT DISTINCT tahun FROM wali_kelas ORDER BY tahun DESC')->result_array();
                // $data['kelas_siswa'] = NULL;
                $this->db->where('id', $this->session->userdata("id_staff"));
                $data["staff"] = $this->db->get('staff')->row_array();
                $data['title'] = "Manajemen Kelas";
                $this->load->view('admin/header', $data);
                $this->load->view('admin/managementkelas');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function mktambahkelas()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "4") {
                $data["title"] = "Manajemen Kelas";
                $data["csrf"] = $this->csrf;
                $data["kelas"] = $this->db->get('kelas')->result_array();
                if ((int)date('m') >= 7 && (int)date('m') <= 12) {
                    $tahun = date('Y');
                    $th = (int)date('y') + 1;
                    $tahunajar = $tahun . '/' . (string)$th;
                } else {
                    $tahun = (int)date('Y') - 1;
                    $th = date('y');
                    $tahunajar = (string)$tahun . '/' . $th;
                }
                $data['tahun'] = $tahunajar;
                $this->session->set_userdata('tahun', $tahunajar);
                $this->load->view('admin/pilihkelas2', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function mkkelas($tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "4") {
                $tahunAjar = $tahun . '/' . $th;
                $this->session->set_userdata('tahun', $tahunAjar);
                $data = ['kelas' => $this->db->get('kelas')->result_array()];
                $this->db->where('id', $this->session->userdata("id_staff"));
                $data["staff"] = $this->db->get('staff')->row_array();
                $data['title'] = "Manajemen Kelas";
                if (isset($_POST['pilihwalikelas'])) {
                    $mapped = [
                        'id_kelas' => $this->input->post('idkelas'),
                        'tahun' => $this->input->post('tahun'),
                        'id_staff' => $this->input->post('pilihwalikelas')
                    ];
                    $this->Admin->pilihWaliKelas($mapped);
                    $this->session->set_flashdata('walibaru', 'success');
                }
                $this->load->view('admin/header', $data);
                $this->load->view('admin/mkkelas');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function getwalikelas($idkelas, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "4") {
                $newTch = [];
                $idwkterpilih = [];
                $wkTerpilih = $this->db->query('SELECT id_staff FROM wali_kelas WHERE tahun ="' . $tahun . '/' . $th . '"')->result_array();
                foreach ($wkTerpilih as $wt) {
                    $idwkterpilih[] = $wt["id_staff"];
                }
                $allTch = $this->db->get('staff')->result_array();
                foreach ($allTch as $at) {
                    if (!in_array($at["id"], $idwkterpilih)) {
                        $newTch[] = $at;
                    }
                }
                $data["newTch"] = $newTch;
                $data["idkelas"] = $idkelas;
                $data["csrf"] = $this->csrf;
                $this->load->view('/admin/mknewtch', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function hapuswalikelas($idkelas, $tahun, $th, $idstaff)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "4") {
                $checkRow = $this->db->query('SELECT * FROM wali_kelas WHERE tahun="' . $tahun . '/' . $th . '" AND id_kelas=' . $idkelas . ' AND id_staff=' . $idstaff)->row_array();
                if ($checkRow) {
                    $this->db->where('tahun', $tahun . '/' . $th);
                    $this->db->where('id_kelas', $idkelas);
                    $this->db->where('id_staff', $idstaff);
                    $this->db->delete('wali_kelas');
                }
                redirect('admin/mkkelas/' . $tahun . '/' . $th);
            } else {
                redirect('admin');
            }
        }
    }

    public function mksiswa($idkelas, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "4") {
                var_dump($idkelas, $tahun, $th);
            } else {
                redirect('admin');
            }
        }
    }

    public function statusspp()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku SPP';
                $data["csrf"] = $this->csrf;
                $data["spp_status"] = $this->db->get('spp_status')->result_array();

                if (isset($_POST['submit'])) {
                    $spp_status["status"] =  $this->input->post('spp_status');
                    $this->db->insert('spp_status', $spp_status);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/statusspp');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/statusspp');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahstatusspp($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["spp_status"] = $this->db->get('spp_status')->row_array();
                $data["title"] = "Buku SPP";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE spp_status SET status='" . $this->input->post('spp_status') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/statusspp');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editstatusspp');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function metodebayarspp()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku SPP';
                $data["csrf"] = $this->csrf;
                $data["metode_bayar"] = $this->db->get('metode_bayar_spp')->result_array();

                if (isset($_POST['submit'])) {
                    $metode_bayar_spp["metode"] =  $this->input->post('metode_bayar_spp');
                    $this->db->insert('metode_bayar_spp', $metode_bayar_spp);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/metodebayarspp');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/metodebayarspp');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahmetodebayarspp($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["metode_bayar_spp"] = $this->db->get('metode_bayar_spp')->row_array();
                $data["title"] = "Buku SPP";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE metode_bayar_spp SET metode='" . $this->input->post('metode_bayar_spp') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/metodebayarspp');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editmetodebayarspp');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function nominalspp()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku SPP';
                $data["csrf"] = $this->csrf;
                $data["nominal"] = $this->db->get('nominal_spp')->result_array();

                if (isset($_POST['submit'])) {
                    $nominal_spp["nominal"] =  $this->input->post('nominal_spp');
                    $this->db->insert('nominal_spp', $nominal_spp);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/nominalspp');
                    }
                }
                $this->load->view('admin/header', $data);
                $this->load->view('admin/nominalspp');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahnominalspp($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["nominal_spp"] = $this->db->get('nominal_spp')->row_array();
                $data["title"] = "Buku SPP";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $this->db->query("UPDATE nominal_spp SET nominal='" . $this->input->post('nominal_spp') . "' WHERE id=" . $id);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/nominalspp');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editnominalspp');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function bulanakademik()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data["title"] = 'Buku SPP';
                $data["csrf"] = $this->csrf;
                $data["bulan"] = $this->db->get('bulan_akademik')->result_array();

                if (isset($_POST['submit'])) {
                    $bulan_akademik = [
                        "angka_bulan" =>  $this->input->post('angka_bulan'),
                        "nama_bulan" =>  $this->input->post('nama_bulan')
                    ];
                    $this->db->insert('bulan_akademik', $bulan_akademik);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/bulanakademik');
                    }
                }
                $this->load->view('admin/header', $data);
                $this->load->view('admin/bulanakademik');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahbulanakademik($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $this->db->where('id', $id);
                $data["bulan_akademik"] = $this->db->get('bulan_akademik')->row_array();
                $data["title"] = "Buku SPP";
                $data["csrf"] = $this->csrf;

                if (isset($_POST["submit"])) {
                    $mapped = [
                        "angka_bulan" => $this->input->post('angka_bulan'),
                        "nama_bulan" => $this->input->post('nama_bulan'),
                    ];
                    $this->db->where('id', $id);
                    $this->db->update('bulan_akademik', $mapped);
                    if ($this->db->affected_rows() > 0) {
                        redirect('admin/bulanakademik');
                    }
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/editbulanakademik');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function nominalspppertingkat()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data['title'] = "Buku SPP";
                $data['csrf'] = $this->csrf;
                if (isset($_POST["submit"])) {
                    $this->Admin->setNominalPerTingkat($this->tahunAjar, $this->input->post());
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('updateNominalSpp', 'success');
                        redirect('admin/nominalspppertingkat');
                    }
                }
                $data["nominal"] = $this->db->get('nominal_spp')->result_array();
                $data['nominal_per_tingkat_tahun_ini'] = $this->Admin->getNominalPertingkat($this->tahunAjar);
                $this->load->view('admin/header', $data);
                $this->load->view('admin/nominalspppertingkat');
                $this->load->view('admin/footer');
                $this->session->unset_userdata('updateNominalSpp');
            } else {
                redirect('admin');
            }
        }
    }

    public function gettotalsppthtsb($tahunajaran, $thajaran)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data = $this->db->query("SELECT SUM(nominal) AS total_spp FROM spp WHERE tahun_ajaran='" . $tahunajaran . "/" . $thajaran . "'")->row_array();
                echo ($data["total_spp"]) ? rupiah($data["total_spp"]) : 'Rp0.-';
                $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function gettotalsppblntsb($idbulan, $tahunajaran, $thajaran)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data = $this->db->query("SELECT SUM(nominal) AS total_spp_bulan FROM spp WHERE tahun_ajaran='" . $tahunajaran . "/" . $thajaran . "' AND bulan=" . $idbulan)->row_array();
                echo ($data["total_spp_bulan"]) ? rupiah($data["total_spp_bulan"]) : 'Rp0.-';
                $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function spp($nama = null, $kelas = null)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data['title'] = "Buku SPP";
                $data['csrf'] = $this->csrf;
                $this->db->where('tahun_ajaran', $this->tahunAjar);
                $data['nominal_per_tingkat_tahun_ini'] = $this->db->get('nominal_spp_per_tingkat')->result_array();
                $data["kelas"] = $this->db->get('kelas')->result_array();
                $data["total_spp_masuk"] = $this->db->query("SELECT SUM(nominal) AS total_spp FROM spp WHERE tahun_ajaran='" . $this->tahunAjar . "'")->row_array();
                $tahunajaran = $this->db->query('SELECT DISTINCT tahun_ajaran FROM spp ORDER BY tahun_ajaran DESC')->result_array();
                $allAcademicYears = [];
                if ($tahunajaran) {
                    foreach ($tahunajaran as $ta) {
                        $allAcademicYears[] = $ta["tahun_ajaran"];
                    }
                } else {
                    $allAcademicYears[] = $this->tahunAjar;
                }
                if (!in_array($this->tahunAjar, $allAcademicYears)) {
                    $allAcademicYears[] = $this->tahunAjar;
                    arsort($allAcademicYears);
                }
                $data["tahunajaran"] = $allAcademicYears;

                $this->Admin->SppFreeCharge($this->tahunAjar);

                if (isset($_POST["idkelas"])) {
                    redirect('admin/sppkelas/' . $this->input->post('idkelas') . '/' . $this->input->post('tahunpelajaran'));
                }

                if ($nama && $kelas) {
                    echo '';
                }

                $this->load->view('admin/header', $data);
                $this->load->view('admin/spp');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    private function _sppPerTahun($idkelas, $tahunajaran, $thajaran, $idtransaksi, $idsiswa, $spp_untuk_kelas)
    {
        $data['title'] = "Buku SPP";
        $data['csrf'] = $this->csrf;
        $data['nominal_spp'] = $this->db->query("SELECT nominal_spp_per_tingkat.id_nominal_spp, nominal_spp.nominal FROM nominal_spp_per_tingkat JOIN nominal_spp ON nominal_spp_per_tingkat.id_nominal_spp= nominal_spp.id WHERE nominal_spp_per_tingkat.tahun_ajaran='" . $tahunajaran . "/" . $thajaran . "' AND nominal_spp_per_tingkat.id_kelas=" . $idkelas)->row_array();
        $kelas = $this->db->query("SELECT wali_kelas.*, kelas.class, staff.nama FROM wali_kelas JOIN kelas ON wali_kelas.id_kelas = kelas.id JOIN staff ON wali_kelas.id_staff = staff.id WHERE wali_kelas.id_kelas = " . $idkelas . " AND wali_kelas.tahun = '" . $tahunajaran . "/" . $thajaran . "'")->row_array();
        if ($kelas) {
            $data["kelas"] = $kelas;
        } else {
            $data["kelas"] = [
                "id_kelas" => $idkelas,
                "class" => $this->db->query("SELECT class FROM kelas WHERE id=" . $idkelas)->row_array()["class"],
                "tahun" => $tahunajaran . '/' . $thajaran,
                "nama" => "-"
            ];
        }
        if ($idsiswa !== null) {
            $data["siswa"] = $this->db->query("SELECT kelas_siswa.id AS id_kelas_siswa, kelas_siswa.tahun, kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.insert_by, siswa.nomor_induk, siswa.nama, siswa.status_spp, siswa.id_detail_status_spp FROM kelas_siswa JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=" . $idsiswa . " AND kelas_siswa.id_kelas=" . $idkelas . " AND kelas_siswa.tahun='" . $tahunajaran . "/" . $thajaran . "'")->result_array();
        } else {
            $data["siswa"] = $this->db->query("SELECT kelas_siswa.id AS id_kelas_siswa, kelas_siswa.tahun, kelas_siswa.id_siswa, kelas_siswa.id_kelas, kelas_siswa.insert_by, siswa.nomor_induk, siswa.nama, siswa.status_spp, siswa.id_detail_status_spp FROM kelas_siswa JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_kelas=" . $idkelas . " AND kelas_siswa.tahun='" . $tahunajaran . "/" . $thajaran . "'")->result_array();
        }
        $data["bulan_akademik"] = $this->db->get('bulan_akademik')->result_array();
        if ($idtransaksi !== null) {
            $this->session->set_flashdata('idtransaksi', $idtransaksi);
            $this->session->set_flashdata('pembayar', $this->Admin->getSppPaymentDetail($idtransaksi)["nama"]);
        }
        $data["spp"] = $this->db->get('spp')->result_array();
        $data["total_spp_kelas"] = $this->db->query("SELECT SUM(spp.nominal) AS total, kelas_siswa.id_kelas, kelas.id FROM spp JOIN kelas_siswa ON spp.id_kelas_siswa = kelas_siswa.id JOIN kelas ON kelas_siswa.id_kelas = kelas.id WHERE spp.tahun_ajaran='" . $tahunajaran . "/" . $thajaran . "' AND kelas.id = " . $idkelas)->row_array();
        $data["spp_untuk_kelas"] = $spp_untuk_kelas;
        $this->load->view('admin/header', $data);
        if ($spp_untuk_kelas == true) {
            $this->load->view('admin/sppkelas');
        } else {
            $data["tahun"] = $tahunajaran . '/' . $thajaran;
            $this->load->view('admin/sppsiswa', $data);
        }
        $this->load->view('admin/footer');
    }

    public function sppkelas($idkelas, $tahunajaran, $thajaran, $idtransaksi = null)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $this->session->set_userdata('tahun', $tahunajaran . '/' . $thajaran);
                $this->_sppPerTahun($idkelas, $tahunajaran, $thajaran, $idtransaksi, idsiswa: null, spp_untuk_kelas: true);
            } else {
                redirect('admin');
            }
        }
    }

    public function modalpaymentajax($idsiswa, $idkelas, $idbulan, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data = [
                    "siswa" => $this->db->query("SELECT siswa.id, siswa.nomor_induk, siswa.nama, siswa.status_spp, siswa.id_detail_status_spp, kelas_siswa.id AS id_ks FROM siswa JOIN kelas_siswa ON kelas_siswa.id_siswa = siswa.id WHERE siswa.id=" . $idsiswa . " AND kelas_siswa.id_kelas=" . $idkelas)->row_array(),
                    "bulan" => $this->db->query("SELECT * FROM bulan_akademik WHERE id=" . $idbulan)->row_array(),
                    "kelas" => $this->db->query("SELECT * FROM kelas WHERE id=" . $idkelas)->row_array(),
                    "tahun" => $tahun . '/' . $th,
                    "tagihankelas" => $this->db->query('SELECT * FROM nominal_spp_per_tingkat WHERE id_kelas=' . $idkelas . " AND tahun_ajaran='" . $tahun . "/" . $th . "'")->row_array(),
                    "metode_bayar" => $this->db->get("metode_bayar_spp")->result_array(),
                    "csrf" => $this->csrf
                ];

                if ($data["siswa"]["id_detail_status_spp"]) {
                    $data["status_spp"] = $this->db->query("SELECT detail_status_spp_siswa.*, spp_status.status FROM detail_status_spp_siswa JOIN spp_status ON detail_status_spp_siswa.id_status_spp = spp_status.id WHERE detail_status_spp_siswa.id=" . $data["siswa"]["id_detail_status_spp"])->row_array();
                } else {
                    $data["status_spp"] = null;
                }
                $this->load->view('admin/modalpaymentcontentajax', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function uploadbuktitfspp($upload = null)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                if (isset($_POST["submit"])) {
                    if ($upload == "upload") {
                        $config["file_name"] = 'bukti-tf-spp-';
                        $config['upload_path'] = 'assets/spptf/';
                        $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                        $config['max_size']     = '2000'; //kb
                        $config["overwrite"] = false;
                        $this->load->library('upload', $config);
                        $tr = new GoogleTranslate();
                        $tr->setSource('en');
                        $tr->setTarget('id');
                        if (!$this->upload->do_upload('buktitf')) {
                            $data = [
                                "error" => $tr->translate(strip_tags($this->upload->display_errors())),
                                "new_csrf_token" => $this->csrf
                            ];
                            echo json_encode($data);
                        } else {
                            $data = [
                                "file" => $this->upload->data(),
                                "post" => $this->input->post(),
                                "new_csrf_token" => $this->csrf
                            ];
                            $data["post"]["bukti_transfer"] = $this->upload->data("file_name");
                            $data["post"]["id_staff"] = $this->session->userdata('id_staff');
                            $this->Admin->postSPP($data["post"]);
                        }
                    } else {
                        $data = [
                            "post" => $this->input->post(),
                            "new_csrf_token" => $this->csrf
                        ];
                        $data["post"]["bukti_transfer"] = "";
                        $data["post"]["id_staff"] = $this->session->userdata('id_staff');
                        $this->Admin->postSPP($data["post"]);
                    }
                    $this->load->view('admin/halamankosong');
                } else {
                    $this->load->view('admin/uploadbuktitfspp');
                }
            } else {
                redirect('admin');
            }
        }
    }

    public function buktipembayaranspp($idtr)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [150, 150]]);
                $mpdf->SetTitle('Bukti Pembayaran SPP');
                $spp = $this->Admin->getSppPaymentDetail($idtr);
                $html = '<div style="display:flex;justify-content:space-between">
                <div style="width:380px;float:left;line-height:0.3">
                <h2>BUKTI PEMBAYARAN SPP</h2><h3>SD Islam Al-Khairiyah Banyuwangi</h3>
                </div>
                <div style="margin-right:0px;">
                <img src="' . base_url('assets/img/alkhairiyah.png') . '" width="70px" height="70px" style="margin-top:-20px"></img>
                </div>
                </div>
                <hr/>
                <div style="margin-top:20px">
                <div style="width:91px;float:left;line-height:2;">
                Tanggal<br/>
                Nama<br/>
                No. Induk<br/>
                Kelas<br/>
                Bulan<br/>
                Tahun Ajaran<br/>
                Nominal<br/>
                </div>
                <div style="position:absolute;width:362px;float:right; top:-176px;right:10px;line-height:2">
                : ' . $spp['tanggal'] . ' <br>
                : <strong>' . $spp['nama'] . '</strong> <br> 
                : ' . $spp['nomor_induk'] . ' <br>
                : ' . $spp['class'] . '<br>
                : ' . $spp['nama_bulan'] . '<br>
                : ' . $spp['tahun_ajaran'] . '<br>
                : <strong>' . rupiah($spp['nominal']) . '</strong><br>
                </div>
                </div>
                <br/><br/>
                <div style="width:50%;padding-left:250px;">
                <div style="text-align:center;width:600px">
                Admin<br/><br/>ttd.<br/><br/><u>' . $spp['nama_admin'] . '</u></div></div>';
                $mpdf->writeHTML($html);
                $mpdf->Output('Bukti Pembayaran SPP ' . $idtr . '.pdf', 'D');
                // $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function paidoffsppajax($idtr)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $checkDetailStatus = $this->db->query("SELECT id_detail_status_spp FROM spp WHERE id=" . $idtr)->row_array();
                if ($checkDetailStatus["id_detail_status_spp"]) {
                    $data["strukSPP"] = $this->db->query("SELECT spp.id, detail_status_spp_siswa.id_status_spp, spp_status.status, detail_status_spp_siswa.keterangan, siswa.nama, siswa.nomor_induk, kelas_siswa.id_kelas, kelas.class, bulan_akademik.nama_bulan, spp.tahun_ajaran, spp.nominal, spp.tanggal, metode_bayar_spp.metode, spp.bukti_transfer, staff.nama AS nama_staff FROM spp JOIN detail_status_spp_siswa ON spp.id_detail_status_spp=detail_status_spp_siswa.id JOIN spp_status ON detail_status_spp_siswa.id_status_spp=spp_status.id JOIN siswa ON spp.id_siswa = siswa.id JOIN kelas_siswa ON spp.id_kelas_siswa = kelas_siswa.id JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN bulan_akademik ON spp.bulan = bulan_akademik.id JOIN metode_bayar_spp ON spp.metode_bayar = metode_bayar_spp.id JOIN staff ON spp.id_staff = staff.id WHERE spp.id=" . $idtr)->row_array();
                } else {
                    $data["strukSPP"] = $this->db->query("SELECT spp.id, siswa.nama, siswa.nomor_induk, kelas_siswa.id_kelas, kelas.class, bulan_akademik.nama_bulan, spp.tahun_ajaran, spp.nominal, spp.tanggal, metode_bayar_spp.metode, spp.bukti_transfer, staff.nama AS nama_staff FROM spp JOIN siswa ON spp.id_siswa = siswa.id JOIN kelas_siswa ON spp.id_kelas_siswa = kelas_siswa.id JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN bulan_akademik ON spp.bulan = bulan_akademik.id JOIN metode_bayar_spp ON spp.metode_bayar = metode_bayar_spp.id JOIN staff ON spp.id_staff = staff.id WHERE spp.id=" . $idtr)->row_array();
                    $data["strukSPP"]["status"] = '';
                    $data["strukSPP"]["keterangan"] = '';
                }
                $this->load->view('admin/paidoffsppmodalcontent', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function changesppstatus($idsiswa, $idkelas, $tahun, $th)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data = [
                    "csrf" => $this->csrf,
                    "siswa" => $this->db->query("SELECT id,nomor_induk,nama,status_spp,id_detail_status_spp FROM siswa WHERE id=" . $idsiswa)->row_array(),
                    "id_kelas" => $idkelas,
                    "tahun" => $tahun . '/' . $th,
                    "status_spp" => $this->db->get('spp_status')->result_array(),
                    "nominal_spp" => $this->db->query('SELECT * FROM nominal_spp ORDER BY id DESC')->result_array()
                ];
                if (isset($_POST["submit"])) {
                    echo json_encode($this->Admin->ubahStatusSpp($this->input->post()));
                    $this->load->view('admin/halamankosong');
                } else {
                    $this->load->view('admin/changesppstatus', $data);
                }
            } else {
                redirect('admin');
            }
        }
    }

    public function getallnominalsppajax()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $result = $this->db->query('SELECT * FROM nominal_spp ORDER BY id DESC')->result_array();
                $data = [];
                foreach ($result as $r) {
                    $r["nominal"] = rupiah($r["nominal"]);
                    $data[] = $r;
                }
                echo json_encode($data);
                $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function sppmainstudentsearch($keyword, $tahunajar, $thajaran)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $keyword = str_ireplace('%20', ' ', $keyword);
                if ($keyword !== 'all_students') {
                    $data["result"]["onclass"] = $this->db->query("SELECT kelas_siswa.*, siswa.nama, siswa.nomor_induk, siswa.nisn, kelas.class AS kelas FROM kelas_siswa JOIN siswa ON kelas_siswa.id_siswa = siswa.id JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE (siswa.nama LIKE '%" . $keyword . "%' OR siswa.nomor_induk LIKE '%" . $keyword . "%' OR siswa.nisn LIKE '%" . $keyword . "%') AND kelas_siswa.tahun='" . $tahunajar . "/" . $thajaran . "' AND kelas_siswa.id_kelas != 'NULL'")->result_array();
                    $offclass = $this->db->query("SELECT * FROM siswa WHERE nama LIKE '%" . $keyword . "%' OR nomor_induk LIKE '%" . $keyword . "%' OR nisn LIKE '%" . $keyword . "%'")->result_array();
                } else {
                    $data["result"]["onclass"] = $this->db->query("SELECT kelas_siswa.*, siswa.nama, siswa.nomor_induk, siswa.nisn, kelas.class AS kelas FROM kelas_siswa JOIN siswa ON kelas_siswa.id_siswa = siswa.id JOIN kelas ON kelas_siswa.id_kelas=kelas.id WHERE kelas_siswa.tahun='" . $tahunajar . "/" . $thajaran . "' AND kelas_siswa.id_kelas != 'NULL'")->result_array();
                    $offclass = $this->db->get("siswa")->result_array();
                }
                $onIdSiswa = [];
                foreach ($data["result"]["onclass"] as $on) {
                    $onIdSiswa[] = $on["id_siswa"];
                }
                $offclasscontainer = [];

                foreach ($offclass as $off) {
                    if (
                        !in_array($off["id"], $onIdSiswa)
                        && $this->_sppStudentSearch($off["id"], $tahunajar, $thajaran)["kelas"][0] !== "lulus"
                        && $this->_sppStudentSearch($off["id"], $tahunajar, $thajaran)["kelas"][0] !== "belum daftar"
                    ) {
                        $offclasscontainer[] = $off;
                    }
                }

                $data["result"]["offclass"] = $offclasscontainer;
                $data["tahun_ajaran"] = $tahunajar . "/" . $thajaran;
                $this->load->view('admin/sppmainstudentsearch', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function sppsiswa($idkelas, $tahunajaran, $thajaran, $idsiswa, $idtransaksi = null)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $this->_sppPerTahun($idkelas, $tahunajaran, $thajaran, idtransaksi: $idtransaksi, idsiswa: $idsiswa, spp_untuk_kelas: false);
            } else {
                redirect('admin');
            }
        }
    }

    private function _sppStudentSearch($idsiswa, $tahunajaran, $thajaran)
    {
        $data["id_siswa"] = $idsiswa;
        $tahunSebelumnya = (string)(((int)$tahunajaran) - 1) . "/" . (string)(((int)$thajaran) - 1);
        $duaTahunSebelumnya = (string)(((int)$tahunajaran) - 2) . "/" . (string)(((int)$thajaran) - 2);
        $tigaTahunSebelumnya = (string)(((int)$tahunajaran) - 3) . "/" . (string)(((int)$thajaran) - 3);
        $empatTahunSebelumnya = (string)(((int)$tahunajaran) - 4) . "/" . (string)(((int)$thajaran) - 4);
        $limaTahunSebelumnya = (string)(((int)$tahunajaran) - 5) . "/" . (string)(((int)$thajaran) - 5);
        $enamTahunSebelumnya = (string)(((int)$tahunajaran) - 6) . "/" . (string)(((int)$thajaran) - 6);
        $tahunSetelahnya = (string)(((int)$tahunajaran) + 1) . "/" . (string)(((int)$thajaran) + 1);
        $duaTahunSetelahnya = (string)(((int)$tahunajaran) + 2) . "/" . (string)(((int)$thajaran) + 2);
        $tigaTahunSetelahnya = (string)(((int)$tahunajaran) + 3) . "/" . (string)(((int)$thajaran) + 3);
        $empatTahunSetelahnya = (string)(((int)$tahunajaran) + 4) . "/" . (string)(((int)$thajaran) + 4);
        $limaTahunSetelahnya = (string)(((int)$tahunajaran) + 5) . "/" . (string)(((int)$thajaran) + 5);
        $enamTahunSetelahnya = (string)(((int)$tahunajaran) + 6) . "/" . (string)(((int)$thajaran) + 6);
        $kelasTahunSebelumnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $tahunSebelumnya . "'")->row_array();
        $kelasDuaTahunSebelumnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $duaTahunSebelumnya . "'")->row_array();
        $kelasTigaTahunSebelumnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $tigaTahunSebelumnya . "'")->row_array();
        $kelasEmpatTahunSebelumnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $empatTahunSebelumnya . "'")->row_array();
        $kelasLimaTahunSebelumnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $limaTahunSebelumnya . "'")->row_array();
        $kelasTahunTahunSebelumnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun<='" . $enamTahunSebelumnya . "'")->row_array();
        $kelasTahunSetelahnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $tahunSetelahnya . "'")->row_array();
        $kelasDuaTahunSetelahnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $duaTahunSetelahnya . "'")->row_array();
        $kelasTigaTahunSetelahnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $tigaTahunSetelahnya . "'")->row_array();
        $kelasEmpatTahunSetelahnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $empatTahunSetelahnya . "'")->row_array();
        $kelasLimaTahunSetelahnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun='" . $limaTahunSetelahnya . "'")->row_array();
        $kelasTahunTahunSetelahnya = $this->db->query('SELECT kelas_siswa.*, kelas.class, siswa.nama FROM kelas_siswa JOIN kelas ON kelas_siswa.id_kelas = kelas.id JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_siswa=' . $idsiswa . " AND kelas_siswa.tahun>='" . $enamTahunSetelahnya . "'")->row_array();
        if ($kelasTahunSebelumnya) {
            switch ($kelasTahunSebelumnya) {
                case ((int)$kelasTahunSebelumnya["id_kelas"] >= 1 && (int)$kelasTahunSebelumnya["id_kelas"] <= 4):
                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=5 AND id<=8")->result_array();
                    break;
                case ((int)$kelasTahunSebelumnya["id_kelas"] >= 5 && (int)$kelasTahunSebelumnya["id_kelas"] <= 8):
                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=9 AND id<=12")->result_array();
                    break;
                case ((int)$kelasTahunSebelumnya["id_kelas"] >= 9 && (int)$kelasTahunSebelumnya["id_kelas"] <= 12):
                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=13 AND id<=16")->result_array();
                    break;
                case ((int)$kelasTahunSebelumnya["id_kelas"] >= 13 && (int)$kelasTahunSebelumnya["id_kelas"] <= 16):
                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=17 AND id<=20")->result_array();
                    break;
                case ((int)$kelasTahunSebelumnya["id_kelas"] >= 17 && (int)$kelasTahunSebelumnya["id_kelas"] <= 20):
                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=21 AND id<=24")->result_array();
                    break;
                case ((int)$kelasTahunSebelumnya["id_kelas"] >= 21):
                    $data["kelas"] = ["lulus"];
                    break;
            }
            $data["reason"] = $kelasTahunSebelumnya;
        } else {
            if ($kelasDuaTahunSebelumnya) {
                switch ($kelasDuaTahunSebelumnya) {
                    case ((int)$kelasDuaTahunSebelumnya["id_kelas"] >= 1 && (int)$kelasDuaTahunSebelumnya["id_kelas"] <= 4):
                        $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=9 AND id<=12")->result_array();
                        break;
                    case ((int)$kelasDuaTahunSebelumnya["id_kelas"] >= 5 && (int)$kelasDuaTahunSebelumnya["id_kelas"] <= 8):
                        $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=13 AND id<=16")->result_array();
                        break;
                    case ((int)$kelasDuaTahunSebelumnya["id_kelas"] >= 9 && (int)$kelasDuaTahunSebelumnya["id_kelas"] <= 12):
                        $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=17 AND id<=20")->result_array();
                        break;
                    case ((int)$kelasDuaTahunSebelumnya["id_kelas"] >= 13 && (int)$kelasDuaTahunSebelumnya["id_kelas"] <= 16):
                        $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=21 AND id<=24")->result_array();
                        break;
                    case ((int)$kelasDuaTahunSebelumnya["id_kelas"] >= 17):
                        $data["kelas"] = ["lulus"];
                        break;
                }
                $data["reason"] = $kelasDuaTahunSebelumnya;
            } else {
                if ($kelasTigaTahunSebelumnya) {
                    switch ($kelasTigaTahunSebelumnya) {
                        case ((int)$kelasTigaTahunSebelumnya["id_kelas"] >= 1 && (int)$kelasTigaTahunSebelumnya["id_kelas"] <= 4):
                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=13 AND id<=16")->result_array();
                            break;
                        case ((int)$kelasTigaTahunSebelumnya["id_kelas"] >= 5 && (int)$kelasTigaTahunSebelumnya["id_kelas"] <= 8):
                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=17 AND id<=20")->result_array();
                            break;
                        case ((int)$kelasTigaTahunSebelumnya["id_kelas"] >= 9 && (int)$kelasTigaTahunSebelumnya["id_kelas"] <= 12):
                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=21 AND id<=24")->result_array();
                            break;
                        case ((int)$kelasTigaTahunSebelumnya["id_kelas"] >= 13):
                            $data["kelas"] = ["lulus"];
                            break;
                    }
                    $data["reason"] = $kelasTigaTahunSebelumnya;
                } else {
                    if ($kelasEmpatTahunSebelumnya) {
                        switch ($kelasEmpatTahunSebelumnya) {
                            case ((int)$kelasEmpatTahunSebelumnya["id_kelas"] >= 1 && (int)$kelasEmpatTahunSebelumnya["id_kelas"] <= 4):
                                $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=17 AND id<=20")->result_array();
                                break;
                            case ((int)$kelasEmpatTahunSebelumnya["id_kelas"] >= 5 && (int)$kelasEmpatTahunSebelumnya["id_kelas"] <= 8):
                                $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=21 AND id<=24")->result_array();
                                break;
                            case ((int)$kelasEmpatTahunSebelumnya["id_kelas"] >= 9):
                                $data["kelas"] = ["lulus"];
                                break;
                        }
                        $data["reason"] = $kelasEmpatTahunSebelumnya;
                    } else {
                        if ($kelasLimaTahunSebelumnya) {
                            switch ($kelasLimaTahunSebelumnya) {
                                case ((int)$kelasLimaTahunSebelumnya["id_kelas"] >= 1 && (int)$kelasLimaTahunSebelumnya["id_kelas"] <= 4):
                                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=21 AND id<=24")->result_array();
                                    break;
                                case ((int)$kelasLimaTahunSebelumnya["id_kelas"] >= 5):
                                    $data["kelas"] = ["lulus"];
                                    break;
                            }
                            $data["reason"] = $kelasLimaTahunSebelumnya;
                        } else {
                            if ($kelasTahunTahunSebelumnya) {
                                if ((int)$kelasTahunTahunSebelumnya["id_kelas"] >= 1) {
                                    $data["kelas"] = ["lulus"];
                                }
                                $data["reason"] = $kelasTahunTahunSebelumnya;
                            } else {
                                if ($kelasTahunSetelahnya) {
                                    switch ($kelasTahunSetelahnya) {
                                        case ((int)$kelasTahunSetelahnya["id_kelas"] >= 21 && (int)$kelasTahunSetelahnya["id_kelas"] <= 24):
                                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=17 AND id<=20")->result_array();
                                            break;
                                        case ((int)$kelasTahunSetelahnya["id_kelas"] >= 17 && (int)$kelasTahunSetelahnya["id_kelas"] <= 20):
                                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=13 AND id<=16")->result_array();
                                            break;
                                        case ((int)$kelasTahunSetelahnya["id_kelas"] >= 13 && (int)$kelasTahunSetelahnya["id_kelas"] <= 16):
                                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=9 AND id<=12")->result_array();
                                            break;
                                        case ((int)$kelasTahunSetelahnya["id_kelas"] >= 9 && (int)$kelasTahunSetelahnya["id_kelas"] <= 12):
                                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=5 AND id<=8")->result_array();
                                            break;
                                        case ((int)$kelasTahunSetelahnya["id_kelas"] >= 5 && (int)$kelasTahunSetelahnya["id_kelas"] <= 8):
                                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=1 AND id<=4")->result_array();
                                            break;
                                        case ((int)$kelasTahunSetelahnya["id_kelas"] <= 4):
                                            $data["kelas"] = ["belum daftar"];
                                            break;
                                    }
                                    $data["reason"] = $kelasTahunSetelahnya;
                                } else {
                                    if ($kelasDuaTahunSetelahnya) {
                                        switch ($kelasDuaTahunSetelahnya) {
                                            case ((int)$kelasDuaTahunSetelahnya["id_kelas"] >= 21 && (int)$kelasDuaTahunSetelahnya["id_kelas"] <= 24):
                                                $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=13 AND id<=16")->result_array();
                                                break;
                                            case ((int)$kelasDuaTahunSetelahnya["id_kelas"] >= 17 && (int)$kelasDuaTahunSetelahnya["id_kelas"] <= 20):
                                                $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=9 AND id<=12")->result_array();
                                                break;
                                            case ((int)$kelasDuaTahunSetelahnya["id_kelas"] >= 13 && (int)$kelasDuaTahunSetelahnya["id_kelas"] <= 16):
                                                $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=5 AND id<=8")->result_array();
                                                break;
                                            case ((int)$kelasDuaTahunSetelahnya["id_kelas"] >= 9 && (int)$kelasDuaTahunSetelahnya["id_kelas"] <= 12):
                                                $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=1 AND id<=4")->result_array();
                                                break;
                                            case ((int)$kelasDuaTahunSetelahnya["id_kelas"] <= 8):
                                                $data["kelas"] = ["belum daftar"];
                                                break;
                                        }
                                        $data["reason"] = $kelasDuaTahunSetelahnya;
                                    } else {
                                        if ($kelasTigaTahunSetelahnya) {
                                            switch ($kelasTigaTahunSetelahnya) {
                                                case ((int)$kelasTigaTahunSetelahnya["id_kelas"] >= 21 && (int)$kelasTigaTahunSetelahnya["id_kelas"] <= 24):
                                                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=9 AND id<=12")->result_array();
                                                    break;
                                                case ((int)$kelasTigaTahunSetelahnya["id_kelas"] >= 17 && (int)$kelasTigaTahunSetelahnya["id_kelas"] <= 20):
                                                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=5 AND id<=8")->result_array();
                                                    break;
                                                case ((int)$kelasTigaTahunSetelahnya["id_kelas"] >= 13 && (int)$kelasTigaTahunSetelahnya["id_kelas"] <= 16):
                                                    $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=1 AND id<=4")->result_array();
                                                    break;
                                                case ((int)$kelasTigaTahunSetelahnya["id_kelas"] <= 12):
                                                    $data["kelas"] = ["belum daftar"];
                                                    break;
                                            }
                                            $data["reason"] = $kelasTigaTahunSetelahnya;
                                        } else {
                                            if ($kelasEmpatTahunSetelahnya) {
                                                switch ($kelasEmpatTahunSetelahnya) {
                                                    case ((int)$kelasEmpatTahunSetelahnya["id_kelas"] >= 21 && (int)$kelasEmpatTahunSetelahnya["id_kelas"] <= 24):
                                                        $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=5 AND id<=8")->result_array();
                                                        break;
                                                    case ((int)$kelasEmpatTahunSetelahnya["id_kelas"] >= 17 && (int)$kelasEmpatTahunSetelahnya["id_kelas"] <= 20):
                                                        $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=1 AND id<=4")->result_array();
                                                        break;
                                                    case ((int)$kelasEmpatTahunSetelahnya["id_kelas"] <= 16):
                                                        $data["kelas"] = ["belum daftar"];
                                                        break;
                                                }
                                                $data["reason"] = $kelasEmpatTahunSetelahnya;
                                            } else {
                                                if ($kelasLimaTahunSetelahnya) {
                                                    switch ($kelasLimaTahunSetelahnya) {
                                                        case ((int)$kelasLimaTahunSetelahnya["id_kelas"] >= 21 && (int)$kelasLimaTahunSetelahnya["id_kelas"] <= 24):
                                                            $data["kelas"] = $this->db->query("SELECT * FROM kelas WHERE id>=1 AND id<=4")->result_array();
                                                            break;
                                                        case ((int)$kelasLimaTahunSetelahnya["id_kelas"] <= 20):
                                                            $data["kelas"] = ["belum daftar"];
                                                            break;
                                                    }
                                                    $data["reason"] = $kelasLimaTahunSetelahnya;
                                                } else {
                                                    if ($kelasTahunTahunSetelahnya) {
                                                        if ((int)$kelasTahunTahunSetelahnya["id_kelas"] >= 1 && (int)$kelasTahunTahunSetelahnya["id_kelas"] <= 24) {
                                                            $data["kelas"] = ["belum daftar"];
                                                        }
                                                        $data["reason"] = $kelasTahunTahunSetelahnya;
                                                    } else {
                                                        $data["kelas"] = $this->db->get("kelas")->result_array();
                                                        $data["reason"] = [
                                                            "nama" => $this->db->query('SELECT nama FROM siswa WHERE id=' . $idsiswa)->row_array()["nama"],
                                                            "class" => null,
                                                            "tahun" => null,
                                                        ];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }

    public function sppinsertstudenttoclass($idsiswa, $tahunajaran, $thajaran)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data = $this->_sppStudentSearch($idsiswa, $tahunajaran, $thajaran);
                $data["academic_year_of_search"] = $tahunajaran . '/' . $thajaran;
                $data["id_siswa"] = $idsiswa;
                $data["csrf"] = $this->csrf;
                $this->load->view('admin/insertstudenttoclass', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function sppinsertstudentajax()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                if (isset($_POST["submit"])) {
                    echo json_encode($this->Admin->masukkanKelas($this->input->post('id_siswa'), $this->input->post('id_kelas'), $this->input->post('tahun')));
                }
                $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function sppkelasinsertstudent()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                if (isset($_POST["submit"])) {
                    $idsiswa = $this->input->post("id_siswa");
                    $idkelas = $this->input->post("id_kelas");
                    $tahun = $this->input->post('tahun');
                    echo json_encode($this->Admin->masukkanKelas($idsiswa, $idkelas, $tahun));
                }
                $this->load->view('admin/halamankosong');
            } else {
                redirect('admin');
            }
        }
    }

    public function cetaksppkelastemplate($idKelas, $tahunAjaran, $thAjaran)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $tahunAkademik = $tahunAjaran . "/" . $thAjaran;
                $data["kelas"] = $this->db->query('SELECT * FROM kelas WHERE id=' . $idKelas)->row_array();
                $data["tahunpelajaran"] = $tahunAjaran . " - " . (int)$tahunAjaran + 1;
                $data["bulan_akademik"] = $this->db->get('bulan_akademik')->result_array();
                $data["siswa"] = $this->db->query("SELECT kelas_siswa.*, siswa.nama, siswa.status_spp  FROM kelas_siswa JOIN siswa ON kelas_siswa.id_siswa = siswa.id WHERE kelas_siswa.id_kelas=" . $idKelas . " AND tahun='" . $tahunAkademik . "'")->result_array();
                $data["spp"] = $this->db->query("SELECT spp.*, kelas_siswa.id_kelas FROM spp JOIN kelas_siswa ON spp.id_kelas_siswa = kelas_siswa.id WHERE spp.tahun_ajaran='" . $tahunAkademik . "' AND kelas_siswa.id_kelas=" . $idKelas)->result_array();
                $this->load->view('admin/templatecetaksppkelas', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function cetaksppkelas($idKelas, $tahunAjaran, $thAjaran)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $this->db->where('id', $idKelas);
                $kelas = $this->db->get("kelas")->row_array();
                $tahunAkademik = $tahunAjaran . "/" . $thAjaran;
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [330, 215]]);
                $mpdf->SetTitle('Buku SPP Kelas ' . $kelas["class"]);
                $stylesheet = file_get_contents(base_url('assets/css/sppcetak.css'));
                $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER['HTTP_COOKIE'] . "\r\n"));
                $context = stream_context_create($opts);
                session_write_close();
                $html = file_get_contents(base_url('admin/cetaksppkelastemplate/' . $idKelas . '/' . $tahunAkademik), false, $context);
                session_start();
                $mpdf->writeHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
                $mpdf->writeHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
                $mpdf->Output('Data SPP kelas ' . $kelas["class"] . '.pdf', 'D');
            } else {
                redirect('admin');
            }
        }
    }

    public function keuangan()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data["title"] = "Buku SPP";
                $data["total_spp_masuk"] = $this->db->query("SELECT SUM(nominal) FROM spp WHERE tahun_ajaran='2022/23'")->result_array();
                $tahunajaran = $this->db->query('SELECT DISTINCT tahun_ajaran FROM spp ORDER BY tahun_ajaran DESC')->result_array();
                $allAcademicYears = [];
                if ($tahunajaran) {
                    foreach ($tahunajaran as $ta) {
                        $allAcademicYears[] = $ta["tahun_ajaran"];
                    }
                } else {
                    $allAcademicYears[] = $this->tahunAjar;
                }
                if (!in_array($this->tahunAjar, $allAcademicYears)) {
                    $allAcademicYears[] = $this->tahunAjar;
                    arsort($allAcademicYears);
                }
                $data["tahunajaran"] = $allAcademicYears;
                $data["total_spp_masuk"] = $this->db->query("SELECT SUM(nominal) AS total_spp FROM spp WHERE tahun_ajaran='" . $this->tahunAjar . "'")->row_array();
                $data["bulan"] = $this->db->get('bulan_akademik')->result_array();
                $idBulanIni = $this->db->query("SELECT id FROM bulan_akademik WHERE angka_bulan=" . (int)date('m'))->row_array()["id"];
                $data["total_spp_bulan"] = $this->db->query("SELECT SUM(nominal) AS total_spp_bulan FROM spp WHERE tahun_ajaran='" . $this->tahunAjar . "' AND bulan=" . $idBulanIni)->row_array();
                $sudahbayar = $this->db->query("SELECT id_siswa FROM spp WHERE bulan =" . $idBulanIni . " AND tahun_ajaran='" . $this->tahunAjar . "'")->result_array();
                $idsudahbayar = [];
                foreach ($sudahbayar as $sb) {
                    $idsudahbayar[] = $sb["id_siswa"];
                }

                $semuaSiswaAktif = $this->db->query("SELECT kelas_siswa.*, siswa.nama, siswa.no_hp_ortu FROM kelas_siswa JOIN siswa ON kelas_siswa.id_siswa=siswa.id WHERE kelas_siswa.tahun='" . $this->tahunAjar . "'")->result_array();
                $siswaBelumBayar = [];
                foreach ($semuaSiswaAktif as $ssa) {
                    if (!in_array($ssa["id_siswa"], $idsudahbayar)) {
                        $siswaBelumBayar[] = $ssa;
                    }
                }
                $data["pada_belum_bayar"] = $siswaBelumBayar;
                $this->load->view('admin/header', $data);
                $this->load->view("admin/sppkeuangan");
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function belumbayar($idbulan, $tahunajaran, $thajaran)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "2") {
                $data["title"] = "Buku SPP";
                $tahunAjaran = $tahunajaran . "/" . $thajaran;
                $namaBulan = $this->db->query("SELECT nama_bulan FROM bulan_akademik WHERE id=" . $idbulan)->row_array()["nama_bulan"];
                $sudahbayar = $this->db->query("SELECT id_siswa FROM spp WHERE bulan =" . $idbulan . " AND tahun_ajaran='" . $tahunAjaran . "'")->result_array();
                $idsudahbayar = [];
                foreach ($sudahbayar as $sb) {
                    $idsudahbayar[] = $sb["id_siswa"];
                }

                $semuaSiswaAktif = $this->db->query("SELECT kelas_siswa.*, siswa.nama,siswa.no_hp_ortu FROM kelas_siswa JOIN siswa ON kelas_siswa.id_siswa=siswa.id WHERE kelas_siswa.tahun='" . $tahunAjaran . "'")->result_array();
                $siswaBelumBayar = [];
                foreach ($semuaSiswaAktif as $ssa) {
                    if (!in_array($ssa["id_siswa"], $idsudahbayar)) {
                        $siswaBelumBayar[] = $ssa;
                    }
                }
                $data["pada_belum_bayar"] = $siswaBelumBayar;
                $this->load->view("admin/sppbelumpadabayar", $data);
            } else {
                redirect('admin');
            }
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
        netralize();
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
        netralize();
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
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function materi()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data['title'] = 'Materi Terbaru';
                $data['materi'] = $this->db->query("SELECT materi.id, kelas.class, mapel.nama_mapel, materi.chapter, materi.material, materi.date FROM materi JOIN kelas ON kelas.id = materi.class_id JOIN mapel ON mapel.id = materi.subject ORDER BY materi.id DESC LIMIT 35")->result_array();

                $this->load->view('admin/header', $data);
                $this->load->view('admin/materi');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function detailmateri($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function ubahmateri($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function hapusmateri($id)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                $data['title'] = 'Detail Materi';
                $this->db->where('id', $id);
                $this->db->delete('materi');
                redirect('admin/materi');
            } else {
                redirect('admin');
            }
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
            if ($this->session->userdata('role') == "9") {

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
            } else {
                redirect('admin');
            }
        }
    }

    public function wali()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function calonsiswa()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function pendaftartersimpan()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function daftar($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                netralize();
                $this->session->unset_userdata('sukses');
                $data['title'] = 'Berhasil';
                $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
                $data['id'] = $id;
                $this->load->view('admin/header', $data);
                $this->load->view('admin/sukses');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function detailpendaftar($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                netralize();
                $data['calon_siswa'] = $this->Pendaftaran->detail($id);
                $data['title'] = 'Pendaftaran';
                $data['description'] = 'Detail calon siswa of SDI Al-Khairiyah Banyuwangi';
                $this->load->view('admin/header', $data);
                $this->load->view('admin/detailpendaftar');
                $this->load->view('admin/footer');
            } else {
                redirect('admin');
            }
        }
    }

    public function cetak($id)
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function cetakexcell()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function registerduplication()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    //-------------------- Akhir Pendaftaran ------------------------------

    public function uploadmediatk()
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
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
            } else {
                redirect('admin');
            }
        }
    }

    public function newattach()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9") {
                netralize();
                $this->load->view('admin/newattach');
            } else {
                redirect('admin');
            }
        }
    }

    public function livetime()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            netralize();
            $this->load->view('admin/livetime');
        }
    }
    public function togglesidebar()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            netralize();
            if ($this->session->userdata("toggle") == "toggled") {
                $this->session->set_userdata("toggle", "not_toggled");
            } else {
                $this->session->set_userdata("toggle", "toggled");
            }
        }
    }

    public function tambahkelas($idstaff, $csrfname, $csrfhash)
    {
        netralize();
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1" || $this->session->userdata('role') == "4") {
                $tahunTerpilih = $this->db->query('SELECT tahun FROM wali_kelas WHERE id_staff ="' . $idstaff . '"')->result_array();
                $arrayTahunTerpilih = [];

                foreach ($tahunTerpilih as $tt) {
                    $arrayTahunTerpilih[] = $tt["tahun"];
                }

                $pilihanTahun = [];

                for ($i = 0; $i < 30; $i++) {

                    $year = (int)date("Y") - $i - 1;
                    $yr = (int)date("Y") - $i;

                    if (strlen((string)$yr) == 1) {
                        $strYr = "0" . substr((string)$yr, 2);
                    } else {
                        $strYr = substr((string)$yr, 2);
                    }

                    $tahunAjar = (string)$year . "/" . $strYr;
                    if (!in_array($tahunAjar, $arrayTahunTerpilih)) {
                        $pilihanTahun[] = $tahunAjar;
                    }
                }

                $data["tahun"] = $pilihanTahun;
                $data["idstaff"] = $idstaff;
                $data["csrfname"] = $csrfname;
                $data["csrfhash"] = $csrfhash;
                $this->load->view('admin/pilihtahun', $data);
            } else {
                redirect('admin');
            }
        }
    }


    public function redirectPilihKelas()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('role') == "9" || $this->session->userdata('role') == "1" || $this->session->userdata('role') == "4") {
                netralize();
                if (isset($_POST["submit"])) {
                    $this->session->set_userdata('tahun', $this->input->post('pilihtahun'));
                    redirect('admin/pilihkelas2/' . $this->input->post('id_staff') . '/' . $this->input->post('pilihtahun'));
                }
            } else {
                redirect('admin');
            }
        }
    }

    public function cleareditbiodataflasdatasession()
    {
        $this->session->unset_userdata('editBiodataAlert');
        $this->session->unset_userdata('suksestambahkelas');
    }

    public function fallback()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/login');
        } else {
            $data["title"] = "Internet Terputus";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/fallback');
            $this->load->view('admin/footer');
        }
    }

    public function logout()
    {
        netralize();
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('id_staff');
        // $this->session->unset_userdata('toggle');
        $this->session->unset_userdata('id_kelas');
        $this->session->unset_userdata('tahun');
        $this->session->unset_userdata('success');
        redirect('admin');
    }
}
