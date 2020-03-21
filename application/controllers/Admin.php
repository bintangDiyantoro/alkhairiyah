<?php

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPendaftaran', 'Pendaftaran');
        $this->csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
    }

    public function index(){
        if($this->session->userdata('admin')){
            $this->session->unset_userdata('error');
            redirect('admin/dashboard');
        } else {            
            $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'Nama admin wajib diisi', 'regex_match' => 'Nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'Nama maksimal 50 huruf']);
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'required' => 'Password wajib diisi',
            'min_length' => 'Password minimal 3 karakter!'
            ]);
            
            $data['csrf'] = $this->csrf;
            if($this->form_validation->run() == FALSE){
                $data['title'] = 'Login';
                $this->load->view('admin/login',$data);
                $this->session->unset_userdata('error');
            } else {
                $this->db->where('name', $this->input->post('name'));
                $this->db->from('admin');
                $query = $this->db->get()->row_array();
                if($query != NULL && password_verify($this->input->post('password'), $query['password']) == TRUE){
                    if($query['verified'] == 1){
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
    }

    public function register(){
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-z-\s\']+$/i]|max_length[50]', ['required' => 'nama admin wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required'=>'Password wajib diisi',
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password minimal 3 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        $data['csrf'] = $this->csrf;
        
        if($this->form_validation->run() == FALSE){
            $data['title'] = 'Registrasi';
            $this->load->view('admin/register', $data);
        }else{
            $data = [
                'name' => $this->input->post('name'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'verified' => 0
            ];
            $this->db->insert('admin',$data);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Registrasi sukses! Silahkan hubungi Ust. Arif Isnandi untuk verifikasi');
                redirect('admin');
            }
        }
    }

    public function dashboard(){
        $data['title'] = 'Dashboard';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }

    public function notfound(){
        $data['title'] = 'Not Found';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/404');
        $this->load->view('admin/footer');
    }

    public function postDakwah(){
        $data['title'] = 'Buat Artikel Dakwah';
        $data['csrf'] = $this->csrf;
        $this->load->view('admin/header', $data);
        $this->load->view('admin/postdakwah');
        $this->load->view('admin/footer');
    }

    public function dakwah(){
        $data['title'] = 'Dakwah';
        $data['dakwah'] = $this->db->get('test')->result_array();
        // var_dump($data); die;
        $this->load->view('admin/header', $data);
        $this->load->view('admin/dakwah');
        $this->load->view('admin/footer');
    }

    public function post(){
        $data['content'] = $this->input->post('content');
        $this->db->insert('test',$data);
    }

    public function logout(){
        $this->session->unset_userdata('admin');
        redirect('admin');
    }
}