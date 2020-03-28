<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Ahlan Wa Sahlan!</h1>
        <p class="lead">Selamat datang di laman SD Islam Al-Khairiyah Banyuwangi &#128591;</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2 card-3" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h3 class="display-4 text-center">Berita Terkini</h3>
                    <div id="carouselExampleCaptions" class="carousel slide mt-3" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            if (count($berita) <= 4) :
                                for ($i = 0; $i < count($berita); $i++) : ?>
                                    <li data-target="#carouselExampleCaptions" data-slide-to="<?= $i ?>" class="c-ind"></li>
                                <?php endfor;
                            else :
                                for ($i = 0; $i <= 3; $i++) : ?>
                                    <li data-target="#carouselExampleCaptions" data-slide-to="<?= $i ?>" class="c-ind"></li>
                            <?php endfor;
                            endif; ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php if (count($berita) <= 4) :
                                for ($j = 0; $j <= count($berita) - 1; $j++) : ?>
                                    <div class="carousel-item">
                                        <a href="berita/detail/<?= $berita[$k]['id'] - 1 ?>">
                                            <img src="<?= base_url() . $berita[$j]['image'] ?>" class="d-block rounded w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h1 class="news-heading"><?= $berita[$j]['title'] ?></h1>
                                                <p class="news-heading"><?= $berita[$j]['prev'] ?>...</p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endfor;
                            else :
                                for ($k = 0; $k <= 3; $k++) : ?>
                                    <div class="carousel-item">
                                        <a href="berita/detail/<?= $berita[$k]['id']-1 ?>">
                                            <img src="<?= base_url() . $berita[$k]['image'] ?>" class="d-block rounded w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h1 class="news-heading"><?= $berita[$k]['title'] ?></h1>
                                                <p class="news-heading"><?= $berita[$k]['prev'] ?>...</p>
                                            </div>
                                        </a>
                                    </div>
                            <?php endfor;
                            endif; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!-- <p class="lead text-center">Selamat datang di halaman utama SDI Al Khairiyah </p>
                    <hr class="my-4"> -->
                    <!-- <a class="btn btn-primary btn" href="<?= base_url('pendaftaran') ?>" role="button">Daftarkan Siswa Baru</a> -->
                </div>
                <div class="col-lg-3">
                    <h3 class="text-center my-3"><strong>Semua Berita</strong></h3>
                    <?php if(count($berita) <= 15):?>
                    <ul>
                        <?php for ($i = 0; $i <= count($berita) - 1; $i++) : ?>
                            <li>
                                <a href="berita/detail/<?= $berita[$i]['id']-1 ?>">
                                    <?php
                                    $str = $berita[$i]['content'];
                                    $length = strlen(substr($str, strpos($str, "<p>") + 3));
                                    $link = strip_tags(substr($str, 0, -$length));
                                    echo $link;
                                    ?>
                                </a>
                                &nbsp;<small>(<?= $berita[$i]['date'] ?>)</small>
                            </li>
                        <?php endfor; ?>
                    </ul>
                    <?php else:?>
                    <ul>
                    <?php for ($i = 0; $i <= 14; $i++) : ?>
                        <li>
                            <a href="berita/detail/<?= $berita[$i]['id']-1 ?>">
                                <?php
                                $str = $berita[$i]['content'];
                                $length = strlen(substr($str, strpos($str, "<p>") + 3));
                                $link = strip_tags(substr($str, 0, -$length));
                                echo $link;
                                ?>
                            </a>
                            &nbsp;<small>(<?= $berita[$i]['date'] ?>)</small>
                        </li>
                    <?php endfor; ?>
                    </ul>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-1 card-3 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h1 class="text-center mb-3 main-section"><strong>Buletin Dakwah Terbaru</strong></h1>

                    <?php
                    if ($dakwah) {
                        echo "<small>" . $dakwah[count($dakwah) - 1]['date'] . "</small>";
                        echo $dakwah[count($dakwah) - 1]['content'];
                        echo "<small><i>Diposting oleh: " . $dakwah[count($dakwah) - 1]['admin'] . "</i></small>";
                    }
                    ?>
                </div>
                <div class="col-lg-3 right-bar">
                    <h3 class="text-center my-3"><strong>Semua Artikel Dakwah</strong></h3>
                    <ul>
                        <?php for ($i = count($dakwah) - 1; $i >= 0; $i--) : ?>
                            <li>
                                <a href="dakwah/detail/<?= $i ?>">
                                    <?php
                                    $str = $dakwah[$i]['content'];
                                    $length = strlen(substr($str, strpos($str, "<p>") + 3));
                                    $link = strip_tags(substr($str, 0, -$length));
                                    echo $link;
                                    ?>
                                </a>
                                &nbsp; <small>(<?= $dakwah[$i]['date'] ?>)</small>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>