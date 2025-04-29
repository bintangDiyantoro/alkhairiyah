<!-- <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?> | SDI Al-Khairiyah</title> -->

<!-- Custom fonts for this template-->
<!-- <link href="<?= base_url('assets/vendor/fontawesome-free/css/') ?>all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/alkhairiyah.png"> -->

<!-- Custom styles for this template-->
<!-- <link href="<?= base_url('assets/css/') ?>sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/') ?>style.css" rel="stylesheet"> 
</head> -->

<body class="bg-gradient-success">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <?php if ($this->session->flashdata('registrasisuccess')) : ?>
                                            <div class="alert alert-success alert-dismissible fade show text-left mb-4" role="alert">
                                                <strong>Registrasi Berhasil!</strong><br> <?= $this->session->flashdata('registrasisuccess') ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif ?>
                                        <h1 class="h4 text-gray-900 mb-4">Masukkan No. HP Wali & ID Pendaftaran</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                                        <div class="form-group">
                                            <label for="no_hp_wali" style="display:block;text-align:center;margin-bottom:0;font-size:small;color:rgb(31, 31, 31)">No. HP/WA Wali</label>
                                            <input type="text" name="no_hp_wali" class="form-control form-control-user fill mb-3" value="<?= set_value('no_hp_wali') ?>" placeholder="+628XXXXXXXXXXX" autofocus>
                                        </div>
                                        <?php if (form_error('no_hp_wali', '<small class="text-danger">', '</small>')) : ?>
                                            <div class="px-3" style="margin: -13px 0 -10px 0">
                                                <?= form_error('no_hp_wali', '<small class="text-danger" style="display:block;text-align:center">', '</small>'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group mt-3">
                                            <label for="idppdb" style="display:block;text-align:center;margin-bottom:0;font-size:small;color:rgb(31, 31, 31)">ID Pendaftaran</label>
                                            <input type="text" name="idppdb" class="form-control form-control-user" placeholder="CS-XXXX" value="<?= set_value('idppdb') ?>">
                                            <div class="px-3">
                                                <?= form_error('idppdb', '<small class="text-danger" style="display:block;text-align:center">', '</small>'); ?>
                                                <?= '<small class="text-danger text-center" style="display:block;text-align:center">' . $this->session->userdata('error') . '</small>' ?>
                                            </div>
                                            <!-- <input type="hidden" id='error' value="<?= $this->session->userdata('error') ?>"> -->
                                        </div>
                                        <button type="submit" id="submit-btn" name="submit" class="btn btn-primary btn-user btn-block">
                                            Masuk
                                        </button>
                                        <hr>
                                        <div class="row d-flex justify-content-center">
                                            <div class="login" style="padding:0px;height:0px;position:fixed"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/') ?>jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/vendor/') ?>bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url() ?>assets/js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/js/pickmeup1.js"></script>
    <script src="<?= base_url() ?>assets/js/mainscript99.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/') ?>jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/') ?>sb-admin-2.min.js"></script>
    <script>
        const title = $('title').html().split(' ')[4]
        if (title !== 'Pendaftaran' && title !== 'Tutup' && title !== 'Materi' && title !== 'Berhasil') {
            $(window).scroll(() => {
                var scroll = $(window).scrollTop();
                if (scroll > 70) {
                    $('.navbar').addClass('anu');
                } else {
                    $('.navbar').removeClass('anu');
                }
                document.querySelector('.container-fluid').style.marginTop = (-80 - 0.5 * scroll) + "px";
            })
        } else {
            $('.navbar').addClass('anu');
        }
    </script>
</body>

</html>