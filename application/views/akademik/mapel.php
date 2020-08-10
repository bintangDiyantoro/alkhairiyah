<div class="container mb-3">
    <div class="row d-flex justify-content-center">
        <h1 class="mt-3 text-center">Materi Pelajaran <?= $mapel[0]["nama_mapel"] ?> Kelas <?= $kelas["class"] ?></h1>
    </div>
    <div class="row d-flex justify-content-center mb-3">
        <div class="col-lg mt-3">
            <div class="row d-flex justify-content-center pt-2 mb-3">

                <table class="table table-hover" style="background-color: rgba(255,255,255, .4);">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Bab/Materi</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($mapel as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i++?></th>
                                <td><?= $m["chapter"] ?></td>
                                <td><a href="<?= base_url('materi/detail/') . $m["id"] ?>" class="btn btn-info">Lihat Materi</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="row d-flex justify-content-center">
                <a href="<?= base_url('materi/index/').$kelas["id"] ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>