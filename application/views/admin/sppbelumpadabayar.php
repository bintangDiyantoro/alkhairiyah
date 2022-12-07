<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-left">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($pada_belum_bayar as $pbb) : ?>
            <tr>
                <th class="align-middle" scope="row"><?= $i ?></th>
                <td class="align-middle text-left"><?= $pbb["nama"] ?></td>
                <td class="align-middle"><?= getStudentsClass($pbb["id"]) ?></td>
                <td class="align-middle"><?= ($pbb["no_hp_ortu"]) ? '<a class="badge badge-pill badge-primary" href="https://wa.me/' . $pbb["no_hp_ortu"] . '">Hubungi Wali Murid</a>' : 'Sabar' ?></td>
            </tr>
        <?php $i++;
        endforeach ?>
    </tbody>
</table>