    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahStatusSpp" data-toggle="modal">Tambah Status Spp</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status Spp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($spp_status) :
                        foreach ($spp_status as $ss) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $ss["status"] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubahstatusspp/') . $ss["id"] ?>" class="badge badge-warning">
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
            <div class="modal fade" id="FormTambahStatusSpp" tabindex="-1" role="dialog" aria-labelledby="FormTambahStatusSppTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahStatusSppTitle">Tambah StatusSpp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="StatusSpp">Status Spp</label>
                                    <input type="text" class="form-control" id="spp_status" name="spp_status" placeholder="Jenis StatusSpp" autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Status Spp</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>