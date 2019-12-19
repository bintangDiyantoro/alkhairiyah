<div class="col-lg">
    <form action="" method="post">
        <?= form_error('wali', '<div class="row justify-content-center"><div class="text-center alert alert-danger alert-dismissible fade show mt-2 col-lg-8 ml-3 mr-3" role="alert"><strong>Gagal!</strong> ', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>') ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 my-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Data wali</h3>
                        <div class="form-group">
                            <label for="nama_wali">Nama</label>
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <input type="text" name="nama_wali" class="form-control" id="nama_wali" placeholder="(Nama sesuai KTP)" autocomplete="off" value="<?= $this->session->userdata('nama_wali') ?>">
                            <?= form_error('nama_wali', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat_wali">Alamat</label>
                            <input type="text" name="alamat_wali" class="form-control" id="alamat_wali" placeholder="(Alamat sesuai KTP)" autocomplete="off" value="<?= $this->session->userdata('alamat_wali') ?>">
                            <?= form_error('alamat_wali', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="status_wali">Status</label>
                            <input type="text" name="status_wali" class="form-control" id="status_wali" placeholder="(kakek/nenek/paman/bibi/lainnya)" autocomplete="off" value="<?= $this->session->userdata('status_wali') ?>">
                            <?= form_error('status_wali', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_wali">Pekerjaan</label>
                            <input type="text" name="pekerjaan_wali" class="form-control" id="pekerjaan_wali" autocomplete="off" value="<?= $this->session->userdata('pekerjaan_wali') ?>">
                        </div>
                        <div class="form-group">
                            <label for="pendterakhir_wali">Pendidikan terakhir</label>
                            <input type="text" name="pendterakhir_wali" class="form-control" id="pendterakhir_wali" autocomplete="off" value="<?= $this->session->userdata('pendterakhir_wali') ?>">
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