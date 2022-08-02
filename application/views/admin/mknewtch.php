<form action="<?= base_url('admin/mkkelas/' . $this->session->userdata('tahun')) ?>" method="post" id="formPilihWaliKelas">
    <input type="hidden" class="input-pilih-wali-kelas" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
    <input type="hidden" class="input-pilih-wali-kelas" name="idkelas" value="<?= $idkelas ?>">
    <input type="hidden" class="input-pilih-wali-kelas" name="tahun" value="<?= $this->session->userdata('tahun') ?>">
    <div class="row pilih-wali-kelas">
        <div class="form-group">
            <select class="form-control" aria-label="Default select example" name="pilihwalikelas" id="pilihwalikelas">
                <?php foreach ($newTch as $nt) : ?>
                    <option class="opsiwalikelas" value="<?= $nt["id"] ?>"><?= $nt["nama"] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group ml-2">
            <button type="submit" name="submitee" class="btn btn-primary" style="border-radius:50px;" id="submitWaliKelas">Pilih</button>
        </div>
    </div>
</form>