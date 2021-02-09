<div class="container d-flex justify-content-center pt-3">
    <div style="overflow-x: auto;">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Mapel</th>
                    <th scope="col">Bab</th>
                    <th scope="col">Materi</th>
                    <th scope="col">Tanggal</th>
                    <th colspan="3">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach ($materi as $m) : ?>
                    <tr>
                        <th scope="row"><?= $counter ?></th>
                        <td><?= $m["class"] ?></td>
                        <td><?= $m["nama_mapel"] ?></td>
                        <td><?= strip_tags(substr($m["chapter"], 0, 20)) . "..." ?></td>
                        <td><?= strip_tags(substr($m["material"], 0, 20)) . "..." ?></td>
                        <td><?= $m["date"] ?></td>
                        <td>
                            <a href="<?= base_url('admin/detailmateri/') . $m["id"] ?>" class="badge badge-info">
                                Lihat
                            </a>
                            <a href="<?= base_url('admin/ubahmateri/') . $m["id"] ?>" class="badge badge-warning">
                                Ubah
                            </a>
                            <a href="<?= base_url('admin/hapusmateri/') . $m["id"] ?>" class="badge badge-danger" data-id="<?= $m["id"] ?>" data-judul="<?= $m["chapter"] ?>">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php $counter++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>