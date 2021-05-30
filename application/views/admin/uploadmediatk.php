<div class="container py-3 d-flex justify-content-center">
    <div class="col-md-7">
        <form method="post" class="mt-3 main-form" enctype="multipart/form-data">
            <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
            <div class="form-group row">
                <div class="col-md-6 mb-2">
                    <div class="d-flex justify-content-start align-items-baseline">
                        <label for="kegiatan" style="margin-right: 65px;">Kegiatan</label>
                        <select id="kegiatan" class="form-control col-sm-6" name="kegiatan">
                            <option selected value="">Pilih Kegiatan</option>
                            <?php foreach ($kegiatan as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= $k['kegiatan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?= form_error('kegiatan', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <label for="date" style="margin-right: 5px;">Tanggal</label>
                        <div id="inline" data-date="01/01/2020"></div>
                        <input type="text" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control" value="<?= $this->session->userdata('tgl_kegiatan') ?>" placeholder="dd-mm-yyyy" autocomplete="off">
                        <?= form_error('tgl_kegiatan', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= '<small class="text-danger pl-3">' . $this->session->flashdata('regex') . '</small>' ?>
                    </div>
                </div>
            </div>
            Media
            <div class="form-group custom-file mb-2 mt-2">
                <div>
                    <input type="file" class="custom-file-input" name="attachment">
                    <label class="custom-file-label mr-2" for="attachment">Pilih file</label>
                </div>
            </div>
            <div class="additional-attachment"></div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-info btn-sm add-media self mb-3">Tambah Media</button>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Unggah</button>
            </div>
        </form>
    </div>
</div>
<div id="myalert" data-alert="<?= $this->session->flashdata('alert') ?>"></div>