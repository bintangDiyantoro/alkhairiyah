<div class="container mb-3">

    <div class="row d-flex justify-content-center">
        <h1 class="mt-3 text-center" style="display: block;width:100%">Materi Pelajaran Kelas <?= $kelas["class"] ?></h1>
        <?php $rd = explode('-', $date) ?>
        <h1><small>tanggal: <?= $rd[2] . "-" . $rd[1] . "-" . $rd[0] ?></small></h1>
    </div>
    <div class="row d-flex justify-content-center mb-3">
        <div class="col-lg mt-3">
            <div class="row d-flex justify-content-center pt-2">
                <?php if ($materi) : ?>
                    <?php foreach ($materi as $m) : ?>
                        <div class="card class-card text-center px-0 mb-3 mx-1">
                            <div class="card-header">
                                <h5><?= $m["nama_mapel"] ?></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-title mb-3"></p>
                                <a href="<?= base_url('materi/mapel/') . $kelas["id"] . "/" . $m["subject"] ?>" class="btn btn-info">Lihat Materi Pelajaran</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h2>Belum ada materi</h2>
                <?php endif; ?>
            </div>
            <div class="row d-flex justify-content-center">
                <a href="<?= base_url('materi/index/') . $kelas["id"] ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>

</div>