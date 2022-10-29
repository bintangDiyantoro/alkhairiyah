<div class="container">
    <div class="row d-flex justify-content-start ml-2 mt-5 mb-4">
        <div style="width: 115px;padding-right:0;">
            <h5>Kelas</h5>
            <h5>Tahun Ajaran</h5>
            <h5>Wali Kelas</h5>
            <h5>Nominal SPP</h5>
        </div>
        <div class="col nominal-spp-kelas" <?= ($nominal_spp) ? 'data-nominalspp="' . $nominal_spp["id_nominal_spp"] . '"' : '' ?>>
            <h5>: <strong><?= $kelas["class"] ?></strong></h5>
            <h5>: <strong><?= $kelas["tahun"] ?></strong></h5>
            <h5>: <?= $kelas["nama"] ?></h5>
            <h5>: <?= ($nominal_spp) ? rupiah($nominal_spp["nominal"]) . ' <small>/bulan</small>' : 'Nominal Belum Ditentukan' ?></h5>
        </div>
    </div>
    <?php if ($siswa) : ?>
        <div class="d-flex justify-content-center" style="width: 100%;">
            <div class="table-name-col">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="align-middle pl-3" scope="col">#</th>
                            <th class="align-middle text-left pr-2" style="padding-left:10px" scope="col">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($siswa as $s) : ?>
                            <tr>
                                <th class="align-middle pl-3" scope="row"><?= $i ?></th>
                                <td class="align-middle text-left pr-2" style="padding-left:10px"><?= $s["nama"] ?></td>
                            </tr>
                        <?php
                            $i++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="table-content-col">
                <div style="overflow-x: auto;margin-top: 0;">
                    <table class="table table-sm table-hover table-spp" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <?php foreach ($bulan_akademik as $ba) : ?>
                                    <th scope="col"><?= $ba["nama_bulan"] ?></th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php tabelSPPLooper($siswa, $kelas, $bulan_akademik, $spp) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else : ?>
        <h3 class="text-center my-5">Kelas Masih Kosong</h3>
    <?php endif ?>
    <div class="row d-flex justify-content-end idtransaksi" style="width:100%;margin-top:35px" data-idtransaksi="<?= $this->session->flashdata("idtransaksi") ?>" data-pembayar="<?= $this->session->flashdata('pembayar') ?>">
        <a href="<?= base_url('admin/spp') ?>" class="btn btn-secondary px-3" style="border-radius: 20px;">Kembali</a>
        <span class="btn btn-info px-3 ml-2 trigger-cari-siswa" style="border-radius: 20px;">Tambahkan Siswa</span>
        <a href="<?= base_url('admin/cetaksppkelas/' . $kelas["id_kelas"] . '/' . $kelas["tahun"]) ?>" class="btn btn-primary px-3 ml-2" style="border-radius: 20px;" target="_blank" >Cetak</a>
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