    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahRole" data-toggle="modal">Tambah Role</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role ID</th>
                        <th scope="col">Role</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($roles) :
                        foreach ($roles as $s) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $s["role_id"] ?></td>
                                <td><?= $s["role"] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubahrole/') . $s["id"] ?>" class="badge badge-warning">
                                        Ubah
                                    </a>
                                </td>
                            </tr>
                    <?php $i++;
                        endforeach;
                    endif ?>
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="FormTambahRole" tabindex="-1" role="dialog" aria-labelledby="FormTambahRoleTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahRoleTitle">Tambah Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="role_id">Role Id</label>
                                    <input type="text" class="form-control" id="role_id" name="role_id" placeholder="0" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" placeholder="Nama Role" autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Role</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>