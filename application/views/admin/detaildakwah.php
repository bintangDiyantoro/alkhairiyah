<div class="container pb-3">
    <div class="row mb-3">
        <div class="col-md-9">
            <small>
                <?= $detail['date'] ?>
            </small>
            <?php
            echo $detail['content'];
            echo "<small><i>Diposting oleh: " . $detail['admin'] . "</i></small>";
            ?>
        </div>
        <div class="col-md-3 right-bar">
            <h3 class="text-center my-3"><strong>Semua Artikel Dakwah</strong></h3>
            <ul>
                <?php for ($i = count($dakwah) - 1; $i >= 0; $i--) : ?>
                    <li>
                        <a href="<?= $i ?>">
                            <?php
                            $str = $dakwah[$i]['content'];
                            $length = strlen(substr($str, strpos($str, "<p>") + 3));
                            $link = strip_tags(substr($str, 0, -$length));
                            echo $link;
                            ?>
                        </a>
                        &nbsp;<small>(<?= $dakwah[$i]['date'] ?>)</small>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <a href="<?= base_url('admin/dakwah') ?>" class="btn btn-primary">Kembali</a>
    <a href="<?= base_url('admin/editdakwah/') . $detail['id'] ?>" class="btn btn-warning">Edit</a>
    <?php 
    $full = $detail["content"];
    $con_length = strlen(substr($full, strpos($full,"<p>")+3));
    $title = strip_tags(substr($full, 0, -$con_length));
    ?>
    <a href="<?= base_url('admin/hapusdakwah/') . $detail['id'] ?>" class="btn btn-danger" data-id="<?= $detail['id'] ?>" data-judul="<?= $title?>">Hapus</a>
</div>