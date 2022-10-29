    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahNominalSpp" data-toggle="modal">Tambah Nominal Spp</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($nominal) :
                        foreach ($nominal as $n) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= rupiah($n["nominal"]) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubahnominalspp/') . $n["id"] ?>" class="badge badge-warning">
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
            <div class="modal fade" id="FormTambahNominalSpp" tabindex="-1" role="dialog" aria-labelledby="FormTambahNominalSppTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahNominalSppTitle">Tambah Nominal Spp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="NominalSpp">Nominal Spp</label>
                                    <input type="text" class="form-control" id="nominal_spp" name="nominal_spp" placeholder="Jenis Nominal Spp" autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Nominal Spp</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>