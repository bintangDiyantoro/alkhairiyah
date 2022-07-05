    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahKetidakhadiran" data-toggle="modal">Tambah Ketidakhadiran</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ketidakhadiran</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($ketidakhadiran) :
                        foreach ($ketidakhadiran as $th) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $th["ketidakhadiran"] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubahketidakhadiran/') . $th["id"] ?>" class="badge badge-warning">
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
            <div class="modal fade" id="FormTambahKetidakhadiran" tabindex="-1" role="dialog" aria-labelledby="FormTambahKetidakhadiranTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahKetidakhadiranTitle">Tambah Ketidakhadiran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="Ketidakhadiran">Ketidakhadiran</label>
                                    <input type="text" class="form-control" id="ketidakhadiran" name="ketidakhadiran" placeholder="Jenis Ketidakhadiran" autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Ketidakhadiran</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>