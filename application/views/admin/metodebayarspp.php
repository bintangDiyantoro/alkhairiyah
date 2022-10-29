    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahMetodeBayarSpp" data-toggle="modal">Tambah Metode Bayar Spp</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Metode Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($metode_bayar) :
                        foreach ($metode_bayar as $mb) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $mb["metode"] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubahmetodebayarspp/') . $mb["id"] ?>" class="badge badge-warning">
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
            <div class="modal fade" id="FormTambahMetodeBayarSpp" tabindex="-1" role="dialog" aria-labelledby="FormTambahMetodeBayarSppTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahMetodeBayarSppTitle">Tambah MetodeBayarSpp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="MetodeBayarSpp">Metode Bayar Spp</label>
                                    <input type="text" class="form-control" id="metode_bayar_spp" name="metode_bayar_spp" placeholder="Jenis Metode Bayar Spp" autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Metode Bayar Spp</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>