<div class="container my-5 py-5" style="padding-left: 0;padding-right: 0;">
    <form class="d-flex justify-content-center align-items-center" action="" method="post">
        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
        <div class="form-group">
            Pilih Kelas Anda:
        </div>
        <div class="form-group ml-2" style="width: 63px;">
            <select class="form-control" aria-label="Default select example" name="pilihkelas">
                <?php foreach ($kelas as $k) : ?>
                    <option value="<?= $k["id"] ?>"><?= $k["class"] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group ml-1">
            <button type="submit" name="submit" class="btn btn-primary">Pilih</button>
        </div>
        <div class="form group">
            <a href="<?= base_url('admin/bukuinduk') ?>" style="height: 36px;margin-top: -18px;" class="btn btn-secondary form-control ml-1">Kembali</a>
        </div>
    </form>
</div>