<div class="row mb-4 tb-absensi-flex-container d-flex justify-content-center">
    <div class="col tb-absensi-label">
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
    <div class="col tb-absensi-data" style="overflow-x: auto;">
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
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-primary update-absensi mb-1" data-session="<?= $this->session->userdata('admin') ?>"><i class="fas fa-edit"></i> Ubah Data</button>
    <a href="<?= base_url('admin/cetaknilaiki3ki4/') . $siswa["id"] ?>" class="btn btn-info ml-1 mb-1"><i class="fas fa-print"></i> Cetak Nilai Ki3-Ki4</a>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success mb-1 ml-1"><i class="fas fa-step-backward"></i>Kembali</a>
</div>