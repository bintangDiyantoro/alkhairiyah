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
                <form action="<?= base_url('admin/ubahnilaisikap/' . $id_siswa . "/" . $id_kelas . "/" . $tahun) ?>" method="post" style="display: inline">
                    <input type="hidden" class="form-control ubah-nilai-sikap" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                    <input type="hidden" class="form-control" id="idsiswa" value="<?= $id_siswa ?>">
                    <tbody>
                        <tr>
                            <th class="align-middle" scope="row" rowspan="2">Semester I</th>
                            <td class="align-middle">Sikap Spiritual</td>
                            <?php ubahSikapTextareaLoop($akses_wali_kelas, '1', '1', $nilai_sikap) ?>
                        </tr>
                        <tr>
                            <td class="align-middle" scope="row">Sikap Sosial</td>
                            <?php ubahSikapTextareaLoop($akses_wali_kelas, '1', '2', $nilai_sikap) ?>
                        </tr>
                        <tr>
                            <th class="align-middle" scope="row" rowspan="2">Semester II</th>
                            <td class="align-middle">Sikap Spiritual</td>
                            <?php ubahSikapTextareaLoop($akses_wali_kelas, '2', '1', $nilai_sikap) ?>
                        </tr>
                        <tr>
                            <td class="align-middle" scope="row">Sikap Sosial</td>
                            <?php ubahSikapTextareaLoop($akses_wali_kelas, '2', '2', $nilai_sikap) ?>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div class="row d-flex justify-content-end">
            <button class="btn btn-info update-sikap ubah-nilai-sikap mr-1" type="submit" name="submit" id="simpanNilaiSikap">Simpan</button>
            </form>
            <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . "/" . $this->session->userdata('tahun')) ?>" class="btn btn-secondary">Kembali</a>
        </div>