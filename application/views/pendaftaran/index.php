<div class="col-lg">
    <form action="" method="post">
        <?= form_error('wali', '<div class="row justify-content-center"><div class="text-center alert alert-danger alert-dismissible fade show mt-2 col-lg-8 ml-3 mr-3" role="alert"><strong>Gagal!</strong> ', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>') ?>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Data Ayah</h3>
                        <div class="form-group">
                            <label for="nama_ayah">Nama ayah</label>
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <input type="text" name="nama_ayah" class="form-control fill" id="nama_ayah" placeholder="(Nama sesuai KK)" autocomplete="off" value="<?= $this->session->userdata('nama_ayah') ?>" autofocus>
                            <?= form_error('nama_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat_ayah">Alamat</label>
                            <input type="text" name="alamat_ayah" class="form-control" id="alamat_ayah" placeholder="(Alamat sesuai KK)" autocomplete="off" value="<?= $this->session->userdata('alamat_ayah') ?>">
                            <?= form_error('alamat_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_ayah">Pekerjaan</label>
                            <select class="custom-select" id="pekerjaan_ayah" name="pekerjaan_ayah">
                                <option <?= selectedOpt("Tidak bekerja", $this->session->userdata('pekerjaan_ayah')) ?> value="Tidak bekerja">Tidak bekerja</option>
                                <option <?= selectedOpt("Nelayan", $this->session->userdata('pekerjaan_ayah')) ?> value="Nelayan">Nelayan</option>
                                <option <?= selectedOpt("Petani", $this->session->userdata('pekerjaan_ayah')) ?> value="Petani">Petani</option>
                                <option <?= selectedOpt("Peternak", $this->session->userdata('pekerjaan_ayah')) ?> value="Peternak">Peternak</option>
                                <option <?= selectedOpt("PNS/TNI/Polri", $this->session->userdata('pekerjaan_ayah')) ?> value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                <option <?= selectedOpt("Karyawan Swasta", $this->session->userdata('pekerjaan_ayah')) ?> value="Karyawan Swasta">Karyawan Swasta</option>
                                <option <?= selectedOpt("Pedagang Kecil", $this->session->userdata('pekerjaan_ayah')) ?> value="Pedagang Kecil">Pedagang Kecil</option>
                                <option <?= selectedOpt("Pedagang Besar", $this->session->userdata('pekerjaan_ayah')) ?> value="Pedagang Besar">Pedagang Besar</option>
                                <option <?= selectedOpt("Wiraswasta", $this->session->userdata('pekerjaan_ayah')) ?> value="Wiraswasta">Wiraswasta</option>
                                <option <?= selectedOpt("Wirausaha", $this->session->userdata('pekerjaan_ayah')) ?> value="Wirausaha">Wirausaha</option>
                                <option <?= selectedOpt("Buruh", $this->session->userdata('pekerjaan_ayah')) ?> value="Buruh">Buruh</option>
                                <option <?= selectedOpt("Pensiunan", $this->session->userdata('pekerjaan_ayah')) ?> value="Pensiunan">Pensiunan</option>
                                <option <?= selectedOpt("Tenaga Kerja Indonesia", $this->session->userdata('pekerjaan_ayah')) ?> value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                                <option <?= selectedOpt("Karyawan BUMN", $this->session->userdata('pekerjaan_ayah')) ?> value="Karyawan BUMN">Karyawan BUMN</option>
                                <option <?= selectedOpt("Tidak dapat diterapkan", $this->session->userdata('pekerjaan_ayah')) ?> value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                <option <?= selectedOpt("Sudah Meninggal", $this->session->userdata('pekerjaan_ayah')) ?> value="Sudah Meninggal">Sudah Meninggal</option>
                                <option <?= selectedOpt("Lainnya", $this->session->userdata('pekerjaan_ayah')) ?> value="Lainnya">Lainnya</option>
                            </select>
                            <?= form_error('pekerjaan_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pendterakhir_ayah">Pendidikan Terakhir</label>
                            <select class="custom-select" id="pendterakhir_ayah" name="pendterakhir_ayah" value="<?= set_value('pendterakhir_ayah') ?>">
                                <option <?= pendidikanWali("D1", $this->session->userdata('pendterakhir_ayah')) ?> value="D1">D1</option>
                                <option <?= pendidikanWali("D2", $this->session->userdata('pendterakhir_ayah')) ?> value="D2">D2</option>
                                <option <?= pendidikanWali("D3", $this->session->userdata('pendterakhir_ayah')) ?> value="D3">D3</option>
                                <option <?= pendidikanWali("D4", $this->session->userdata('pendterakhir_ayah')) ?> value="D4">D4</option>
                                <option <?= pendidikanWali("Informal", $this->session->userdata('pendterakhir_ayah')) ?>value="Informal">Informal</option>
                                <option <?= pendidikanWali("Lainnya", $this->session->userdata('pendterakhir_ayah')) ?> value="Lainnya">Lainnya</option>
                                <option <?= pendidikanWali("Non formal", $this->session->userdata('pendterakhir_ayah')) ?> value="Non formal">Non formal</option>
                                <option <?= pendidikanWali("Paket A", $this->session->userdata('pendterakhir_ayah')) ?> value="Paket A">Paket A</option>
                                <option <?= pendidikanWali("Paket B", $this->session->userdata('pendterakhir_ayah')) ?> value="Paket B">Paket B</option>
                                <option <?= pendidikanWali("Paket C", $this->session->userdata('pendterakhir_ayah')) ?> value="Paket C">Paket C</option>
                                <option <?= pendidikanWali("PAUD", $this->session->userdata('pendterakhir_ayah')) ?> value="PAUD">PAUD</option>
                                <option <?= pendidikanWali("Profesi", $this->session->userdata('pendterakhir_ayah')) ?> value="Profesi">Profesi</option>
                                <option <?= pendidikanWali("Putus SD", $this->session->userdata('pendterakhir_ayah')) ?> value="Putus SD">Putus SD</option>
                                <option <?= pendidikanWali("S1", $this->session->userdata('pendterakhir_ayah')) ?> value="S1">S1</option>
                                <option <?= pendidikanWali("S2", $this->session->userdata('pendterakhir_ayah')) ?> value="S2">S2</option>
                                <option <?= pendidikanWali("D2 terapan", $this->session->userdata('pendterakhir_ayah')) ?> value="S2 terapan">S2 terapan</option>
                                <option <?= pendidikanWali("S3", $this->session->userdata('pendterakhir_ayah')) ?> value="S3">S3</option>
                                <option <?= pendidikanWali("S3 terapan", $this->session->userdata('pendterakhir_ayah')) ?> value="S3 terapan">S3 terapan</option>
                                <option <?= pendidikanWali("SD / sederajat", $this->session->userdata('pendterakhir_ayah')) ?> value="SD / sederajat">SD / sederajat</option>
                                <option <?= pendidikanWali("SMP / sederajat", $this->session->userdata('pendterakhir_ayah')) ?> value="SMP / sederajat">SMP / sederajat</option>
                                <option <?= pendidikanWali("SMA / sederajat", $this->session->userdata('pendterakhir_ayah')) ?> value="SMA / sederajat">SMA / sederajat</option>
                                <option <?= pendidikanWali("Sp-1", $this->session->userdata('pendterakhir_ayah')) ?> value="Sp-1">Sp-1</option>
                                <option <?= pendidikanWali("Sp-2", $this->session->userdata('pendterakhir_ayah')) ?> value="Sp-2">Sp-2</option>
                            </select>
                            <?= form_error('pendterakhir_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_ayah">Keterangan</label>
                            <input type="text" name="keterangan_ayah" class="form-control" id="keterangan_ayah" autocomplete="off" value="<?= $this->session->userdata('keterangan_ayah') ?>" placeholder="(meninggal, di luar kota/negeri, dsb)">
                            <?= form_error('keterangan_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nohape_ayah">No HP/WA</label>
                            <input type="text" name="nohape_ayah" class="form-control" id="nohape_ayah" autocomplete="off" value="<?= $this->session->userdata('nohape_ayah') ?>">
                            <?= form_error('nohape_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Data Ibu</h3>
                        <input type="hidden" class="first" value="<?= $this->session->userdata('first') ?>">
                        <input type="hidden" class="error" value="<?= $this->session->userdata('error') ?>">
                        <div class="form-group">
                            <label for="nama_ibu">Nama ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" placeholder="(Nama sesuai KK)" autocomplete="off" value="<?= $this->session->userdata('nama_ibu') ?>">
                            <?= form_error('nama_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat_ibu">Alamat</label>
                            <input type="text" name="alamat_ibu" class="form-control" id="alamat_ibu" placeholder="(Alamat sesuai KK)" autocomplete="off" value="<?= $this->session->userdata('alamat_ibu') ?>">
                            <?= form_error('alamat_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_ibu">Pekerjaan</label>
                            <select class="custom-select" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                <option <?= selectedOpt("Tidak bekerja", $this->session->userdata('pekerjaan_ibu')) ?> value="Tidak bekerja">Tidak bekerja</option>
                                <option <?= selectedOpt("Nelayan", $this->session->userdata('pekerjaan_ibu')) ?> value="Nelayan">Nelayan</option>
                                <option <?= selectedOpt("Petani", $this->session->userdata('pekerjaan_ibu')) ?> value="Petani">Petani</option>
                                <option <?= selectedOpt("Peternak", $this->session->userdata('pekerjaan_ibu')) ?> value="Peternak">Peternak</option>
                                <option <?= selectedOpt("PNS/TNI/Polri", $this->session->userdata('pekerjaan_ibu')) ?> value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                <option <?= selectedOpt("Karyawan Swasta", $this->session->userdata('pekerjaan_ibu')) ?> value="Karyawan Swasta">Karyawan Swasta</option>
                                <option <?= selectedOpt("Pedagang Kecil", $this->session->userdata('pekerjaan_ibu')) ?> value="Pedagang Kecil">Pedagang Kecil</option>
                                <option <?= selectedOpt("Pedagang Besar", $this->session->userdata('pekerjaan_ibu')) ?> value="Pedagang Besar">Pedagang Besar</option>
                                <option <?= selectedOpt("Wiraswasta", $this->session->userdata('pekerjaan_ibu')) ?> value="Wiraswasta">Wiraswasta</option>
                                <option <?= selectedOpt("Wirausaha", $this->session->userdata('pekerjaan_ibu')) ?> value="Wirausaha">Wirausaha</option>
                                <option <?= selectedOpt("Buruh", $this->session->userdata('pekerjaan_ibu')) ?> value="Buruh">Buruh</option>
                                <option <?= selectedOpt("Pensiunan", $this->session->userdata('pekerjaan_ibu')) ?> value="Pensiunan">Pensiunan</option>
                                <option <?= selectedOpt("Tenaga Kerja Indonesia", $this->session->userdata('pekerjaan_ibu')) ?> value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                                <option <?= selectedOpt("Karyawan BUMN", $this->session->userdata('pekerjaan_ibu')) ?> value="Karyawan BUMN">Karyawan BUMN</option>
                                <option <?= selectedOpt("Tidak dapat diterapkan", $this->session->userdata('pekerjaan_ibu')) ?> value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                <option <?= selectedOpt("Sudah Meninggal", $this->session->userdata('pekerjaan_ibu')) ?> value="Sudah Meninggal">Sudah Meninggal</option>
                                <option <?= selectedOpt("Lainnya", $this->session->userdata('pekerjaan_ibu')) ?> value="Lainnya">Lainnya</option>
                            </select>
                            <?= form_error('pekerjaan_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pendterakhir_ibu">Pendidikan Terakhir</label>
                            <select class="custom-select" id="pendterakhir_ibu" name="pendterakhir_ibu" value="<?= set_value('pendterakhir_ibu') ?>">
                                <option <?= pendidikanWali("D1", $this->session->userdata('pendterakhir_ibu')) ?> value="D1">D1</option>
                                <option <?= pendidikanWali("D2", $this->session->userdata('pendterakhir_ibu')) ?> value="D2">D2</option>
                                <option <?= pendidikanWali("D3", $this->session->userdata('pendterakhir_ibu')) ?> value="D3">D3</option>
                                <option <?= pendidikanWali("D4", $this->session->userdata('pendterakhir_ibu')) ?> value="D4">D4</option>
                                <option <?= pendidikanWali("Informal", $this->session->userdata('pendterakhir_ibu')) ?>value="Informal">Informal</option>
                                <option <?= pendidikanWali("Lainnya", $this->session->userdata('pendterakhir_ibu')) ?> value="Lainnya">Lainnya</option>
                                <option <?= pendidikanWali("Non formal", $this->session->userdata('pendterakhir_ibu')) ?> value="Non formal">Non formal</option>
                                <option <?= pendidikanWali("Paket A", $this->session->userdata('pendterakhir_ibu')) ?> value="Paket A">Paket A</option>
                                <option <?= pendidikanWali("Paket B", $this->session->userdata('pendterakhir_ibu')) ?> value="Paket B">Paket B</option>
                                <option <?= pendidikanWali("Paket C", $this->session->userdata('pendterakhir_ibu')) ?> value="Paket C">Paket C</option>
                                <option <?= pendidikanWali("PAUD", $this->session->userdata('pendterakhir_ibu')) ?> value="PAUD">PAUD</option>
                                <option <?= pendidikanWali("Profesi", $this->session->userdata('pendterakhir_ibu')) ?> value="Profesi">Profesi</option>
                                <option <?= pendidikanWali("Putus SD", $this->session->userdata('pendterakhir_ibu')) ?> value="Putus SD">Putus SD</option>
                                <option <?= pendidikanWali("S1", $this->session->userdata('pendterakhir_ibu')) ?> value="S1">S1</option>
                                <option <?= pendidikanWali("S2", $this->session->userdata('pendterakhir_ibu')) ?> value="S2">S2</option>
                                <option <?= pendidikanWali("D2 terapan", $this->session->userdata('pendterakhir_ibu')) ?> value="S2 terapan">S2 terapan</option>
                                <option <?= pendidikanWali("S3", $this->session->userdata('pendterakhir_ibu')) ?> value="S3">S3</option>
                                <option <?= pendidikanWali("S3 terapan", $this->session->userdata('pendterakhir_ibu')) ?> value="S3 terapan">S3 terapan</option>
                                <option <?= pendidikanWali("SD / sederajat", $this->session->userdata('pendterakhir_ibu')) ?> value="SD / sederajat">SD / sederajat</option>
                                <option <?= pendidikanWali("SMP / sederajat", $this->session->userdata('pendterakhir_ibu')) ?> value="SMP / sederajat">SMP / sederajat</option>
                                <option <?= pendidikanWali("SMA / sederajat", $this->session->userdata('pendterakhir_ibu')) ?> value="SMA / sederajat">SMA / sederajat</option>
                                <option <?= pendidikanWali("Sp-1", $this->session->userdata('pendterakhir_ibu')) ?> value="Sp-1">Sp-1</option>
                                <option <?= pendidikanWali("Sp-2", $this->session->userdata('pendterakhir_ibu')) ?> value="Sp-2">Sp-2</option>
                            </select>
                            <?= form_error('pendterakhir_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_ibu">Keterangan</label>
                            <input type="text" name="keterangan_ibu" class="form-control" id="keterangan_ibu" autocomplete="off" value="<?= $this->session->userdata('keterangan_ibu') ?>" placeholder="(meninggal, di luar kota/negeri, dsb)">
                            <?= form_error('keterangan_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nohape_ibu">No HP/WA</label>
                            <input type="text" name="nohape_ibu" class="form-control" id="nohape_ibu" autocomplete="off" value="<?= $this->session->userdata('nohape_ibu') ?>">
                            <?= form_error('nohape_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-sm">
                <label class="float-right mt-2" for="wali">Wali murid:</label>
            </div>
            <div class="col-sm-2 mb-2">
                <select class="custom-select" id="wali" name="wali" value="<?= set_value('wali') ?>">
                    <option value="">Pilih salah satu</option>
                    <option <?= selectwali('Ayah') ?> value="Ayah">Ayah</option>
                    <option <?= selectwali('Ibu') ?> value="Ibu">Ibu</option>
                    <option <?= selectwali('Lainnya') ?> value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary float-right" name="submit">Selanjutnya</button>
            </div>
        </div>
    </form>
</div>