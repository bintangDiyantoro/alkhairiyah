<div class="row mb-4" style="overflow-x: auto">
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
            <tr>
                <th class="align-middle" scope="col" colspan="2">KKM Satuan Pendidikan</th>
                <?= kkmLooper($kkm) ?>
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
                    <?= nilaiMapelLooper($nilai_pengetahuan_keterampilan, $mp["id"]) ?>
                </tr>
            <?php $i++;
            endforeach ?>
        </tbody>
    </table>
</div>
<div class="row d-flex justify-content-end">
    <button class="btn btn-primary update-pengetahuan-keterampilan mr-1" data-session="<?= $this->session->userdata('admin') ?>">Ubah Data</button>
    <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
</div>