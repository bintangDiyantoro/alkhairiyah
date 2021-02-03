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
                        <td><?= $m["chapter"] ?></td>
                        <td><?= strip_tags(substr($m["material"], 0, 20)) . "..." ?></td>
                        <td><?= $m["date"] ?></td>
                    </tr>
                <?php $counter++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>