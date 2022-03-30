<div class="container">
    <div class="row my-5 mx-5">
        <div class="col-lg-7 d-flex align-items-center">
            <form class="col-lg-12 d-flex align-items-center" action="" method="post" style="display: inline;">
                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                <div class="mx-3">
                    Nama Asli:
                </div>
                <select class="form-control  my-5 mx-3 col-sm-5" aria-label="Default select example" name="id_guru">
                    <?php if ($admin["id_guru"]) : ?>
                        <option value="<?= NULL ?>">Kosongkan</option>
                        <option value="<?= $admin["id_guru"] ?>" selected><?= $admin['nama'] ?></option>
                    <?php else : ?>
                        <option value="<?= NULL ?>" selected>Pilih Nama Guru</option>
                    <?php endif; ?>
                    <?php foreach ($guru as $g) :
                        if ($g["nama"] !== $admin["nama"]) : ?>
                            <option value="<?= $g["id"] ?>"><?= $g["nama"] ?></option>
                    <?php
                        endif;
                    endforeach; ?>
                </select>
                <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
            </form>
            <a href="<?= base_url('admin/adminmanagement') ?>" class="btn btn-info" style="margin-left: -120px;z-index: 2;">Kembali</a>
        </div>
    </div>
</div>