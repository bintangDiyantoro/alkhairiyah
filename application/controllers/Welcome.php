<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('ModelPendaftaran','Pendaftaran');
	}
	private function _netralize(){
		$this->session->unset_userdata('nama_ayah');
		$this->session->unset_userdata('alamat_ayah');
		$this->session->unset_userdata('pekerjaan_ayah');
		$this->session->unset_userdata('pendterakhir_ayah');
		$this->session->unset_userdata('keterangan_ayah');
		$this->session->unset_userdata('nohape_ayah');
		$this->session->unset_userdata('nama_ibu');
		$this->session->unset_userdata('alamat_ibu');
		$this->session->unset_userdata('pekerjaan_ibu');
		$this->session->unset_userdata('pendterakhir_ibu');
		$this->session->unset_userdata('keterangan_ibu');
		$this->session->unset_userdata('nohape_ibu');
		$this->session->unset_userdata('nama_wali');
		$this->session->unset_userdata('alamat_wali');
		$this->session->unset_userdata('status_wali');
		$this->session->unset_userdata('pekerjaan_wali');
		$this->session->unset_userdata('pendterakhir_wali');
		$this->session->unset_userdata('nohape_wali');
		$this->session->unset_userdata('stwali');
        $this->session->unset_userdata('wali');
	}
	public function index()
	{
		$this->_netralize();
		$data['title'] = 'Home';
		$id = $this->session->userdata('id_calon_siswa');
		$data['calon_siswa'] = $this->Pendaftaran->getCalonSiswa($id);
		$this->load->view('templates/header', $data);
		$this->load->view('home/index');
		$this->load->view('templates/footer');
	}
	
}
