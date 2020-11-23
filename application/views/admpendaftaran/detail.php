<div class="container mt-3 mb-3">
    <div class="row d-flex justify-content-center">
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
                            Nama ayah</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['nama_ayah'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Alamat ayah</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['alamat_ayah'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Pekerjaan ayah</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['pekerjaan_ayah'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Pendidikan terakhir ayah</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['pendterakhir_ayah'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Keterangan ayah</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['keterangan_ayah'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            No. HP ayah</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['nohape_ayah'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Nama ibu</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['nama_ibu'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Alamat ibu</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['alamat_ibu'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Pekerjaan ibu</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['pekerjaan_ibu'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Pendidikan terakhir ibu</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['pendterakhir_ibu'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Keterangan ibu</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['keterangan_ibu'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            No. HP ibu</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['nohape_ibu'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Nama wali</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['nama_wali'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Alamat wali</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['alamat_wali'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Status wali</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['status_wali'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Pekerjaan wali</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['pekerjaan_wali'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            Pendidikan terakhir wali</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['pendterakhir_wali'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            No. HP wali</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['wali']['nohape_wali'] ?> <br>
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
                    <a href="<?= base_url('admpendaftaran/tersimpan') ?>" class="btn btn-primary float-right mr-4">Kembali</a>
                    <input type="hidden" name="tersimpan" id="tersimpan" value="ok">
                </div>
            </div>
        </div>
    </div>
</div>