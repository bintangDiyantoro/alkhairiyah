<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-5">
            <h1>Edit Nominal SPP</h1>
            <form method="post" action="">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="form-group">
                    <label for="nominal_spp">Nominal SPP</label>
                    <input type="text" class="form-control" id="nominal_spp" name="nominal_spp" placeholder="Nominal SPP" value="<?= $nominal_spp["nominal"] ?>" autofocus onfocus="this.value = this.value;" />
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                <a href="<?= base_url('admin/nominalspp') ?>" class="btn btn-info">Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>