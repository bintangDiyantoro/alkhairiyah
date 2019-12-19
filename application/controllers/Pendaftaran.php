<?php 

class Pendaftaran extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPendaftaran','Pendaftaran');
        $this->csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
    }

    private function _fillTheForm(){
        $data['title'] = 'Pendaftaran';
        $data['csrf'] = $this->csrf;
        $this->load->view('templates/header', $data);
        $this->load->view('pendaftaran/index');
        $this->load->view('templates/footer');
    }
    
    private function _validateFormOrtu(){
        $this->form_validation->set_rules('nama_ayah', 'nama_ayah', 'required|alpha_numeric_spaces', ['required' => 'nama ayah wajib diisi','alpha_numeric_spaces' => 'nama tidak boleh mengandung selain huruf latin']);
        $this->form_validation->set_rules('alamat_ayah', 'alamat_ayah', 'required', ['required' => 'alamat ayah wajib diisi']);
        $this->form_validation->set_rules('nohape_ayah', 'nohape_ayah', 'numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid','min_length'=>'nomor hp minimal berisi 11 digit','max_length'=>'nomor hp maksimal berisi 15 digit']);
        $this->form_validation->set_rules('nama_ibu', 'nama_ibu', 'required|alpha_numeric_spaces', ['required' => 'nama ibu wajib diisi', 'alpha_numeric_spaces' => 'nama tidak boleh mengandung selain huruf latin']);
        $this->form_validation->set_rules('alamat_ibu', 'alamat_ibu', 'required', ['required' => 'alamat ibu wajib diisi']);
        $this->form_validation->set_rules('nohape_ibu', 'nohape_ibu', 'numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
        $this->form_validation->set_rules('wali', 'wali', 'required|alpha', ['required' => 'Setiap siswa harus memiliki wali murid, silahkan pilih wali murid terlebih dahulu!']);
    }

    private function _validateFormWali(){
        $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required|alpha_numeric_spaces', ['required' => 'nama wali wajib diisi','alpha_numeric_spaces'=>'nama tidak boleh mengandung selain huruf latin']);
        $this->form_validation->set_rules('alamat_wali', 'alamat_wali', 'required', ['required' => 'alamat wali wajib diisi']);
        $this->form_validation->set_rules('status_wali', 'status_wali', 'required', ['required' => 'status wali wajib diisi']);
        $this->form_validation->set_rules('nohape_wali', 'nohape_wali', 'required|numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid','required' => 'nomor hp wali tidak boleh kosong', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
    }

    private function _validateFormCalonSiswa(){
        $this->form_validation->set_rules('nama_calon_siswa', 'nama_calon_siswa', 'required|alpha_numeric_spaces', ['required' => 'nama calon siswa wajib diisi','alpha_numeric_spaces'=> 'nama tidak boleh mengandung selain huruf latin']);
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required|alpha', ['required' => 'jenis kelamin wajib dipilih']);
        $this->form_validation->set_rules('umur', 'umur', 'required|numeric', ['required' => 'usia calon siswa wajib diisi','numeric' => 'umur hanya boleh diisi dengan angka']);
    }

    private function _dataOrtu($data_ortu){
        $this->Pendaftaran->inputDataOrtu($data_ortu);
    }

    private function _dataWali($data_wali)
    {
        $this->Pendaftaran->inputDataWali($data_wali);
    }

    public function index()
    {
        $this->session->unset_userdata('error');
        if($this->session->userdata('stwali') == 'valid' || $this->session->userdata('wali') == 'Lainnya'){
            $this->session->unset_userdata('first');
        }else{
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
            redirect('pendaftaran/calonsiswa');
        } elseif ($this->input->post('wali') == 'Lainnya') {
            $this->session->unset_userdata('error');
            $this->_dataOrtu($this->security->xss_clean($this->input->post()));
            redirect('pendaftaran/wali');
        }
    }
    
    public function wali(){
        if($this->session->userdata('wali') == 'Lainnya'){
            $this->_validateFormWali();
            if($this->form_validation->run() == FALSE){
                if(isset($_POST['submit'])){
                    $this->session->set_userdata('error', 'error');
                    $this->_dataWali($this->security->xss_clean($this->input->post()));
                }
                $data['title'] = 'Pendaftaran';
                $data['csrf'] = $this->csrf;
                $this->load->view('templates/header', $data);
                $this->load->view('pendaftaran/wali');
                $this->load->view('templates/footer');
            }else{
                $this->session->set_userdata('stwali', 'valid');
                $this->session->unset_userdata('error');
                $this->_dataWali($this->security->xss_clean($this->input->post()));
                redirect('pendaftaran/calonsiswa');
            }
        }else{
            redirect('pendaftaran');
        }
    }
    
    public function calonsiswa(){
        if($this->session->userdata('stwali') == 'valid'){

            if($this->input->post('jenis_kelamin') == 'L'){
                $this->session->set_userdata('jenis_kelamin', 'L');
            }elseif($this->input->post('jenis_kelamin') == 'P'){
                $this->session->set_userdata('jenis_kelamin', 'P');
            }else{
                $this->session->set_userdata('jenis_kelamin', null);
            }

            $this->_validateFormCalonSiswa();
            if($this->form_validation->run() == FALSE){
                if (isset($_POST['submit'])) {
                    $this->session->set_userdata('error', 'error');
                }
                $data['title'] = 'Pendaftaran';
                $data['csrf'] = $this->csrf;
                $this->load->view('templates/header', $data);
                $this->load->view('pendaftaran/calonsiswa');
                $this->load->view('templates/footer');
            }else{
                if($this->session->userdata('wali') == 'Ayah' || $this->session->userdata('wali') == 'Ibu'){
                    $this->session->unset_userdata('nama_wali');
                    $this->session->unset_userdata('alamat_wali');
                    $this->session->unset_userdata('status_wali');
                    $this->session->unset_userdata('pekerjaan_wali');
                    $this->session->unset_userdata('pendterakhir_wali');
                    $this->session->unset_userdata('nohape_wali');
                }
                $this->session->unset_userdata('error');
                $data_calon_siswa = $this->security->xss_clean($this->input->post());
                $this->Pendaftaran->inputDataCalonSiswa($data_calon_siswa);
            }
        }elseif($this->session->userdata('wali') == 'Lainnya'){
            redirect('pendaftaran/wali');
        }else{
            redirect('pendaftaran');
        }
    }

    public function tersimpan(){
        $data['title'] = 'Pendaftaran';
        $data['calon_siswa'] = $this->db->get('calon_siswa')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('pendaftaran/tersimpan');
        $this->load->view('templates/footer');
    }

    public function berhasil(){
        $this->session->unset_userdata('sukses');
    }

    public function detail($id){
        $data['calon_siswa'] = $this->Pendaftaran->detail($id);
        $data['title'] = 'Pendaftaran';
        $this->load->view('templates/header', $data);
        $this->load->view('pendaftaran/detail');
        $this->load->view('templates/footer');
    }
}