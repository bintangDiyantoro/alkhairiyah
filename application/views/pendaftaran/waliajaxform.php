<div class="row d-flex justify-content-center">
    <div class="col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                <h3 class="text-center">Data Wali</h3>
                <div class="form-group">
                    <label for="nama_wali">Nama Wali</label>
                    <input type="text" name="nama_wali" class="form-control" id="nama_wali" placeholder="(Nama sesuai KK)" autocomplete="on" value="<?= updateFormValue($this->session->userdata('formDataPPDB')["nama_wali"], $this->input->post('nama_wali')) ?>">
                </div>
                <div class="form-group">
                    <label for="nik_wali">NIK Wali</label>
                    <input type="text" name="nik_wali" class="form-control" id="nik_wali" placeholder="(NIK wali)" autocomplete="on" value="<?= set_value('nik_wali') ?>" maxlength="16" minlength="16">
                </div>
                <div class="form-group">
                    <label for="tahun_lahir_wali">Tahun Lahir Wali</label>
                    <input type="text" name="tahun_lahir_wali" class="form-control" id="tahun_lahir_wali" placeholder="(Tahun Lahir wali)" autocomplete="on" minlength="4" maxlength="4" value="<?= set_value('tahun_lahir_wali') ?>">
                </div>
                <div class="form-group">
                    <label for="pendidikan_wali">Pendidikan Terakhir</label>
                    <select class="custom-select" id="pendidikan_wali" name="pendidikan_wali">
                        <option <?= waliSelectedOpt("D1", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="D1">D1</option>
                        <option <?= waliSelectedOpt("D2", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="D2">D2</option>
                        <option <?= waliSelectedOpt("D3", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="D3">D3</option>
                        <option <?= waliSelectedOpt("D4", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="D4">D4</option>
                        <option <?= waliSelectedOpt("Informal", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?>value="Informal">Informal</option>
                        <option <?= waliSelectedOpt("Lainnya", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Lainnya">Lainnya</option>
                        <option <?= waliSelectedOpt("Non formal", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Non formal">Non formal</option>
                        <option <?= waliSelectedOpt("Paket A", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Paket A">Paket A</option>
                        <option <?= waliSelectedOpt("Paket B", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Paket B">Paket B</option>
                        <option <?= waliSelectedOpt("Paket C", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Paket C">Paket C</option>
                        <option <?= waliSelectedOpt("PAUD", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="PAUD">PAUD</option>
                        <option <?= waliSelectedOpt("Profesi", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Profesi">Profesi</option>
                        <option <?= waliSelectedOpt("Putus SD", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Putus SD">Putus SD</option>
                        <option <?= waliSelectedOpt("S1", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="S1">S1</option>
                        <option <?= waliSelectedOpt("S2", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="S2">S2</option>
                        <option <?= waliSelectedOpt("D2 terapan", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="S2 terapan">S2 terapan</option>
                        <option <?= waliSelectedOpt("S3", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="S3">S3</option>
                        <option <?= waliSelectedOpt("S3 terapan", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="S3 terapan">S3 terapan</option>
                        <option <?= waliSelectedOpt("SD / sederajat", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="SD / sederajat">SD / sederajat</option>
                        <option <?= waliSelectedOpt("SMP / sederajat", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="SMP / sederajat">SMP / sederajat</option>
                        <option <?= waliSelectedOpt("SMA / sederajat", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="SMA / sederajat">SMA / sederajat</option>
                        <option <?= waliSelectedOpt("Sp-1", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Sp-1">Sp-1</option>
                        <option <?= waliSelectedOpt("Sp-2", $this->input->post("pendidikan_wali"), $this->session->userdata('formDataPPDB')["pendterakhir_wali"]) ?> value="Sp-2">Sp-2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pekerjaan_wali">Pekerjaan</label>
                    <select class="custom-select" id="pekerjaan_wali" name="pekerjaan_wali">
                        <option <?= waliSelectedOpt("Tidak bekerja", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Tidak bekerja">Tidak bekerja</option>
                        <option <?= waliSelectedOpt("Nelayan", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Nelayan">Nelayan</option>
                        <option <?= waliSelectedOpt("Petani", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Petani">Petani</option>
                        <option <?= waliSelectedOpt("Peternak", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Peternak">Peternak</option>
                        <option <?= waliSelectedOpt("PNS/TNI/Polri", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                        <option <?= waliSelectedOpt("Karyawan Swasta", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Karyawan Swasta">Karyawan Swasta</option>
                        <option <?= waliSelectedOpt("Pedagang Kecil", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Pedagang Kecil">Pedagang Kecil</option>
                        <option <?= waliSelectedOpt("Pedagang Besar", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Pedagang Besar">Pedagang Besar</option>
                        <option <?= waliSelectedOpt("Wiraswasta", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Wiraswasta">Wiraswasta</option>
                        <option <?= waliSelectedOpt("Wirausaha", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Wirausaha">Wirausaha</option>
                        <option <?= waliSelectedOpt("Buruh", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Buruh">Buruh</option>
                        <option <?= waliSelectedOpt("Pensiunan", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Pensiunan">Pensiunan</option>
                        <option <?= waliSelectedOpt("Tenaga Kerja Indonesia", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                        <option <?= waliSelectedOpt("Karyawan BUMN", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Karyawan BUMN">Karyawan BUMN</option>
                        <option <?= waliSelectedOpt("Tidak dapat diterapkan", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                        <option <?= waliSelectedOpt("Sudah Meninggal", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Sudah Meninggal">Sudah Meninggal</option>
                        <option <?= waliSelectedOpt("Lainnya", $this->input->post("pekerjaan_wali"), $this->session->userdata('formDataPPDB')["pekerjaan_wali"]) ?> value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="penghasilan_wali">Penghasilan Wali</label>
                    <select class="custom-select" id="penghasilan_wali" name="penghasilan_wali" value="<?= set_value('penghasilan_wali') ?>">
                        <option <?= selectedOpt("Kurang dari Rp. 500,000", $this->input->post("penghasilan_wali")) ?> value="Kurang dari Rp. 500,000">Kurang dari Rp. 500,000</option>
                        <option <?= selectedOpt("Rp. 500,000 - Rp. 999,999", $this->input->post("penghasilan_wali")) ?> value="Rp. 500,000 - Rp. 999,999">Rp. 500,000 - Rp. 999,999</option>
                        <option <?= selectedOpt("Rp. 1,000,000 - Rp. 1,999,999", $this->input->post("penghasilan_wali")) ?> value="Rp. 1,000,000 - Rp. 1,999,999">Rp. 1,000,000 - Rp. 1,999,999</option>
                        <option <?= selectedOpt("Rp. 2,000,000 - Rp. 4,999,999", $this->input->post("penghasilan_wali")) ?> value="Rp. 2,000,000 - Rp. 4,999,999">Rp. 2,000,000 - Rp. 4,999,999</option>
                        <option <?= selectedOpt("Rp. 5,000,000 - Rp. 20,000,000", $this->input->post("penghasilan_wali")) ?> value="Rp. 5,000,000 - Rp. 20,000,000">Rp. 5,000,000 - Rp. 20,000,000</option>
                        <option <?= selectedOpt("Lebih dari Rp. 20,000,000", $this->input->post("penghasilan_wali")) ?> value="Lebih dari Rp. 20,000,000">Lebih dari Rp. 20,000,000</option>
                        <option <?= selectedOpt("Tidak Berpenghasilan", $this->input->post("penghasilan_wali")) ?> value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kebutuhanKhususWali">Berkebutuhan Khusus Wali?</label>
                    <select class="custom-select" id="kebutuhanKhususWali" name="kebutuhanKhususWali" value="<?= set_value('kebutuhanKhususWali') ?>">
                        <option <?= selectedOpt("Tidak Ada", $this->input->post("kebutuhanKhususWali")) ?>value="Tidak Ada">Tidak ada</option>
                        <option <?= selectedOpt("netra (A)", $this->input->post("kebutuhanKhususWali")) ?> value="netra (A)">netra (A)</option>
                        <option <?= selectedOpt("rungu (B)", $this->input->post("kebutuhanKhususWali")) ?> value="rungu (B)">rungu (B)</option>
                        <option <?= selectedOpt("grahita ringan (C)", $this->input->post("kebutuhanKhususWali")) ?> value="grahita ringan (C)">grahita ringan (C)</option>
                        <option <?= selectedOpt("grahita sedang (C1)", $this->input->post("kebutuhanKhususWali")) ?> value="grahita sedang (C1)">grahita sedang (C1)</option>
                        <option <?= selectedOpt("daksa ringan (D)", $this->input->post("kebutuhanKhususWali")) ?> value="daksa ringan (D)">daksa ringan (D)</option>
                        <option <?= selectedOpt("daksa sedang (D1)", $this->input->post("kebutuhanKhususWali")) ?> value="daksa sedang (D1)">daksa sedang (D1)</option>
                        <option <?= selectedOpt("laras (E)", $this->input->post("kebutuhanKhususWali")) ?> value="laras (E)">laras (E)</option>
                        <option <?= selectedOpt("wicara (F)", $this->input->post("kebutuhanKhususWali")) ?> value="wicara (F)">wicara (F)</option>
                        <option <?= selectedOpt("hyperaktif (H)", $this->input->post("kebutuhanKhususWali")) ?> value="hyperaktif (H)">hyperaktif (H)</option>
                        <option <?= selectedOpt("cerdas istimewa (I)", $this->input->post("kebutuhanKhususWali")) ?> value="cerdas istimewa (I)">cerdas istimewa (I)</option>
                        <option <?= selectedOpt("bakat istimewa (J)", $this->input->post("kebutuhanKhususWali")) ?> value="bakat istimewa (J)">bakat istimewa (J)</option>
                        <option <?= selectedOpt("kesulitan ", $this->input->post("kebutuhanKhususWali")) ?> value="kesulitan belajar (K)">kesulitan belajar (K)</option>
                        <option <?= selectedOpt("narkoba (N)", $this->input->post("kebutuhanKhususWali")) ?> value="narkoba (N)">narkoba (N)</option>
                        <option <?= selectedOpt("indigo (O)", $this->input->post("kebutuhanKhususWali")) ?> value="indigo (O)">indigo (O)</option>
                        <option <?= selectedOpt("down syndrome (P)", $this->input->post("kebutuhanKhususWali")) ?> value="down syndrome (P)">down syndrome (P)</option>
                        <option <?= selectedOpt("autis (Q)", $this->input->post("kebutuhanKhususWali")) ?> value="autis (Q)">autis (Q)</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" id="submit-btn" class="btn btn-primary float-right mt-3" name="submit-btn">Kirim Data</button>
    </div>
</div>