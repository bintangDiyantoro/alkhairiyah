<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#004632">

    <title>SDI Al-Khairiyah | <?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/') ?>all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/alkhairiyah.png">
    <link rel="apple-touch-icon" href="<?= base_url('assets/img/') ?>alkhairiyah192b.png">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/') ?>sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/') ?>adminmainstyle2.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/') ?>pickmeup1.css" rel="stylesheet">
    <link rel="manifest" href="<?= base_url() ?>manifest.json">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav anu sidebar sidebar-dark accordion <?= togglesidebar($this->session->userdata("toggle")) ?>" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url() ?>assets/img/alkhairiyah.png" width="50px" height="50px" style="margin-right:7px"></img>
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if ($this->session->userdata('role') == "9") : ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Admin
                </div>


                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages5" aria-expanded="true" aria-controls="collapsePages5">
                        <i class="fas fa-user-cog"></i>
                        <span>Users Management</span>
                    </a>
                    <div id="collapsePages5" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu Manajemen:</h6>
                            <a class="collapse-item" href="<?= base_url('admin/adminmanagement') ?>">Admins Management</a>
                            <a class="collapse-item" href="<?= base_url('admin/staffsmanagement') ?>">Staffs Management</a>
                            <a class="collapse-item" href="<?= base_url('admin/rolesmanagement') ?>">Roles Management</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Posts
                </div>


                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true" aria-controls="collapsePages3">
                        <i class="fa fa-book"></i>
                        <span>Materi</span>
                    </a>
                    <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu Materi:</h6>
                            <a class="collapse-item" href="<?= base_url('admin/buatmateri') ?>">Buat Materi Baru</a>
                            <a class="collapse-item" href="<?= base_url('admin/materi') ?>">Lihat Materi Terbaru</a>
                        </div>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages4" aria-expanded="true" aria-controls="collapsePages4">
                        <i class="fas fa-clipboard"></i>
                        <span>Pendaftaran</span>
                    </a>
                    <div id="collapsePages4" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu Pendaftaran:</h6>
                            <a class="collapse-item" href="<?= base_url('admin/pendaftaran') ?>">Daftarkan Siswa Baru</a>
                            <a class="collapse-item" href="<?= base_url('admin/pendaftartersimpan') ?>">Lihat Calon Siswa</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/uploadmediatk') ?>">
                        <i class="fas fa-photo-video"></i>
                        <span>Upload Media TK</span>
                    </a>
                </li>

            <?php endif; ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <?php if ($this->session->userdata('role') == "1") : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/bukuinduk') ?>">
                        <i class="fas fa-book-open"></i>
                        <span>Buku Induk Siswa</span>
                    </a>
                </li>
            <?php elseif ($this->session->userdata('role') == "9") : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages6" aria-expanded="true" aria-controls="collapsePages6">
                        <i class="fa fa-book-open"></i>
                        <span>Buku Induk Siswa</span>
                    </a>
                    <div id="collapsePages6" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu Buku Induk:</h6>
                            <a class="collapse-item" href="<?= base_url('admin/dftnilaisikap') ?>">Nilai Sikap</a>
                            <a class="collapse-item" href="<?= base_url('admin/dftmuatanpelajaran') ?>">Muatan Pelajaran</a>
                            <a class="collapse-item" href="<?= base_url('admin/dftekstrakurikuler') ?>">Ekstrakurikuler</a>
                            <a class="collapse-item" href="<?= base_url('admin/dftketidakhadiran') ?>">Ketidakhadiran</a>
                            <a class="collapse-item" href="<?= base_url('admin/dftketnaiklulus') ?>">Ket. Naik-Lulus</a>
                            <a class="collapse-item" href="<?= base_url('admin/dftsemester') ?>">Index Semester</a>
                            <a class="collapse-item" href="<?= base_url('admin/dftkompetensiinti') ?>">Kompetensi Inti</a>
                        </div>
                    </div>
                </li>
            <?php elseif ($this->session->userdata('role') == "3") : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/ksbukuinduk') ?>">
                        <i class="fas fa-book-open"></i>
                        <span>Buku Induk Siswa</span>
                    </a>
                </li>
            <?php endif ?>

            <?php if ($this->session->userdata('role') == "2" || $this->session->userdata('role') == "5") : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages7" aria-expanded="true" aria-controls="collapsePages7">
                        <i class="fa fa-money-bill-alt"></i>
                        <span>Buku SPP</span>
                    </a>
                    <div id="collapsePages7" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu Buku SPP:</h6>
                            <?php if ($this->session->userdata("role") == "2") : ?>
                                <a class="collapse-item" href="<?= base_url('admin/nominalspppertingkat') ?>">Nominal SPP Per Tingkat</a>
                            <?php endif ?>
                            <a class="collapse-item" href="<?= base_url('admin/spp') ?>">Pembayaran SPP</a>
                            <a class="collapse-item" href="<?= base_url('admin/keuangan') ?>">Keuangan</a>
                        </div>
                    </div>
                </li>
            <?php elseif ($this->session->userdata('role') == "9") : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages7" aria-expanded="true" aria-controls="collapsePages7">
                        <i class="fa fa-money-bill-alt"></i>
                        <span>Buku SPP</span>
                    </a>
                    <div id="collapsePages7" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu Buku SPP:</h6>
                            <a class="collapse-item" href="<?= base_url('admin/statusspp') ?>">Status SPP</a>
                            <a class="collapse-item" href="<?= base_url('admin/metodebayarspp') ?>">Metode Bayar SPP</a>
                            <a class="collapse-item" href="<?= base_url('admin/nominalspp') ?>">Nominal SPP</a>
                            <a class="collapse-item" href="<?= base_url('admin/bulanakademik') ?>">Bulan Akademik</a>
                            <a class="collapse-item" href="<?= base_url('admin/editsppdata')?>">Edit Data</a>
                        </div>
                    </div>
                </li>
            <?php endif ?>

            <?php if ($this->session->userdata('role') == "4") : ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin/classesmanagement') ?>" class="nav-link">
                        <i class="fas fa-user-graduate"></i>
                        <span>Manajemen Kelas</span>
                    </a>
                </li>
            <?php endif ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-star-and-crescent"></i>
                    <span>Dakwah</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Dakwah:</h6>
                        <a class="collapse-item" href="<?= base_url('admin/postdakwah') ?>">Buat Artikel Dakwah</a>
                        <a class="collapse-item" href="<?= base_url('admin/dakwah') ?>">Lihat Artikel Dakwah</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages2">
                    <i class="far fa-newspaper"></i>
                    <span>Berita</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Berita:</h6>
                        <a class="collapse-item" href="<?= base_url('admin/postberita') ?>">Buat Berita Baru</a>
                        <a class="collapse-item" href="<?= base_url('admin/berita') ?>">Lihat Semua Berita</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>">
                    <i class="fa fa-home"></i>
                    <span>Halaman Utama</span>
                </a>
            </li>
            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow d-flex justify-content-center <?= togglesidebar($this->session->userdata("toggle")) ?>">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="col-lg-10 d-flex justify-content-center desktop">
                        <h2 class="text-center " style="margin-left: 100px;"><?= $title ?></h2>
                    </div>
                    <div class="col-lg-12 mobile">
                        <strong><?= $title ?></strong>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block">
                        </div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('admin') ?></span>
                                <!-- <img class="img-profile rounded-circle" src="<?= base_url('assets/img/') ?>pp.jpeg"> -->
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div style="background-color: red;margin-top: 100px;"></div>
                <!-- End of Topbar -->