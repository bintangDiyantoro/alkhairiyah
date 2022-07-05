<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-5">
            <h1>Edit Sikap</h1>
            <form method="post" action="">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="form-group">
                    <label for="sikap">Sikap</label>
                    <input type="text" class="form-control" id="sikap" name="sikap" placeholder="Sikap" value="<?= $sikap["sikap"] ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                <a href="<?= base_url('admin/dftnilaisikap') ?>" class="btn btn-info">Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>