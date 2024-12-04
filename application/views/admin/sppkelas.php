<div class="container">
    <div class="d-flex justify-content-start">
        <div class="student-spp-detail-label" style="margin-left: 7px;margin-right:1px">
            <h6>Kelas</h6>
        </div>
        <div class="div-colon-r2" style="margin-top: -4px;">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment">
            <h6>
                <strong>
                    <?= $kelas["class"] ?>
                </strong>
            </h6>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="student-spp-detail-label" style="margin-left: 7px;margin-right:1px">
            <h6>Tahun Ajaran</h6>
        </div>
        <div class="div-colon-r2" style="margin-top: -4px;">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment">
            <h6>
                <strong>
                    <?= $kelas["tahun"] ?>
                </strong>
            </h6>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="student-spp-detail-label" style="margin-left: 7px;margin-right:1px">
            <h6>Wali Kelas</h6>
        </div>
        <div class="div-colon-r2" style="margin-top: -4px;">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment">
            <h6>
                <strong>
                    <?= $kelas["nama"] ?>
                </strong>
            </h6>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <div class="student-spp-detail-label" style="margin-left: 7px;margin-right:1px">
            <h6 class="nominal-spp-kelas" data-nominalspp="<?= $nominal_spp["id_nominal_spp"] ?>">Nominal SPP</h6>
        </div>
        <div class="div-colon-r2" style="margin-top: -4px;">
            <p class="colon-r2">: </p>
        </div>
        <div class="spp-data-payment">
            <h6>
                <strong>
                    <?= ($nominal_spp) ? rupiah($nominal_spp["nominal"]) . ' <small>/bulan</small>' : 'Nominal Belum Ditentukan' ?>
                </strong>
            </h6>
        </div>
    </div>
    <?php if ($siswa) : ?>
        <div class="d-flex justify-content-center row" style="width: 100%;">
            <div class="spp-labels-container col">
                <table class="table table-sm table-hover table-spp-labels">
                    <thead>
                        <tr>
                            <th class="align-middle" scope="col">#</th>
                            <th class="align-middle text-left pr-2" style="padding-left:10px" scope="col">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($siswa as $s) : ?>
                            <tr>
                                <th class="align-middle" scope="col"><?= $i ?></th>
                                <td class="align-middle text-left pr-2" style="padding-left:10px">
                                    <div style="width: 100%;height:60px;display:flex;align-items:center">
                                        <?= $s["nama"] ?>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        endforeach ?>
                        <tr>
                            <td class="align-middle text-left pl-2" style="font-size:12px;color: darkgreen;" scope="row"></td>
                            <td class="align-middle text-left pl-2" style="font-size:12px;color: darkgreen;" scope="row">Total</td>
                        </tr>
                        <tr>
                            <td class="align-middle text-left pl-2" style="font-size:12px;color: darkred ;" scope="row"></td>
                            <td class="align-middle text-left pl-2" style="font-size:12px;color: darkred ;" scope="row">Kekurangan</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="overflow-x: auto;margin-top: 0;" class="table-spp-data-col col">
                <table class="table table-sm table-hover table-spp">
                    <thead>
                        <tr>
                            <th scope="col" class="pl-3">#</th>
                            <th scope="col" class="text-left pl-2">Nama</th>
                            <?php foreach ($bulan_akademik as $ba) : ?>
                                <th scope="col" style="width: 80px;"><?= $ba["nama_bulan"] ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php tabelSPPLooper($siswa, $kelas, $bulan_akademik, $spp) ?>
                        <tr style="font-weight: bold;color: darkgreen;">
                            <td class="align-middle pl-3" scope="row"></td>
                            <td class="align-middle pl-3" scope="row">Total</td>
                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <td class="align-middle pl-3" style="font-size: 12px;" scope="row"><?= (totalSppKelasPerbulan($this->uri->segment(4), $this->uri->segment(5), $this->uri->segment(3), $i)) ? rupiah(totalSppKelasPerbulan($this->uri->segment(4), $this->uri->segment(5), $this->uri->segment(3), $i)) : "-" ?></td>
                            <?php endfor ?>
                        </tr>
                        <tr style="color:brown;font-weight:bold;">
                            <td class="align-middle pl-3" scope="row"></td>
                            <td class="align-middle pl-3" scope="row">Kekurangan</td>
                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <td class="align-middle pl-3" style="font-size: 12px;" scope="row"><?= ($i <= (int)idBulanIni()) ? rupiah($potMaksPerBln - totalSppKelasPerbulan($this->uri->segment(4), $this->uri->segment(5), $this->uri->segment(3), $i)) : "-" ?></td>
                            <?php endfor ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else : ?>
        <h3 class="text-center my-5">Kelas Masih Kosong</h3>
    <?php endif ?>
    <div class="row" style="margin-top:40px;">
        <div class="" style="display: flex;width: 200px;padding-right: 0;align-items: center;">
            <p style="display: block; text-align: center;">Total SPP masuk</p>
        </div>
        <div class="" style="margin-left: -10px;">
            <?php if ($total_spp_kelas["total"]) : ?>
                <p style="">: <strong style="font-size: 22px; color:darkgreen"><?= rupiah($total_spp_kelas["total"]) ?></strong></p>
            <?php else : ?>
                <p style="">: <strong style="font-size: 22px;"><?= rupiah(0) ?></strong></p>
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="" style="display: block;width: 200px;padding-right: 0;">
            <p>Potensi Maks berjalan </p>
        </div>
        <div class="" style="margin-left: -10px;">
            <p style="margin-top: -3px;">: <strong style="font-size: 18px;"><?= rupiah((int)$potMaksPerBln * (int)idBulanIni()) ?></strong></p>
        </div>
    </div>
    <div class="row">
        <div class="" style="display: block;width: 200px;padding-right: 0;">
            <p>Belum Terbayar</p>
        </div>
        <div class="" style="margin-left: -10px;">
            <p style="margin-top: -3px;">: <strong style="font-size: 18px; color:darkred"><?= rupiah((int)$potMaksPerBln * (int)idBulanIni() - (int)$total_spp_kelas["total"]) ?></strong></p>
        </div>
    </div>
    <div class="row">
        <div class="" style="display: block;width: 200px;padding-right: 0;">
            <p>Potensi Maks per bulan</p>
        </div>
        <div class="" style="margin-left: -10px;">
            <p style="margin-top: -3px;">: <strong style="font-size: 18px;"><?= rupiah($potMaksPerBln) ?></strong></p>
        </div>
    </div>
    <div class="row">
        <div class="" style="display: block;width: 200px;padding-right: 0;">
            <p>Potensi Maks total</p>
        </div>
        <div class="" style="margin-left: -10px;">
            <p style="margin-top: -3px;">: <strong style="font-size: 18px;"><?= rupiah((int)$potMaksPerBln * 12) ?></strong></p>
        </div>
    </div>
    <div class="row d-flex justify-content-end idtransaksi" style="width:100%;margin-top:35px" data-idtransaksi="<?= $this->session->flashdata("idtransaksi") ?>" data-pembayar="<?= $this->session->flashdata('pembayar') ?>">
        <a href="<?= base_url('admin/spp') ?>" class="btn btn-secondary px-3 mt-2" style="border-radius: 20px;">Kembali</a>
        <?php if ($this->session->userdata("role") == "2") : ?>
            <span class="btn btn-info px-3 ml-2 trigger-cari-siswa mt-2" style="border-radius: 20px;">Tambahkan Siswa</span>
            <a href="<?= base_url('admin/cetaksppkelas/' . $kelas["id_kelas"] . '/' . $kelas["tahun"]) ?>" class="btn btn-primary px-3 ml-2 mt-2" style="border-radius: 20px;">Cetak</a>
        <?php endif ?>
    </div>
</div>
<div class="ajax-cari-siswa" style="margin-left: 8%;margin-right:8%;margin-top:40px"></div>

<!-- Modal -->
<div class="modal fade" id="ModalForPayment" tabindex="-1" role="dialog" aria-labelledby="ModalForPaymentTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-payment-content">

        </div>
    </div>
</div>

<div class="modal fade" id="paidOffModal" tabindex="-1" role="dialog" aria-labelledby="paidOffModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content paid-off-modal-content">
        </div>
    </div>
</div>