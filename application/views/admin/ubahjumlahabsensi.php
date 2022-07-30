<div class="row mb-4" style="overflow-x: auto">
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th class="align-middle" scope="col">Kelas</th>
                <?php headerLooper($kelas_siswa, 'class', 2) ?>
            </tr>
            <tr>
                <th class="align-middle" scope="col">Tahun Pelajaran</th>
                <?php headerLooper($kelas_siswa, 'tahun', 2) ?>
            </tr>
            <tr>
                <th class="align-middle" scope="col">Semester</th>
                <?php for ($i = 0; $i < 6; $i++) : ?>
                    <th class="align-middle" scope="col">S1</th>
                    <th class="align-middle" scope="col">S2</th>
                <?php endfor ?>
            </tr>
        </thead>
        <form action="<?= base_url('admin/ubahjumlahabsensi/' . $id_siswa . "/" . $id_kelas . "/" . $tahun) ?>" method="post" style="display: inline">
            <input type="hidden" class="form-control ubah-jumlah-absensi" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
            <input type="hidden" class="form-control" id="idsiswa" value="<?= $id_siswa ?>">
            <tbody>
                <?= jumlahKetidakhadiranInputLooper($akses_wali_kelas, $ketidakhadiran, $jumlah_ketidakhadiran) ?>
            </tbody>
    </table>
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-info update-absensi ubah-jumlah-absensi mr-1" type="submit" name="submit" id="simpanJumlahAbsensi" data-session="<?= $this->session->userdata("admin") ?>">Simpan</button>
    </form>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-secondary">Kembali</a>
</div>