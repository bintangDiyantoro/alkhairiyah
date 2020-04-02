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

    private function _regex(){
        $string = "/^". "(0[1-9]|1[0-9]|2[0-9]|3[0-1])-(0[1-9]|1[0-2])-201[2-4]$/";
        if (preg_match($string, $this->input->post('tgl_lahir'))) {
            return 1;
        }else{
            return 0;
        }
    }

    private function _fillTheForm(){
        $data['title'] = 'Pendaftaran';
        $data['csrf'] = $this->csrf;
        $this->load->view('templates/header', $data);
        $this->load->view('pendaftaran/index');
        $this->load->view('templates/footer');
    }
    
    private function _validateFormOrtu(){
        $this->form_validation->set_rules('nama_ayah', 'nama_ayah', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]',['required' => 'nama ayah wajib diisi','regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)','max_length'=>'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_ayah', 'alamat_ayah', 'required|regex_match[/^[a-z0-9,.\/":&-()\s\']+$/i]|max_length[255]',['required' => 'alamat ayah wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length'=>'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pekerjaan_ayah', 'pekerjaan_ayah', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_ayah', 'pendterakhir_ayah','regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir ayah tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('keterangan_ayah', 'keterangan_ayah', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid','max_length'=>'keterangan tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('nohape_ayah', 'nohape_ayah', 'numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid','min_length'=>'nomor hp minimal berisi 11 digit','max_length'=>'nomor hp maksimal berisi 15 digit']);
        $this->form_validation->set_rules('nama_ibu', 'nama_ibu', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama ibu wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_ibu', 'alamat_ibu', 'required|regex_match[/^[a-z0-9,.\/":&-()\s\']+$/i]|max_length[255]', ['required' => 'alamat ibu wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pekerjaan_ibu', 'pekerjaan_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_ibu', 'pendterakhir_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir ibu tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('keterangan_ibu', 'keterangan_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'keterangan tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('nohape_ibu', 'nohape_ibu', 'numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
        $this->form_validation->set_rules('wali','wali', 'required|in_list[Ayah,Ibu,Lainnya]',['required'=> 'Setiap siswa harus memiliki wali murid, silahkan pilih wali murid terlebih dahulu!']);
    }

    private function _validateFormWali(){
        $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama wali wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_wali', 'alamat_wali', 'required|regex_match[/^[a-z0-9,.\/":&-()\s\']+$/i]|max_length[255]', ['required' => 'alamat wali wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('status_wali', 'status_wali', 'required|regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['required' => 'status wali wajib diisi','regex_match' => 'karakter inputan tidak valid', 'max_length' => 'status tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('pekerjaan_wali', 'pekerjaan_wali', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_wali', 'pendterakhir_wali', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir wali tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('nohape_wali', 'nohape_wali', 'required|numeric|min_length[11]|max_length[15]', ['required' => 'nomor hp wali tidak boleh kosong', 'numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
    }

    private function _validateFormCalonSiswa(){
        $this->form_validation->set_rules('nama_calon_siswa', 'nama_calon_siswa', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama wali wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required|in_list[L,P]', ['required' => 'jenis kelamin wajib dipilih']);
        $this->form_validation->set_rules('tgl_lahir2','tgl_lahir2', 'require',['require'=>'tanggal lahir wajib diisi']);
        $this->form_validation->set_rules('asal_tk', 'asal_tk', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'asal tk tidak boleh lebih dari 50 karakter']);
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
        $this->session->unset_userdata('search');
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
        if($this->session->userdata('wali') == 'Lainnya' && $this->csrf['name'] == $this->security->get_csrf_token_name() && $this->csrf['hash'] == $this->security->get_csrf_hash()){
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
        if($this->session->userdata('stwali') == 'valid' && $this->csrf['name'] == $this->security->get_csrf_token_name() && $this->csrf['hash'] == $this->security->get_csrf_hash()){

            if($this->input->post('jenis_kelamin') == 'L'){
                $this->session->set_userdata('jenis_kelamin', 'L');
            }elseif($this->input->post('jenis_kelamin') == 'P'){
                $this->session->set_userdata('jenis_kelamin', 'P');
            }else{
                $this->session->set_userdata('jenis_kelamin', null);
            }

            $this->_validateFormCalonSiswa();
            $this->_regex();
            if($this->form_validation->run() == FALSE && $this->_regex() == 0){
                if (isset($_POST['submit'])) {
                    $this->session->set_userdata('error', 'error');
                    $this->session->set_userdata('regex', 'input tidak valid atau usia di bawah 6 tahun / di atas 7,6 tahun');
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
                // var_dump($data_calon_siswa);
            }
        }elseif($this->session->userdata('wali') == 'Lainnya'){
            redirect('pendaftaran/wali');
        }else{
            redirect('pendaftaran');
        }
    }

    public function tersimpan(){
        $data['title'] = 'Pendaftaran';
        $data['csrf'] = $this->csrf;
        if($this->input->post('search') || isset($_POST['search'])){
            $keyword=$this->input->post('search');
            $this->session->set_userdata('search', $this->input->post('search'));
            $data['start'] = NULL;
        }else{
            $keyword = $this->session->userdata('search');
            $this->session->unset_userdata('search');
            $data['start'] = $this->uri->segment(3);
        }
        $this->db->like('nama', $keyword);
        $result = $this->db->get('calon_siswa')->num_rows();
        $config['base_url'] = base_url().'pendaftaran/tersimpan';
        $config['total_rows'] = $result;
        $config['per_page'] = 8;
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
        $this->db->limit($config['per_page']);
        $this->db->like('nama', $keyword);
        $this->db->or_like('id_cs', $keyword);
        $data['calon_siswa'] = $this->db->get('calon_siswa',$config['per_page'],$data['start'])->result_array();
        // var_dump($data['calon_siswa']);die;
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