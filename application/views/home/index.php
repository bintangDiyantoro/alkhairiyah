<div class="row d-flex justify-content-center">
    <div class="col-lg-8">
        <div class="jumbotron mt-3">
            <h3 class="display-4 text-center">Ahlan Wasahlan!</h3>
            <div id="carouselExampleCaptions" class="carousel slide mt-3" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= base_url() ?>/assets/img/fotohlm.jpeg" class="d-block rounded w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Selamat Datang di halaman Resmi SDI Al-Khairiyah</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url() ?>/assets/img/1.jpg" class="d-block rounded w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Second slide label</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url() ?>/assets/img/2.jpg" class="d-block rounded w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Third slide label</h5>
                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url() ?>/assets/img/3.jpg" class="d-block rounded w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Third slide label</h5>
                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> -->
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <p class="lead text-center">Selamat datang di halaman utama SDI Al Khairiyah &#128591;</p>
            <hr class="my-4">
            <a class="btn btn-primary btn" href="<?= base_url('pendaftaran') ?>" role="button">Daftarkan Siswa Baru</a>
            <input type="hidden" name="sukses" id="sukses" value="<?= $this->session->userdata('sukses') ?>">
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="MyModalTitle">Selamat! Data anda sudah tersimpan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 font-weight-bolder">
                        ID Pendaftaran</br>
                    </div>
                    <div class="col-md-5">
                        <?= $calon_siswa['id'] ?> <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 font-weight-bolder">
                        Nama</br>
                    </div>
                    <div class="col-md-5">
                        <?= $calon_siswa['nama'] ?> <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 font-weight-bolder">
                        Jenis kelamin</br>
                    </div>
                    <div class="col-md-5">
                        <?= $calon_siswa['jenis_kelamin'] ?> <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 font-weight-bolder">
                        Umur</br>
                    </div>
                    <div class="col-md-5">
                        <?= $calon_siswa['umur'] . ' tahun' ?> <br>
                    </div>
                </div>
                <?php if ($calon_siswa['asal_tk'] !== null || $calon_siswa['asal_tk'] !== "") : ?>
                    <div class="row">
                        <div class="col-md-5 font-weight-bolder">
                            TK Asal</br>
                        </div>
                        <div class="col-md-5">
                            <?= $calon_siswa['asal_tk'] ?> <br>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-5 font-weight-bolder">
                        Wali</br>
                    </div>
                    <div class="col-md-5">
                        <?= $calon_siswa['namawali'] ?> <br>
                    </div>
                </div>
                </br><strong>Simpan ID pendaftaran yang tertera untuk bukti pendaftaran.</strong>
                </br>
                Kami akan menghubungi anda secepatnya, jika anda butuh dana.</br>
                <p>Tapi jika anda ingin melihat daftar calon siswa, silahkan pilih menu <strong> Pendaftaran > Lihat data calon siswa</strong></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal-close" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>