<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Calon Siswa</h5>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            ID Pendaftaran</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['id'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Nama</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['nama'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Jenis kelamin</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['jenis_kelamin'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Umur</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['umur'] . ' tahun' ?> <br>
                        </div>
                    </div>
                    <?php if ($calon_siswa['asal_tk'] !== null || $calon_siswa['asal_tk'] !== "") : ?>
                        <div class="row">
                            <div class="col-md-5 font-weight-bolder">
                                TK Asal</br>
                            </div>
                            <div class="col-md-5">
                                <?= $calon_siswa['asal_tk'] ?> <br>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Wali</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['namawali'] ?> <br>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-5 font-weight-bolder">
                            Terdaftar Pada</br>
                        </div>
                        <div class="col-md-7">
                            <?= $calon_siswa['tanggal'] . ' pukul ' . $calon_siswa['jam']  ?> <br>
                        </div>
                    </div>
                    <a href="<?= base_url('pendaftaran/tersimpan') ?>" class="btn btn-primary float-right mr-4">Kembali</a>
                    <input type="hidden" name="tersimpan" id="tersimpan" value="ok">
                </div>
            </div>
        </div>
    </div>
</div>