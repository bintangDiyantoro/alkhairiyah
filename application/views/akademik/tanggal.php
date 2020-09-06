<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Materi Pelajaran</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <?php if ($date) : ?>
                <div class="row d-flex justify-content-center">
                    <h1 class="mt-3 text-center">Materi Pelajaran Kelas <?= $kelas["class"] ?></h1>
                </div>
                <div class="row d-flex justify-content-center mb-3">
                    <div class="col-lg mt-3">
                        <div class="row d-flex justify-content-center pt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    foreach ($date as $d) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $counter++ ?></th>
                                            <?php $rd = explode('-', $d["date"]) ?>
                                            <td><?= $rd[2] . "-" . $rd[1]."-".$rd[0] ?></td>
                                            <td><a href="<?= base_url('materi/date/') . $kelas['id'] . "/" . $d["date"] ?>" class="badge badge-info badge-pill">lihat materi</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <h1 class="text-center">Belum ada materi</h1>
            <?php endif; ?>
            <div class="d-flex justify-content-center">
                <a href="<?= base_url('akademik/materi/') ?>" class="btn btn-primary mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>





<!-- <div class="container mt-3">
    <h1 class="text-center display-4 mt-3 mb-3">Materi Pelajaran</h1>
</div> -->