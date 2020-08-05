<div class="container py-3 d-flex justify-content-center">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="text-center mb-3 main-section"><strong>Berita Terbaru</strong></h1>

            <?php
            if ($berita) {
                echo "<small>" . $berita[count($berita) - 1]['date'] . "</small>";
                echo $berita[count($berita) - 1]['content'];
                echo "<small><i>Diposting oleh: " . $berita[count($berita) - 1]['admin'] . "</i></small>";
            }
            ?>
        </div>
        <div class="col-lg-3 right-bar">
            <h3 class="text-center my-3"><strong>Semua Berita</strong></h3>
            <ul>
                <?php for ($i = count($berita) - 1; $i >= 0; $i--) : ?>
                    <li>
                        <a href="detailberita/<?= $i ?>">
                            <?php
                            $str = $berita[$i]['content'];
                            $length = strlen(substr($str, strpos($str, "<p>") + 3));
                            $link = strip_tags(substr($str, 0, -$length));
                            echo $link;
                            ?>
                        </a>
                        &nbsp; <small>(<?= $berita[$i]['date'] ?>)</small>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>
<input type="hidden" class="success" value="<?= $this->session->flashdata('success') ?>">