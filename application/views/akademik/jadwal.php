<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Jadwal</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Jadwal Belajar & Mengajar</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3" style="overflow-x:auto">
                    <table class="table table-hover ptk">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Ruang / Prasarana</th>
                                <th scope="col">Pembelajaran Jam Ke-</th>
                                <th scope="col">Senin</th>
                                <th scope="col">Selasa</th>
                                <th scope="col">Rabu</th>
                                <th scope="col">Kamis</th>
                                <th scope="col">Jumat</th>
                                <th scope="col">Sabtu</th>
                                <th scope="col">Minggu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jadwal as $j) : ?>
                                <tr>
                                    <td><?= $j['A'] ?></td>
                                    <td><?= $j['B'] ?></td>
                                    <td><?= $j['C'] ?></td>
                                    <td><?= $j['D'] ?></td>
                                    <td><?= $j['E'] ?></td>
                                    <td><?= $j['F'] ?></td>
                                    <td><?= $j['G'] ?></td>
                                    <td><?= $j['H'] ?></td>
                                    <td><?= $j['I'] ?></td>
                                    <td><?= $j['J'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>