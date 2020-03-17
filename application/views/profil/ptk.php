<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Tenaga Kependidikan</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2 card-3" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Daftar Tenaga Kependidikan</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <table class="table table-hover ptk">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NUPTK</th>
                                <th scope="col">JK</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Status</th>
                                <th scope="col">Jenis PTK</th>
                                <th scope="col">Gelar Depan</th>
                                <th scope="col">Gelar Belakang</th>
                                <th scope="col">Jenjang</th>
                                <th scope="col">Prodi</th>
                                <th scope="col">Sertifikasi</th>
                                <th scope="col">TMT Kerja</th>
                                <th scope="col">Tugas Tambahan</th>
                                <th scope="col">Mengajar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tpk as $t) : ?>
                                <tr>
                                    <th scope="row"><?= $t['A'] ?></th>
                                    <td><?= $t['B'] ?></td>
                                    <td><?= $t['C'] ?></td>
                                    <td><?= $t['D'] ?></td>
                                    <td><?= $t['E'] ?></td>
                                    <td><?= $t['F'] ?></td>
                                    <td><?= $t['H'] ?></td>
                                    <td><?= $t['I'] ?></td>
                                    <td><?= $t['J'] ?></td>
                                    <td><?= $t['K'] ?></td>
                                    <td><?= $t['L'] ?></td>
                                    <td><?= $t['M'] ?></td>
                                    <td><?= $t['N'] ?></td>
                                    <td><?= $t['O'] ?></td>
                                    <td><?= $t['P'] ?></td>
                                    <td><?= $t['Q'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>