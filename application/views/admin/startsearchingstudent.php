<a href="" class="btn btn-info trigger-cari-siswa mb-1" data-session="<?= $this->session->userdata('admin') ?>">Tambahkan Siswa Lain</a>
<?php if ($this->session->userdata("role") == "1") : ?>
    <a href="<?= base_url('admin/bukuinduk') ?>" class="btn btn-secondary mb-1">Kembali</a>
<?php elseif ($this->session->userdata('role') == "4") : ?>
    <a href="<?= base_url('admin/mkkelas/' . $this->session->userdata('tahun')) ?>" class="btn btn-secondary mb-1">Kembali</a>
<?php endif ?>