<div class="container py-3 d-flex justify-content-center">
    <div class="col-md-7">
        <form method="post" class="mt-3 main-form" enctype="multipart/form-data">
            <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
            <div class="form-group row">
                <div class="col-md-6 mb-2">
                    <div class="d-flex justify-content-start align-items-baseline">
                        <label for="class_id" style="margin-right: 65px;">Kelas</label>
                        <select id="class_id" class="form-control col-sm-6" name="class_id">
                            <option selected value="">Pilih Kelas</option>
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= $k['class'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?= form_error('class_id', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <label for="date" style="margin-right: 5px;">Tanggal</label>
                        <select id="date" class="form-control col-sm-8" name="date">
                            <?php for ($i = (int)date('d') - 50; $i < (int)date('d'); $i++) :
                                if ($i !== 0 && $i > 0) :
                                    if ($i < 10) : ?>
                                        <option value="<?= date('Y-m-') . '0' . $i  ?>"><?= '0' . $i . date('-m-Y') ?></option>
                                    <?php else : ?>
                                        <option value="<?= date('Y-m-') . $i  ?>"><?= $i . date('-m-Y') ?></option>
                                    <?php endif;
                                else :
                                    $_31 = [1, 3, 5, 7, 8, 10, 12];
                                    $prevmonth = (int)date('m') - 1;
                                    if (in_array($prevmonth, $_31)) {
                                        $prevdays = 31 + $i;
                                    } elseif ($prevmonth == 2) {
                                        $prevdays = 29 + $i;
                                    } else {
                                        $prevdays = 30 + $i;
                                    }

                                    if ($prevmonth > 9) : ?>
                                        <option value="<?= date('Y-') . $prevmonth . '-' . $prevdays ?>">
                                            <?= $prevdays . '-' . $prevmonth . date('-Y') ?>
                                        </option>
                                    <?php else : ?>
                                        <option value="<?= date('Y-') . '0' . $prevmonth . '-' . $prevdays ?>">
                                            <?= $prevdays . '-' . '0' . $prevmonth . date('-Y') ?>
                                        </option>
                                    <?php endif;
                                endif;
                            endfor; ?>
                            <option selected value="<?= date("Y-m-d") ?>">Hari ini, <?= date("d-m-Y") ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-7">
                <div class="d-flex justify-content-start align-items-baseline">
                    <label for="subject" class="mr-2" style="margin-left: -12px;">Tema / Mapel </label>
                    <select id="subject" class="form-control col-sm-7" name="subject">
                        <option selected value="">Pilih Tema / Mapel</option>
                        <?php foreach ($mapel as $m) : ?>
                            <option value="<?= $m['id'] ?>"><?= $m['nama_mapel'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?= form_error('subject', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <input type="text" name="chapter" class="form-control form-control-user" placeholder="Bab / Sub tema">
                <?= form_error('chapter', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="editor" class="mr-2 col-sm-3" style="margin-left: -12px;">Materi</label>
                <textarea class="form-control" name="material" id="editor" rows="3" autofocus><?= $this->session->flashdata('material') ?></textarea>
                <?= form_error('material', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            Lampiran (gambar/dokumen)
            <div class="form-group custom-file mb-2 mt-2">
                <div>
                    <!-- <input type="file" class="custom-file-input" id="attachment" name="attachment"> -->
                    <input type="file" class="custom-file-input" name="attachment">
                    <label class="custom-file-label mr-2" for="attachment">Pilih file</label>
                </div>
            </div>
            <div class="additional-attachment"></div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-info btn-sm add-attachment self">Tambah Lampiran</button>
            </div>
            <div class="form-group">
                <label for="questions" class="mr-2 col-sm-3" style="margin-left: -12px;">Soal</label>
                <textarea class="form-control" name="questions" id="questions" rows="3"><?= $this->session->flashdata('questions') ?></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Unggah</button>
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url('assets/js/ckeditor.js') ?>"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                options: {
                    resourceType: 'Images'
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#questions'), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                options: {
                    resourceType: 'Images'
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
<div id="myalert" data-alert="<?= $this->session->flashdata('alert') ?>"></div>