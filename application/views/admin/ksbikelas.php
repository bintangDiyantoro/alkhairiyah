<div class="container">
    <div class="row py-5">
        <div class="col d-flex justify-content-center">
            <h1>Data Buku Induk tahun <?= $bukuinduk[0]["tahun"] ?></h1>
        </div>
    </div>
    <div class="row my-3">
        <table class="table table-hover col-lg-8">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Wali</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($bukuinduk as $bi) : ?>
                    <tr>
                        <th scope="row" class="align-middle"><?= $i += 1; ?></th>
                        <td class="align-middle"><?= $bi["class"] ?></td>
                        <td class="align-middle"><?= $bi["nama"] ?></td>
                        <td><a href="<?= base_url('admin/ksbisiswa/' . $bi["id_kelas"]) . "/" . $bi["tahun"] ?>" class="btn btn-success" style="width:70px;border-radius:50px">Lihat</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="row d-flex justify-content-center my-5">
        <div class="d-flex justify-content-center">
            <a href="<?= base_url('admin/ksbukuinduk') ?>" class="btn btn-info" style="width:200px;border-radius:50px">Kembali</a>
        </div>
    </div>
</div>