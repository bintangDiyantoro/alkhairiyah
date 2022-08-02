<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10">
            <div class="row d-flex justify-content-center mt-3 mb-4 mx-4">
                <h3>Daftar Siswa Kelas <strong><?= $kelas["class"] ?> </strong> tahun ajaran <strong><?= $tahun ?></strong></h3>
            </div>
            <?php if ($semua_siswa) : ?>
                <div style="overflow-x: auto;">
                    <table class="table table-hover my-3">
                        <thead>
                            <tr>
                                <th class="align-middle" scope="col">#</th>
                                <th class="align-middle" scope="col">Nomor Induk</th>
                                <th class="align-middle" scope="col">NISN</th>
                                <th class="align-middle" scope="col">Nama</th>
                                <th class="align-middle" scope="col">Jenis Kelamin</th>
                                <th class="align-middle" scope="col">Diinput oleh</th>
                                <th class="align-middle" scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($semua_siswa as $ss) : ?>
                                <tr>
                                    <th class="align-middle" scope="row"><?= $i ?></th>
                                    <td class="align-middle"><?= $ss["nomor_induk"] ?></td>
                                    <td class="align-middle"><?= $ss["nisn"] ?></td>
                                    <td class="align-middle"><?= $ss["nama"] ?></td>
                                    <td class="align-middle">
                                        <?php if ($ss["jenis_kelamin"] == "L") {
                                            echo "Laki-laki";
                                        } elseif ($ss["jenis_kelamin"] == "P") {
                                            echo "Perempuan";
                                        } ?>
                                    </td>
                                    <td class="align-middle">
                                        <small>
                                            <i class="text-monospace" style="color:limegreen;font-weight:300 ;">
                                                <?= ($ss['insert_by'] == $this->session->userdata('id_staff')) ? 'Anda' : $ss["nama_staff"] ?>
                                            </i>
                                        </small>
                                    </td>
                                    <td class="align-middle">
                                        <?php if ($this->session->userdata("role") == "1") : ?>
                                            <a href="<?= base_url('admin/kelolanilai/' . $ss["id"] . "/" . $ss["id_kelas"] . "/" . $tahun) ?>" class="badge py-1 px-2 my-1 badge-primary" data-name="<?= $ss["nama"] ?>">
                                            Kelola Nilai
                                        </a>
                                        <?php endif ?>
                                        <a href="<?= base_url('admin/biodatasiswa/' . $ss["id"]) ?>" class="badge py-1 px-2 my-1 badge-info">
                                            Lihat Biodata
                                        </a>
                                        <a href="<?= base_url('admin/keluarkansiswa/' . $ss["id"] . "/" . $ss["id_kelas"] . "/" . $tahun) ?>" class="badge py-1 px-2 my-1 badge-danger keluarkan-siswa" data-name="<?= $ss["nama"] ?>">
                                            Keluarkan Dari Kelas
                                        </a>
                                    </td>
                                </tr>
                            <?php $i++;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row d-flex justify-content-center mt-3 mb-5">
                    <div class="ajax-cari-siswa" style="overflow-x: hidden!important;">
                        <a href="" class="btn btn-info trigger-cari-siswa mb-1" data-session="<?= $this->session->userdata('admin') ?>">Tambahkan Siswa Lain</a>
                        <?php if ($this->session->userdata("role") == "1") : ?>
                            <a href="<?= base_url('admin/bukuinduk') ?>" class="btn btn-secondary">Kembali</a>
                        <?php elseif ($this->session->userdata('role') == "4") : ?>
                            <a href="<?= base_url('admin/mkkelas/' . $this->session->userdata('tahun')) ?>" class="btn btn-secondary mb-1">Kembali</a>
                        <?php endif ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="row d-flex justify-content-center mt-3 mb-5">
                    <div class="ajax-cari-siswa mt-5" style="overflow-x: hidden!important;">
                        <div class="alert alert-warning p-5" role="alert">
                            Kelas masih kosong, silahkan memasukkan data-data para siswa ke kelas ini
                            <div class="row d-flex justify-content-center mt-5">
                                <a href="" class="btn btn-primary trigger-cari-siswa mr-1" data-session="<?= $this->session->userdata('admin') ?>">Cari Siswa</a>
                                <?php if ($this->session->userdata("role") == "1") : ?>
                                    <a href="<?= base_url('admin/bukuinduk') ?>" class="btn btn-secondary">Kembali</a>
                                <?php elseif ($this->session->userdata('role') == "4") : ?>
                                    <a href="<?= base_url('admin/mkkelas/' . $this->session->userdata('tahun')) ?>" class="btn btn-secondary">Kembali</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>