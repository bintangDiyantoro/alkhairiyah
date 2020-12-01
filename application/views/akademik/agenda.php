<div class="jbtr">
    <div class="container">
        <h1 class="display-3">Agenda Pendidikan</h1>
        <p class="lead">SD Islam Al-Khairiyah Banyuwangi</p>
    </div>
</div>
<div class="container-fluid">
    <div class="card card-2" style="margin-top: -70px">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <h3 class="mt-3">Kalender Akademik</h3>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-lg mt-3" style="overflow-x:auto">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Uraian kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            foreach ($agenda as $a) : ?>
                                <tr>
                                    <td><?= $counter++ ?></td>
                                    <td><?= $a['B'] ?></td>
                                    <td><?= $a['C'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>