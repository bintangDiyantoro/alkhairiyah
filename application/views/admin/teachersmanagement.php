    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahGuru" data-toggle="modal">Tambah Guru</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIY</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($teachers as $t) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $t["NIY"] ?></td>
                            <td><?= $t["nama"] ?></td>
                            <td><?= $t["jenis_kelamin"] ?></td>
                            <td>
                                <a href="<?= base_url('admin/ubahguru/') . $t["id"] ?>" class="badge badge-warning">
                                    Ubah
                                </a>
                                <a href="<?= base_url('admin/hapusguru/') . $t["id"] ?>" class="badge badge-danger" data-judul="<?= $t['nama']?>" data-id="<?= $t["id"] ?>">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach ?>
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="FormTambahGuru" tabindex="-1" role="dialog" aria-labelledby="FormTambahGuruTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahGuruTitle">Tambah Guru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?=$csrf["name"]?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anda">
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
                                <button type="submit" name="submit" class="btn btn-primary">Tambah Guru</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>