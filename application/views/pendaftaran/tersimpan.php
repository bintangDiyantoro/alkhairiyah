<div class="container mt-3 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-9">
            <h2>Data pendaftar tersimpan</h2>
            <form class="form-inline my-2 my-lg-0" method="post" action="" style="display: inline;">
                <div class="srctest">
                    <input type="hidden" class="srctoken" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                </div>
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="cari data pendaftar" value="<?= $this->session->userdata('search') ?>" autofocus>
                <button class="btn btn-info my-2 my-sm-0" type="submit">Cari</button>
            </form>&nbsp;
            <?php if ((int)date('mdHi') >= 3141700 && (int)date('mdHi') < 3181700) : ?>
                <a class="btn btn-success" href="https://chat.whatsapp.com/G3sn2t1ji2d0FcfcHRtdNv" target="_blank">Masuk grup WhatsApp</a>
            <?php endif; ?>
            <?php if ($calon_siswa) : ?>
                <table class="table table-hover table-success my-3">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col">Nama</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($calon_siswa as $cs) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= ++$start ?></th>
                                <td class="text-center">
                                    <?php
                                    // $zeroes = '000';
                                    // $cs['id'] = (string) $cs['id'];
                                    // echo 'CS-' . substr($zeroes . $cs['id'], -4, 4);
                                    echo $cs['id_cs'];
                                    ?>
                                </td>
                                <td><?= $cs['nama'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('pendaftaran/detail/' . $cs['id']) ?>" class="badge badge-primary badge-pill detail">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h5 class="my-5">Maaf data tidak ditemukan</h5>
            <?php endif; ?>
            <?= $this->pagination->create_links() ?>
            <input type="hidden" name="tersimpan" id="tersimpan" value="ok">
            &nbsp;
            <!-- <a class="btn btn-dark mb-2" style="margin-left: -6px;" href="<?= base_url('jadwal verifikasi tgl 18 Maret ' . date('Y') . '.pdf') ?>">Jadwal verifikasi 60 pendaftar pertama</a>&nbsp;
            <a class="btn btn-dark mb-2 ml-0" href="<?= base_url('jadwal verifikasi tgl 20 Maret ' . date('Y') . '.pdf') ?>">Jadwal verifikasi 70 pendaftar berikutnya (terakhir)</a> -->
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">
                    <h1>Sabar ya tadz!</h1>
                    <h2>Masih proses</h2>
                    <span class="text-center" style='font-size:100px;'>&#128540;</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal-close" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>