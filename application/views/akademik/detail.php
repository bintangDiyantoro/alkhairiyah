<div class="card-2 d-flex justify-content-center mt-4 py-4" style="overflow-x: auto;">
    <div class="col-md-11">
        <h3 class="text-center">Materi <?= $materi["nama_mapel"] ?> Kelas <?= $materi["class"] ?></h3>
        <!-- <h6>Materi:</h6> -->

        <div class="row">
            <h6 style="display: block;width: 100%;"><strong>Bab: <?= $materi["chapter"] ?></strong></h6>
            <?= $materi["material"] ?>
        </div>
        <div class="row">
            <h6><strong>Lampiran:</strong></h6>
            <ul style="display: block;width: 100%;">
                <?php for ($i = 1; $i <= 5; $i++) :
                    if ($materi["attachment_" . $i]) :
                        if (is_image($materi["attachment_" . $i])) : ?>
                            <li style="list-style: none;">
                                Lampiran <?= $i ?>
                                <a href="<?= base_url() . $materi["attachment_" . $i] ?>" target="_blank">
                                    <img src="<?= base_url() . $materi["attachment_" . $i] ?>" alt="<?= base_url() . $materi["attachment_" . $i] ?>" height="100px" style="display: block;">
                                    <small class="text-center">Klik untuk melihat gambar</small>
                                </a>
                            </li>
                        <?php else : ?>
                            <li>
                                <a href="<?= base_url() . $materi["attachment_" . $i] ?>" target="_blank">
                                    Lampiran <?= $i ?> <small> (klik untuk mendownload)</small>
                                </a>
                            </li>
                <?php endif;
                    endif;
                endfor; ?>
            </ul>
        </div>
        <?php if ($materi["questions"]) : ?>
            <div class="row">
                <h6 style="display: block;width: 100%;"><strong>Soal:</strong></h6>
                <?= $materi["questions"] ?>
            </div>
        <?php endif; ?>
        <a href="<?= base_url('materi/mapel/') . $materi["class_id"] . "/" . $materi["subject"] ?>" class="btn btn-primary">Kembali</a>
    </div>
</div>