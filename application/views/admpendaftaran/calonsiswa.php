<div class="col-lg">
    <form action="" method="post">
        <div class="row justify-content-center">
            <div class="col-md-6 my-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="tex-center">Data calon siswa</h3>
                        <div class="form-group">
                            <label for="nama_calon_siswa">Nama Calon Siswa</label>
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <input type="text" name="nama_calon_siswa" class="form-control fill" id="nama_calon_siswa" placeholder="(Nama sesuai KK)" autocomplete="off" value="<?= set_value('nama_calon_siswa') ?>" autofocus>
                            <?= form_error('nama_calon_siswa', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis kelamin</label>
                            <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin" value="<?= set_value('jenis_kelamin') ?>">
                                <option value="">Pilih jenis kelamin</option>
                                <option <?= selectKel('L') ?> value="L">Laki-laki</option>
                                <option <?= selectKel('P') ?> value="P">Perempuan</option>
                            </select>
                            <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <div id="inline" data-date="01/01/2020"></div>
                            <input type="text" name="tgl_lahir2" id="tgl_lahir2" class="form-control" value="<?= $this->session->userdata('tgl_lahir3') ?>" placeholder="dd-mm-yyyy">
                            <?= '<small class="text-danger pl-3">' . $this->session->flashdata('regex2') . '</small>' ?>
                        </div>
                        <div class="form-group">
                            <label for="asal_tk">Asal TK</label>
                            <input type="text" name="asal_tk" class="form-control" id="asal_tk" placeholder="TK asal" autocomplete="off" value="<?= set_value('asal_tk') ?>">
                            <?= form_error('asal_tk', '<small class="text-danger pl-3">', '</small>') ?>
                            <input type="hidden" class="error" value="<?= $this->session->userdata('error2') ?>">
                            <input type="hidden" class="wali" value="<?= $this->session->userdata('wali2') ?>">
                        </div>
                        <div class="form-group float-md-right">
                            <button class="btn btn-info stuback2">Kembali</button>
                            <button type="submit" class="btn btn-primary" name="submit">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>