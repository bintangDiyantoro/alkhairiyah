<div class="modal-header">
    <h5 class="modal-title px-3" id="ModalForPaymentTitle"><strong><?= $reason["nama"] ?></strong></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body px-4" style="margin-left: 8px;">
    <div class="d-flex justify-content-start">
        <div class="spp-insert-student-to-class-label" style="margin-left: -1px;margin-right:1px">
            Masukkan ke Kelas
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <?php if ($kelas[0] !== "lulus" && $kelas[0] !== "belum daftar") : ?>
            <div class="spp-data-insert-student-to-class">
                <div class="form-group">
                    <select class="form-control spp-chosen-class" name="kelas" style="margin-top:-5px;padding-left:10px;width:70px">
                        <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k["id"] ?>" class="class-option <?= $k["id"] ?>"><?= $k["class"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                </br>
            </div>
        <?php else : ?>
            <div class="spp-data-insert-student-to-class">- (<?= $kelas[0] ?>)</br>
            </div>
        <?php endif ?>
    </div>
    <?php if ($reason && $reason["tahun"]) : ?>
        <div class="d-flex justify-content-start">
            <div class="spp-insert-student-to-class-label" style="margin-left: -1px;margin-right:1px">
                Keterangan
            </div>
            <div class="div-colon-r2">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-insert-student-to-class"><?= $reason["class"] . " - " . $reason["tahun"] ?></br>
            </div>
        </div>
    <?php endif ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    <?php if ($kelas[0] !== "lulus" && $kelas[0] !== "belum daftar") : ?>
        <button type="button" class="btn btn-primary spp-insert-student-to-class-btn" data-idsiswa="<?= $id_siswa ?>" data-acyearsrc="<?= $academic_year_of_search ?>" data-namasiswa="<?= $reason["nama"] ?>" data-csrf="<?= $csrf["hash"] ?>">Masukkan</button>
    <?php endif ?>
</div>