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
        <tbody>
            <?= jumlahKetidakhadiranLooper($ketidakhadiran, $jumlah_ketidakhadiran) ?>
        </tbody>
    </table>
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-primary update-absensi mr-1" data-session="<?= $this->session->userdata('admin') ?>">Ubah Data</button>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
</div>