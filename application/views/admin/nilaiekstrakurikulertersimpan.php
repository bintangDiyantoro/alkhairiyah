<div class="row mb-4" style="overflow-x: auto">
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th class="align-middle" scope="col" rowspan="2">Semester</th>
                <th class="align-middle" scope="col" rowspan="2">Jenis Ekstrakurikuler</th>
                <?php headerLooper($kelas_siswa, 'class') ?>
            </tr>
            <tr>
                <?php headerLooper($kelas_siswa, 'tahun') ?>
            </tr>
        </thead>
        <tbody>
            <?= nilaiEkskulLooper($ekskul_terpilih, $nilai_ekskul, 1) ?>
            <?= nilaiEkskulLooper($ekskul_terpilih, $nilai_ekskul, 2) ?>
        </tbody>
    </table>
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-primary update-ekstrakurikuler mb-1" data-session="<?= $this->session->userdata('admin') ?>"><i class="fas fa-edit"></i> Ubah Data</button>
    <a href="<?= base_url('admin/cetaknilaiki3ki4/') . $siswa["id"] ?>" class="btn btn-info ml-1 mb-1"><i class="fas fa-print"></i> Cetak Nilai Ki3-Ki4</a>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success mb-1 ml-1"><i class="fas fa-step-backward"></i>Kembali</a>
</div>