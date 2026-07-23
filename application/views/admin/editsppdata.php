<div class="container">
    <div class="row">
        <form action="" method="get">
            <div class="input-group mb-3 mt-3 ml-3">
                <input type="hidden" class="csrf-token" name="csrf_token" value="<?= $csrf['hash'] ?>">
                <input type="text" name="no_induk" class="form-control no-induk" placeholder="No. Induk" aria-label="Cari data spp dengan No. Induk" maxlength="4">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="search">Cari Data</button>
                </div>
            </div>
        </form>
    </div>
    <?php if($siswa): ?>
        <div class="row hasil-pencarian-spp">
            <div class="col-lg-10" style="overflow-x: scroll;">
                <table class="table table-hover table-light">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No. Induk</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Thn. Ajaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($siswa as $s): ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $s["nomor_induk"] ?></td>
                                <td><?= $s["nama"] ?></td>
                                <td><?= $s["tanggal"] ?></td>
                                <td><?= $s["nominal"] ?></td>
                                <td><?= $s["nama_bulan"] ?></td>
                                <td><?= $s["tahun_ajaran"] ?></td>
                                <td><button type="button" class="btn btn-danger spp-data-row-to-delete" data-idspptodelete="<?= $s["id"] ?>">Hapus</button></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>