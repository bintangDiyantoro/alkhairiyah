<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-7">
            <div class="alert alert-light" role="alert">
                <h2 class="alert-heading">Selamat!</h2>
                <h5>Pendaftaran online telah berhasil.</h5>
                <p>Silahkan download bukti pendaftaran lalu melakukan verifikasi offline sesuai jadwal yang diinformasikan melalui grup WhatsApp dan di Website ini.</p>
                <hr>
                <a class="btn btn-info mb-2" href="<?= base_url('ppdb/cetak/') . $id ?>" target="_blank">Download bukti pendaftaran</a> &nbsp;
                <a class="btn btn-success mb-2" href="https://chat.whatsapp.com/BFBYqiliLHs1kclKTfubVb" target="_blank">Masuk grup WhatsApp</a> &nbsp;
                <a class="btn btn-primary mb-2" href="<?= base_url('ppdb/cs') ?>">Lihat semua pendaftar</a>
                &nbsp;
                <!-- <a class="btn btn-dark mb-2" href="<?= base_url('jadwal verifikasi tgl 18 Maret ' . date('Y') . '.pdf') ?>">Jadwal verifikasi 60 pendaftar pertama</a>&nbsp;
                <a class="btn btn-dark mb-2" href="<?= base_url('jadwal verifikasi tgl 20 Maret ' . date('Y') . '.pdf') ?>">Jadwal verifikasi 70 pendaftar berikutnya (terakhir)</a> -->
            </div>
        </div>
    </div>
</div>