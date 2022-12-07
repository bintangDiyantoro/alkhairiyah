<div class="tb-sikap-flex-container d-flex justify-content-center">
    <div class="col tb-sikap-label mb-4">
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
    <div class="col tb-sikap-data mb-4" style="overflow-x: auto">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="align-middle tb-sikap-data-hidden" scope="col" rowspan="2">Semester</th>
                    <th class="align-middle tb-sikap-data-hidden" scope="col">Kelas</th>
                    <?php headerLooper($kelas_siswa, 'class') ?>
                </tr>
                <tr>
                    <th class="align-middle tb-sikap-data-hidden" scope="col">Tahun Pelajaran</th>
                    <?php headerLooper($kelas_siswa, 'tahun') ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="align-middle tb-sikap-data-hidden" scope="row" rowspan="2">Semester I</th>
                    <td class="align-middle tb-sikap-data-hidden">Sikap Spiritual</td>
                    <?= nilaiSikapLooper($nilai_sikap, '1', '1') ?>
                </tr>
                <tr>
                    <td class="align-middle tb-sikap-data-hidden" scope="row">Sikap Sosial</td>
                    <?= nilaiSikapLooper($nilai_sikap, '1', '2') ?>
                </tr>
                <tr>
                    <th class="align-middle tb-sikap-data-hidden" scope="row" rowspan="2">Semester II</th>
                    <td class="align-middle tb-sikap-data-hidden">Sikap Spiritual</td>
                    <?= nilaiSikapLooper($nilai_sikap, '2', '1') ?>
                </tr>
                <tr>
                    <td class="align-middle tb-sikap-data-hidden" scope="row">Sikap Sosial</td>
                    <?= nilaiSikapLooper($nilai_sikap, '2', '2') ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-primary update-sikap mb-1" data-session="<?= $this->session->userdata('admin') ?>"><i class="fas fa-edit"></i> Ubah Data</button>
    <a href="<?= base_url('admin/cetaknilaisikap/') . $siswa["id"] ?>" class="btn btn-info ml-1 mb-1"><i class="fas fa-print"></i> Cetak Nilai Sikap</a>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success ml-1 mb-1"><i class="fas fa-step-backward"></i>Kembali</a>
</div>