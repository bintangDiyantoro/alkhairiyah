<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Materi Pelajaran</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <h1 class="mt-3 text-center">Materi Pelajaran</h1>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <div class="row d-flex justify-content-center pt-2">
                        <?php foreach ($kelas as $k) : ?>
                            <div class="card class-card text-center px-0 mb-3 mx-1">
                                <div class="card-header">
                                    <h5>Kelas <?= $k["class"] ?></h5>
                                </div>
                                <div class="card-body">
                                    Guru Kelas:
                                    <p class="card-title mb-3 text-center"><?= guruKelas($k['id'], $wali_kelas) ?></p>
                                    <a href="<?= base_url('materi/index/') . $k["id"] ?>" class="btn btn-info">Lihat Materi Pelajaran</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- <div class="container mt-3">
    <h1 class="text-center display-4 mt-3 mb-3">Materi Pelajaran</h1>
</div> -->