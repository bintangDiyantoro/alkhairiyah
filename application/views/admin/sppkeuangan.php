<div class="container pt-3">
    <div class="row d-flex justify-content-start mx-2">
        <h1>Data Keuangan</h1>
    </div>
    <div class="row d-flex justify-content-start mb-2 mx-2">
        <p class="mt-2 mr-2"> Tahun Ajaran: </p>
        <select class="form-control spp-keuangan-academic-year" style="width: 110px;margin-top:1px">
            <?php foreach ($tahunajaran as $ta) : ?>
                <option value="<?= $ta ?>" class="newyearclassname"><?= $ta ?></option>
            <?php endforeach ?>
            <!-- for trial -->
            <!-- <option value="2021/22">2021/22</option> -->
        </select>
    </div>
    <div class="row d-flex justify-content-start mx-2">
        Total SPP Masuk: <span class="total-spp-th-tsb-span ml-1" style="font-size:22px;margin-top:-8px"><?= ($total_spp_masuk["total_spp"]) ? rupiah($total_spp_masuk["total_spp"]) : 'Rp0.-' ?></span>
    </div>
    <div class="row d-flex justify-content-start mx-2 mt-4">
        <p class="mt-2 mr-1">
            Total SPP Masuk bulan
        </p>
        <select class="form-control spp-keuangan-academic-month pl-1" style="width: 120px;margin-top:1px;background-color: #F8F9FC;">
            <?php foreach ($bulan as $b) : ?>
                <option value="<?= $b["id"] ?>" class="newmonthclassname" <?= selectedAcademicMonth($b["angka_bulan"]) ?>><?= $b["nama_bulan"] ?></option>
            <?php endforeach ?>
        </select>
        <strong class="mt-2">
            :
        </strong>
    </div>
    <div class="row d-flex justify-content-start mx-2">
        <h4 class="total-spp-bulan-tsb mr-1">
            <?= ($total_spp_bulan["total_spp_bulan"]) ? rupiah($total_spp_bulan["total_spp_bulan"]) : 'Rp0.-' ?>
        </h4>
    </div>
    <div class="row d-flex justify-content-start mx-2 mt-3">
        <h5 class="mt-2 mr-1">
            Daftar siswa belum pada bayar
        </h5>
    </div>
    <div class="row d-flex justify-content-start spp-keuangan-belum-pada-bayar mt-1 mx-2">
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
    </div>
</div>