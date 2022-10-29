<div class="modal-header">
    <h5 class="modal-title px-2" id="ModalForPaymentTitle"><strong>Pembayaran SPP</strong></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" style="margin-left: 8px;">
    <div class="d-flex justify-content-start">
        <div class="spp-label" style="margin-left: -1px;margin-right:1px">
            Tgl. Bayar
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment tanggal"><?= $strukSPP['tanggal'] ?></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            No. Induk
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment"><?= $strukSPP["nomor_induk"] ?></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Nama
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment siswa"><strong><?= $strukSPP["nama"] ?></strong></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Kelas
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment"><strong><?= $strukSPP["class"] ?></strong></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Bulan
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment bulan"><strong><?= $strukSPP["nama_bulan"] ?></strong></br>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="spp-label" style="margin-left: -1px;margin-right:1px">
            Tahun Ajaran
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment tahun"><?= $strukSPP["tahun_ajaran"] ?></br>
        </div>
    </div>
    <div class="d-flex justify-content-start nominal">
        <div class="spp-label">
            Nominal
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment"><strong><?= rupiah($strukSPP["nominal"]) ?></strong></br>
        </div>
    </div>
    <?php if ($strukSPP["status"] && $strukSPP["status"] !== "Reguler") : ?>
        <div class="d-flex justify-content-start mt-2">
            <div class="spp-label">
                Status
            </div>
            <div class="div-colon-r2">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-payment"><?= $strukSPP["status"] ?></br>
            </div>
        </div>
        <?php if ($strukSPP["keterangan"]) : ?>
            <div class="d-flex justify-content-start">
                <div class="spp-label">
                    Keterangan
                </div>
                <div class="div-colon-r2">
                    <p class="colon-r2">: </p>
                </div>
                <div class="spp-data-payment"><?= $strukSPP["keterangan"] ?></br>
                </div>
            </div>
        <?php endif ?>
    <?php endif ?>
    <?php if ($strukSPP["nominal"] !== '0') : ?>
        <div class="d-flex justify-content-start metode-bayar-row">
            <div class="spp-label">
                Bayar dengan
            </div>
            <div class="div-colon-r2">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-payment nominal"><?= $strukSPP["metode"] ?></br>
            </div>
        </div>
    <?php endif ?>
    <?php if ($strukSPP["metode"] == "Transfer") : ?>
        <div class="d-flex justify-content-start mb-2">
            <div class="spp-label bukti-tf-label">
                Bukti Transfer
            </div>
            <div class="div-colon-r2">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-payment pt-2">
                <a href="<?= base_url('assets/spptf/') . $strukSPP["bukti_transfer"] ?>" target="_blank">
                    <?= (strchr($strukSPP["bukti_transfer"], ".pdf") == ".pdf") ? $strukSPP["bukti_transfer"] :
                        "<img src=" . base_url('assets/spptf/') . $strukSPP["bukti_transfer"] . " alt=" . $strukSPP["bukti_transfer"] . ' class="bukti-tf-spp-img">'
                    ?>
                </a>
                </br>
            </div>
        </div>
    <?php endif; ?>
    <div class="d-flex justify-content-start">
        <div class="spp-label">
            Admin
        </div>
        <div class="div-colon-r2">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment"><?= $strukSPP["nama_staff"] ?></br>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a href="<?= base_url('admin/buktipembayaranspp/') . $strukSPP["id"] ?>" class="btn btn-info text-light" target="_blank">Unduh Bukti Pembayaran &nbsp;&nbsp;<i class="fas fa-file-download"></i></a>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>