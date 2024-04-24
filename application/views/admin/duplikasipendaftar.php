<div class="container mt-3 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-9">
            <h2>Data Duplikasi Pendaftar</h2>

            <?php if ($duplikat) : ?>
                <table class="table table-hover table-success my-3">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Data Duplikat/Mirip</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $start = 1;
                        foreach ($duplikat as $d) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $start++ ?></th>
                                <td class="text-center">
                                    <?php
                                    echo $d;
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h5 class="my-5">Maaf data tidak ditemukan</h5>
            <?php endif; ?>
        </div>
        <div class="col-md-9">
            <a href="<?= base_url('admin/pendaftartersimpan') ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>