<div class="col-lg">
    <!-- <?php var_dump($this->session->userdata('stwali')) ?> -->
    <form action="" method="post">
        <?= form_error('wali', '<div class="row justify-content-center"><div class="text-center alert alert-danger alert-dismissible fade show mt-2 col-lg-8 ml-3 mr-3" role="alert"><strong>Gagal!</strong> ', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>') ?>
        <div class="row">
            <div class="col-md-6 mt-2">
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
                            <input type="text" name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah" autocomplete="off" value="<?= $this->session->userdata('pekerjaan_ayah') ?>">
                            <?= form_error('pekerjaan_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pendterakhir_ayah">Pendidikan terakhir</label>
                            <input type="text" name="pendterakhir_ayah" class="form-control" id="pendterakhir_ayah" autocomplete="off" value="<?= $this->session->userdata('pendterakhir_ayah') ?>">
                            <?= form_error('pendterakhir_ayah', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_ayah">Keterangan</label>
                            <input type="text" name="keterangan_ayah" class="form-control" id="keterangan_ayah" autocomplete="off" value="<?= $this->session->userdata('keterangan_ayah') ?>" placeholder="(meninggal, bercerai, di luar kota, dsb)">
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
            <div class="col-md-6 mt-2">
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
                            <input type="text" name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu" autocomplete="off" value="<?= $this->session->userdata('pekerjaan_ibu') ?>">
                            <?= form_error('pekerjaan_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pendterakhir_ibu">Pendidikan terakhir</label>
                            <input type="text" name="pendterakhir_ibu" class="form-control" id="pendterakhir_ibu" autocomplete="off" value="<?= $this->session->userdata('pendterakhir_ibu') ?>">
                            <?= form_error('pendterakhir_ibu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_ibu">Keterangan</label>
                            <input type="text" name="keterangan_ibu" class="form-control" id="keterangan_ibu" autocomplete="off" value="<?= $this->session->userdata('keterangan_ibu') ?>" placeholder="(meninggal, bercerai, di luar kota, dsb)">
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