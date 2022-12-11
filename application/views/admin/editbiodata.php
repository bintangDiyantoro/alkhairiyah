<div class="container">
    <div class="row mt-5 mb-3 mx-4 d-flex justify-content-center">
        <h4>Ubah biodata <?= $biodata["nama"] ?></h4>
    </div>
    <div class="row my-2 mx-3 d-flex justify-content-center">
        <div class="col-md-5 ubah-biodata">
            <form action="" method="post">
                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                <input type="hidden" id="editBiodataAlert" name="id" value="<?= $biodata['id'] ?>" data-alert="<?= $this->session->flashdata("editBiodataAlert") ?>" data-name="<?= $biodata["nama"] ?>">
                <div class="form-group">
                    <label for="nomor_induk">No. Induk</label>
                    <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="<?= $biodata["nomor_induk"] ?>" placeholder="0000" maxlength="4">
                    <?= form_error('nomor_induk', '<small class="text-danger pl-3">', '</small>') ?>
                    <?= '<small class="text-danger pl-3">' . $this->session->flashdata('nomor_induk_error') . '</small>' ?>
                </div>
                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $biodata["nisn"] ?>" placeholder="0000000000" maxlength="10">
                    <?= form_error('nisn', '<small class="text-danger pl-3">', '</small>') ?>
                    <?= '<small class="text-danger pl-3">' . $this->session->flashdata('nisn_error') . '</small>' ?>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $biodata["nama"] ?>" placeholder="Fulan/ah" maxlength="50">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="tmp_lahir">Tempat, tgl lahir</label>
                    <div id="inline" data-date="01/01/2020"></div>
                    <?php explode(', ', $biodata["ttl"]) ?>
                    <input type="text" class="form-control col-sm-7 mr-1 mb-1" style="display: inline-block;" id="tmp_lahir" name="tmp_lahir" value="<?= explode(', ', $biodata["ttl"])[0] ?>" placeholder="Majapahit" autocomplete="off">
                    <input type="text" class="form-control col-sm-4" style="display: inline-block;" id="tgl_lahir_edit" name="tgl_lahir" value="<?= explode(', ', $biodata["ttl"])[1] ?>" data-pmu="<?= explode(', ', $biodata["ttl"])[1] ?>" placeholder="dd-mm-yyyy" autocomplete="off">
                    <?= form_error('ttl', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                        <option value="L" <?= selectedOpt("L", $biodata["jenis_kelamin"]) ?>>Laki-laki</option>
                        <option value="P" <?= selectedOpt("P", $biodata["jenis_kelamin"]) ?>>Perempuan</option>
                    </select>
                    <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <select id="agama" class="form-control" name="agama">
                        <option value="Islam" <?= selectedOpt("Islam", $biodata["agama"]) ?>>Islam</option>
                        <option value="Protestan" <?= selectedOpt("Protestan", $biodata["agama"]) ?>>Protestan</option>
                        <option value="Katholik" <?= selectedOpt("Katholik", $biodata["agama"]) ?>>Katholik</option>
                        <option value="Hindu" <?= selectedOpt("Hindu", $biodata["agama"]) ?>>Hindu</option>
                        <option value="Buddha" <?= selectedOpt("Buddha", $biodata["agama"]) ?>>Buddha</option>
                        <option value="Konghucu" <?= selectedOpt("Konghucu", $biodata["agama"]) ?>>Konghucu</option>
                    </select>
                    <?= form_error('agama', '<small class="text-danger pl-3">', '</small>') ?>
                    <?= '<small class="text-danger pl-3">' . $this->session->flashdata('agama_error') . '</small>' ?>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Lengkap"><?= $biodata["alamat"] ?></textarea>
                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="pendidikan_sebelumnya">Pendidikan Sebelumnya</label>
                    <input type="text" class="form-control" id="pendidikan_sebelumnya" name="pendidikan_sebelumnya" value="<?= $biodata["pendidikan_sebelumnya"] ?>" placeholder="SD/MI Majapahit 1">
                    <?= form_error('pendidikan_sebelumnya', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
        </div>
        <div class="col-md-5 ubah-biodata">
            <div class="form-group">
                <label for="nama_ayah">Nama Ayah</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $biodata["nama_ayah"] ?>" placeholder="Abu Fulan">
                <?= form_error('nama_ayah', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?= $biodata["pekerjaan_ayah"] ?>" placeholder="Presiden">
                <?= form_error('pekerjaan_ayah', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $biodata["nama_ibu"] ?>" placeholder="Ummu Fulan">
                <?= form_error('nama_ibu', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?= $biodata["pekerjaan_ibu"] ?>" placeholder="Pramugari">
                <?= form_error('pekerjaan_ibu', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <h5>Alamat Ortu</h5>
            <div class="form-group">
                <label for="provinsi_ortu">Provinsi</label>
                <select id="provinsi_ortu" class="form-control" name="provinsi_ortu">
                    <?= ($biodata["provinsi_ortu"]) ? '<option value="' . $biodata["provinsi_ortu"] . '">' . $biodata["provinsi_ortu"] . '</option>' : '<option value="">-- Pilih Provinsi --</option>' ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kabupaten_ortu">Kabupaten/Kota</label>
                <select id="kabupaten_ortu" class="form-control" name="kabupaten_ortu">
                    <?= ($biodata["kabupaten_ortu"]) ? '<option value="' . $biodata["kabupaten_ortu"] . '">' . $biodata["kabupaten_ortu"] . '</option>' : '<option value="">-- Pilih Kabupaten/Kota --</option>' ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kecamatan_ortu">Kecamatan</label>
                <select id="kecamatan_ortu" class="form-control" name="kecamatan_ortu">
                    <?= ($biodata["kecamatan_ortu"]) ? '<option value="' . $biodata["kecamatan_ortu"] . '">' . $biodata["kecamatan_ortu"] . '</option>' : '<option value="">-- Pilih Kecamatan --</option>' ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kelurahan_ortu">Kelurahan/Desa</label>
                <select id="kelurahan_ortu" class="form-control" name="kelurahan_ortu">
                    <?= ($biodata["kelurahan_ortu"]) ? '<option value="' . $biodata["kelurahan_ortu"] . '">' . $biodata["kelurahan_ortu"] . '</option>' : '<option value="">-- Pilih Kelurahan/Desa --</option>' ?>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat_ortu">Jalan, Blok, RT/RW</label>
                <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3" placeholder="Alamat Lengkap"><?= $biodata["alamat_ortu"] ?></textarea>
                <?= form_error('alamat_ortu', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="nama_wali">Nama Wali</label>
                <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?= $biodata["nama_wali"] ?>" placeholder="Fulan/ah">
                <?= form_error('nama_wali', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="pekerjaan_wali">Pekerjaan Wali</label>
                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="<?= $biodata["pekerjaan_wali"] ?>" placeholder="Wali Kota">
                <?= form_error('pekerjaan_wali', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <h5>Alamat Wali</h5>
            <div class="form-group">
                <label for="provinsi_wali">Provinsi</label>
                <select id="provinsi_wali" class="form-control" name="provinsi_wali">
                    <?= ($biodata["provinsi_wali"]) ? '<option value="' . $biodata["provinsi_wali"] . '">' . $biodata["provinsi_wali"] . '</option>' : '<option value="">-- Pilih Provinsi --</option>' ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kabupaten_wali">Kabupaten/Kota</label>
                <select id="kabupaten_wali" class="form-control" name="kabupaten_wali">
                    <?= ($biodata["kabupaten_wali"]) ? '<option value="' . $biodata["kabupaten_wali"] . '">' . $biodata["kabupaten_wali"] . '</option>' : '<option value="">-- Pilih Kabupaten/Kota --</option>' ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kecamatan_wali">Kecamatan</label>
                <select id="kecamatan_wali" class="form-control" name="kecamatan_wali">
                    <?= ($biodata["kecamatan_wali"]) ? '<option value="' . $biodata["kecamatan_wali"] . '">' . $biodata["kecamatan_wali"] . '</option>' : '<option value="">-- Pilih Kecamatan --</option>' ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kelurahan_wali">Kelurahan/Desa</label>
                <select id="kelurahan_wali" class="form-control" name="kelurahan_wali">
                    <?= ($biodata["kelurahan_wali"]) ? '<option value="' . $biodata["kelurahan_wali"] . '">' . $biodata["kelurahan_wali"] . '</option>' : '<option value="">-- Pilih Kelurahan/Desa --</option>' ?>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat_wali">Jalan, Blok, RT/RW</label>
                <textarea class="form-control" id="alamat_wali" name="alamat_wali" rows="3" placeholder="Alamat Lengkap"><?= $biodata["alamat_wali"] ?></textarea>
                <?= form_error('alamat_wali', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group mb-4">
                <label for="no_hp_ortu">No Hp Ortu/Wali</label>
                <input type="text" class="form-control" id="no_hp_ortu" name="no_hp_ortu" value="<?= $biodata["no_hp_ortu"] ?>" placeholder="+6280000000000">
                <?= form_error('no_hp_ortu', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group d-flex justify-content-end">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Ubah Data</button>
                </form>
                <a href="<?= base_url('admin/biodatasiswa/' . $biodata["id"]) ?>" class="btn btn-secondary ml-1">Kembali</a>
            </div>
        </div>
    </div>
</div>