<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Peserta Didik</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Jumlah Peserta Didik Berdasarkan Jenis Kelamin</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Laki-laki</th>
                                <th scope="col">Perempuan</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pdJK as $jk) : ?>
                                <tr>
                                    <td><?= $jk['A'] ?></td>
                                    <td><?= $jk['B'] ?></td>
                                    <td><?= $jk['C'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-1">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Jumlah Peserta Didik Berdasarkan Usia</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Usia</th>
                                <th scope="col">Laki-laki</th>
                                <th scope="col">Perempuan</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pdUsia as $usia) : ?>
                                <tr>
                                    <td><?= $usia['A'] ?></td>
                                    <td><?= $usia['B'] ?></td>
                                    <td><?= $usia['C'] ?></td>
                                    <td><?= $usia['D'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-2">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Jumlah Peserta Didik Berdasarkan Agama</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Agama</th>
                                <th scope="col">Laki-laki</th>
                                <th scope="col">Perempuan</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pdAgama as $agama) : ?>
                                <tr>
                                    <td><?= $agama['A'] ?></td>
                                    <td><?= $agama['B'] ?></td>
                                    <td><?= $agama['C'] ?></td>
                                    <td><?= $agama['D'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-1">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Jumlah Peserta Didik Berdasarkan Penghasilan Orang Tua/Wali</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Penghasilan</th>
                                <th scope="col">Laki-laki</th>
                                <th scope="col">Perempuan</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pdPOT as $POT) : ?>
                                <tr>
                                    <td><?= $POT['F'] ?></td>
                                    <td><?= $POT['H'] ?></td>
                                    <td><?= $POT['I'] ?></td>
                                    <td><?= $POT['J'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-2">
        <div class="container">
            <div class="row">
                <h3 class="mt-3 text-center">Jumlah Peserta Didik Berdasarkan Tingkat Pendidikan</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Tingkat Pendidikan</th>
                                <th scope="col">Laki-laki</th>
                                <th scope="col">Perempuan</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pdTP as $TP) : ?>
                                <tr>
                                    <td><?= $TP['L'] ?></td>
                                    <td><?= $TP['M'] ?></td>
                                    <td><?= $TP['N'] ?></td>
                                    <td><?= $TP['O'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>