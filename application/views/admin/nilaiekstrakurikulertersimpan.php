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
    <button class="btn btn-primary update-ekstrakurikuler mr-1" data-session="<?= $this->session->userdata('admin') ?>">Ubah Data</button>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
</div>