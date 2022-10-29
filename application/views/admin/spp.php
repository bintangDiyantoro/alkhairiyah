<div class="container">
    <div class="row d-flex justify-content-between mt-5 mb-4 spp-first-row">
        <div class="col mb-1">
            <h2>Buku SPP SD</h2>
        </div>
        <?php if (count($nominal_per_tingkat_tahun_ini) == 24) : ?>
            <div class="col d-flex justify-content-end main-spp-search-container">
                <div class="row <?= togglesidebar($this->session->userdata("toggle")) ?>" id="customSppSearchToggle">
                    <div class="align-bottom mx-3 mb-2" style="margin-top: 6px;width:75px;">
                        Cari Siswa:
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="form-group mx-3 main-spp-search">
                            <input type="text" class="form-control spp-find-student" name="keyword" data-csrf="<?= $csrf["hash"] ?>" placeholder="NISN/No Induk/Nama Siswa" autofocus autocomplete="off">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary form-control spp-find-student-button" data-session="<?= $this->session->userdata('admin') ?>">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
    <?php if (count($nominal_per_tingkat_tahun_ini) < 24) : ?>
        <div class="row d-flex justify-content-center mt-3 mb-5">
            <div class="alert alert-warning undefined-spp-classes-cost-warning" role="alert">
                Anda belum menentukan nominal spp per tingkat kelas pada tahun ajaran ini, silahkan tentukan nominal terlebih dahulu.
                <div class="row d-flex justify-content-center mt-5">
                    <?php
                    $slash = (int)date('y') + 1;
                    $tahunAjar = date('Y') . "/" . (string)$slash;
                    ?>
                    <a href="<?= base_url('admin/nominalspppertingkat/') ?>" class="btn btn-primary">Tentukan Nominal SPP</a>
                </div>
            </div>
        </div>
    <?php else : ?>
        <form method="POST">
            <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
            <div class="row spp-tahun-ajaran-row">
                <div class="form-group d-flex justify-content-center mr-2" style="margin-top: 7px;">
                    Tahun Ajaran:
                </div>
                <div class="form-group">
                    <select class="form-control spp-main-page-academic-year" name="tahunpelajaran">
                        <?php for ($i = 0; $i < count($tahunajaran); $i++) : ?>
                            <option value="<?= $tahunajaran[$i]["tahun_ajaran"] ?>" class="newyearclassname"><?= $tahunajaran[$i]["tahun_ajaran"] ?></option>
                        <?php endfor ?>
                    </select>
                </div>
            </div>
            <div class="container spp-main-page-student-search-result"></div>
            <div class="container spp-main-page-content-container">
                <div class="row d-flex justify-content-center mb-3">
                    <div class="col-lg mt-3">
                        <div class="row d-flex justify-content-center pt-2">
                            <?php foreach ($kelas as $k) : ?>
                                <div class="card class-card spp-class-card text-center px-0 mb-3 mx-2 <?= classCardColor($k["id"]) ?>" style="border-color: transparent;">
                                    <h5>Kelas <?= $k["class"] ?></h5>
                                    <button type="submit" name="idkelas" value="<?= $k["id"] ?>" class="btn btn-light <?= classBtnCardColor($k["id"]) ?> mb-3 mt-1" style="border-radius:20px">Buka Buku SPP</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
</div>
</form>