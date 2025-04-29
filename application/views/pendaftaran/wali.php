<div class="col-lg mt-3">
    <form action="" method="post">
        <?= form_error('wali', '<div class="row justify-content-center"><div class="text-center alert alert-danger alert-dismissible fade show mt-2 col-lg-8 ml-3 mr-3" role="alert"><strong>Gagal!</strong> ', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>') ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 my-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Data wali murid (selain ayah / wali)</h3>
                        <div class="form-group">
                            <label for="nama_wali">Nama Wali</label>
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <input type="text" name="nama_wali" class="form-control fill" id="nama_wali" placeholder="(Nama sesuai KTP)" autocomplete="off" value="<?= $this->session->userdata('nama_wali') ?>" autofocus>
                            <?= form_error('nama_wali', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat_wali">Alamat</label>
                            <input type="text" name="alamat_wali" class="form-control" id="alamat_wali" placeholder="(Alamat sesuai KTP)" autocomplete="off" value="<?= $this->session->userdata('alamat_wali') ?>">
                            <?= form_error('alamat_wali', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="status_wali">Status hubungan dengan murid</label>
                            <input type="text" name="status_wali" class="form-control" id="status_wali" placeholder="(kakek/nenek/paman/bibi/lainnya)" autocomplete="off" value="<?= $this->session->userdata('status_wali') ?>">
                            <?= form_error('status_wali', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_wali">Pekerjaan</label>
                            <select class="custom-select" id="pekerjaan_wali" name="pekerjaan_wali">
                                <option <?= selectedOpt("Tidak bekerja", $this->session->userdata('pekerjaan_wali')) ?> value="Tidak bekerja">Tidak bekerja</option>
                                <option <?= selectedOpt("Nelayan", $this->session->userdata('pekerjaan_wali')) ?> value="Nelayan">Nelayan</option>
                                <option <?= selectedOpt("Petani", $this->session->userdata('pekerjaan_wali')) ?> value="Petani">Petani</option>
                                <option <?= selectedOpt("Peternak", $this->session->userdata('pekerjaan_wali')) ?> value="Peternak">Peternak</option>
                                <option <?= selectedOpt("PNS/TNI/Polri", $this->session->userdata('pekerjaan_wali')) ?> value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                <option <?= selectedOpt("Karyawan Swasta", $this->session->userdata('pekerjaan_wali')) ?> value="Karyawan Swasta">Karyawan Swasta</option>
                                <option <?= selectedOpt("Pedagang Kecil", $this->session->userdata('pekerjaan_wali')) ?> value="Pedagang Kecil">Pedagang Kecil</option>
                                <option <?= selectedOpt("Pedagang Besar", $this->session->userdata('pekerjaan_wali')) ?> value="Pedagang Besar">Pedagang Besar</option>
                                <option <?= selectedOpt("Wiraswasta", $this->session->userdata('pekerjaan_wali')) ?> value="Wiraswasta">Wiraswasta</option>
                                <option <?= selectedOpt("Wirausaha", $this->session->userdata('pekerjaan_wali')) ?> value="Wirausaha">Wirausaha</option>
                                <option <?= selectedOpt("Buruh", $this->session->userdata('pekerjaan_wali')) ?> value="Buruh">Buruh</option>
                                <option <?= selectedOpt("Pensiunan", $this->session->userdata('pekerjaan_wali')) ?> value="Pensiunan">Pensiunan</option>
                                <option <?= selectedOpt("Tenaga Kerja Indonesia", $this->session->userdata('pekerjaan_wali')) ?> value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                                <option <?= selectedOpt("Karyawan BUMN", $this->session->userdata('pekerjaan_wali')) ?> value="Karyawan BUMN">Karyawan BUMN</option>
                                <option <?= selectedOpt("Tidak dapat diterapkan", $this->session->userdata('pekerjaan_wali')) ?> value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                <option <?= selectedOpt("Sudah Meninggal", $this->session->userdata('pekerjaan_wali')) ?> value="Sudah Meninggal">Sudah Meninggal</option>
                                <option <?= selectedOpt("Lainnya", $this->session->userdata('pekerjaan_wali')) ?> value="Lainnya">Lainnya</option>
                            </select>
                            <?= form_error('pekerjaan_wali', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pendterakhir_wali">Pendidikan Terakhir</label>
                            <select class="custom-select" id="pendterakhir_wali" name="pendterakhir_wali" value="<?= set_value('pendterakhir_wali') ?>">
                                <option <?= pendidikanWali("D1", $this->session->userdata('pendterakhir_wali')) ?> value="D1">D1</option>
                                <option <?= pendidikanWali("D2", $this->session->userdata('pendterakhir_wali')) ?> value="D2">D2</option>
                                <option <?= pendidikanWali("D3", $this->session->userdata('pendterakhir_wali')) ?> value="D3">D3</option>
                                <option <?= pendidikanWali("D4", $this->session->userdata('pendterakhir_wali')) ?> value="D4">D4</option>
                                <option <?= pendidikanWali("Informal", $this->session->userdata('pendterakhir_wali')) ?>value="Informal">Informal</option>
                                <option <?= pendidikanWali("Lainnya", $this->session->userdata('pendterakhir_wali')) ?> value="Lainnya">Lainnya</option>
                                <option <?= pendidikanWali("Non formal", $this->session->userdata('pendterakhir_wali')) ?> value="Non formal">Non formal</option>
                                <option <?= pendidikanWali("Paket A", $this->session->userdata('pendterakhir_wali')) ?> value="Paket A">Paket A</option>
                                <option <?= pendidikanWali("Paket B", $this->session->userdata('pendterakhir_wali')) ?> value="Paket B">Paket B</option>
                                <option <?= pendidikanWali("Paket C", $this->session->userdata('pendterakhir_wali')) ?> value="Paket C">Paket C</option>
                                <option <?= pendidikanWali("PAUD", $this->session->userdata('pendterakhir_wali')) ?> value="PAUD">PAUD</option>
                                <option <?= pendidikanWali("Profesi", $this->session->userdata('pendterakhir_wali')) ?> value="Profesi">Profesi</option>
                                <option <?= pendidikanWali("Putus SD", $this->session->userdata('pendterakhir_wali')) ?> value="Putus SD">Putus SD</option>
                                <option <?= pendidikanWali("S1", $this->session->userdata('pendterakhir_wali')) ?> value="S1">S1</option>
                                <option <?= pendidikanWali("S2", $this->session->userdata('pendterakhir_wali')) ?> value="S2">S2</option>
                                <option <?= pendidikanWali("D2 terapan", $this->session->userdata('pendterakhir_wali')) ?> value="S2 terapan">S2 terapan</option>
                                <option <?= pendidikanWali("S3", $this->session->userdata('pendterakhir_wali')) ?> value="S3">S3</option>
                                <option <?= pendidikanWali("S3 terapan", $this->session->userdata('pendterakhir_wali')) ?> value="S3 terapan">S3 terapan</option>
                                <option <?= pendidikanWali("SD / sederajat", $this->session->userdata('pendterakhir_wali')) ?> value="SD / sederajat">SD / sederajat</option>
                                <option <?= pendidikanWali("SMP / sederajat", $this->session->userdata('pendterakhir_wali')) ?> value="SMP / sederajat">SMP / sederajat</option>
                                <option <?= pendidikanWali("SMA / sederajat", $this->session->userdata('pendterakhir_wali')) ?> value="SMA / sederajat">SMA / sederajat</option>
                                <option <?= pendidikanWali("Sp-1", $this->session->userdata('pendterakhir_wali')) ?> value="Sp-1">Sp-1</option>
                                <option <?= pendidikanWali("Sp-2", $this->session->userdata('pendterakhir_wali')) ?> value="Sp-2">Sp-2</option>
                            </select>
                            <?= form_error('pendterakhir_wali', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nohape_wali">No HP/WA</label>
                            <input type="text" name="nohape_wali" class="form-control" id="nohape_wali" autocomplete="off" value="<?= $this->session->userdata('nohape_wali') ?>">
                            <?= form_error('nohape_wali', '<small class="text-danger pl-3">', '</small>') ?>
                            <input type="hidden" class="error" value="<?= $this->session->userdata('error') ?>">
                        </div>
                        <div class="form-group float-md-right">
                            <button class="btn btn-info waliback">Kembali</button>
                            <button type="submit" class="btn btn-primary" name="submit">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>