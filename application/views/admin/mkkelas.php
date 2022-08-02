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
    <div class="row d-flex justify-content-center my-5">
        <div class="d-flex justify-content-center">
            <a href="<?= base_url('admin/classesmanagement') ?>" class="btn btn-info" style="width:200px;border-radius:50px">Kembali</a>
        </div>
    </div>
</div>