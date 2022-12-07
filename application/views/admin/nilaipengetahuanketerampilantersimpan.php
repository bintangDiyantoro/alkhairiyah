<div class="row tb-pengetahuan-keterampilan-flex-container d-flex justify-content-center">
    <div class="col tb-pengetahuan-keterampilan-label mb-4">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Kelas</th>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Tahun Pelajaran</th>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Semester</th>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">KKM Satuan Pendidikan</th>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Muatan Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($muatanpelajaran as $mp) : ?>
                    <tr>
                        <td class="align-middle" scope="col"><?= $i ?></td>
                        <td class="align-middle" scope="col"><?= $mp["muatan_pelajaran"] ?></td>
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
                    <th class="align-middle tb-pengetahuan-keterampilan-data-hidden" scope="col" colspan="2">Kelas</th>
                    <?php headerLooper($kelas_siswa, 'class', 4) ?>
                </tr>
                <tr>
                    <th class="align-middle tb-pengetahuan-keterampilan-data-hidden" scope="col" colspan="2">Tahun Pelajaran</th>
                    <?php headerLooper($kelas_siswa, 'tahun', 4) ?>
                </tr>
                <tr>
                    <th class="align-middle tb-pengetahuan-keterampilan-data-hidden" scope="col" colspan="2">Semester</th>
                    <?php for ($i = 0; $i < 6; $i++) : ?>
                        <th class="align-middle" scope="col" colspan="2">S1</th>
                        <th class="align-middle" scope="col" colspan="2">S2</th>
                    <?php endfor ?>
                </tr>
                <tr>
                    <th class="align-middle tb-pengetahuan-keterampilan-data-hidden" scope="col" colspan="2">KKM Satuan Pendidikan</th>
                    <?= kkmLooper($kkm) ?>
                </tr>
                <tr>
                    <th class="align-middle tb-pengetahuan-keterampilan-data-hidden" scope="col" colspan="2">Muatan Pelajaran</th>
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
                        <td class="align-middle tb-pengetahuan-keterampilan-data-hidden" scope="col"><?= $i ?></td>
                        <td class="align-middle tb-pengetahuan-keterampilan-data-hidden" scope="col"><?= $mp["muatan_pelajaran"] ?></td>
                        <?= nilaiMapelLooper($nilai_pengetahuan_keterampilan, $mp["id"]) ?>
                    </tr>
                <?php $i++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-primary update-pengetahuan-keterampilan mb-1" data-session="<?= $this->session->userdata('admin') ?>"><i class="fas fa-edit"></i> Ubah Data</button>
    <a href="<?= base_url('admin/cetaknilaiki3ki4/') . $siswa["id"] ?>" class="btn btn-info ml-1 mb-1"><i class="fas fa-print"></i> Cetak Nilai Ki3-Ki4</a>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success ml-1 mb-1"><i class="fas fa-step-backward"></i>Kembali</a>
</div>