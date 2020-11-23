<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Profil Sekolah</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Identitas Sekolah</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <?php foreach ($identitas as $i) : ?>
                        <div class="row">
                            <div class="col-md-5 font-weight-bolder">
                                <?= $i["B"]; ?></br>
                            </div>
                            <div class="col-md-5">
                                <?= $i["D"]; ?></br>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-1">
        <div class="container">
            <div class="row">
                <h3 class="mt-3">Data Pelengkap</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <?php foreach ($pelengkap as $p) : ?>
                        <div class="row">
                            <div class="col-md-5 font-weight-bolder">
                                <?= $p["B"]; ?></br>
                            </div>
                            <div class="col-md-5">
                                <?= $p["D"]; ?></br>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-2">
        <div class="container">
            <div class="row">
                <h3 class="mt-3">Data Periodik</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <?php foreach ($periodik as $dp) : ?>
                        <div class="row">
                            <div class="col-md-5 font-weight-bolder">
                                <?= $dp["B"]; ?></br>
                            </div>
                            <div class="col-md-5">
                                <?= $dp["D"]; ?></br>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-1">
        <div class="container">
            <div class="row">
                <h3 class="mt-3">Sanitasi</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <?php foreach ($sanitasi as $s) : ?>
                        <div class="row">
                            <div class="col-md-5 font-weight-bolder">
                                <?= $s["B"]; ?></br>
                            </div>
                            <div class="col-md-5">
                                <?= $s["D"]; ?></br>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>