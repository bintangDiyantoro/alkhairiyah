<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?> | Admin SDI Al-Khairiyah</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/vendor/fontawesome-free/css/') ?>all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/alkhairiyah.png">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/css/') ?>sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/css/') ?>style.css" rel="stylesheet">
</head>

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
                    <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                  </div>
                  <form class="user" method="post">
                    <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                    <input type="hidden" class="success" value="<?= $this->session->flashdata('success') ?>">
                    <div class="form-group">
                      <input type="text" name="name" class="form-control form-control-user fill mb-3" value="<?= $this->session->userdata('admin') ?>" placeholder="Nama" autofocus autocomplete="off">
                    </div>
                    <?php if (form_error('name', '<small class="text-danger">', '</small>')) : ?>
                      <div class="pl-3" style="margin: -13px 0 -10px 0">
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                      </div>
                    <?php endif; ?>
                    <div class="form-group mt-3">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Kata sandi">
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                      <?= '<small class="text-danger pl-3">' . $this->session->userdata('error') . '</small>' ?>
                      <!-- <input type="hidden" id='error' value="<?= $this->session->userdata('error') ?>"> -->
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input">
                        <label class="custom-control-label" for="customCheck">Ingat saya</label>
                      </div>
                    </div> -->
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                      Masuk
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('admin/register') ?>">Belum punya akun admin? Buat akun!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('/') ?>">Bukan admin? Kembali ke halaman utama!</a>
                  </div>
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
  <script src="<?= base_url() ?>assets/js/mainscript.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/vendor/') ?>jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/js/') ?>sb-admin-2.min.js"></script>

</body>

</html>