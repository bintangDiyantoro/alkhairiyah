<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Alumni tahun <?= $tahun ?></h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <?php foreach ($alumni as $a) : ?>
                    <div class="col-md-3 mb-3">
                        <div class="card" style="width: 14rem;">
                            <?php if ($a['D'] == "LAKI - LAKI") : ?>
                                <img src="<?= base_url('assets/img') ?>/Male.png" class="card-img-top" alt="...">
                            <?php else : ?>
                                <img src="<?= base_url('assets/img') ?>/Female.png" class="card-img-top" alt="...">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-text"><?= $a["C"] ?></h5>
                                <p>No. Induk: <?= $a["E"] ?></p>
                                Alamat:
                                <p class="card-text"><?= $a['K'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>