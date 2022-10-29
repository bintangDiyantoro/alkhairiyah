<div class="container py-4 px-5 d-flex justify-content-center">
    <div class="row d-flex justify-content-center">
        <div class="row px-4 py-2" style="margin: auto;">
            <h3 class="ml-4">Nominal SPP Per Tingkat Kelas Tahun Ajaran <?= $this->tahunAjar ?></h3>
        </div>
        <div class="row mt-4">
            <form action="<?= base_url('admin/nominalspppertingkat/') ?>" method="post">
                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                <div class="row nominal-spp-kelas-row" style="margin:auto;" data-update="<?= $this->session->flashdata('updateNominalSpp') ?>">
                    <div class="w-100"></div>
                    <div class="col-sm-3 align-bottom d-flex justify-content-start ml-2">
                        <div class="form-group d-flex justify-content-center" style="margin-top: 7px;">
                            Kelas 1:
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="sppkelas1">
                                <?php foreach ($nominal as $n) : ?>
                                    <option value="<?= $n["id"] ?>" class="newyearclassname" <?= selectedNominal($n["id"], $nominal_per_tingkat_tahun_ini["kls1"]) ?>><?= rupiah($n["nominal"]) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-sm-3 align-bottom d-flex justify-content-start ml-2">
                        <div class="form-group d-flex justify-content-center" style="margin-top: 7px;">
                            Kelas 2:
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="sppkelas2">
                                <?php foreach ($nominal as $n) : ?>
                                    <option value="<?= $n["id"] ?>" class="newyearclassname" <?= selectedNominal($n["id"], $nominal_per_tingkat_tahun_ini["kls2"]) ?>><?= rupiah($n["nominal"]) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-sm-3 align-bottom d-flex justify-content-start ml-2">
                        <div class="form-group d-flex justify-content-center" style="margin-top: 7px;">
                            Kelas 3:
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="sppkelas3">
                                <?php foreach ($nominal as $n) : ?>
                                    <option value="<?= $n["id"] ?>" class="newyearclassname" <?= selectedNominal($n["id"], $nominal_per_tingkat_tahun_ini["kls3"]) ?>><?= rupiah($n["nominal"]) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-sm-3 align-bottom d-flex justify-content-start ml-2">
                        <div class="form-group d-flex justify-content-center" style="margin-top: 7px;">
                            Kelas 4:
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="sppkelas4">
                                <?php foreach ($nominal as $n) : ?>
                                    <option value="<?= $n["id"] ?>" class="newyearclassname" <?= selectedNominal($n["id"], $nominal_per_tingkat_tahun_ini["kls4"]) ?>><?= rupiah($n["nominal"]) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-sm-3 align-bottom d-flex justify-content-start ml-2">
                        <div class="form-group d-flex justify-content-center" style="margin-top: 7px;">
                            Kelas 5:
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="sppkelas5">
                                <?php foreach ($nominal as $n) : ?>
                                    <option value="<?= $n["id"] ?>" class="newyearclassname" <?= selectedNominal($n["id"], $nominal_per_tingkat_tahun_ini["kls5"]) ?>><?= rupiah($n["nominal"]) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-sm-3 align-bottom d-flex justify-content-start ml-2">
                        <div class="form-group d-flex justify-content-center" style="margin-top: 7px;">
                            Kelas 6:
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="sppkelas6">
                                <?php foreach ($nominal as $n) : ?>
                                    <option value="<?= $n["id"] ?>" class="newyearclassname" <?= selectedNominal($n["id"], $nominal_per_tingkat_tahun_ini["kls6"]) ?>><?= rupiah($n["nominal"]) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="w-100"></div>
                </div>
        </div>
        <div class="row mt-4">
            <di-sm-4v class="form-group">
                <button name="submit" class="btn btn-primary">Simpan</button>
            </di-sm-4v>
            <div class="form group">
                <a href="<?= base_url('admin/spp') ?>" class="btn btn-secondary ml-1">Pembayaran SPP</a>
            </div>
            </form>
        </div>
    </div>
</div>