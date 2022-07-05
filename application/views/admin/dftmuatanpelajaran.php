    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahMuatanPelajaran" data-toggle="modal">Tambah Muatan Pelajaran</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Muatan Pelajaran</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($muatanpelajaran) :
                        foreach ($muatanpelajaran as $mp) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $mp["muatan_pelajaran"] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubahmuatanpelajaran/') . $mp["id"] ?>" class="badge badge-warning">
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
            <div class="modal fade" id="FormTambahMuatanPelajaran" tabindex="-1" role="dialog" aria-labelledby="FormTambahMuatanPelajaranTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahMuatanPelajaranTitle">Tambah Muatan Pelajaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="Muatan Pelajaran">Muatan Pelajaran</label>
                                    <input type="text" class="form-control" id="muatan_pelajaran" name="muatan_pelajaran" placeholder="Nama Muatan Pelajaran" autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Muatan Pelajaran</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>