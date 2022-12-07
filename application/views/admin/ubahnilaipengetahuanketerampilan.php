<div class="row tb-pengetahuan-keterampilan-flex-container d-flex justify-content-center">
    <div class="col tb-pengetahuan-keterampilan-label mb-4">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Kelas</th>
                    <?php headerLooper($kelas_siswa, 'class', 4) ?>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Tahun Pelajaran</th>
                    <?php headerLooper($kelas_siswa, 'tahun', 4) ?>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Semester</th>
                    <?php for ($i = 0; $i < 6; $i++) : ?>
                        <th class="align-middle tb-hidden" scope="col" colspan="2">S1</th>
                        <th class="align-middle tb-hidden" scope="col" colspan="2">S2</th>
                    <?php endfor ?>
                </tr>
                <form action="<?= base_url('admin/ubahnilaipengetahuanketerampilan/' . $id_siswa . "/" . $id_kelas . "/" . $tahun) ?>" method="post" style="display: inline">
                    <input type="hidden" class="form-control ubah-nilai-pengetahuan-keterampilan" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                    <input type="hidden" class="form-control" id="idsiswa" value="<?= $id_siswa ?>">
                    <tr>
                        <th class="align-middle" scope="col" colspan="2">KKM Satuan Pendidikan</th>
                        <?= kkmInputLooper($akses_wali_kelas, $kkm) ?>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="col" colspan="2">Muatan Pelajaran</th>
                        <?php for ($i = 0; $i < 12; $i++) : ?>
                            <th class="align-middle tb-hidden" scope="col">K13</th>
                            <th class="align-middle tb-hidden" scope="col">K14</th>
                        <?php endfor ?>
                    </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($muatanpelajaran as $mp) : ?>
                    <tr>
                        <td class="align-middle" scope="col"><?= $i ?></td>
                        <td class="align-middle" scope="col"><?= $mp["muatan_pelajaran"] ?></td>
                        <?= nilaiMapelInputLooper($akses_wali_kelas, $nilai_pengetahuan_keterampilan, $mp["id"]) ?>
                    </tr>
                <?php $i++;
                endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="col tb-pengetahuan-keterampilan-data mb-4" style="overflow-x: auto">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Kelas</th>
                    <?php headerLooper($kelas_siswa, 'class', 4) ?>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Tahun Pelajaran</th>
                    <?php headerLooper($kelas_siswa, 'tahun', 4) ?>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Semester</th>
                    <?php for ($i = 0; $i < 6; $i++) : ?>
                        <th class="align-middle" scope="col" colspan="2">S1</th>
                        <th class="align-middle" scope="col" colspan="2">S2</th>
                    <?php endfor ?>
                </tr>
                <form action="<?= base_url('admin/ubahnilaipengetahuanketerampilan/' . $id_siswa . "/" . $id_kelas . "/" . $tahun) ?>" method="post" style="display: inline">
                    <input type="hidden" class="form-control ubah-nilai-pengetahuan-keterampilan" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                    <input type="hidden" class="form-control" id="idsiswa" value="<?= $id_siswa ?>">
                    <tr>
                        <th class="align-middle" scope="col" colspan="2">KKM Satuan Pendidikan</th>
                        <?= kkmInputLooper($akses_wali_kelas, $kkm) ?>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="col" colspan="2">Muatan Pelajaran</th>
                        <?php for ($i = 0; $i < 12; $i++) : ?>
                            <th class="align-middle" scope="col">K13</th>
                            <th class="align-middle" scope="col">K14</th>
                        <?php endfor ?>
                    </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($muatanpelajaran as $mp) : ?>
                    <tr>
                        <td class="align-middle" scope="col"><?= $i ?></td>
                        <td class="align-middle" scope="col"><?= $mp["muatan_pelajaran"] ?></td>
                        <?= nilaiMapelInputLooper($akses_wali_kelas, $nilai_pengetahuan_keterampilan, $mp["id"]) ?>
                    </tr>
                <?php $i++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row d-flex justify-content-end">
    <button class="btn btn-info update-pengetahuan-keterampilan ubah-nilai-pengetahuan-keterampilan mr-1" type="submit" name="submit" id="simpanNilaiPengetahuanKeterampilan" data-session="<?= $this->session->userdata("admin") ?>"><i class="fas fa-save"></i> Simpan</button>
    </form>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-secondary"><i class="fas fa-step-backward"></i> Kembali</a>
</div>