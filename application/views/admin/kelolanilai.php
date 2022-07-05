<div class="container">
    <div class="row mt-5 mb-2 pt-3 pb-2 d-flex justify-content-between" style="background-color: lightcyan; margin-left:-32px;margin-right:-32px;padding-left:22px;padding-right:22px;border-radius: 10px;">
        <div class="row mr-1" style="margin-left: -1px;">
            <h5 class="mr-1">Nama:</h5>
            <h5><strong style="color:dimgray"><?= $siswa["nama"] ?></strong></h5>
        </div>
        <h5>NISN: <strong style="color:dimgray"><?= $siswa["nisn"] ?></strong></h5>
        <h5>No. Induk: <strong style="color:dimgray"><?= $siswa["nomor_induk"] ?></strong></h5>
        <h5>Kelas: <strong style="color:dimgray"><?= $kelas["class"] ?></strong></h5>
        <h5>Tahun Pelajaran: <strong style="color:dimgray"><?= $tahun ?></strong></h5>
    </div>
    <div class="row mt-4 mb-2">
        <h4>A. Sikap</h4>
    </div>
    <div id="ajax-sikap" data-idsiswa="<?= $id_siswa ?>" data-idkelas="<?= $id_kelas ?>" data-tahun="<?= $tahun ?>">
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
            <button class="btn btn-primary update-sikap mr-1">Ubah Data</button>
            <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
        </div>
    </div>
    <div class="row mt-5 mb-2">
        <h4>B. Pengetahuan dan Keterampilan</h4>
    </div>
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
                    <th class="align-middle" scope="col" colspan="2">S1</th>
                    <th class="align-middle" scope="col" colspan="2">S2</th>
                    <th class="align-middle" scope="col" colspan="2">S1</th>
                    <th class="align-middle" scope="col" colspan="2">S2</th>
                    <th class="align-middle" scope="col" colspan="2">S1</th>
                    <th class="align-middle" scope="col" colspan="2">S2</th>
                    <th class="align-middle" scope="col" colspan="2">S1</th>
                    <th class="align-middle" scope="col" colspan="2">S2</th>
                    <th class="align-middle" scope="col" colspan="2">S1</th>
                    <th class="align-middle" scope="col" colspan="2">S2</th>
                    <th class="align-middle" scope="col" colspan="2">S1</th>
                    <th class="align-middle" scope="col" colspan="2">S2</th>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">KKM Satuan Pendidikan</th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                    <th class="align-middle" scope="col" colspan="2"></th>
                </tr>
                <tr>
                    <th class="align-middle" scope="col" colspan="2">Muatan Pelajaran</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                    <th class="align-middle" scope="col">K13</th>
                    <th class="align-middle" scope="col">K14</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($muatanpelajaran as $mp) : ?>
                    <tr>
                        <td class="align-middle" scope="col"><?= $i ?></td>
                        <td class="align-middle" scope="col"><?= $mp["muatan_pelajaran"] ?></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                    </tr>
                <?php $i++;
                endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="row d-flex justify-content-end">
        <button class="btn btn-primary update-pengetahuan-keterampilan mr-1">Ubah Data</button>
        <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
    </div>
    <div class="row mt-5 mb-2">
        <h4>C. Ekstrakurikuler</h4>
    </div>
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
                <tr>
                    <th class="align-middle" scope="row" rowspan="3">Semester I</th>
                    <td class="align-middle">1.</td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                </tr>
                <tr>
                    <td class="align-middle" scope="row">2.</td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                </tr>
                <tr>
                    <td class="align-middle" scope="row">3.</td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                </tr>
                <tr>
                    <th class="align-middle" scope="row" rowspan="3">Semester II</th>
                    <td class="align-middle">1.</td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                </tr>
                <tr>
                    <td class="align-middle" scope="row">2.</td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                </tr>
                <tr>
                    <td class="align-middle" scope="row">3.</td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row d-flex justify-content-end">
        <button class="btn btn-primary update-ekstrakurikuler mr-1">Ubah Data</button>
        <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
    </div>
    <div class="row mt-5 mb-2">
        <h4>D. Ketidakhadiran</h4>
    </div>
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
                    <th class="align-middle" scope="col">S1</th>
                    <th class="align-middle" scope="col">S2</th>
                    <th class="align-middle" scope="col">S1</th>
                    <th class="align-middle" scope="col">S2</th>
                    <th class="align-middle" scope="col">S1</th>
                    <th class="align-middle" scope="col">S2</th>
                    <th class="align-middle" scope="col">S1</th>
                    <th class="align-middle" scope="col">S2</th>
                    <th class="align-middle" scope="col">S1</th>
                    <th class="align-middle" scope="col">S2</th>
                    <th class="align-middle" scope="col">S1</th>
                    <th class="align-middle" scope="col">S2</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($ketidakhadiran as $k) : ?>
                    <tr>
                        <td class="align-middle" scope="col"><?= $k["ketidakhadiran"] ?></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                        <td class="align-middle" scope="col"></td>
                    </tr>
                <?php $i++;
                endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="row d-flex justify-content-end">
        <button class="btn btn-primary update-ketidakhadiran mr-1">Ubah Data</button>
        <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
    </div>
    <div class="row mt-5 mb-2">
        <h4>E. Keterangan</h4>
    </div>
    <div class="row mb-4" style="overflow-x: auto">
        <table class="table table-bordered table-hover table-sm">
            <tr>
                <th class="align-middle" scope="col">Keterangan</th>
                <th class="align-middle" scope="col">Naik/Tidak Naik</th>
                <th class="align-middle" scope="col">Naik/Tidak Naik</th>
                <th class="align-middle" scope="col">Naik/Tidak Naik</th>
                <th class="align-middle" scope="col">Naik/Tidak Naik</th>
                <th class="align-middle" scope="col">Naik/Tidak Naik</th>
                <th class="align-middle" scope="col">Lulus/Tidak Lulus</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="row d-flex justify-content-end">
        <button class="btn btn-primary update-ketnaiklulus mr-1">Ubah Data</button>
        <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-success">Kembali</a>
    </div>
    <div class="row mt-5 mb-2 d-flex justify-content-between">
        <p><i>Catatan:</i></p>
        <p><i>S1 = Semester 1</i></p>
        <p><i>S2 = Semester 2</i></p>
        <p><i>K13 = Kompetensi Inti 3 (Pengetahuan)</i></p>
        <p><i>K14 = Kompetensi Inti 4 (Keterampilan)</i></p>
    </div>
</div>