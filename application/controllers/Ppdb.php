<?php

require_once 'vendor/autoload.php';

class Ppdb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPendaftaran', 'Pendaftaran');
        $this->csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->listKabupaten = [
            "Aceh Barat",
            "Aceh Barat Daya",
            "Aceh Besar",
            "Aceh Jaya",
            "Aceh Selatan",
            "Aceh Singkil",
            "Aceh Tamiang",
            "Aceh Tengah",
            "Aceh Tenggara",
            "Aceh Timur",
            "Aceh Utara",
            "Bener Meriah",
            "Bireuen",
            "Gayo Lues",
            "Nagan Raya",
            "Pidie",
            "Pidie Jaya",
            "Simeulue",
            "Kota Banda Aceh",
            "Kota Langsa",
            "Kota Lhokseumawe",
            "Kota Sabang",
            "Kota Subulussalam",
            "Badung",
            "Bangli",
            "Buleleng",
            "Gianyar",
            "Jembrana",
            "Karangasem",
            "Klungkung",
            "Tabanan",
            "Kota Denpasar",
            "Lebak",
            "Pandeglang",
            "Serang",
            "Tangerang",
            "Kota Cilegon",
            "Kota Serang",
            "Kota Tangerang",
            "Kota Tangerang Selatan",
            "Bengkulu Selatan",
            "Bengkulu Tengah",
            "Bengkulu Utara",
            "Kaur",
            "Kepahiang",
            "Lebong",
            "Muko Muko",
            "Rejang Lebong",
            "Seluma",
            "Kota Bengkulu",
            "Bantul",
            "Gunungkidul",
            "Kulon Progo",
            "Sleman",
            "Kota Yogyakarta",
            "Adm. Kep. Seribu",
            "Kota Adm. Jakarta Barat",
            "Kota Adm. Jakarta Pusat",
            "Kota Adm. Jakarta Selatan",
            "Kota Adm. Jakarta Timur",
            "Kota Adm. Jakarta Utara",
            "Boalemo",
            "Bone Bolango",
            "Gorontalo",
            "Gorontalo Utara",
            "Pohuwato",
            "Kota Gorontalo",
            "Batanghari",
            "Bungo",
            "Kerinci",
            "Merangin",
            "Muaro Jambi",
            "Sarolangun",
            "Tanjung Jabung Barat",
            "Tanjung Jabung Timur",
            "Tebo",
            "Kota Jambi",
            "Kota Sungai Penuh",
            "Bandung",
            "Bandung Barat",
            "Bekasi",
            "Bogor",
            "Ciamis",
            "Cianjur",
            "Cirebon",
            "Garut",
            "Indramayu",
            "Karawang",
            "Kuningan",
            "Majalengka",
            "Pangandaran",
            "Purwakarta",
            "Subang",
            "Sukabumi",
            "Sumedang",
            "Tasikmalaya",
            "Kota Bandung",
            "Kota Banjar",
            "Kota Bekasi",
            "Kota Bogor",
            "Kota Cimahi",
            "Kota Cirebon",
            "Kota Depok",
            "Kota Sukabumi",
            "Kota Tasikmalaya",
            "Banjarnegara",
            "Banyumas",
            "Batang",
            "Blora",
            "Boyolali",
            "Brebes",
            "Cilacap",
            "Demak",
            "Grobogan",
            "Jepara",
            "Karanganyar",
            "Kebumen",
            "Kendal",
            "Klaten",
            "Kudus",
            "Magelang",
            "Pati",
            "Pekalongan",
            "Pemalang",
            "Purbalingga",
            "Purworejo",
            "Rembang",
            "Semarang",
            "Sragen",
            "Sukoharjo",
            "Tegal",
            "Temanggung",
            "Wonogiri",
            "Wonosobo",
            "Kota Magelang",
            "Kota Pekalongan",
            "Kota Salatiga",
            "Kota Semarang",
            "Kota Surakarta",
            "Kota Tegal",
            "Bangkalan",
            "Banyuwangi",
            "Blitar",
            "Bojonegoro",
            "Bondowoso",
            "Gresik",
            "Jember",
            "Jombang",
            "Kediri",
            "Lamongan",
            "Lumajang",
            "Madiun",
            "Magetan",
            "Malang",
            "Mojokerto",
            "Nganjuk",
            "Ngawi",
            "Pacitan",
            "Pamekasan",
            "Pasuruan",
            "Ponorogo",
            "Probolinggo",
            "Sampang",
            "Sidoarjo",
            "Situbondo",
            "Sumenep",
            "Trenggalek",
            "Tuban",
            "Tulungagung",
            "Kota Batu",
            "Kota Blitar",
            "Kota Kediri",
            "Kota Madiun",
            "Kota Malang",
            "Kota Mojokerto",
            "Kota Pasuruan",
            "Kota Probolinggo",
            "Kota Surabaya",
            "Bengkayang",
            "Kapuas Hulu",
            "Kayong Utara",
            "Ketapang",
            "Kubu Raya",
            "Landak",
            "Melawi",
            "Mempawah",
            "Sambas",
            "Sanggau",
            "Sekadau",
            "Sintang",
            "Kota Pontianak",
            "Kota Singkawang",
            "Balangan",
            "Banjar",
            "Barito Kuala",
            "Hulu Sungai Selatan",
            "Hulu Sungai Tengah",
            "Hulu Sungai Utara",
            "Kotabaru",
            "Tabalong",
            "Tanah Bumbu",
            "Tanah Laut",
            "Tapin",
            "Kota Banjarbaru",
            "Kota Banjarmasin",
            "Barito Selatan",
            "Barito Timur",
            "Barito Utara",
            "Gunung Mas",
            "Kapuas",
            "Katingan",
            "Kotawaringin Barat",
            "Kotawaringin Timur",
            "Lamandau",
            "Murung Raya",
            "Pulang Pisau",
            "Seruyan",
            "Sukamara",
            "Kota Palangkaraya",
            "Berau",
            "Kutai Barat",
            "Kutai Kartanegara",
            "Kutai Timur",
            "Mahakam Ulu",
            "Paser",
            "Penajam Paser Utara",
            "Kota Balikpapan",
            "Kota Bontang",
            "Kota Samarinda",
            "Bulungan",
            "Malinau",
            "Nunukan",
            "Tana Tidung",
            "Kota Tarakan",
            "Bangka",
            "Bangka Barat",
            "Bangka Selatan",
            "Bangka Tengah",
            "Belitung",
            "Belitung Timur",
            "Kota Pangkal Pinang",
            "Bintan",
            "Karimun",
            "Kepulauan Anambas",
            "Lingga",
            "Natuna",
            "Kota Batam",
            "Kota Tanjung Pinang",
            "Lampung Barat",
            "Lampung Selatan",
            "Lampung Tengah",
            "Lampung Timur",
            "Lampung Utara",
            "Mesuji",
            "Pesawaran",
            "Pesisir Barat",
            "Pringsewu",
            "Tanggamus",
            "Tulang Bawang",
            "Tulang Bawang Barat",
            "Way Kanan",
            "Kota Bandar Lampung",
            "Kota Metro",
            "Buru",
            "Buru Selatan",
            "Kepulauan Aru",
            "Kepulauan Tanimbar",
            "Maluku Barat Daya",
            "Maluku Tengah",
            "Maluku Tenggara",
            "Seram Bagian Barat",
            "Seram Bagian Timur",
            "Kota Ambon",
            "Kota Tual",
            "Halmahera Barat",
            "Halmahera Selatan",
            "Halmahera Tengah",
            "Halmahera Timur",
            "Halmahera Utara",
            "Kepulauan Sula",
            "Pulau Morotai",
            "Pulau Taliabu",
            "Kota Ternate",
            "Kota Tidore Kepulauan",
            "Bima",
            "Dompu",
            "Lombok Barat",
            "Lombok Tengah",
            "Lombok Timur",
            "Lombok Utara",
            "Sumbawa",
            "Sumbawa Barat",
            "Kota Bima",
            "Kota Mataram",
            "Alor",
            "Belu",
            "Ende",
            "Flores Timur",
            "Kupang",
            "Lembata",
            "Malaka",
            "Manggarai",
            "Manggarai Barat",
            "Manggarai Timur",
            "Nagekeo",
            "Ngada",
            "Rote Ndao",
            "Sabu Raijua",
            "Sikka",
            "Sumba Barat",
            "Sumba Barat Daya",
            "Sumba Tengah",
            "Sumba Timur",
            "Timor Tengah Selatan",
            "Timor Tengah Utara",
            "Kota Kupang",
            "Biak Numfor",
            "Jayapura",
            "Keerom",
            "Kepulauan Yapen",
            "Mamberamo Raya",
            "Sarmi",
            "Supiori",
            "Waropen",
            "Kota Jayapura",
            "Fak Fak",
            "Kaimana",
            "Manokwari",
            "Manokwari Selatan",
            "Maybrat",
            "Pegunungan Arfak",
            "Raja Ampat",
            "Sorong",
            "Sorong Selatan",
            "Tambrauw",
            "Teluk Bintuni",
            "Teluk Wondama",
            "Kota Sorong",
            "Jayawijaya",
            "Lanny Jaya",
            "Mamberamo Tengah",
            "Nduga",
            "Pegunungan Bintang",
            "Tolikara",
            "Yahukimo",
            "Yalimo",
            "Asmat",
            "Boven Digoel",
            "Mappi",
            "Merauke",
            "Deiyai",
            "Dogiyai",
            "Intan Jaya",
            "Mimika",
            "Nabire",
            "Paniai",
            "Puncak",
            "Puncak Jaya",
            "Bengkalis",
            "Indragiri Hilir",
            "Indragiri Hulu",
            "Kampar",
            "Kepulauan Meranti",
            "Kuantan Singingi",
            "Pelalawan",
            "Rokan Hilir",
            "Rokan Hulu",
            "Siak",
            "Kota Dumai",
            "Kota Pekanbaru",
            "Majene",
            "Mamasa",
            "Mamuju",
            "Mamuju Tengah",
            "Pasangkayu",
            "Polewali Mandar",
            "Bantaeng",
            "Barru",
            "Bone",
            "Bulukumba",
            "Enrekang",
            "Gowa",
            "Jeneponto",
            "Kepulauan Selayar",
            "Luwu",
            "Luwu Timur",
            "Luwu Utara",
            "Maros",
            "Pangkajene Kepulauan",
            "Pinrang",
            "Sidenreng Rappang",
            "Sinjai",
            "Soppeng",
            "Takalar",
            "Tana Toraja",
            "Toraja Utara",
            "Wajo",
            "Kota Makassar",
            "Kota Palopo",
            "Kota Pare Pare",
            "Banggai",
            "Banggai Kepulauan",
            "Banggai Laut",
            "Buol",
            "Donggala",
            "Morowali",
            "Morowali Utara",
            "Parigi Moutong",
            "Poso",
            "Sigi",
            "Tojo Una Una",
            "Toli Toli",
            "Kota Palu",
            "Bombana",
            "Buton",
            "Buton Selatan",
            "Buton Tengah",
            "Buton Utara",
            "Kolaka",
            "Kolaka Timur",
            "Kolaka Utara",
            "Konawe",
            "Konawe Kepulauan",
            "Konawe Selatan",
            "Konawe Utara",
            "Muna",
            "Muna Barat",
            "Wakatobi",
            "Kota Bau Bau",
            "Kota Kendari",
            "Bolaang Mongondow",
            "Bolaang Mongondow Selatan",
            "Bolaang Mongondow Timur",
            "Bolaang Mongondow Utara",
            "Kep. Siau Tagulandang Biaro",
            "Kepulauan Sangihe",
            "Kepulauan Talaud",
            "Minahasa",
            "Minahasa Selatan",
            "Minahasa Tenggara",
            "Minahasa Utara",
            "Kota Bitung",
            "Kota Kotamobagu",
            "Kota Manado",
            "Kota Tomohon",
            "Agam",
            "Dharmasraya",
            "Kepulauan Mentawai",
            "Lima Puluh Kota",
            "Padang Pariaman",
            "Pasaman",
            "Pasaman Barat",
            "Pesisir Selatan",
            "Sijunjung",
            "Solok",
            "Solok Selatan",
            "Tanah Datar",
            "Kota Bukittinggi",
            "Kota Padang",
            "Kota Padang Panjang",
            "Kota Pariaman",
            "Kota Payakumbuh",
            "Kota Sawahlunto",
            "Kota Solok",
            "Banyuasin",
            "Empat Lawang",
            "Lahat",
            "Muara Enim",
            "Musi Banyuasin",
            "Musi Rawas",
            "Musi Rawas Utara",
            "Ogan Ilir",
            "Ogan Komering Ilir",
            "Ogan Komering Ulu",
            "Ogan Komering Ulu Selatan",
            "Ogan Komering Ulu Timur",
            "Penukal Abab Lematang Ilir",
            "Kota Lubuk Linggau",
            "Kota Pagar Alam",
            "Kota Palembang",
            "Kota Prabumulih",
            "Asahan",
            "Batu Bara",
            "Dairi",
            "Deli Serdang",
            "Humbang Hasundutan",
            "Karo",
            "Labuhanbatu",
            "Labuhanbatu Selatan",
            "Labuhanbatu Utara",
            "Langkat",
            "Mandailing Natal",
            "Nias",
            "Nias Barat",
            "Nias Selatan",
            "Nias Utara",
            "Padang Lawas",
            "Padang Lawas Utara",
            "Pakpak Bharat",
            "Samosir",
            "Serdang Bedagai",
            "Simalungun",
            "Tapanuli Selatan",
            "Tapanuli Tengah",
            "Tapanuli Utara",
            "Toba",
            "Kota Binjai",
            "Kota Gunungsitoli",
            "Kota Medan",
            "Kota Padangsidimpuan",
            "Kota Pematangsiantar",
            "Kota Sibolga",
            "Kota Tanjung Balai",
            "Kota Tebing Tinggi",
        ];
        ksort($this->listKabupaten);
        // if ((int)date('m') >= 1 && (int)date('m') <= 6) {
        //     $tahun = (int)date('Y') - 1;
        //     $slash = (int)date('Y');
        //     $this->tahunAjar = (string)$tahun . "/" . (string)$slash;
        // } else {
        $tahun = (int)date('Y');
        $slash = (int)date('Y') + 1;
        $this->tahunAjar = (string)$tahun . "/" . (string)$slash;
        // }
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

    private function _regex()
    {
        $birthyear = (int)date('Y') - 6;
        $by1 = $birthyear - 6;
        $by2 = $birthyear - 5;
        $by3 = $birthyear - 4;
        $by4 = $birthyear - 3;
        $by5 = $birthyear - 2;
        $by6 = $birthyear - 1;
        $pattern = "/^" . "((0[1-9]|[1-2][\d]|3[0-1])-(0[1-9]|1[0-2])-(" . $by1 . "|" . $by2 . "|" . $by2 . "|" . $by3 . "|" . $by4 . "|" . $by5 . "|" . $by6 . ")|((0[1-9]|[1-2][\d]|3[0-1])-0[1-6]|01-07)-" . $birthyear . ")$/";
        $string = ($this->input->post('tgl_lahir')) ? $this->input->post('tgl_lahir') : date('d-m-Y');
        if (preg_match($pattern, $string)) {
            return 1;
        } else {
            return 0;
        }
    }

    private function _fillTheForm()
    {
        $data['csrf'] = $this->csrf;
        $data['title'] = 'Pendaftaran';
        $data["canonical"] = base_url('ppdb');
        $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';

        $count = $this->db->query("SELECT * FROM calon_siswa WHERE tahun = " . date('Y'))->num_rows();

        $this->load->view('templates/header', $data);

        // echo date('mdHi');die;
        $kuota = 170;
        $waktubuka1 = 4250000; // int bulan-tanggaltanggal-jamjam(-7)-menitmenit
        $waktututup1 = 4251400;
        $waktubuka2 = 4260000;
        $waktututup2 = 4261400;

        // if ($count < $kuota && (int)date('mdHi') < $waktututup2) {
        //     if (((int)date('mdHi') >= $waktubuka1 && (int)date('mdHi') <= $waktututup1) || (int)date('mdHi') >= $waktubuka2) {
        //         $this->load->view('pendaftaran/index');
        //     } else {
        //         $this->load->view('pendaftaran/sabar');
        //     }
        $this->load->view('pendaftaran/index');
        // } else {
        //     $this->load->view('pendaftaran/tutup');
        // }
        $this->load->view('templates/footer');
    }

    private function _validateFormOrtu()
    {
        $this->form_validation->set_rules('nama_ayah', 'nama_ayah', 'required|regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', ['required' => 'nama ayah wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_ayah', 'alamat_ayah', 'required|regex_match[/^[a-z0-9,.\/":&\-()\s\']+$/i]|max_length[255]', ['required' => 'alamat ayah wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pekerjaan_ayah', 'pekerjaan_ayah', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_ayah', 'pendterakhir_ayah', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir ayah tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('keterangan_ayah', 'keterangan_ayah', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'keterangan tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('nohape_ayah', 'nohape_ayah', 'numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
        $this->form_validation->set_rules('nama_ibu', 'nama_ibu', 'required|regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', ['required' => 'nama ibu wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_ibu', 'alamat_ibu', 'required|regex_match[/^[a-z0-9,.\/":&\-()\s\']+$/i]|max_length[255]', ['required' => 'alamat ibu wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pekerjaan_ibu', 'pekerjaan_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_ibu', 'pendterakhir_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir ibu tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('keterangan_ibu', 'keterangan_ibu', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'keterangan tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('nohape_ibu', 'nohape_ibu', 'numeric|min_length[11]|max_length[15]', ['numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
        $this->form_validation->set_rules('wali', 'wali', 'required|in_list[Ayah,Ibu,Lainnya]', ['required' => 'Setiap siswa harus memiliki wali murid, silahkan pilih wali murid terlebih dahulu!']);
    }

    private function _validateFormWali()
    {
        $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required|regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', ['required' => 'nama wali wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('alamat_wali', 'alamat_wali', 'required|regex_match[/^[a-z0-9,.\/":&\-()\s\']+$/i]|max_length[255]', ['required' => 'alamat wali wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('status_wali', 'status_wali', 'required|regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['required' => 'status wali wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'status tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('pekerjaan_wali', 'pekerjaan_wali', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[255]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pekerjaan tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('pendterakhir_wali', 'pendterakhir_wali', 'regex_match[/^[a-z0-9,.\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'pendidikan terakhir wali tidak boleh melebihi 50 karakter']);
        $this->form_validation->set_rules('nohape_wali', 'nohape_wali', 'required|numeric|min_length[11]|max_length[15]', ['required' => 'nomor hp wali tidak boleh kosong', 'numeric' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']);
    }

    private function _validateFormCalonSiswa()
    {
        $this->form_validation->set_rules('nama_calon_siswa', 'nama_calon_siswa', 'required|regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', ['required' => 'nama calon siswa wajib diisi', 'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\') dan strip (-)', 'max_length' => 'nama maksimal 50 huruf']);
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required|in_list[L,P]', ['required' => 'jenis kelamin wajib dipilih']);
        $this->form_validation->set_rules('tgl_lahir2', 'tgl_lahir2', 'require', ['require' => 'tanggal lahir wajib diisi']);
        $this->form_validation->set_rules('asal_tk', 'asal_tk', 'regex_match[/^[a-z0-9,.\'\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'asal tk tidak boleh lebih dari 50 karakter']);
    }

    private function _dataOrtu($data_ortu)
    {
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
            redirect('ppdb/calonsiswa');
        } elseif ($this->input->post('wali') == 'Lainnya') {
            $this->session->unset_userdata('error');
            $this->_dataOrtu($this->security->xss_clean($this->input->post()));
            redirect('ppdb/wali');
        }
    }

    public function wali()
    {
        if ($this->session->userdata('wali') == 'Lainnya' && $this->csrf['name'] == $this->security->get_csrf_token_name() && $this->csrf['hash'] == $this->security->get_csrf_hash()) {
            $this->_validateFormWali();
            if ($this->form_validation->run() == FALSE) {
                if (isset($_POST['submit'])) {
                    $this->session->set_userdata('error', 'error');
                    $this->_dataWali($this->security->xss_clean($this->input->post()));
                }
                $data['title'] = 'Pendaftaran';
                $data['canonical'] = base_url('ppdb/wali');
                $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
                $data['csrf'] = $this->csrf;
                $this->load->view('templates/header', $data);
                $this->load->view('pendaftaran/wali');
                $this->load->view('templates/footer');
            } else {
                $this->session->set_userdata('stwali', 'valid');
                $this->session->unset_userdata('error');
                $this->_dataWali($this->security->xss_clean($this->input->post()));
                redirect('ppdb/calonsiswa');
            }
        } else {
            redirect('ppdb');
        }
    }

    public function calonsiswa()
    {
        if ($this->session->userdata('stwali') == 'valid' && $this->csrf['name'] == $this->security->get_csrf_token_name() && $this->csrf['hash'] == $this->security->get_csrf_hash()) {

            $this->_validateFormCalonSiswa();
            $this->_regex();

            if ($this->input->post('jenis_kelamin') == 'L') {
                $this->session->set_userdata('jenis_kelamin', 'L');
            } elseif ($this->input->post('jenis_kelamin') == 'P') {
                $this->session->set_userdata('jenis_kelamin', 'P');
            } else {
                $this->session->set_userdata('jenis_kelamin', null);
            }


            if ($this->form_validation->run() == FALSE || $this->_regex() == 0) {
                if (isset($_POST['submit'])) {
                    $this->session->set_userdata('error', 'error');
                    $this->session->set_userdata('tgl_lahir', $this->input->post('tgl_lahir'));
                    $this->session->set_flashdata('regex', 'Usia minimal 6 tahun per 1 Juli ' . date('Y'));
                }
                $data['title'] = 'Pendaftaran';
                $data['canonical'] = base_url('ppdb/calonsiswa');
                $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
                $data['csrf'] = $this->csrf;
                $this->load->view('templates/header', $data);
                $this->load->view('pendaftaran/calonsiswa');
                $this->load->view('templates/footer');
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
                // var_dump($data_calon_siswa);
                // $this->load->view('templates/blank');
            }
        } else {
            if ($this->session->userdata('wali') == 'Lainnya') {
                redirect('ppdb/wali');
            } else {
                redirect('ppdb');
            }
        }
    }

    public function cs()
    {
        netralize2();
        $data['title'] = 'Pendaftaran';
        $data['canonical'] = base_url('ppdb/cs');
        $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
        $data['csrf'] = $this->csrf;
        if ($this->input->post('search') || isset($_POST['search'])) {
            $keyword = $this->input->post('search');
            $this->session->set_userdata('search', $this->input->post('search'));
            $data['start'] = NULL;
            $result = $this->db->query('SELECT * FROM calon_siswa WHERE nama LIKE "%' . $keyword . '%" AND tahun = ' . date('Y'))->num_rows();
        } else {
            $keyword = $this->session->userdata('search');
            $data['start'] = (int)$this->uri->segment(3);
            $result = $this->db->query("SELECT * FROM calon_siswa WHERE tahun = " . date('Y'))->num_rows();
        }

        $config['base_url'] = base_url() . 'ppdb/cs';
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
                $data['calon_siswa'] = $this->db->query('SELECT * FROM calon_siswa WHERE tahun = ' . date('Y') . ' AND nama LIKE "%' . $keyword . '%" LIMIT ' . $config["per_page"] . " OFFSET " . $data["start"])->result_array();
            } else {
                $data['calon_siswa'] = $this->db->query('SELECT * FROM calon_siswa WHERE tahun = ' . date('Y') . ' AND nama LIKE "%' . $keyword . '%" LIMIT ' . $config["per_page"] . "")->result_array();
            }
        } else {
            if ($data["start"]) {
                $data['calon_siswa'] = $this->db->query('SELECT * FROM calon_siswa WHERE tahun = ' . date('Y') . ' LIMIT ' . $config["per_page"] . " OFFSET " . $data["start"])->result_array();
            } else {
                $data['calon_siswa'] = $this->db->query("SELECT * FROM calon_siswa WHERE tahun = " . date('Y') . " LIMIT " . $config["per_page"] . "")->result_array();
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pendaftaran/tersimpan');
        $this->load->view('templates/footer');
    }

    public function daftar($id)
    {
        netralize();
        $this->session->unset_userdata('sukses');
        $data['title'] = 'Berhasil';
        $data['canonical'] = base_url('ppdb/daftar/' . $id);
        $data['description'] = 'Pendaftaran/registration of SDI Al-Khairiyah Banyuwangi';
        $data['id'] = $id;
        $this->load->view('templates/header', $data);
        $this->load->view('pendaftaran/sukses');
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        netralize();
        $data['calon_siswa'] = $this->Pendaftaran->detail($id);
        $data['title'] = 'Pendaftaran';
        $data['canonical'] = base_url('ppdb/detail/' . $id);
        $data['description'] = 'Detail calon siswa of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('pendaftaran/detail');
        $this->load->view('templates/footer');
    }

    public function cetak($id)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [160, 165]]);
        $mpdf->showImageErrors = true;
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
        Pengumuman jadwal verifikasi offline dapat dilihat melalui link: <div style="color:blue"><i>https://chat.whatsapp.com/BFBYqiliLHs1kclKTfubVb</i><br/></div><br>
        atau silahkan kembali ke: <div style="color:blue"><i>' . base_url('ppdb/daftar/') . $id . '</i><br/></div>
        <script>
            alert(\'ok\');
        </script>';
        $nextyear = (int)date('Y') + 1;
        $mpdf->writeHTML($html);
        $mpdf->Output('Bukti Pendaftaran PPDB Online SD Islam Al-Khairiyah Tahun Ajaran ' . date('Y') . '-' . $nextyear . '.pdf', 'D');
    }

    public function formpelengkapandatalogin()
    {
        netralize();
        $this->session->unset_userdata('regex');
        $this->session->unset_userdata('error');
        $this->session->unset_userdata('formDataPPDB');
        $data['csrf'] = $this->csrf;
        $data['title'] = 'Pendaftaran';
        $data['canonical'] = base_url('ppdb/formpelengkapandata/');
        $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';

        $this->form_validation->set_rules(
            'no_hp_wali',
            'no_hp_wali',
            'numeric|required|min_length[11]|max_length[15]',
            ['numeric' => 'nomor hp tidak valid', 'required' => 'nomor hp wali tidak boleh kosong', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 15 digit']
        );
        $this->form_validation->set_rules(
            'idppdb',
            'idppdb',
            'required|regex_match[/^cs-\d{4}$/i]',
            [
                'required' => 'ID PPDB tidak boleh kosong',
                'regex_match' => 'ID PPDB tidak valid',
            ]
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('pendaftaran/pelengkapandatapdbarulogin');
        } else {
            $data = $this->db->query("SELECT calon_siswa.*, wali.* FROM calon_siswa JOIN wali ON calon_siswa.id_wali=wali.id_wali WHERE calon_siswa.tahun = '" . date('Y') . "' AND (wali.nohape_ayah= '" . $this->input->post("no_hp_wali") . "' OR wali.nohape_ibu='" . $this->input->post('no_hp_wali') . "' OR wali.nohape_wali='" . $this->input->post('no_hp_wali') . "') AND calon_siswa.id_cs='" . $this->input->post('idppdb') . "'")->row_array();
            if ($data) {
                $data["nohape"] = $this->input->post('no_hp_wali');
                if ($data["nama_wali"]) {
                    $data["mempunyaiWali"] = "ya";
                } else {
                    $data["mempunyaiWali"] = "tidak";
                }
                $this->session->set_userdata('formDataPPDB', $data);
                $this->session->unset_userdata('error');
                redirect('ppdb/formpelengkapandata');
            } else {
                $this->session->set_userdata('error', 'No HP/WA atau ID Pendaftaran salah!');
                $data["csrf"] = $this->csrf;
                $data['title'] = 'Pendaftaran';
                $data['canonical'] = base_url('ppdb/formpelengkapandata/');
                $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';
                $this->load->view('templates/header', $data);
                $this->load->view('pendaftaran/pelengkapandatapdbarulogin');
            }
        }
    }

    private function _validateFormPelengkapanData()
    {
        $this->form_validation->set_rules('nama_siswa', 'nama_siswa', 'required|regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', [
            'required' => 'nama siswa wajib diisi',
            'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\'), strip (-) dan titik (.)',
            'max_length' => 'nama maksimal 50 huruf'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required|in_list[L,P]', ['required' => 'jenis kelamin wajib dipilih']);
        $this->form_validation->set_rules('asal_tk', 'asal_tk', 'regex_match[/^[a-z0-9,.\'\/\-()\s]+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'asal tk tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('nisn', 'nisn', 'regex_match[/^[0-9\-]+$/i]|max_length[10]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'NISN tidak boleh lebih dari 10 karakter']);
        $this->form_validation->set_rules('no_kk', 'no_kk', 'required|regex_match[/^[0-9\-]+$/i]|exact_length[16]', ['required' => 'No KK wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'exact_length' => 'No KK harus 16 digit']);
        $this->form_validation->set_rules('nik_anak', 'nik_anak', 'required|regex_match[/^[0-9\-]+$/i]|exact_length[16]', ['required' => 'NIK wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'exact_length' => 'NIK harus 16 digit']);
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', ['regex_match' => 'karakter inputan tidak valid', 'max_length' => 'tempat lahir tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('no_reg_akta_lahir', 'no_reg_akta_lahir', 'required|regex_match[/^[a-z0-9.\s\-]+$/i]|min_length[13]|max_length[21]', ['required' => 'No Registrasi Akta wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'min_length' => 'No Akta Lahir tidak boleh kurang dari 13 karakter', 'max_length' => 'No Akta Lahir tidak boleh lebih dari 21 karakter']);
        $this->form_validation->set_rules('agama', 'agama', 'required|in_list[Islam,Kristen,Katolik,Hindu,Budha,Konghucu]', ['required' => 'Agama wajib diisi', 'in_list' => 'Agama harus salah satu dari Islam, Kristen, Katolik, Hindu, Budha, Konghucu']);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|regex_match[/^[a-z0-9,.\/":&\-()\s\']+$/i]|max_length[255]', ['required' => 'alamat wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'max_length' => 'alamat tidak boleh lebih dari 255 karakter']);
        $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required', ['required' => 'kecamatan wajib dipilih']);
        $this->form_validation->set_rules('rt', 'rt', 'required|numeric|max_length[3]', ['required' => 'RT wajib diisi', 'numeric' => 'RT tidak valid', 'max_length' => 'RT tidak boleh lebih dari 3 digit']);
        $this->form_validation->set_rules('rw', 'rw', 'required|numeric|max_length[3]', ['required' => 'RW wajib diisi', 'numeric' => 'RW tidak valid', 'max_length' => 'RW tidak boleh lebih dari 3 digit']);
        $this->form_validation->set_rules('dusun', 'dusun', 'regex_match[/^[a-z0-9,.\/":&\-()\s\']+$/i]|max_length[50]', ['regex_match' => 'Nama dusun tidak valid', 'max_length' => 'Nama dusun tidak boleh lebih dari 50 karakter']);
        $this->form_validation->set_rules('kode_pos', 'kode_pos', 'regex_match[/^[0-9]+$/i]|exact_length[5]', ['regex_match' => 'Kode pos hanya boleh terdiri dari angka', 'exact_length' => 'Kode pos harus 5 digit']);
        $this->form_validation->set_rules('nohape', 'nohape', 'required|regex_match[/^[0-9+\-\s\']+$/i]|min_length[11]|max_length[17]', ['required' => 'nomor hp tidak boleh kosong', 'regex_match' => 'nomor hp tidak valid', 'min_length' => 'nomor hp minimal berisi 11 digit', 'max_length' => 'nomor hp maksimal berisi 17 digit']);
        $this->form_validation->set_rules('anak_ke', 'anak_ke', 'required|numeric|max_length[2]', ['required' => 'data wajib diisi', 'numeric' => 'karakter input hanya boleh diisi angka', 'max_length' => 'no urutan anak tidak boleh lebih dari 2 digit']);
        $this->form_validation->set_rules('jml_saudara_kandung', 'jml_saudara_kandung', 'required|numeric|max_length[2]', ['required' => 'data wajib diisi', 'numeric' => 'karakter input hanya boleh diisi angka', 'max_length' => 'jumlah saudara kandung tidak boleh lebih dari 2 digit']);
        $this->form_validation->set_rules('berat_badan', 'berat_badan', 'required|numeric|min_length[2]|max_length[3]', ['required' => 'berat badan wajib diisi', 'numeric' => 'berat badan hanya boleh diisi angka', 'min_length' => 'berat badan tidak boleh kurang dari 2 digit', 'max_length' => 'berat badan tidak boleh lebih dari 3 digit']);
        $this->form_validation->set_rules('tinggi_badan', 'tinggi_badan', 'required|numeric|min_length[2]|max_length[3]', ['required' => 'tinggi badan wajib diisi', 'numeric' => 'tinggi badan hanya boleh diisi angka', 'min_length' => 'tinggi badan tidak boleh kurang dari 2 digit', 'max_length' => 'tinggi badan tidak boleh lebih dari 3 digit']);
        $this->form_validation->set_rules('lingkar_kepala', 'lingkar_kepala', 'required|numeric|max_length[2]', ['required' => 'lingkar kepala wajib diisi', 'numeric' => 'lingkar kepala hanya boleh diisi angka', 'max_length' => 'lingkar kepala tidak boleh lebih dari 2 digit']);
        $this->form_validation->set_rules('jarak_rumah_ke_sekolah', 'jarak_rumah_ke_sekolah', 'required|numeric|max_length[3]', ['required' => 'jarak rumah ke sekolah wajib diisi', 'numeric' => 'jarak rumah ke sekolah hanya boleh diisi angka', 'max_length' => 'jarak rumah ke sekolah tidak boleh lebih dari 3 digit']);
        $this->form_validation->set_rules('nama_ayah', 'nama_ayah', 'required|regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', [
            'required' => 'nama ayah wajib diisi',
            'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\'), strip (-) dan titik (.)',
            'max_length' => 'nama maksimal 50 huruf'
        ]);
        $this->form_validation->set_rules('nik_ayah', 'nik_ayah', 'required|regex_match[/^[0-9\-]+$/i]|exact_length[16]', ['required' => 'NIK wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'exact_length' => 'NIK harus 16 digit']);
        $this->form_validation->set_rules('tahun_lahir_ayah', 'tahun_lahir_ayah', 'required|numeric|exact_length[4]', ['required' => 'tahun lahir ayah wajib diisi', 'numeric' => 'tahun lahir ayah hanya boleh diisi angka', 'exact_length' => 'tahun lahir ayah harus 4 digit']);
        $this->form_validation->set_rules('nama_ibu', 'nama_ibu', 'required|regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', [
            'required' => 'nama ibu wajib diisi',
            'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\'), strip (-) dan titik (.)',
            'max_length' => 'nama maksimal 50 huruf'
        ]);
        $this->form_validation->set_rules('nik_ibu', 'nik_ibu', 'required|regex_match[/^[0-9\-]+$/i]|exact_length[16]', ['required' => 'NIK wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'exact_length' => 'NIK harus 16 digit']);
        $this->form_validation->set_rules('tahun_lahir_ibu', 'tahun_lahir_ibu', 'required|numeric|exact_length[4]', ['required' => 'tahun lahir ibu wajib diisi', 'numeric' => 'tahun lahir ibu hanya boleh diisi angka', 'exact_length' => 'tahun lahir ibu harus 4 digit']);
        if ($this->input->post('mempunyaiWali') == 'ya') {
            $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required|regex_match[/^[a-z\-.\s\']+$/i]|max_length[50]', [
                'required' => 'nama wali wajib diisi',
                'regex_match' => 'nama tidak boleh mengandung selain huruf, spasi, petik tunggal (\'), strip (-) dan titik (.)',
                'max_length' => 'nama maksimal 50 huruf'
            ]);
            $this->form_validation->set_rules('nik_wali', 'nik_wali', 'required|regex_match[/^[0-9\-]+$/i]|exact_length[16]', ['required' => 'NIK wajib diisi', 'regex_match' => 'karakter inputan tidak valid', 'exact_length' => 'NIK harus 16 digit']);
            $this->form_validation->set_rules('tahun_lahir_wali', 'tahun_lahir_wali', 'required|numeric|exact_length[4]', ['required' => 'tahun lahir wali wajib diisi', 'numeric' => 'tahun lahir wali hanya boleh diisi angka', 'exact_length' => 'tahun lahir wali harus 4 digit']);
        }
    }

    public function formpelengkapandata()
    {
        if ($this->session->userdata('formDataPPDB')) {
            netralize();
            $data['csrf'] = $this->csrf;
            $data['title'] = 'Pendaftaran';
            $data['canonical'] = base_url('ppdb/formpelengkapandata');
            $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';
            $countries = [];

            // using restcountries
            $countriesAPI = $this->_fetchAPI('https://restcountries.com/v3.1/all');
            foreach ($countriesAPI as $countryAPI) {
                if ($countryAPI["name"]["common"] !== "Israel") {
                    $countries[$countryAPI["name"]["common"]][] = [
                        "name" => $countryAPI["name"]["common"],
                        "cca2" => $countryAPI["cca2"],
                        "flag" => $countryAPI["flag"],
                    ];
                }
            }

            // // using first API 
            // $countriesAPI = $this->_fetchAPI('https://api.first.org/data/v1/countries')["data"];
            // foreach ($countriesAPI as $cca2 => $countryAPI) {
            //     $countries[$countryAPI["country"]][] = [
            //         "name" => $countryAPI["country"],
            //         "cca2" => $cca2,
            //         "flag" => "",
            //     ];
            // }

            // border of RestAPI Choice


            $kecamatanBWI = $this->_fetchAPI("https://wilayah.id/api/districts/" . "35.10" . ".json")["data"];

            $kecamatandiBWI = [];
            foreach ($kecamatanBWI as $code) {
                $kecamatandiBWI[$code["name"]] = ["name" => $code["name"], "code" => $code["code"]];
            }

            sort($this->listKabupaten);
            $data["kecamatanBWI"] = $kecamatandiBWI;
            $data["semuaKabupaten"] = $this->listKabupaten;


            ksort($countries);
            $data["countries"] = $countries;

            if ($this->input->post()) {
                $this->_regex();
                if ($this->_regex() == 0) {
                    $this->session->set_userdata('regex', 'Usia minimal 6 tahun per 1 Juli ' . date('Y'));
                } else {
                    $this->session->unset_userdata('regex');
                }
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_userdata('error', 'error');
                } else {
                    $this->session->unset_userdata('error');
                }
            } else {
                $this->session->unset_userdata('regex');
                $this->session->unset_userdata('error');
            }

            $this->_validateFormPelengkapanData();
            if ($this->form_validation->run() == FALSE || $this->_regex() == 0) {
                $this->load->view('templates/header', $data);
                $this->load->view('pendaftaran/formpelengkapandata');
                $this->load->view('templates/footer');
            } else {
                $this->session->unset_userdata('regex');
                $inputdata = $this->input->post();
                $inputdata['tahun_input_pertama'] = $this->tahunAjar;
                $response = $this->Pendaftaran->insertDataLengkapSiswa($inputdata);

                if ($response !== false) {
                    redirect('ppdb/pelengkapandataberhasil/' . $response);
                } else {
                    redirect('ppdb/pelengkapandatagagal');
                }
            }
        } else {
            redirect('ppdb/formpelengkapandatalogin');
        }
    }
    public function pelengkapandataberhasil($id)
    {
        if ($this->session->userdata('formDataPPDB')) {
            netralize();

            $data['title'] = 'Pendaftaran';
            $data['canonical'] = base_url('ppdb/pelengkapandataberhasil/');
            $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';
            $this->db->where('id', $id);
            $data['nama'] = $this->db->get('siswa')->row_array()["nama"];
            $this->load->view('templates/header', $data);
            $this->load->view('pendaftaran/suksesdapodik');
            $this->load->view('templates/footer');
        } else {
            redirect('ppdb/formpelengkapandatalogin');
        }
    }
    public function pelengkapandatagagal()
    {
        if ($this->session->userdata('formDataPPDB')) {
            netralize();

            $data['title'] = 'Pendaftaran';
            $data['canonical'] = base_url('ppdb/pelengkapandatagagal/');
            $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';
            $this->load->view('templates/header', $data);
            $this->load->view('pendaftaran/gagaldapodik');
            $this->load->view('templates/footer');
        } else {
            redirect('ppdb/formpelengkapandatalogin');
        }
    }
    public function waliajaxform()
    {
        if ($this->session->userdata('formDataPPDB')) {
            netralize();
            $data['csrf'] = $this->csrf;
            $data['title'] = 'Pendaftaran';
            $data['canonical'] = base_url('ppdb/formpelengkapandata/');
            $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';
            $this->load->view('pendaftaran/waliajaxform', $data);
        } else {
            redirect('ppdb/formpelengkapandatalogin');
        }
    }
    public function tanpawaliajaxform()
    {
        if ($this->session->userdata('formDataPPDB')) {
            netralize();
            $data['csrf'] = $this->csrf;
            $data['title'] = 'Pendaftaran';
            $data['canonical'] = base_url('ppdb/formpelengkapandata/');
            $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';
            $this->load->view('pendaftaran/tanpawaliajaxform', $data);
        } else {
            redirect('ppdb/formpelengkapandatalogin');
        }
    }
    public function villagescaller($id, $kelurahanpilihan = "0")
    {
        if ($this->session->userdata('formDataPPDB')) {
            netralize();
            $data['csrf'] = $this->csrf;
            $data['title'] = 'Pendaftaran';
            $data['canonical'] = base_url('ppdb/formpelengkapandata/');
            $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';

            // var_dump($kelurahan);
            if ($id !== "0") {
                $kelurahan = $this->_fetchAPI('https://wilayah.id/api/villages/' . $id . '.json')["data"];
                foreach ($kelurahan as $kel) {
                    if ($kel["name"] == $kelurahanpilihan) {
                        echo '<option value="' . $kel["name"] . '" data-code="' . $kel["postal_code"] . '" selected>' . $kel["name"] . '</option>';
                    } else {
                        echo '<option value="' . $kel["name"] . '" data-code="' . $kel["postal_code"] . '" >' . $kel["name"] . '</option>';
                    }
                }
            } else {
                echo '<option value="">Pilih Kelurahan</option>';
            }

            $this->load->view('templates/blank', $data);
        } else {
            redirect('ppdb/formpelengkapandatalogin');
        }
    }
    public function villagescallerpostalcode($id)
    {
        if ($this->session->userdata('formDataPPDB')) {
            netralize();
            $data['csrf'] = $this->csrf;
            $data['title'] = 'Pendaftaran';
            $data['canonical'] = base_url('ppdb/formpelengkapandata/');
            $data['description'] = 'Form Pelengkapan Data Siswa Baru SDI Al-Khairiyah Banyuwangi';
            $kelurahan = $this->_fetchAPI('https://wilayah.id/api/villages/' . $id . '.json')["data"];

            echo  $kelurahan[0]["postal_code"];

            $this->load->view('templates/blank');
        } else {
            redirect('ppdb/formpelengkapandatalogin');
        }
    }
}
