<div class="container" style="padding-left: 0;padding-right: 0;">
    <form class="d-flex justify-content-center align-items-center" id="ctycForm" action="<?= base_url('admin/pilihkelas/' . $this->session->userdata('id_staff') . '/' . $tahun) ?>" method="post">
        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
        <div class="form-group">
            Pilih Kelas Anda:
        </div>
        <div class="form-group new-class-this-year ml-2">
            <select class="form-control" aria-label="Default select example" name="pilihkelas" id="pilihkelastahuniniselect">
                <?php foreach ($kelas as $k) : ?>
                    <option value="<?= $k["id"] ?>" class="newyearclassname"><?= $k["class"] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group ml-1">
            <button name="submitee" class="btn btn-primary" id="confirmThisYearClass">Pilih</button>
        </div>
        <div class="form group">
            <a href="<?= base_url('admin/bukuinduk') ?>" style="height: 36px;margin-top: -18px;" class="btn btn-secondary form-control ml-1">Kembali</a>
        </div>
    </form>
</div>