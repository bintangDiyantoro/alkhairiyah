<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-5">
            <h1>Edit Semester</h1>
            <form method="post" action="">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" class="form-control" id="semester" name="semester" placeholder="Semester" value="<?= $semester["semester"] ?>" autofocus onfocus="this.value = this.value;" />
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                <a href="<?= base_url('admin/dftsemester') ?>" class="btn btn-info">Kembali</a>
        </div>
        </form>
    </div>
</div>
</div>