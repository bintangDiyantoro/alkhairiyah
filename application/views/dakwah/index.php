<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Buletin Dakwah</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2 card-3" style="margin-top: -70px">
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