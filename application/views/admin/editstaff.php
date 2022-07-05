<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-5">
            <h1>Edit Staff</h1>
            <form method="post" action="">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Staff" value="<?= $staff["nama"] ?>">
                </div>
                <div class="form-group">
                    <label for="NIY">NIY</label>
                    <input type="text" class="form-control" id="NIY" name="NIY" placeholder="1234567890" value="<?= $staff["NIY"] ?>">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                        <?php if ($staff["jenis_kelamin"] == "L") : ?>
                            <option value="L" selected>Laki-laki</option>
                            <option value="P">Perempuan</option>
                        <?php elseif ($staff["jenis_kelamin"] == "P") : ?>
                            <option value="L">Laki-laki</option>
                            <option value="P" selected>Perempuan</option>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Aktif</label>
                    <select id="status" class="form-control" name="status">
                        <?php if ($staff["status"] == "1") : ?>
                            <option value="1" selected>Aktif</option>
                            <option value="0">Non Aktif</option>
                        <?php elseif ($staff["status"] == "0") : ?>
                            <option value="1">Aktif</option>
                            <option value="0" selected>Non Aktif</option>
                        <?php endif ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                <a href="<?= base_url('admin/staffsmanagement') ?>" class="btn btn-info">Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>