<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Rombongan Belajar</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Data Rombongan Belajar</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" scope="col">No</th>
                                <th rowspan="2" scope="col">Nama RomBel</th>
                                <th rowspan="2" scope="col">Tingkat Kelas</th>
                                <th colspan="3" scope="col">Jumlah Siswa</th>
                                <th rowspan="2" scope="col">Wali Kelas</th>
                                <th rowspan="2" scope="col">Kurikulum</th>
                                <th rowspan="2" scope="col">Ruangan</th>
                            </tr>
                            <tr>
                                <th scope="col">L</th>
                                <th scope="col">P</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rombongan as $rb) : ?>
                                <tr>
                                    <td><?= $rb['A'] ?></td>
                                    <td><?= $rb['B'] ?></td>
                                    <td><?= $rb['C'] ?></td>
                                    <td><?= $rb['D'] ?></td>
                                    <td><?= $rb['E'] ?></td>
                                    <td><?= $rb['F'] ?></td>
                                    <td><?= $rb['G'] ?></td>
                                    <td><?= $rb['H'] ?></td>
                                    <td><?= $rb['I'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>