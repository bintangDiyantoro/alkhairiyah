<div class="container">
    <div class="row justify-content-center mt-5" style="margin-left: 30px;margin-right: 30px;" id="editBiodataAlert" data-alert="<?= $this->session->flashdata("editBiodataAlert") ?>" data-name="<?= $biodata["nama"] ?>">
        <h4 class="font-weight-bolder">IDENTITAS PESERTA DIDIK</h4>
    </div>
    <div class="row justify-content-center m-4">
        <div class="col-lg mt-3 mb-5">
            <h5 class="mb-4">A. KETERANGAN MURID</h5>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    1. Nomor Induk<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk"> <?= $biodata["nomor_induk"] ?></br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    2. NISN<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk"> <?= $biodata["nisn"] ?></br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    3. Nama Peserta Didik<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk"> <?= $biodata["nama"] ?></br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    4. Tempat, tanggal lahir<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk"> <?= $biodata["ttl"] ?></br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    5. Jenis Kelamin<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk">
                    <?php if ($biodata["jenis_kelamin"] == "L") : ?>
                        Laki-laki
                    <?php else : ?>
                        Perempuan
                    <?php endif ?>
                    </br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    6. Agama<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk"> <?= $biodata["agama"] ?></br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    7. Pendidikan Sebelumnya<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk">
                    <?php if ($biodata["pendidikan_sebelumnya"]) {
                        echo $biodata["pendidikan_sebelumnya"];
                    } else {
                        echo "-";
                    } ?>
                    </br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    8. Alamat Peserta Didik<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk"> <?= $biodata["alamat"] ?></br>
                </div>
            </div>
        </div>
        <div class="col-lg mt-3">
            <h5 class="mb-4">B. KETERANGAN ORANG TUA / WALI MURID</h5>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    1. Nama Ayah <p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk"> <?= $biodata["nama_ayah"] ?></br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    2. Nama Ibu<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk"> <?= $biodata["nama_ibu"] ?></br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    3. Pekerjaan Ayah<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk">
                    <?php if ($biodata["pekerjaan_ayah"]) {
                        echo $biodata["pekerjaan_ayah"];
                    } else {
                        echo "-";
                    } ?>
                    </br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    4. Pekerjaan Ibu<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk">
                    <?php if ($biodata["pekerjaan_ibu"]) {
                        echo $biodata["pekerjaan_ibu"];
                    } else {
                        echo "-";
                    } ?>
                    </br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    5. Alamat Orang Tua<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk">
                    <?php if ($biodata["alamat_ortu"]) {
                        echo $biodata["alamat_ortu"] . ", " . $biodata["kelurahan_ortu"] . ", KEC." . $biodata["kecamatan_ortu"] . ", " . $biodata["kabupaten_ortu"] . ", " . $biodata["provinsi_ortu"];
                    } else {
                        echo "-";
                    } ?>
                    </br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    6. Nama Wali<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk">
                    <?php if ($biodata["nama_wali"]) {
                        echo $biodata["nama_wali"];
                    } else {
                        echo "-";
                    } ?>
                    </br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    7. Alamat Wali<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk">
                    <?php if ($biodata["alamat_wali"]) {
                        echo $biodata["alamat_wali"] . ", " . $biodata["kelurahan_wali"] . ", KEC." . $biodata["kecamatan_wali"] . ", " . $biodata["kabupaten_wali"] . ", " . $biodata["provinsi_wali"];
                    } else {
                        echo "-";
                    } ?>
                    </br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 font-weight-bolder">
                    8. No. HP Orang Tua/Wali<p class="colon-l">:</p></br>
                </div>
                <div class="col-sm-1 div-colon-r">
                    <p class="colon-r">: </p>
                </div>
                <div class="col-md-5 data-buku-induk">
                    <?php if ($biodata["no_hp_ortu"]) {
                        echo $biodata["no_hp_ortu"];
                    } else {
                        echo "-";
                    } ?>
                    </br>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-5">
        <p>Diupdate oleh: <strong><?= $biodata["nama_staff"] ?></strong></p>
    </div>
    <div class="row justify-content-end" style="margin-right: 33px;">
        <a href="<?= base_url('admin/ubahbiodata/' . $biodata["id"]) ?>" class="btn btn-info mr-1">Ubah Data</a>
        <a href="<?= base_url('admin/cetakbiodata/' . $biodata["id"]) ?>" class="btn btn-success mr-1">Cetak</a>
        <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata("id_kelas") . "/" . $this->session->userdata("tahun")) ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>