<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-5">
            <h1>Edit Bulan Akademik</h1>
            <form method="post" action="">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="form-group">
                    <label for="angka_bulan">Angka Bulan</label>
                    <input type="text" class="form-control" id="angka_bulan" name="angka_bulan" placeholder="Angka Bulan" value="<?= $bulan_akademik["angka_bulan"] ?>" autofocus onfocus="this.value = this.value;" />
                </div>
                <div class="form-group">
                    <label for="nama_bulan">Nama Bulan</label>
                    <input type="text" class="form-control" id="nama_bulan" name="nama_bulan" placeholder="Nama Bulan" value="<?= $bulan_akademik["nama_bulan"] ?>"/>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                <a href="<?= base_url('admin/bulanakademik') ?>" class="btn btn-info">Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>