<div class="container">
    <div class="row py-5">
        <div class="col d-flex justify-content-center">
            <h1>
                Selamat Datang
                <?php if ($staff && $staff["jenis_kelamin"]) {
                    echo ($staff["jenis_kelamin"] == "L") ? "Ustadz " . $staff["nama"] : "Ustadzah " . $staff["nama"];
                } ?>!
            </h1>
        </div>
    </div>
    <?php if ($bukuinduk) : ?>
        <div class="row my-3">
            <table class="table table-hover col-lg-8">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tahun Ajaran</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($bukuinduk as $bi) : ?>
                        <tr>
                            <th scope="row" class="align-middle"><?= $i += 1; ?></th>
                            <td class="align-middle"><?= $bi["tahun"] ?></td>
                            <td><a href="<?= base_url('admin/ksbikelas/' . $bi["tahun"])  ?>" class="btn btn-success" style="width:70px;border-radius:50px">Lihat</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="row d-flex justify-content-center mt-3 mb-5">
            <div class="alert alert-warning p-5" role="alert">
                <h3>Belum ada data buku induk di aplikasi ini.</h3>
            </div>
        </div>
    <?php endif; ?>
</div>