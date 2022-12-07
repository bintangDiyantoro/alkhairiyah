<div class="modal-header">
    <h5 class="modal-title px-2" id="ModalForPaymentTitle"><strong>Pembayaran SPP</strong></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" style="margin-left: 8px;">
    <div class="d-flex justify-content-start">
        <div class="spp-label" style="margin-left: -1px;margin-right:1px">
            Tanggal
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment tanggal" data-tanggal="<?= date('d-m-Y') ?>"><?= date('d-m-Y') ?></br>
        </div>
    </div>
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
        <div class="spp-data-payment siswa" data-id="<?= $siswa["id"] ?>" data-idkelassiswa="<?= $siswa["id_ks"] ?>" data-statusspp="<?= $siswa["status_spp"] ?>" data-detailstatusspp="<?= $siswa["id_detail_status_spp"] ?>"><strong><?= $siswa["nama"] ?></strong></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Kelas
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment"><strong><?= $kelas["class"] ?></strong></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Bulan
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment bulan" data-bulan="<?= $bulan["id"] ?>"><strong><?= $bulan["nama_bulan"] ?></strong></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label" style="margin-left: -1px;margin-right:1px">
            Tahun Ajaran
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment tahun" data-tahun="<?= $tahun ?>"><?= $tahun ?></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Nominal
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment nominal" data-nominal="<?= tagihanSiswaPerbulan($siswa["id"], $tagihankelas) ?>"><strong><?= rupiah(tagihanSiswaPerbulan($siswa["id"], $tagihankelas)) ?></strong></br>
        </div>
    </div>
    <?php if ($status_spp && $status_spp["status"] !== "Reguler") : ?>
        <div class="d-flex justify-content-start">
            <div class="spp-label">
                Status
            </div>
            <div class="div-colon-r2">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-payment status"><?= $status_spp["status"] ?></br>
            </div>
        </div>
        <?php if ($status_spp["keterangan"]) : ?>
            <div class="d-flex justify-content-start">
                <div class="spp-label">
                    Keterangan
                </div>
                <div class="div-colon-r2">
                    <p class="colon-r2">: </p>
                </div>
                <div class="spp-data-payment status"><?= $status_spp["keterangan"] ?></br>
                </div>
            </div>
        <?php endif ?>
    <?php endif ?>
    <?php if (tagihanSiswaPerbulan($siswa["id"], $tagihankelas) !== '0') : ?>
        <div class="d-flex justify-content-start metode-bayar-row">
            <div class="spp-label">
                Bayar dengan
            </div>
            <div class="div-colon-r2">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-payment metode-bayar-col">
                <div class="form-group">
                    <select class="form-control metode-bayar-options" name="tahunpelajaran" style="margin-top: -2px;padding-top: 2px;padding-left: 4px;height:35px;width:100px;border:3px solid lightgrey;">
                        <?php foreach ($metode_bayar as $mb) : ?>
                            <option value="<?= $mb["id"] ?>"><?= $mb["metode"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="d-flex justify-content-start bukti-tf-spp-ajax" data-csrf="<?= $csrf["hash"] ?>"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-success change-spp-status-btn">Ubah Status</button>
    <button type="button" class="btn btn-primary payment-submit">Bayar</button>
</div>