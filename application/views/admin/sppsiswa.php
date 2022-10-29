<?php if ($siswa) : ?>
    <div class="container pt-2" style="margin-bottom: -10px;">
        <div class="d-flex justify-content-start">
            <div class="student-spp-detail-label" style="margin-left: 7px;margin-right:1px">
                <h6>Nama</h6>
            </div>
            <div class="div-colon-r2" style="margin-top: -4px;">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-payment">
                <h6>
                    <strong>
                        <?= $siswa[0]["nama"] ?>
                    </strong>
                </h6>
            </div>
        </div>
        <div class="d-flex justify-content-start">
            <div class="student-spp-detail-label" style="margin-left: 7px;margin-right:1px">
                <h6>Nomor Induk</h6>
            </div>
            <div class="div-colon-r2" style="margin-top: -4px;">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-payment">
                <h6><?= $siswa[0]["nomor_induk"] ?></h6>
            </div>
        </div>
        <div class="d-flex justify-content-start">
            <div class="student-spp-detail-label" style="margin-left: 7px;margin-right:1px">
                <h6>Kelas</h6>
            </div>
            <div class="div-colon-r2" style="margin-top: -4px;">
                <p class="colon-r2">: </p>
            </div>
            <div class="spp-data-payment">
                <h6><?= $kelas["class"] ?></h6>
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
                <h6><?= $kelas["tahun"] ?></h6>
            </div>
        </div>
        <?php if ($nominal_spp) : ?>
            <div class="d-flex justify-content-start">
                <div class="student-spp-detail-label" style="margin-left: 7px;margin-right:1px">
                    <h6 class="nominal-spp-kelas" data-nominalspp="<?= $nominal_spp["id_nominal_spp"] ?>">Tagihan SPP</h6>
                </div>
                <div class="div-colon-r2" style="margin-top: -4px;">
                    <p class="colon-r2">: </p>
                </div>
                <div class="spp-data-payment">
                    <h6><?= rupiah(tagihanSiswaPerbulan($siswa[0]["id_siswa"], $nominal_spp)) ?> <small>/bulan</small></h6>
                </div>
            </div>
        <?php endif ?>
        <div class="d-flex justify-content-center mt-4" style="width: 100%;">
            <div class="table-content-col student-spp-table-landscape">
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
            <div>
                <div class="table-content-col student-spp-table-potrait">
                    <div style="overflow-x: auto;margin-top: -5px;">
                        <table class="table table-sm table-hover" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-right pr-4">Bulan</th>
                                    <th scope="col" class="text-left pl-3">Pembayaran</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="table-content-col student-spp-table-potrait" style="overflow-y: auto;height: 390px;">
                    <div style="overflow-x: auto;margin-top: -3px;">
                        <table class="table table-sm table-hover" style="table-layout: fixed;">
                            <tbody>
                                <?= tabelSppOneStudentLooper($siswa[0], $kelas, $bulan_akademik, $tahun) ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-end idtransaksi" style="width:100%;margin-top:25px" data-idtransaksi="<?= $this->session->flashdata("idtransaksi") ?>" data-pembayar="<?= $this->session->flashdata('pembayar') ?>">
            <a href="<?= base_url('admin/spp') ?>" class="btn btn-success px-3" style="border-radius: 15px;padding-top:2px;padding-bottom:2px;">Kembali</a>
            <a href="<?= base_url('admin/sppkelas/' . $kelas["id_kelas"] . "/" . $kelas["tahun"]) ?>" class="btn btn-info px-3 ml-2" style="border-radius: 15px;padding-top:2px;padding-bottom:2px;margin-right:-10px">Lihat Semua Data Kelas <?= $kelas["class"] ?></a>
        </div>
    </div>

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
<?php else : ?>
    <h3 style="margin-top:10px" class="text-center mt-5 mb-4">Data tidak ditemukan</h3>
    <div style="width: 100%;" class="text-center">
        <a href="<?= base_url('admin/spp') ?>" class="btn btn-secondary">Kembali</a>
    </div>
<?php endif ?>