<div class="container">
    <div class="row py-5">
        <div class="col d-flex justify-content-center">
            <h1>Data kelas tahun <?= $this->session->userdata("tahun") ?></h1>
        </div>
    </div>
    <div class="row my-3" style="overflow-x: auto;">
        <table class="table table-hover col-lg-7" id="mkWaliKelasBaru" data-walibaru="<?= $this->session->flashdata("walibaru") ?>">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Wali</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($kelas as $k) : ?>
                    <tr class="align-middle">
                        <th scope="row" class="align-middle"><?= $i += 1; ?></th>
                        <td class="align-middle"><?= $k["class"] ?></td>
                        <td class="align-middle wali-kelas">
                            <?= cekWaliKelas($k["id"], $this->session->userdata('tahun')) ?>
                        </td>
                        <td class="align-middle mk-wali-kelas">
                            <div class="d-flex justify-content-start">
                                <?= cwkAction($k["id"], $this->session->userdata('tahun'), $k) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="row d-flex justify-content-center mt-3 mb-5">
        <div class="ajax-cari-siswa" style="overflow-x: hidden!important;">
            <?php if ($this->session->userdata("role") == "1") : ?>
                <a href="<?= base_url('admin/bukuinduk') ?>" class="btn btn-secondary mb-1">Kembali</a>
            <?php elseif ($this->session->userdata('role') == "4") : ?>
                <a href="<?= base_url('admin/mkkelas/' . $this->session->userdata('tahun')) ?>" class="btn btn-secondary mb-1">Kembali</a>
            <?php endif ?>
        </div>
        <?php if ($this->session->userdata("role") == "4") : ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="input-group fetch-student-from-excel-input-group" style="width: 260px;">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputExcelStudentClassLabel" aria-describedby="inputExcellStudentFile" name="fileexcel">
                        <label class="custom-file-label fetch-student-from-excel-label" for="inputExcelStudentClassLabel">Ambil Excel</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary" name="submit" type="submit" id="inputExcellStudentFile" style="height: 36px;border-radius:0 5px 5px 0">Upload</button>
                    </div>
                    <div style="color:red;margin-left:5px">
                        <small><?= ($error) ? $error : '' ?></small>
                    </div>
                </div>
            </form>
        <?php endif ?>
    </div>
</div>