<div class="container py-3 d-flex justify-content-center">
    <div class="col-md-7">
        <form method="post" class="mt-3 main-form" enctype="multipart/form-data">
            <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
            <div class="form-group col-md-6">
                <div class="d-flex justify-content-start align-items-baseline">
                    <label for="class_id" style="margin-left: -12px;margin-right: 76px;">Kelas</label>
                    <select id="class_id" class="form-control col-sm-6" name="class_id">
                        <option selected value="">Pilih Kelas</option>
                        <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['id'] ?>"><?= $k['class'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?= form_error('class_id', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group col-md-7">
                <div class="d-flex justify-content-start align-items-baseline">
                    <label for="subject" class="mr-2" style="margin-left: -12px;">Mata Pelajaran</label>
                    <select id="subject" class="form-control col-sm-8" name="subject">
                        <option selected value="">Pilih Mata Pelajaran</option>
                        <?php foreach ($mapel as $m) : ?>
                            <option value="<?= $m['id'] ?>"><?= $m['nama_mapel'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?= form_error('subject', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <input type="text" name="chapter" class="form-control form-control-user" placeholder="Bab / judul materi">
                <?= form_error('chapter', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="editor" class="mr-2 col-sm-3" style="margin-left: -12px;">Materi</label>
                <textarea class="form-control" name="material" id="editor" rows="3" autofocus></textarea>
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
                <textarea class="form-control" name="questions" id="questions" rows="3" autofocus></textarea>
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