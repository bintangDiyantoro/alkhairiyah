<?php if ($result["onclass"] || $result["offclass"]) : ?>
    <h4 style="margin-top: 10px;margin-bottom: 20px;">Hasil Pencarian:</h4>
    <div style="overflow-x: auto;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="align-middle text-left">Nama</th>
                    <th scope="col" class="align-middle">Kelas</th>
                    <th scope="col" class="align-middle">Opsi</th>
                    <th scope="col" class="align-middle">No. Induk</th>
                    <th scope="col" class="align-middle">NISN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result["onclass"] as $on) : ?>
                    <tr>
                        <td class="align-middle text-left"><?= $on["nama"] ?></td>
                        <td class="align-middle"><?= $on["kelas"] ?></td>
                        <td class="align-middle"><small style="cursor: pointer;border-radius:20px;padding-top:1px;padding-bottom:1px" class="btn btn-info check-student-bill px-4" data-classid="<?= $on["id_kelas"] ?>" data-idsiswa="<?= $on["id_siswa"] ?>">Lihat</small></td>
                        <td class="align-middle"><?= $on["nomor_induk"] ?></td>
                        <td class="align-middle"><?= $on["nisn"] ?></td>
                    </tr>
                <?php endforeach ?>
                <?php foreach ($result["offclass"] as $off) : ?>
                    <tr>
                        <td class="align-middle text-left"><?= $off["nama"] ?></td>
                        <td class="align-middle">-</td>
                        <td class="align-middle"><small style="cursor: pointer;" class="badge badge-pill badge-success spp-insert-student-to-class" data-idsiswa="<?= $off["id"] ?>" data-tahun="<?= $tahun_ajaran ?>" data-toggle="modal" data-target="#ModalForInsertStudent">Masukkan Kelas</small></td>
                        <td class="align-middle"><?= $off["nomor_induk"] ?></td>
                        <td class="align-middle"><?= $off["nisn"] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <h3 style="margin-top:10px">Data tidak ditemukan</h3>
<?php endif; ?>

<div class="modal fade" id="ModalForInsertStudent" tabindex="-1" role="dialog" aria-labelledby="ModalForInsertStudentTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-for-insert-student-content">

        </div>
    </div>
</div>