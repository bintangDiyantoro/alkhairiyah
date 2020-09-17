<div class="card-2 d-flex justify-content-center mt-4 py-4" style="overflow-x: auto;">
    <div class="col-md-11">
        <h3 class="text-center">Materi <?= $materi["nama_mapel"] ?> Kelas <?= $materi["class"] ?> </h3>
        <?php $rd = explode('-', $materi["date"]) ?>
        <h5 class="text-center">tanggal <?= $rd[2] . "-" . $rd[1] . "-" . $rd[0] ?></h5>
        <!-- <h6>Materi:</h6> -->

        <div class="row">
            <h6 style="display: block;width: 100%;"><strong>Bab: <?= $materi["chapter"] ?></strong></h6>
            <?= str_ireplace('<p>', '<p style="width:100%;display:block">', str_ireplace('m.youtube', 'www.youtube', str_ireplace('watch?v=', 'embed/', str_ireplace('youtu.be', 'www.youtube.com/embed', str_ireplace('url', 'src', str_ireplace('oembed', 'iframe', $materi["material"])))))) ?>
        </div>
        <div class="row">
            <?php if ($materi["attachment_1"]) : ?>
                <h6><strong>Lampiran:</strong></h6>
            <?php endif; ?>
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
                <h6 style="display: block;width: 100%;"><strong>Tugas:</strong></h6>
                <?php
                $materials =  explode('<br>', $materi["questions"]);
                // echo str_ireplace($link, '<a href="' . $link . '" target="_blank">' . $link . '</a>', str_ireplace('<p>', '<p style="width:100%;display:block;overflow-x:auto">', $materi["questions"]));
                foreach ($materials as $m) {
                    if (preg_match('/http/i', $m) == 1) {
                        echo '<a href="' . $m . '" target="_blank" a>' . $m . '</a><br>';
                    } else {
                        echo $m . "<br>";
                    }
                }
                // echo $materi["questions"];
                ?>
            </div>
        <?php endif; ?>
        <a href="<?= base_url('materi/mapel/') . $materi["class_id"] . "/" . $materi["subject"] . "/" . $materi["date"] ?>" class="btn btn-primary">Kembali</a>
    </div>
</div>