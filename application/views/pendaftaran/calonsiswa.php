<div class="col-lg">
    <form action="" method="post">
        <div class="row justify-content-center">
            <div class="col-md-6 my-2 mt-4">
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
                            <!-- <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?= set_value('tgl_lahir') ?>" placeholder="dd-mm-yyyy" autocomplete="off"> -->
                            <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?= $this->session->userdata('tgl_lahir') ?>" placeholder="dd-mm-yyyy" autocomplete="off">
                            <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>') ?>
                            <?= '<small class="text-danger pl-3">' . $this->session->flashdata('regex') . '</small>' ?>
                        </div>
                        <div class="form-group">
                            <label for="asal_tk">Asal TK</label>
                            <input type="text" name="asal_tk" class="form-control" id="asal_tk" placeholder="TK asal" autocomplete="off" value="<?= set_value('asal_tk') ?>">
                            <?= form_error('asal_tk', '<small class="text-danger pl-3">', '</small>') ?>
                            <input type="hidden" class="error" value="<?= $this->session->userdata('error') ?>">
                            <input type="hidden" class="wali" value="<?= $this->session->userdata('wali') ?>">
                        </div>

                        <!-- <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" accept=".pdf" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div> -->

                        <div class="form-group float-md-right">
                            <button class="btn btn-info stuback">Kembali</button>
                            <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>