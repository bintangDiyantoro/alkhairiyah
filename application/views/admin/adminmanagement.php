    <div class="container d-flex justify-content-center py-5 admvrfchl">
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Akun</th>
                        <th scope="col">Nama Asli</th>
                        <th scope="col">Aktivasi akun</th>
                        <th scope="col">Role</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($admin as &$a) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $a["name"] ?></td>
                            <td>
                                <?php if ($a["id_staff"]) {
                                    $this->db->where('id', $a["id_staff"]);
                                    echo $this->db->get('staff')->row_array()["nama"];
                                } ?>
                            </td>
                            <td>
                                <?php if ($a["verified"] == "1") : ?>
                                    &#9989;
                                <?php elseif ($a["verified"] == "0") : ?>
                                    &#10060;
                                <?php endif; ?>
                            </td>
                            <td><?= $a["role"]?></td>
                            <td>
                                <?= admvrf($a["verified"], $a["id"]) ?>
                                <a href="<?= base_url('admin/ubahadmin/') . $a["id"] ?>" class="badge badge-warning">
                                    Ubah
                                </a>
                                <a href="<?= base_url('admin/hapusadmin/') . $a["id"] ?>" class="badge badge-danger" data-judul="<?= $a["name"] ?>" data-id="<?= $a["id"] ?>">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div>