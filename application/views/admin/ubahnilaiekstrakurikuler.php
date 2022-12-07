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
        <form action="<?= base_url('admin/ubahnilaiekstrakurikuler/' . $id_siswa . "/" . $id_kelas . "/" . $tahun) ?>" method="post" style="display: inline">
            <input type="hidden" class="form-control ubah-nilai-ekstrakurikuler" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
            <input type="hidden" class="form-control" id="idsiswa" value="<?= $id_siswa ?>">
            <input type="hidden" class="form-control" id="ekskulCount" value="<?= count($ekskul) ?>">
            <tbody>
                <?= inputEkskulLooper($ekskul, $ekskul_terpilih, $nilai_ekskul, $akses_wali_kelas, '1') ?>
                <?= inputEkskulLooper($ekskul, $ekskul_terpilih, $nilai_ekskul, $akses_wali_kelas, '2') ?>
            </tbody>
    </table>
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-info update-ekstrakurikuler ubah-nilai-ekstrakurikuler mr-1" id="simpanNilaiEkstrakurikuler" data-session="<?= $this->session->userdata("admin") ?>"><i class="fas fa-save"></i> Simpan</button>
    </form>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-secondary"><i class="fas fa-step-backward"></i> Kembali</a>
</div>