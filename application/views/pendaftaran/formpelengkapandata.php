<div class="col-lg">
    <form action="" method="post">
        <?= form_error('wali', '<div class="row justify-content-center"><div class="text-center alert alert-danger alert-dismissible fade show mt-2 col-lg-8 ml-3 mr-3" role="alert"><strong>Gagal!</strong> ', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>') ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Data Siswa</h3>
                        <input type="hidden" class="first" value="<?= $this->session->userdata('first') ?>">
                        <div class="form-group">
                            <input type="hidden" class="error" value="<?= $this->session->userdata('error') ?>">
                            <label for="id_pendaftaran">ID Pendaftaran</label>
                            <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" value="<?= $this->session->userdata('formDataPPDB')["id_cs"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa (sesuasi akta kelahiran)</label>
                            <input type="text" name="nama_siswa" class="form-control" id="nama_siswa" placeholder="(Nama lengkap siswa sesuai Akta Kelahiran)" autocomplete="on" value="<?= updateFormValue($this->session->userdata('formDataPPDB')["nama"], $this->input->post('nama_siswa')) ?>" maxlength="50">
                            <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis kelamin</label>
                            <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin" value="<?= set_value('jenis_kelamin') ?>">
                                <option value="">(Pilih jenis kelamin)</option>
                                <option <?= selectKel2('L') ?> value="L">Laki-laki</option>
                                <option <?= selectKel2('P') ?> value="P">Perempuan</option>
                            </select>
                            <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="asal_tk">Asal Sekolah</label>
                            <input type="text" name="asal_tk" class="form-control" id="asal_tk" placeholder="(TK asal)" autocomplete="on" value="<?= updateFormValue($this->session->userdata('formDataPPDB')['asal_tk'], $this->input->post('asal_tk')) ?>">
                            <?= form_error('asal_tk', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" name="nisn" class="form-control" id="nisn" placeholder="(isi strip (-) jika belum ada dari TK asal)" autocomplete="on" value="<?= $this->input->post('nisn') ?>" maxlength="10">
                            <?= form_error('nisn', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan">Kewarganegaraan</label>
                            <select class="custom-select" id="kewarganegaraan" name="kewarganegaraan" value="<?= set_value('kewarganegaraan') ?>">
                                <?php foreach ($countries as $country): ?>
                                    <option <?= selectNationality($country[0]["cca2"]) ?> value="<?= $country[0]["cca2"] ?>"><?= $country[0]["flag"] . " " . $country[0]["name"] ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('kewarganegaraan', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="no_kk">Nomor Kartu Keluarga</label>
                            <input type="text" name="no_kk" class="form-control" id="no_kk" placeholder="(Nomor KK)" autocomplete="on" value="<?= set_value('no_kk') ?>" maxlength="16" minlength="16">
                            <?= form_error('no_kk', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nik_anak">NIK Anak</label>
                            <input type="text" name="nik_anak" class="form-control" id="nik_anak" placeholder="(NIK anak sesuai Kartu Keluarga)" autocomplete="on" value="<?= set_value('nik_anak') ?>" minlength="16" maxlength="16">
                            <?= form_error('nik_anak', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="tmpt_lhr_anak">Tempat Lahir</label>
                            <select class="custom-select" id="tmpt_lhr_anak" name="tmpt_lhr_anak" value="<?= set_value('tmpt_lhr_anak') ?>">
                                <option value="">(Pilih Kabupaten/Kota)</option>
                                <?php foreach ($semuaKabupaten as $sk): ?>
                                    <option <?= selectedBirthplace($sk, $this->input->post("tmpt_lhr_anak")) ?> value="<?= $sk ?>"><?= $sk ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('tmpt_lhr_anak', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <div id="inline" data-date="01/01/2020"></div>
                            <!-- <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?= set_value('tgl_lahir') ?>" placeholder="dd-mm-yyyy" autocomplete="on"> -->
                            <input type="text" name="tgl_lahir" data-date="01/01/2020" id="tgl_lahir_2" class="form-control" value="<?= updateFormValue(explode('-', $this->session->userdata('formDataPPDB')['tgl_lahir'])[2] . "-" . explode('-', $this->session->userdata('formDataPPDB')['tgl_lahir'])[1] . "-" . explode('-', $this->session->userdata('formDataPPDB')['tgl_lahir'])[0], $this->input->post('tgl_lahir')) ?>" placeholder="dd-mm-yyyy" autocomplete="on">
                            <!-- <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>') ?> -->
                            <?= '<small class="text-danger pl-3">' . $this->session->userdata('regex') . '</small>' ?>
                        </div>
                        <div class="form-group">
                            <label for="no_reg_akta_lahir">Nomor Registrasi Akta Kelahiran</label>
                            <input type="text" name="no_reg_akta_lahir" class="form-control" id="no_reg_akta_lahir" placeholder="Nomor Registrasi di pojok kanan atas akta" autocomplete="on" value="<?= set_value('no_reg_akta_lahir') ?>" maxlength="21">
                            <?= form_error('no_reg_akta_lahir', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="custom-select" id="agama" name="agama">
                                <option value="">(Pilih Agama)</option>
                                <option <?= selectedOpt("Islam", $this->input->post("agama")) ?> value="Islam">Islam</option>
                                <option <?= selectedOpt("Kristen", $this->input->post("agama")) ?> value="Kristen">Kristen</option>
                                <option <?= selectedOpt("Katolik", $this->input->post("agama")) ?> value="Katolik">Katolik</option>
                                <option <?= selectedOpt("Hindu", $this->input->post("agama")) ?> value="Hindu">Hindu</option>
                                <option <?= selectedOpt("Budha", $this->input->post("agama")) ?> value="Budha">Budha</option>
                                <option <?= selectedOpt("Konghucu", $this->input->post("agama")) ?> value="Konghucu">Konghucu</option>
                            </select>
                            <?= form_error('agama', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="kebutuhanKhusus">Berkebutuhan Khusus?</label>
                            <select class="custom-select" id="kebutuhanKhusus" name="kebutuhanKhusus" value="<?= set_value('kebutuhanKhusus') ?>">
                                <option value="tidak">Tidak ada</option>
                                <option <?= selectedOpt("netra (A)", $this->input->post("kebutuhanKhusus")) ?> value="netra (A)">netra (A)</option>
                                <option <?= selectedOpt("rungu (B)", $this->input->post("kebutuhanKhusus")) ?> value="rungu (B)">rungu (B)</option>
                                <option <?= selectedOpt("grahita ringan (C)", $this->input->post("kebutuhanKhusus")) ?> value="grahita ringan (C)">grahita ringan (C)</option>
                                <option <?= selectedOpt("grahita sedang (C1)", $this->input->post("kebutuhanKhusus")) ?> value="grahita sedang (C1)">grahita sedang (C1)</option>
                                <option <?= selectedOpt("daksa ringan (D)", $this->input->post("kebutuhanKhusus")) ?> value="daksa ringan (D)">daksa ringan (D)</option>
                                <option <?= selectedOpt("daksa sedang (D1)", $this->input->post("kebutuhanKhusus")) ?> value="daksa sedang (D1)">daksa sedang (D1)</option>
                                <option <?= selectedOpt("laras (E)", $this->input->post("kebutuhanKhusus")) ?> value="laras (E)">laras (E)</option>
                                <option <?= selectedOpt("wicara (F)", $this->input->post("kebutuhanKhusus")) ?> value="wicara (F)">wicara (F)</option>
                                <option <?= selectedOpt("hyperaktif (H)", $this->input->post("kebutuhanKhusus")) ?> value="hyperaktif (H)">hyperaktif (H)</option>
                                <option <?= selectedOpt("cerdas istimewa (I)", $this->input->post("kebutuhanKhusus")) ?> value="cerdas istimewa (I)">cerdas istimewa (I)</option>
                                <option <?= selectedOpt("bakat istimewa (J)", $this->input->post("kebutuhanKhusus")) ?> value="bakat istimewa (J)">bakat istimewa (J)</option>
                                <option <?= selectedOpt("kesulitan ", $this->input->post("kebutuhanKhusus")) ?> value="kesulitan belajar (K)">kesulitan belajar (K)</option>
                                <option <?= selectedOpt("narkoba (N)", $this->input->post("kebutuhanKhusus")) ?> value="narkoba (N)">narkoba (N)</option>
                                <option <?= selectedOpt("indigo (O)", $this->input->post("kebutuhanKhusus")) ?> value="indigo (O)">indigo (O)</option>
                                <option <?= selectedOpt("down syndrome (P)", $this->input->post("kebutuhanKhusus")) ?> value="down syndrome (P)">down syndrome (P)</option>
                                <option <?= selectedOpt("autis (Q)", $this->input->post("kebutuhanKhusus")) ?> value="autis (Q)">autis (Q)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="(Nama & No. Jalan/Perumahan)" autocomplete="on" value="<?= set_value('alamat') ?>">
                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <select class="custom-select" id="kecamatan" name="kecamatan" value="<?= set_value('kecamatan') ?>">
                                <option value="">(Pilih Kecamatan)</option>
                                <?php foreach ($kecamatanBWI as $kc): ?>
                                    <option value="<?= $kc["name"] ?>" data-code="<?= $kc["code"] ?>"><?= $kc["name"] ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="kelurahan">Desa / Kelurahan</label>
                            <select class="custom-select village-caller" id="kelurahan" name="kelurahan" value="<?= set_value('kelurahan') ?>">
                                <option value="">(Pilih Kelurahan)</option>
                            </select>
                            <?= form_error('kelurahan', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="dusun">Dusun</label>
                            <input type="text" name="dusun" class="form-control" id="dusun" placeholder="(Dusun)" autocomplete="on" value="<?= set_value('dusun') ?>">
                            <?= form_error('dusun', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="text" name="rt" class="form-control" id="rt" placeholder="(RT)" autocomplete="on" maxlength="3" value="<?= set_value('rt') ?>">
                            <?= form_error('rt', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="text" name="rw" class="form-control" id="rw" placeholder="(RW)" autocomplete="on" maxlength="3" value="<?= set_value('rw') ?>">
                            <?= form_error('rw', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control village-caller-postal-code" id="kode_pos" placeholder="(Kode Pos)" autocomplete="on" minlength="5" maxlength="5" value="<?= set_value('kode_pos') ?>">
                            <?= form_error('kode_pos', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nohape">No HP/WA yang selalu bisa dihubungi</label>
                            <input type="text" name="nohape" class="form-control" id="nohape" placeholder="+62XX-XXX-XXX-XXX" autocomplete="on" value="<?= updateFormValue($this->session->userdata('formDataPPDB')["nohape"], $this->input->post("nohape")) ?>">
                            <?= form_error('nohape', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="tempat_tinggal">Tempat tinggal</label>
                            <select class="custom-select" id="tempat_tinggal" name="tempat_tinggal">
                                <option <?= selectedOpt("Bersama orang tua", $this->input->post("tempat_tinggal")) ?> value="Bersama orang tua">Bersama orang tua</option>
                                <option <?= selectedOpt("Wali", $this->input->post("tempat_tinggal")) ?> value="Wali">Wali</option>
                                <option <?= selectedOpt("Kost", $this->input->post("tempat_tinggal")) ?> value="Kost">Kost</option>
                                <option <?= selectedOpt("Asrama", $this->input->post("tempat_tinggal")) ?> value="Asrama">Asrama</option>
                                <option <?= selectedOpt("Panti Asuhan", $this->input->post("tempat_tinggal")) ?> value="Panti Asuhan">Panti Asuhan</option>
                                <option <?= selectedOpt("Pesantren", $this->input->post("tempat_tinggal")) ?> value="Pesantren">Pesantren</option>
                                <option <?= selectedOpt("Lainnya", $this->input->post("tempat_tinggal")) ?> value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="transportasi">Transportasi ke sekolah</label>
                            <select class="custom-select" id="transportasi" name="transportasi">
                                <option <?= selectedOpt("Jalan kaki", $this->input->post("transportasi")) ?> value="Jalan kaki">Jalan kaki</option>
                                <option <?= selectedOpt("Angkutan ", $this->input->post("transportasi")) ?> value="Angkutan umum/bus/pete-pete">Angkutan umum/bus/pete-pete</option>
                                <option <?= selectedOpt("Mobil/bus antar ", $this->input->post("transportasi")) ?> value="Mobil/bus antar jemput">Mobil/bus antar jemput</option>
                                <option <?= selectedOpt("Kereta api", $this->input->post("transportasi")) ?> value="Kereta api">Kereta api</option>
                                <option <?= selectedOpt("Ojek", $this->input->post("transportasi")) ?> value="Ojek">Ojek</option>
                                <option <?= selectedOpt("Andong/bendi/sado/dokar/delman/becak", $this->input->post("transportasi")) ?> value="Andong/bendi/sado/dokar/delman/becak">Andong/bendi/sado/dokar/delman/becak</option>
                                <option <?= selectedOpt("Perahu ", $this->input->post("transportasi")) ?> value="Perahu penyeberangan/rakit/getek">Perahu penyeberangan/rakit/getek</option>
                                <option <?= selectedOpt("Kuda", $this->input->post("transportasi")) ?> value="Kuda">Kuda</option>
                                <option <?= selectedOpt("Sepeda", $this->input->post("transportasi")) ?> value="Sepeda">Sepeda</option>
                                <option <?= selectedOpt("Sepeda motor", $this->input->post("transportasi")) ?> value="Sepeda motor">Sepeda motor</option>
                                <option <?= selectedOpt("Mobil pribadi", $this->input->post("transportasi")) ?> value="Mobil pribadi">Mobil pribadi</option>
                                <option <?= selectedOpt("Lainnya", $this->input->post("transportasi")) ?> value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="anak_ke">Anak ke-berapa?</label>
                            <input type="text" name="anak_ke" class="form-control" id="anak_ke" placeholder="(Anak ke-berapa berdasarkan KK)" autocomplete="on" maxlength="2" value="<?= set_value('anak_ke') ?>">
                            <?= form_error('anak_ke', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="jml_saudara_kandung">Jumlah Saudara Kandung</label>
                            <input type="text" name="jml_saudara_kandung" class="form-control" id="jml_saudara_kandung" placeholder="(Jumlah Saudara Kandung berdasarkan KK)" autocomplete="on" maxlength="2" value="<?= set_value("jml_saudara_kandung") ?>">
                            <?= form_error('jml_saudara_kandung', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan (kg)</label>
                            <input type="text" name="berat_badan" class="form-control" id="berat_badan" placeholder="(Berat Badan terbaru)" autocomplete="on" maxlength="3" value="<?= set_value("berat_badan") ?>">
                            <?= form_error('berat_badan', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan (cm)</label>
                            <input type="text" name="tinggi_badan" class="form-control" id="tinggi_badan" placeholder="(Tinggi Badan terbaru)" autocomplete="on" maxlength="3" value="<?= set_value("tinggi_badan") ?>">
                            <?= form_error('tinggi_badan', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="lingkar_kepala">Lingkar Kepala (cm)</label>
                            <input type="text" name="lingkar_kepala" class="form-control" id="lingkar_kepala" placeholder="(Lingkar Kepala terbaru)" autocomplete="on" maxlength="2" value="<?= set_value("lingkar_kepala") ?>">
                            <?= form_error('lingkar_kepala', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="jarak_rumah_ke_sekolah">Jarak dari rumah ke sekolah (km)</label>
                            <input type="text" name="jarak_rumah_ke_sekolah" class="form-control" id="jarak_rumah_ke_sekolah" placeholder="(Jarak dari rumah ke sekolah)" autocomplete="on" maxlength="3" value="<?= set_value("jarak_rumah_ke_sekolah") ?>">
                            <?= form_error('jarak_rumah_ke_sekolah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <span name="session" id="session-data"
                            data-kecamatan="<?= $this->input->post("kecamatan") ?>"
                            data-kelurahan="<?= $this->input->post("kelurahan") ?>"
                            data-namawali="<?= dataWali($this->input->post('nama_wali'), $this->session->userdata('formDataPPDB')["nama_wali"]) ?>"
                            data-nikwali="<?= dataWali($this->input->post('nik_wali'), null) ?>"
                            data-tahunlahirwali="<?= dataWali($this->input->post('tahun_lahir_wali'), null) ?>"
                            data-pendidikanwali="<?= dataWali($this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?>"
                            data-pekerjaanwali="<?= dataWali($this->input->post('pekerjaan_wali'), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?>"
                            data-penghasilanwali="<?= dataWali($this->input->post('penghasilan_wali'), null) ?>"
                            data-kebutuhanKhususWali="<?= dataWali($this->input->post('kebutuhanKhususWali'), null) ?>"
                            data-namawalierror="<?= form_error('nama_wali') ?>"
                            data-nikwalierror="<?= form_error('nik_wali') ?>"
                            data-tahunlahirwalierror="<?= form_error('tahun_lahir_wali') ?>"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Data Ayah</h3>
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" id="nama_ayah" placeholder="(Nama sesuai KK)" autocomplete="on" value="<?= updateFormValue($this->session->userdata('formDataPPDB')["nama_ayah"], $this->input->post('nama_ayah')) ?>">
                            <?= form_error('nama_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nik_ayah">NIK Ayah</label>
                            <input type="text" name="nik_ayah" class="form-control" id="nik_ayah" placeholder="(NIK ayah)" autocomplete="on" value="<?= set_value('nik_ayah') ?>" maxlength="16" minlength="16">
                            <?= form_error('nik_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="tahun_lahir_ayah">Tahun Lahir Ayah</label>
                            <input type="text" name="tahun_lahir_ayah" class="form-control" id="tahun_lahir_ayah" placeholder="(Tahun Lahir ayah)" autocomplete="on" minlength="4" maxlength="4" value="<?= set_value('tahun_lahir_ayah') ?>">
                            <?= form_error('tahun_lahir_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pendidikan_ayah">Pendidikan Terakhir</label>
                            <select class="custom-select" id="pendidikan_ayah" name="pendidikan_ayah">
                                <option <?= waliSelectedOpt("D1", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="D1">D1</option>
                                <option <?= waliSelectedOpt("D2", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="D2">D2</option>
                                <option <?= waliSelectedOpt("D3", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="D3">D3</option>
                                <option <?= waliSelectedOpt("D4", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="D4">D4</option>
                                <option <?= waliSelectedOpt("Informal", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?>value="Informal">Informal</option>
                                <option <?= waliSelectedOpt("Lainnya", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Lainnya">Lainnya</option>
                                <option <?= waliSelectedOpt("Non formal", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Non formal">Non formal</option>
                                <option <?= waliSelectedOpt("Paket A", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Paket A">Paket A</option>
                                <option <?= waliSelectedOpt("Paket B", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Paket B">Paket B</option>
                                <option <?= waliSelectedOpt("Paket C", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Paket C">Paket C</option>
                                <option <?= waliSelectedOpt("PAUD", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="PAUD">PAUD</option>
                                <option <?= waliSelectedOpt("Profesi", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Profesi">Profesi</option>
                                <option <?= waliSelectedOpt("Putus SD", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Putus SD">Putus SD</option>
                                <option <?= waliSelectedOpt("S1", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="S1">S1</option>
                                <option <?= waliSelectedOpt("S2", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="S2">S2</option>
                                <option <?= waliSelectedOpt("D2 terapan", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="S2 terapan">S2 terapan</option>
                                <option <?= waliSelectedOpt("S3", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="S3">S3</option>
                                <option <?= waliSelectedOpt("S3 terapan", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="S3 terapan">S3 terapan</option>
                                <option <?= waliSelectedOpt("SD / sederajat", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="SD / sederajat">SD / sederajat</option>
                                <option <?= waliSelectedOpt("SMP / sederajat", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="SMP / sederajat">SMP / sederajat</option>
                                <option <?= waliSelectedOpt("SMA / sederajat", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="SMA / sederajat">SMA / sederajat</option>
                                <option <?= waliSelectedOpt("Sp-1", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Sp-1">Sp-1</option>
                                <option <?= waliSelectedOpt("Sp-2", $this->input->post("pendidikan_ayah"), $this->session->userdata('formDataPPDB')["pendterakhir_ayah"]) ?> value="Sp-2">Sp-2</option>
                            </select>
                            <?= form_error('pendterakhir_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_ayah">Pekerjaan</label>
                            <select class="custom-select" id="pekerjaan_ayah" name="pekerjaan_ayah">
                                <option <?= waliSelectedOpt("Tidak bekerja", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Tidak bekerja">Tidak bekerja</option>
                                <option <?= waliSelectedOpt("Nelayan", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Nelayan">Nelayan</option>
                                <option <?= waliSelectedOpt("Petani", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Petani">Petani</option>
                                <option <?= waliSelectedOpt("Peternak", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Peternak">Peternak</option>
                                <option <?= waliSelectedOpt("PNS/TNI/Polri", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                <option <?= waliSelectedOpt("Karyawan Swasta", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Karyawan Swasta">Karyawan Swasta</option>
                                <option <?= waliSelectedOpt("Pedagang Kecil", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Pedagang Kecil">Pedagang Kecil</option>
                                <option <?= waliSelectedOpt("Pedagang Besar", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Pedagang Besar">Pedagang Besar</option>
                                <option <?= waliSelectedOpt("Wiraswasta", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Wiraswasta">Wiraswasta</option>
                                <option <?= waliSelectedOpt("Wirausaha", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Wirausaha">Wirausaha</option>
                                <option <?= waliSelectedOpt("Buruh", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Buruh">Buruh</option>
                                <option <?= waliSelectedOpt("Pensiunan", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Pensiunan">Pensiunan</option>
                                <option <?= waliSelectedOpt("Tenaga Kerja Indonesia", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                                <option <?= waliSelectedOpt("Karyawan BUMN", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Karyawan BUMN">Karyawan BUMN</option>
                                <option <?= waliSelectedOpt("Tidak dapat diterapkan", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                <option <?= waliSelectedOpt("Sudah Meninggal", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Sudah Meninggal">Sudah Meninggal</option>
                                <option <?= waliSelectedOpt("Lainnya", $this->input->post("pekerjaan_ayah"), $this->session->userdata('formDataPPDB')["pekerjaan_ayah"]) ?> value="Lainnya">Lainnya</option>
                            </select>
                            <?= form_error('pekerjaan_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="penghasilan_ayah">Penghasilan Ayah</label>
                            <select class="custom-select" id="penghasilan_ayah" name="penghasilan_ayah" value="<?= set_value('penghasilan_ayah') ?>">
                                <option <?= selectedOpt("Kurang dari Rp. 500,000", $this->input->post("penghasilan_ayah")) ?> value="Kurang dari Rp. 500,000">Kurang dari Rp. 500,000</option>
                                <option <?= selectedOpt("Rp. 500,000 - Rp. 999,999", $this->input->post("penghasilan_ayah")) ?> value="Rp. 500,000 - Rp. 999,999">Rp. 500,000 - Rp. 999,999</option>
                                <option <?= selectedOpt("Rp. 1,000,000 - Rp. 1,999,999", $this->input->post("penghasilan_ayah")) ?> value="Rp. 1,000,000 - Rp. 1,999,999">Rp. 1,000,000 - Rp. 1,999,999</option>
                                <option <?= selectedOpt("Rp. 2,000,000 - Rp. 4,999,999", $this->input->post("penghasilan_ayah")) ?> value="Rp. 2,000,000 - Rp. 4,999,999">Rp. 2,000,000 - Rp. 4,999,999</option>
                                <option <?= selectedOpt("Rp. 5,000,000 - Rp. 20,000,000", $this->input->post("penghasilan_ayah")) ?> value="Rp. 5,000,000 - Rp. 20,000,000">Rp. 5,000,000 - Rp. 20,000,000</option>
                                <option <?= selectedOpt("Lebih dari Rp. 20,000,000", $this->input->post("penghasilan_ayah")) ?> value="Lebih dari Rp. 20,000,000">Lebih dari Rp. 20,000,000</option>
                                <option <?= selectedOpt("Tidak Berpenghasilan", $this->input->post("penghasilan_ayah")) ?> value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kebutuhanKhususAyah">Berkebutuhan Khusus Ayah?</label>
                            <select class="custom-select" id="kebutuhanKhususAyah" name="kebutuhanKhususAyah" value="<?= set_value('kebutuhanKhususAyah') ?>">
                                <option value="tidak">Tidak ada</option>
                                <option <?= selectedOpt("netra (A)", $this->input->post("kebutuhanKhususAyah")) ?> value="netra (A)">netra (A)</option>
                                <option <?= selectedOpt("rungu (B)", $this->input->post("kebutuhanKhususAyah")) ?> value="rungu (B)">rungu (B)</option>
                                <option <?= selectedOpt("grahita ringan (C)", $this->input->post("kebutuhanKhususAyah")) ?> value="grahita ringan (C)">grahita ringan (C)</option>
                                <option <?= selectedOpt("grahita sedang (C1)", $this->input->post("kebutuhanKhususAyah")) ?> value="grahita sedang (C1)">grahita sedang (C1)</option>
                                <option <?= selectedOpt("daksa ringan (D)", $this->input->post("kebutuhanKhususAyah")) ?> value="daksa ringan (D)">daksa ringan (D)</option>
                                <option <?= selectedOpt("daksa sedang (D1)", $this->input->post("kebutuhanKhususAyah")) ?> value="daksa sedang (D1)">daksa sedang (D1)</option>
                                <option <?= selectedOpt("laras (E)", $this->input->post("kebutuhanKhususAyah")) ?> value="laras (E)">laras (E)</option>
                                <option <?= selectedOpt("wicara (F)", $this->input->post("kebutuhanKhususAyah")) ?> value="wicara (F)">wicara (F)</option>
                                <option <?= selectedOpt("hyperaktif (H)", $this->input->post("kebutuhanKhususAyah")) ?> value="hyperaktif (H)">hyperaktif (H)</option>
                                <option <?= selectedOpt("cerdas istimewa (I)", $this->input->post("kebutuhanKhususAyah")) ?> value="cerdas istimewa (I)">cerdas istimewa (I)</option>
                                <option <?= selectedOpt("bakat istimewa (J)", $this->input->post("kebutuhanKhususAyah")) ?> value="bakat istimewa (J)">bakat istimewa (J)</option>
                                <option <?= selectedOpt("kesulitan ", $this->input->post("kebutuhanKhususAyah")) ?> value="kesulitan belajar (K)">kesulitan belajar (K)</option>
                                <option <?= selectedOpt("narkoba (N)", $this->input->post("kebutuhanKhususAyah")) ?> value="narkoba (N)">narkoba (N)</option>
                                <option <?= selectedOpt("indigo (O)", $this->input->post("kebutuhanKhususAyah")) ?> value="indigo (O)">indigo (O)</option>
                                <option <?= selectedOpt("down syndrome (P)", $this->input->post("kebutuhanKhususAyah")) ?> value="down syndrome (P)">down syndrome (P)</option>
                                <option <?= selectedOpt("autis (Q)", $this->input->post("kebutuhanKhususAyah")) ?> value="autis (Q)">autis (Q)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Data Ibu</h3>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" placeholder="(Nama sesuai KK)" autocomplete="on" value="<?= updateFormValue($this->session->userdata('formDataPPDB')["nama_ibu"], $this->input->post('nama_ibu')) ?>">
                            <?= form_error('nama_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nik_ibu">NIK Ibu</label>
                            <input type="text" name="nik_ibu" class="form-control" id="nik_ibu" placeholder="(NIK ibu)" autocomplete="on" value="<?= set_value('nik_ibu') ?>" maxlength="16" minlength="16">
                            <?= form_error('nik_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="tahun_lahir_ibu">Tahun Lahir Ibu</label>
                            <input type="text" name="tahun_lahir_ibu" class="form-control" id="tahun_lahir_ibu" placeholder="(Tahun Lahir ibu)" autocomplete="on" minlength="4" maxlength="4" value="<?= set_value('tahun_lahir_ibu') ?>">
                            <?= form_error('tahun_lahir_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pendidikan_ibu">Pendidikan Terakhir</label>
                            <select class="custom-select" id="pendidikan_ibu" name="pendidikan_ibu">
                                <option <?= waliSelectedOpt("D1", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="D1">D1</option>
                                <option <?= waliSelectedOpt("D2", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="D2">D2</option>
                                <option <?= waliSelectedOpt("D3", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="D3">D3</option>
                                <option <?= waliSelectedOpt("D4", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="D4">D4</option>
                                <option <?= waliSelectedOpt("Informal", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?>value="Informal">Informal</option>
                                <option <?= waliSelectedOpt("Lainnya", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Lainnya">Lainnya</option>
                                <option <?= waliSelectedOpt("Non formal", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Non formal">Non formal</option>
                                <option <?= waliSelectedOpt("Paket A", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Paket A">Paket A</option>
                                <option <?= waliSelectedOpt("Paket B", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Paket B">Paket B</option>
                                <option <?= waliSelectedOpt("Paket C", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Paket C">Paket C</option>
                                <option <?= waliSelectedOpt("PAUD", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="PAUD">PAUD</option>
                                <option <?= waliSelectedOpt("Profesi", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Profesi">Profesi</option>
                                <option <?= waliSelectedOpt("Putus SD", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Putus SD">Putus SD</option>
                                <option <?= waliSelectedOpt("S1", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="S1">S1</option>
                                <option <?= waliSelectedOpt("S2", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="S2">S2</option>
                                <option <?= waliSelectedOpt("D2 terapan", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="S2 terapan">S2 terapan</option>
                                <option <?= waliSelectedOpt("S3", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="S3">S3</option>
                                <option <?= waliSelectedOpt("S3 terapan", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="S3 terapan">S3 terapan</option>
                                <option <?= waliSelectedOpt("SD / sederajat", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="SD / sederajat">SD / sederajat</option>
                                <option <?= waliSelectedOpt("SMP / sederajat", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="SMP / sederajat">SMP / sederajat</option>
                                <option <?= waliSelectedOpt("SMA / sederajat", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="SMA / sederajat">SMA / sederajat</option>
                                <option <?= waliSelectedOpt("Sp-1", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Sp-1">Sp-1</option>
                                <option <?= waliSelectedOpt("Sp-2", $this->input->post("pendidikan_ibu"), $this->session->userdata('formDataPPDB')["pendterakhir_ibu"]) ?> value="Sp-2">Sp-2</option>
                            </select>
                            <?= form_error('pendterakhir_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_ibu">Pekerjaan</label>
                            <select class="custom-select" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                <option <?= waliSelectedOpt("Tidak bekerja", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Tidak bekerja">Tidak bekerja</option>
                                <option <?= waliSelectedOpt("Nelayan", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Nelayan">Nelayan</option>
                                <option <?= waliSelectedOpt("Petani", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Petani">Petani</option>
                                <option <?= waliSelectedOpt("Peternak", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Peternak">Peternak</option>
                                <option <?= waliSelectedOpt("PNS/TNI/Polri", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                <option <?= waliSelectedOpt("Karyawan Swasta", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Karyawan Swasta">Karyawan Swasta</option>
                                <option <?= waliSelectedOpt("Pedagang Kecil", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Pedagang Kecil">Pedagang Kecil</option>
                                <option <?= waliSelectedOpt("Pedagang Besar", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Pedagang Besar">Pedagang Besar</option>
                                <option <?= waliSelectedOpt("Wiraswasta", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Wiraswasta">Wiraswasta</option>
                                <option <?= waliSelectedOpt("Wirausaha", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Wirausaha">Wirausaha</option>
                                <option <?= waliSelectedOpt("Buruh", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Buruh">Buruh</option>
                                <option <?= waliSelectedOpt("Pensiunan", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Pensiunan">Pensiunan</option>
                                <option <?= waliSelectedOpt("Tenaga Kerja Indonesia", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                                <option <?= waliSelectedOpt("Karyawan BUMN", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Karyawan BUMN">Karyawan BUMN</option>
                                <option <?= waliSelectedOpt("Tidak dapat diterapkan", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                <option <?= waliSelectedOpt("Sudah Meninggal", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Sudah Meninggal">Sudah Meninggal</option>
                                <option <?= waliSelectedOpt("Lainnya", $this->input->post("pekerjaan_ibu"), $this->session->userdata('formDataPPDB')["pekerjaan_ibu"]) ?> value="Lainnya">Lainnya</option>
                            </select>
                            <?= form_error('pekerjaan_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="penghasilan_ibu">Penghasilan Ibu</label>
                            <select class="custom-select" id="penghasilan_ibu" name="penghasilan_ibu" value="<?= set_value('penghasilan_ibu') ?>">
                                <option <?= selectedOpt("Kurang dari Rp. 500,000", $this->input->post("penghasilan_ibu")) ?> value="Kurang dari Rp. 500,000">Kurang dari Rp. 500,000</option>
                                <option <?= selectedOpt("Rp. 500,000 - Rp. 999,999", $this->input->post("penghasilan_ibu")) ?> value="Rp. 500,000 - Rp. 999,999">Rp. 500,000 - Rp. 999,999</option>
                                <option <?= selectedOpt("Rp. 1,000,000 - Rp. 1,999,999", $this->input->post("penghasilan_ibu")) ?> value="Rp. 1,000,000 - Rp. 1,999,999">Rp. 1,000,000 - Rp. 1,999,999</option>
                                <option <?= selectedOpt("Rp. 2,000,000 - Rp. 4,999,999", $this->input->post("penghasilan_ibu")) ?> value="Rp. 2,000,000 - Rp. 4,999,999">Rp. 2,000,000 - Rp. 4,999,999</option>
                                <option <?= selectedOpt("Rp. 5,000,000 - Rp. 20,000,000", $this->input->post("penghasilan_ibu")) ?> value="Rp. 5,000,000 - Rp. 20,000,000">Rp. 5,000,000 - Rp. 20,000,000</option>
                                <option <?= selectedOpt("Lebih dari Rp. 20,000,000", $this->input->post("penghasilan_ibu")) ?> value="Lebih dari Rp. 20,000,000">Lebih dari Rp. 20,000,000</option>
                                <option <?= selectedOpt("Tidak Berpenghasilan", $this->input->post("penghasilan_ibu")) ?> value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kebutuhanKhususIbu">Berkebutuhan Khusus Ibu?</label>
                            <select class="custom-select" id="kebutuhanKhususIbu" name="kebutuhanKhususIbu" value="<?= set_value('kebutuhanKhususIbu') ?>">
                                <option value="tidak">Tidak ada</option>
                                <option <?= selectedOpt("netra (A)", $this->input->post("kebutuhanKhususIbu")) ?> value="netra (A)">netra (A)</option>
                                <option <?= selectedOpt("rungu (B)", $this->input->post("kebutuhanKhususIbu")) ?> value="rungu (B)">rungu (B)</option>
                                <option <?= selectedOpt("grahita ringan (C)", $this->input->post("kebutuhanKhususIbu")) ?> value="grahita ringan (C)">grahita ringan (C)</option>
                                <option <?= selectedOpt("grahita sedang (C1)", $this->input->post("kebutuhanKhususIbu")) ?> value="grahita sedang (C1)">grahita sedang (C1)</option>
                                <option <?= selectedOpt("daksa ringan (D)", $this->input->post("kebutuhanKhususIbu")) ?> value="daksa ringan (D)">daksa ringan (D)</option>
                                <option <?= selectedOpt("daksa sedang (D1)", $this->input->post("kebutuhanKhususIbu")) ?> value="daksa sedang (D1)">daksa sedang (D1)</option>
                                <option <?= selectedOpt("laras (E)", $this->input->post("kebutuhanKhususIbu")) ?> value="laras (E)">laras (E)</option>
                                <option <?= selectedOpt("wicara (F)", $this->input->post("kebutuhanKhususIbu")) ?> value="wicara (F)">wicara (F)</option>
                                <option <?= selectedOpt("hyperaktif (H)", $this->input->post("kebutuhanKhususIbu")) ?> value="hyperaktif (H)">hyperaktif (H)</option>
                                <option <?= selectedOpt("cerdas istimewa (I)", $this->input->post("kebutuhanKhususIbu")) ?> value="cerdas istimewa (I)">cerdas istimewa (I)</option>
                                <option <?= selectedOpt("bakat istimewa (J)", $this->input->post("kebutuhanKhususIbu")) ?> value="bakat istimewa (J)">bakat istimewa (J)</option>
                                <option <?= selectedOpt("kesulitan ", $this->input->post("kebutuhanKhususIbu")) ?> value="kesulitan belajar (K)">kesulitan belajar (K)</option>
                                <option <?= selectedOpt("narkoba (N)", $this->input->post("kebutuhanKhususIbu")) ?> value="narkoba (N)">narkoba (N)</option>
                                <option <?= selectedOpt("indigo (O)", $this->input->post("kebutuhanKhususIbu")) ?> value="indigo (O)">indigo (O)</option>
                                <option <?= selectedOpt("down syndrome (P)", $this->input->post("kebutuhanKhususIbu")) ?> value="down syndrome (P)">down syndrome (P)</option>
                                <option <?= selectedOpt("autis (Q)", $this->input->post("kebutuhanKhususIbu")) ?> value="autis (Q)">autis (Q)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="form-group pl-4 mt-3">
                <label for="mempunyaiWali" class="mr-3">Mempunyai Wali?</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="mempunyaiWali" name="mempunyaiWali" class="custom-control-input" <?= punyaWali("ya", $this->input->post("mempunyaiWali"), $this->session->userdata('formDataPPDB')["mempunyaiWali"]) ?> value="ya">
                    <label class="custom-control-label" for="mempunyaiWali">Ya</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="tidakMempunyaiWali" <?= punyaWali("tidak", $this->input->post("mempunyaiWali"), $this->session->userdata('formDataPPDB')["mempunyaiWali"]) ?> name="mempunyaiWali" class="custom-control-input" value="tidak">
                    <label class="custom-control-label" for="tidakMempunyaiWali">Tidak</label>
                </div>
            </div>
        </div>
        <div class="place-for-data-wali-ajax">
            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 mt-3">
                    <button type="submit" id="submit-btn" class="btn btn-primary float-right" name="submit-btn">Kirim Data</button>
                </div>
            </div>
        </div>
    </form>
</div>