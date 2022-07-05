<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-5">
            <h1>Edit Role</h1>
            <form method="post" action="">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="form-group">
                    <label for="role_id">Role ID</label>
                    <input type="text" class="form-control" id="role_id" name="role_id" placeholder="Role" value="<?= $role["role_id"] ?>" autofocus onfocus="this.value = this.value;" />
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" id="role" name="role" placeholder="Role" value="<?= $role["role"] ?>" autofocus onfocus="this.value = this.value;" />
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                <a href="<?= base_url('admin/dftrole') ?>" class="btn btn-info">Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>