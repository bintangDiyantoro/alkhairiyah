<div class="modal-header">
    <h5 class="modal-title px-2" id="ModalForPaymentTitle"><strong>Ubah Status SPP Siswa</strong></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" style="margin-left: 8px;">
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            No. Induk
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment"><?= $siswa["nomor_induk"] ?></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Nama
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment siswa" data-idsiswa="<?= $siswa["id"] ?>" data-statusspp="<?= $siswa["status_spp"] ?>" data-detailstatusspp="<?= $siswa["id_detail_status_spp"] ?>"><strong><?= $siswa["nama"] ?></strong></br>
        </div>
    </div>
    <div class="d-flex justify-content-start metode-bayar-row">
        <div class="spp-label">
            Status
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment">
            <div class="form-group">
                <select class="form-control status-keringanan-spp" name="id_status_spp" style="margin-top: -2px;padding-top: 0;padding-left: 4px;height:35px;width:180px;border:3px solid lightgrey;">
                    <?php foreach ($status_spp as $st_spp) : ?>
                        <option value="<?= $st_spp["id"] ?>" <?= ($st_spp["id"] == $siswa["status_spp"]) ? 'selected' : '' ?>><?= $st_spp["status"] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Tagihan
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment">
            <div class="form-group">
                <select class="form-control nominal-spp-payment-select" name="nominal" style="margin-top: -2px;padding-top: 0;padding-left: 4px;height:35px;width:180px;border:3px solid lightgrey;">
                    <?php foreach ($nominal_spp as $ns) : ?>
                        <option value="<?= $ns["id"] ?>" <?= tagihanSiswa($siswa["status_spp"], $id_kelas, $tahun, $ns["id"], $siswa["id_detail_status_spp"]) ?>><?= rupiah($ns["nominal"]) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Keterangan
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment">
            <div class="form-group">
                <textarea class="form-control keterangan-keringanan-spp" name="keterangan" id="keterangan" rows="2" style="width: 83%;"><?= trim((string)keteranganStatusSpp($siswa["id_detail_status_spp"])) ?></textarea>
            </div>
        </div>
    </div>
    <!-- <div class="d-flex justify-content-start bukti-tf-spp-ajax" style="height: 30px;">
        <div class="spp-label">
            Keterangan
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment form-group custom-file">
            <div style="height: 60px;padding-top: 0px">
                <textarea class="form-control" name="keterangan" cols="30"></textarea>
            </div>
        </div>-->
    <div class="d-flex justify-content-start csrf-ubah-status-spp" data-csrf="<?= $csrf["hash"] ?>"></div>
</div>
<div class="modal-footer" style="margin-bottom: -10px;">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-success change-spp-status-submit-btn">Ubah Status</button>
</div>
</div>