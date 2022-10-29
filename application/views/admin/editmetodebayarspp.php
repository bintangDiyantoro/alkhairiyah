<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-5">
            <h1>Edit Metode Bayar SPP</h1>
            <form method="post" action="">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="form-group">
                    <label for="metode_bayar_spp">Metode Bayar SPP</label>
                    <input type="text" class="form-control" id="metode_bayar_spp" name="metode_bayar_spp" placeholder="Metode Bayar SPP" value="<?= $metode_bayar_spp["metode"] ?>" autofocus onfocus="this.value = this.value;" />
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                <a href="<?= base_url('admin/metodebayarspp') ?>" class="btn btn-info">Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>