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
                                        <a href="berita/detail/<?= $berita[$k]['id'] - 1 ?>">
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
                    <?php if (count($berita) <= 15) : ?>
                        <ul>
                            <?php for ($i = 0; $i <= count($berita) - 1; $i++) : ?>
                                <li>
                                    <a href="berita/detail/<?= $berita[$i]['id'] - 1 ?>">
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
                    <?php else : ?>
                        <ul>
                            <?php for ($i = 0; $i <= 14; $i++) : ?>
                                <li>
                                    <a href="berita/detail/<?= $berita[$i]['id'] - 1 ?>">
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
                    <?php endif; ?>
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
                <input type="hidden" name="sukses" id="sukses" value="<?= $this->session->userdata('sukses') ?>">
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="MyModalTitle">Selamat! Data anda sudah tersimpan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        ID Pendaftaran</br>
                    </div>
                    <div class="col-md-5 font-weight-bolder">
                        <?= $calon_siswa['id'] ?> <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        Nama</br>
                    </div>
                    <div class="col-md-5 font-weight-bolder">
                        <?= $calon_siswa['nama'] ?> <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        Jenis kelamin</br>
                    </div>
                    <div class="col-md-5 font-weight-bolder">
                        <?= $calon_siswa['jenis_kelamin'] ?> <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        Tanggal Lahir</br>
                    </div>
                    <div class="col-md-5 font-weight-bolder">
                        <?= $calon_siswa['tgl_lahir'] ?> <br>
                    </div>
                </div>
                <?php if ($calon_siswa['asal_tk'] !== null || $calon_siswa['asal_tk'] !== "") : ?>
                    <div class="row">
                        <div class="col-md-5">
                            TK Asal</br>
                        </div>
                        <div class="col-md-5 font-weight-bolder">
                            <?= $calon_siswa['asal_tk'] ?> <br>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-5">
                        Wali</br>
                    </div>
                    <div class="col-md-5 font-weight-bolder">
                        <?= $calon_siswa['namawali'] ?> <br>
                    </div>
                </div>
                </br><strong>Simpan ID pendaftaran yang tertera untuk bukti pendaftaran.</strong>
                </br>
                Kami akan menghubungi anda secepatnya, jika siswa diterima.</br>
                <p>Untuk melihat daftar calon siswa, silahkan pilih menu <strong> Pendaftaran > Lihat data calon siswa</strong></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal-close" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>