<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Sarana & Prasarana</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Data Sarana</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jenis Sarana</th>
                                <th scope="col">Letak</th>
                                <th scope="col">Kepemilikan</th>
                                <th scope="col">Spesifikasi</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sarana as $srn) : ?>
                                <tr>
                                    <td><?= $srn['A'] ?></td>
                                    <td><?= $srn['B'] ?></td>
                                    <td><?= $srn['C'] ?></td>
                                    <td><?= $srn['D'] ?></td>
                                    <td><?= $srn['E'] ?></td>
                                    <td><?= $srn['F'] ?></td>
                                    <td><?= $srn['G'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>