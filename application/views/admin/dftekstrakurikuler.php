    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahEkstrakurikuler" data-toggle="modal">Tambah Ekstrakurikuler</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ekstrakurikuler</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($ekstrakurikuler) :
                        foreach ($ekstrakurikuler as $e) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $e["ekskul"] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubahekstrakurikuler/') . $e["id"] ?>" class="badge badge-warning">
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
            <div class="modal fade" id="FormTambahEkstrakurikuler" tabindex="-1" role="dialog" aria-labelledby="FormTambahEkstrakurikulerTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahEkstrakurikulerTitle">Tambah Ekstrakurikuler</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="Ekstrakurikuler">Ekstrakurikuler</label>
                                    <input type="text" class="form-control" id="ekskul" name="ekskul" placeholder="Nama Ekstrakurikuler" autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Ekstrakurikuler</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>