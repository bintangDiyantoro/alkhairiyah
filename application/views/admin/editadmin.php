<div class="container pt-1">
    <div class="row" style="margin-left: 55px;margin-top:30px">
        <h4>Ubah data admin <?= $admin["name"] ?></h4>
    </div>
    <div class="row my-2 mx-5">
        <div class="col-lg-8">
            <form action="" method="post" style="display: inline;">
                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                <div>
                    Nama Asli:
                </div>
                <select class="form-control  my-1 adm-mng-nama-asli col-sm-4" aria-label="Default select example" name="id_staff">
                    <?php if ($admin["id_staff"]) : ?>
                        <option value="<?= NULL ?>">Kosongkan</option>
                        <option value="<?= $admin["id_staff"] ?>" selected><?= $admin['nama']['nama'] ?></option>
                    <?php else : ?>
                        <option value="<?= NULL ?>" selected>Pilih Nama Staff</option>
                    <?php endif; ?>
                    <?php foreach ($staff as $s) :
                        if ($s["nama"] !== $admin["nama"]) : ?>
                            <option value="<?= $s["id"] ?>"><?= $s["nama"] ?></option>
                    <?php
                        endif;
                    endforeach; ?>
                </select>
                Role:
                <select class="form-control  my-1 mb-3 col-sm-3" aria-label="Default select example" name="role">
                    <option value="<?= $admin["slctdrole"]["role_id"] ?>" selected><?= $admin["slctdrole"]["role"] ?></option>
                    <?php foreach ($admin["role"] as $ar) : ?>
                        <?php if ($ar["role"] !== $admin["slctdrole"]["role"]) : ?>
                            <option value="<?= $ar["role_id"] ?>"><?= $ar["role"] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
                <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
            </form>
            <a href="<?= base_url('admin/adminmanagement') ?>" class="btn btn-info" style="z-index: 2;">Kembali</a>
        </div>
    </div>
</div>