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
    <?php if ($kelas_siswa) : ?>
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
                    foreach ($kelas_siswa as $ks) : ?>
                        <tr>
                            <th scope="row" class="align-middle"><?= $i += 1; ?></th>
                            <td class="align-middle"><?= $ks["tahun"] ?></td>
                            <td><a href="<?= base_url('admin/mkkelas/' . $ks["tahun"])  ?>" class="btn btn-success" style="width:70px;border-radius:50px">Lihat</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="row d-flex justify-content-center mt-3 mb-5">
            <div class="alert alert-warning p-5" role="alert">
                <h3>Belum ada data kelas di aplikasi ini.</h3>
                <div class="ajax-tambah-kelas col d-flex justify-content-center mt-5 mb-2">
                    <button class="btn btn-success" id="mktambahkelas" data-idstaff="<?= $this->session->userdata('id_staff') ?>" data-csrfname="<?= $csrf['name'] ?>" data-csrfhash="<?= $csrf['hash'] ?>" data-session="<?= $this->session->userdata('admin') ?>" style="color:white">Tambahkan Kelas</button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>