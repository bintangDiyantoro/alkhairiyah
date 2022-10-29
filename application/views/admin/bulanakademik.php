    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <button class="btn btn-info" data-target="#FormTambahBulanAkademik" data-toggle="modal">Tambah Bulan Akademik</button>
            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Angka Bulan</th>
                        <th scope="col">Nama Bulan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($bulan) :
                        foreach ($bulan as $b) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $b["angka_bulan"] ?></td>
                                <td><?= $b["nama_bulan"] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubahbulanakademik/') . $b["id"] ?>" class="badge badge-warning">
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
            <div class="modal fade" id="FormTambahBulanAkademik" tabindex="-1" role="dialog" aria-labelledby="FormTambahBulanAkademikTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="FormTambahBulanAkademikTitle">Tambah Bulan Akademik</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                <div class="form-group">
                                    <label for="angka_bulan">Angka Bulan</label>
                                    <input type="text" class="form-control" id="angka_bulan" name="angka_bulan" placeholder="Angka Bulan" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="nama_bulan">Nama Bulan</label>
                                    <input type="text" class="form-control" id="nama_bulan" name="nama_bulan" placeholder="Nama Bulan" autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Bulan Akademik</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>