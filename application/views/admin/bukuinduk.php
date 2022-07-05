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
    <?php
    // if ((int)date("m") >= 7) :
    if (!$staff["kelastahunini"]) : ?>
        <div class="row d-flex justify-content-center mt-3 mb-5">
            <div class="alert alert-warning p-5" role="alert">
                Anda belum memilih kelas pada tahun ajaran ini, silahkan memilih kelas terlebih dahulu.
                <div class="row d-flex justify-content-center mt-5">
                    <?php
                    $slash = (int)date('y') + 1;
                    $tahunAjar = date('Y') . "/" . (string)$slash;
                    ?>
                    <a href="<?= base_url('admin/pilihkelas/' . $staff["id"] . "/" . $tahunAjar) ?>" class="btn btn-primary">Pilih Kelas</a>
                </div>
            </div>
        </div>
    <?php endif;
    // endif;
    if ($staff["semuakelas"]) : ?>
        <div class="row d-flex justify-content-center mb-3">
            <div class="col-lg-8">
                Kelas anda:
            </div>
        </div>
        <div class="row my-3">
            <table class="table table-hover col-lg-8">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Tahun Ajaran</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($staff["semuakelas"] as $gk) : ?>
                        <tr>
                            <th scope="row"><?= $i += 1; ?></th>
                            <td><?= $gk["class"] ?></td>
                            <td><?= $gk["tahun"] ?></td>
                            <td><a href="<?= base_url('admin/daftarsiswa/' . $gk["id_kelas"] . "/" . $gk["tahun"])  ?>" class="btn btn-info">Kelola</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif;
    if ($staff["semuakelas"]) : ?>
        <div class="row d-flex justify-content-center my-5">
            <div class="col-lg-10 d-flex justify-content-center">
                <div class="ajax-tambah-kelas col-lg-8 d-flex justify-content-center">
                    <button class="btn btn-success" id="tambahkelas" data-csrfname="<?= $csrf['name'] ?>" data-csrfhash="<?= $csrf['hash'] ?>" data-idguru="<?= $gk["id_staff"] ?>" data-session="<?= $this->session->userdata('admin') ?>" style="color:white">Tambahkan kelas lain</button>
                </div>
            </div>
        </div>
    <?php
    else : ?>
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-lg-10 d-flex justify-content-center">
                <div class="ajax-tambah-kelas col-lg-8 d-flex justify-content-center">
                    <button class="btn btn-success" id="tambahkelas" data-csrfname="<?= $csrf['name'] ?>" data-csrfhash="<?= $csrf['hash'] ?>" data-idguru="<?= $staff["id"] ?>" data-session="<?= $this->session->userdata('admin') ?>" style="color:white">Tambahkan kelas tahun ajaran sebelumnya</button>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>