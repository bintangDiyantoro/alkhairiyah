<div class="jbtr lazyload">
    <div class="container">
        <h2 class="display-3">Ahlan Wa Sahlan!</h2>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2 card-3 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="text-center mb-3 main-section">Selamat Datang di website <strong>SD Islam Al-Khairiyah Banyuwangi</strong></h2>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="./assets/img/78964067382af8722d2f18b5d211faa90fef5c8e_s2_n2_y2(1).webp" alt="Foto Kepala Sekolah SD Islam Al-Khairiyah Banyuwangi" class="img-thumbnail mb-3">
                        </div>
                        <div class="col-md-8">
                            <p style="text-indent: 50px;">
                                <strong>SD Islam Al-Khairiyah Banyuwangi</strong> adalah lembaga pendidikan yang berkomitmen mencetak generasi unggul dengan mengintegrasikan ilmu pengetahuan, teknologi, dan nilai-nilai Islami dalam setiap aspek pembelajaran. Berlokasi di lingkungan yang asri dan kondusif, kami menghadirkan suasana belajar yang nyaman untuk mendukung perkembangan akademik, spiritual, dan karakter siswa.
                            </p>
                            <p style="text-indent: 50px;">
                                Dengan didukung oleh tenaga pendidik profesional, fasilitas modern, dan program unggulan berbasis akhlak mulia, SD Islam Al-Khairiyah Banyuwangi mengedepankan pendidikan holistik yang menginspirasi siswa untuk berprestasi, kreatif, dan memiliki jiwa kepemimpinan. Selain itu, kami juga menanamkan nilai-nilai Al-Qur’an dan hadits dalam keseharian, sehingga siswa tidak hanya cerdas secara intelektual, tetapi juga memiliki integritas moral yang kuat.
                            </p>
                        </div>
                    </div>
                    <p style="text-indent: 50px;">
                        Bergabunglah bersama kami dan jadilah bagian dari keluarga besar SD Islam Al-Khairiyah Banyuwangi, tempat di mana masa depan gemilang dimulai dengan langkah kecil yang penuh makna. Kami percaya, bersama-sama, kita dapat membangun generasi penerus yang siap menghadapi tantangan dunia dengan iman, ilmu, dan amal.
                    </p>
                </div>
                <div class="col-lg-3 right-bar">
                    <h3 class="text-center my-3"><strong>Berita</strong></h3>
                    <?php if (count($berita) <= 5) : ?>
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
                            <?php for ($i = 0; $i <= 6; $i++) : ?>
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
                    <h2 class="text-center mb-3 main-section"><strong>Buletin Dakwah</strong></h2>

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
                <!-- <input type="hidden" name="sukses" id="sukses" value="<?= $this->session->userdata('sukses') ?>"> -->
            </div>
        </div>
    </div>
    <div class="card card-2 card-3 mt-3">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div style="width: 100%;">
                    <h2 class="text-center mb-3 main-section"><strong>Komentar</strong></h2>
                </div>
                <div class="col-lg-5 mb-3">
                    <form method="post">
                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <div class="form-group" id="comments">
                            <label for="comment_name">Nama</label>
                            <input name="comment_name" type="text" class="form-control" id="comment_name" placeholder="Nama" value="<?= $this->session->userdata('comment_name') ?>">
                            <?= form_error('comment_name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input name="comment_email" type="text" class="form-control" id="comment_email" placeholder="contoh@email.com" value="<?= $this->session->userdata('comment_email') ?>">
                            <?= form_error('comment_email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="comment">Komentar</label>
                            <textarea name="comment" class="form-control" id="comment" rows="3" placeholder="Tinggalkan komentar anda"><?= $this->session->userdata('comment') ?></textarea>
                            <?= form_error('comment', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <input type="hidden" style="display: none;" class="scroll" value="<?= $this->session->flashdata('scroll'); ?>">
                        <input type="hidden" name="datetime" value="<?= date("d-m-Y, H:i") ?>" id="comments-form">
                        <button type="submit" name="submit" class="btn btn-primary">Posting Komentar</button>
                    </form>
                </div>
                <?php if ($comments) : ?>
                    <div class="col-lg-6" style="overflow: auto; height:300px;">
                        <div>
                            <ul>
                                <?php foreach ($comments as $komen) : ?>
                                    <li class="mb-3">
                                        <strong><?= $komen["nama"] ?></strong>
                                        <?php if ($komen["email"]) {
                                            echo "(" . $komen["email"] . ")";
                                        } ?>
                                        <ul>
                                            <li style="list-style: none; margin-left: -30px;">
                                                <?= $komen["komentar"] ?>
                                            </li>
                                            <li style="list-style: none; margin-left: -30px;">
                                                <small><?= $komen["tanggal"] ?></small>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <input type="hidden" class="success" value="<?= $this->session->flashdata('success') ?>">
            </div>
        </div>
    </div>
</div>