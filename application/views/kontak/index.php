<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Hubungi Kami</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Kontak Sekolah</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <?php foreach ($kontak as $k) : ?>
                        <div class="row">
                            <div class="col-md-5 font-weight-bolder">
                                <?= $k["B"]; ?></br>
                            </div>
                            <div class="col-md-5">
                                <?= $k["D"]; ?></br>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>