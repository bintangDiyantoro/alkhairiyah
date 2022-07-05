    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahStaff" data-toggle="modal">Tambah Staff</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIY</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Status</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($staffs as $s) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $s["NIY"] ?></td>
                            <td><?= $s["nama"] ?></td>
                            <td><?= $s["jenis_kelamin"] ?></td>
                            <td>
                                <?php if ($s["status"] == 1) {
                                    echo "Aktif";
                                } elseif ($s["status"] == 0) {
                                    echo "Non Aktif";
                                } ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/ubahstaff/') . $s["id"] ?>" class="badge badge-warning">
                                    Ubah
                                </a>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach ?>
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="FormTambahStaff" tabindex="-1" role="dialog" aria-labelledby="FormTambahStaffTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahStaffTitle">Tambah Staff</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Staff">
                                </div>
                                <div class="form-group">
                                    <label for="NIY">NIY</label>
                                    <input type="text" class="form-control" id="NIY" name="NIY" placeholder="1234567890">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Staff</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>