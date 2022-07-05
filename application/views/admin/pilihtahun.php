<div class="container d-flex justify-content-center m-3">
    <div class="row">
        <div class="align-bottom mr-2" style="margin-top: 6px;width:130px;margin-bottom: 10px;">
            Pilih Tahun Ajaran:
        </div>
        <form class="d-flex align-items-center" action="<?= base_url('admin/redirectPilihKelas') ?>" method="post" style="display: inline;">
            <input type="hidden" name="<?= $csrfname ?>" value="<?= $csrfhash ?>">
            <input type="hidden" name="id_staff" value="<?= $idstaff ?>">
            <select class="form-control mr-1" aria-label="Default select example" name="pilihtahun" style="width: 102px;">
                <?php foreach ($tahun as $t) : ?>
                    <option value="<?= $t ?>"><?= $t ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit" name="submit" class="btn btn-primary mr-1">Pilih</button>
            <a href="<?= base_url('admin/bukuinduk') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>