<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-5">
            <h1>Edit Muatan Pelajaran</h1>
            <form method="post" action="">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="form-group">
                    <label for="muatan_pelajaran">Muatan Pelajaran</label>
                    <input type="text" class="form-control" id="muatan_pelajaran" name="muatan_pelajaran" placeholder="Muatan Pelajaran" value="<?= $muatanpelajaran["muatan_pelajaran"] ?>" autofocus onfocus="this.value = this.value;"/>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                <a href="<?= base_url('admin/dftmuatanpelajaran') ?>" class="btn btn-info">Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>