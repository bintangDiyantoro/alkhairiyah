<?php if ($this->session->userdata('role') == "1") : ?>
    <div class="container d-flex justify-content-center m-3">
    <?php endif ?>
    <div class="row">
        <?php if ($this->session->userdata('role') == "1") : ?>
            <div class="align-bottom mr-2" style="margin-top: 6px;width:130px;margin-bottom: 10px;">
            <?php else : ?>
                <div class="align-bottom mr-2" style="margin-top: 6px;width:80px;margin-bottom: 10px;">
                <?php endif ?>
                <?= ($this->session->userdata('role') == "4") ? 'Pilih Kelas:' : 'Pilih Kelas Anda:' ?>
                </div>
                <form class="d-flex justify-content-center align-items-center" action="<?= base_url('admin/pilihkelas2/' . $this->session->userdata('id_staff') . '/' . $this->session->userdata('tahun')) ?>" method="post" id="formPilihKelas" name="formPilihKelas">
                    <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                    <div class="form-group" style="width: 68px;">
                        <select class="form-control" aria-label="Default select example" name="pilihkelas" id="pilihkelas">
                            <?php foreach ($kelas as $k) : ?>
                                <option class="classname" value="<?= $k["id"] ?>"><?= $k["class"] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group ml-1">
                        <button type="submit" name="submitee" class="btn btn-primary" data-role="<?= $this->session->userdata('role') ?>" data-mknewtchtahun="<?= $tahun ?>" id="submitKelas">Pilih</button>
                    </div>
                    <div class="form group">
                        <a href="<?= base_url('admin/bukuinduk') ?>" style="height: 36px;margin-top: -18px;" class="btn btn-secondary form-control ml-1">Kembali</a>
                    </div>
                </form>
            </div>
            <?php if ($this->session->userdata('role') == "1") : ?>
    </div>
<?php endif ?>