<div class="row mb-4" style="overflow-x: auto">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="align-middle" scope="col" rowspan="2">Semester</th>
                <th class="align-middle" scope="col">Kelas</th>
                <?php headerLooper($kelas_siswa, 'class') ?>
            </tr>
            <tr>
                <th class="align-middle" scope="col">Tahun Pelajaran</th>
                <?php headerLooper($kelas_siswa, 'tahun') ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="align-middle" scope="row" rowspan="2">Semester I</th>
                <td class="align-middle">Sikap Spiritual</td>
                <?= nilaiSikapLooper($nilai_sikap, '1', '1') ?>
            </tr>
            <tr>
                <td class="align-middle" scope="row">Sikap Sosial</td>
                <?= nilaiSikapLooper($nilai_sikap, '1', '2') ?>
            </tr>
            <tr>
                <th class="align-middle" scope="row" rowspan="2">Semester II</th>
                <td class="align-middle">Sikap Spiritual</td>
                <?= nilaiSikapLooper($nilai_sikap, '2', '1') ?>
            </tr>
            <tr>
                <td class="align-middle" scope="row">Sikap Sosial</td>
                <?= nilaiSikapLooper($nilai_sikap, '2', '2') ?>
            </tr>
        </tbody>
    </table>
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-primary update-sikap mr-1" data-session="<?= $this->session->userdata("admin") ?>">Ubah Data</button>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
</div>