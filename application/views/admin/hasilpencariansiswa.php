<div class="container">
    <?php if ($query && ($query[0]["class"] !== "lulus" && $query[0]["class"] !== "belum daftar")) : ?>
        <div class="row mt-3">
            <h4 class="text-center">Hasil Pencarian:</h4>
        </div>
        <div class="row" style="overflow-x: auto!important;">
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor Induk</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($query as $q) :
                        if ($q["class"] !== "lulus" && $q["class"] !== "belum daftar") : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $q["nomor_induk"] ?></td>
                                <td><?= $q["nisn"] ?></td>
                                <td><?= $q["nama"] ?></td>
                                <td>
                                    <?php if ($q["jenis_kelamin"] == "L") {
                                        echo "Laki-laki";
                                    } elseif ($q["jenis_kelamin"] == "P") {
                                        echo "Perempuan";
                                    } ?>
                                </td>
                                <td><?= $q["class"] ?></td>
                                <td>
                                    <?php if ($q["class"] === "-") : ?>
                                        <a href="<?= base_url('admin/masukkankelas/' . $q["id"] . "/" . $this->session->userdata("id_kelas") . "/" . $this->session->userdata("tahun")) ?>" class="badge badge-primary badge-masukkan-siswa" data-name="<?= $q["nama"] ?>">
                                            Tambahkan Ke Kelas
                                        </a>
                                    <?php else : ?>
                                        <span href="#" class="badge badge-secondary" style="cursor: pointer;">Tambahkan Ke Kelas</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    <?php $i++;
                        endif;
                    endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="row d-flex justify-content-end mt-2">
            <button class="btn btn-success cari-lagi mr-1">Cari Siswa Lain</button>
            <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata("id_kelas") . '/' . $this->session->userdata('tahun')) ?>" class="btn btn-secondary">Batal</a>
        </div>
    <?php else : ?>
        <h4>Data tidak ditemukan</h4>
        <p>Silahkan masukkan data siswa tersebut</p>
        <button class="btn btn-info my-2" data-target="#FormTambahSiswa" data-toggle="modal">Tambah Siswa</button>
        <button class="btn btn-secondary cari-lagi" style="margin-left: 1px;">Cari Siswa Lain</button>
    <?php endif ?>
</div>
<div class="modal fade" id="FormTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="FormTambahSiswaTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="FormTambahSiswaTitle">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('admin/tambahsiswa') ?>">
                    <input type="hidden" name="<?= $csrf["name"] ?>" id="csrf" value="<?= $csrf["hash"] ?>">
                    <div class="form-group">
                        <label for="nomor_induk">No. Induk</label>
                        <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" placeholder="0000" maxlength="4">
                    </div>
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="0000000000" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Fulan/ah" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="tmp_lahir">Tempat, tgl lahir</label>
                        <div id="inline" data-date="01/01/2020"></div>
                        <input type="text" class="form-control col-sm-8 mr-2 mb-1" style="display: inline-block;" id="tmp_lahir" name="tmp_lahir" placeholder="Majapahit" autocomplete="off">
                        <input type="text" class="form-control col-sm-3" style="display: inline-block;" id="tgl_lahir" name="tgl_lahir" placeholder="dd-mm-yyyy" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <select id="agama" class="form-control" name="agama">
                            <option value="Islam">Islam</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pendidikan_sebelumnya">Pendidikan Sebelumnya</label>
                        <input type="text" class="form-control" id="pendidikan_sebelumnya" name="pendidikan_sebelumnya" placeholder="SD/MI Majapahit 1">
                    </div>
                    <div class="form-group">
                        <label for="nama_ayah">Nama Ayah</label>
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Abu Fulan">
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Presiden">
                    </div>
                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu</label>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Ummu Fulan">
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pramugari">
                    </div>
                    <div class="form-group">
                        <label for="alamat_ortu">Alamat Orang Tua</label>
                        <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3" placeholder="Alamat Lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nama_wali">Nama Wali</label>
                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Fulan/ah">
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan_wali">Pekerjaan Wali</label>
                        <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Wali Kota">
                    </div>
                    <div class="form-group">
                        <label for="alamat_wali">Alamat Wali</label>
                        <textarea class="form-control" id="alamat_wali" name="alamat_wali" rows="3" placeholder="Alamat Lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp_ortu">No Hp Ortu/Wali</label>
                        <input type="text" class="form-control" id="no_hp_ortu" name="no_hp_ortu" placeholder="+6280000000000">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nggak Jadi</button>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary ajax-tambah-siswa">Tambah Siswa</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="<?= base_url('assets/js/tambahsiswa.js') ?>"></script>