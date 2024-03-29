<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="all">
    <meta name="theme-color" content="#004632">
    <meta name="keywords" content="SDI, Al-Khairiyah, Banyuwangi, SD Islam, Sekolah Dasar, Sekolah, SD">
    <meta name="author" content="Al-Khairiyah">
    <meta name="description" content="<?= $description ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" href="<?= base_url('assets/img/') ?>alkhairiyah192b.png">
    <link rel="canonical" href="<?= $canonical ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://youtube.com">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/pickmeup1.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/lite-yt-embed.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/mainstyles2.css">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/alkhairiyah.png">
    <link rel="manifest" href="<?= base_url() ?>manifest.json">
    <title>SDI Al-Khairiyah Banyuwangi | <?= $title; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top mr-0" style="display: flex;justify-content: center;">
        <div class="nav-container">
            <img src="<?= base_url() ?>assets/img/alkhairiyah.png" width="47px" height="47px" style="margin-right:7px" alt="SDI Al-Khairiyah Al Khairiyah Banyuwangi"></img>
            <a class="navbar-brand pt-3" href="<?= base_url() ?>">
                <h1 style="font-size: 16.2px;">SDI Al-Khairiyah Banyuwangi</h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>"><strong>Halaman Utama</strong></a>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                            <div class="nav-link dropdown-toggle" href="#" role="button" id="profil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <strong>Profil</strong>
                            </div>

                            <div class="dropdown-menu" aria-labelledby="profil">
                                <a class="dropdown-item" href="<?= base_url('profil') ?>">Sekolah</a>
                                <a class="dropdown-item" href="<?= base_url('profil/ptk') ?>">Tenaga Kependidikan</a>
                                <a class="dropdown-item" href="<?= base_url('profil/pesertadidik') ?>">Peserta Didik</a>
                                <a class="dropdown-item" href="<?= base_url('profil/sarana') ?>">Sarana</a>
                            </div>
                        </div>
                    </li>
                    <?php if ((int)date('mdHi') >= 3091700 && (int)date('mdHi') <= 4301659) : ?>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <strong>Pendaftaran</strong>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="<?= base_url('pendaftaran') ?>">Daftarkan Siswa Baru</a>
                                    <a class="dropdown-item" href="<?= base_url('pendaftaran/cs') ?>">Lihat Data Pendaftar Tersimpan</a>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('dakwah') ?>"><strong>Dakwah</strong></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <div class="nav-link dropdown-toggle" href="#" role="button" id="akademik" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <strong>Akademik</strong>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="akademik">
                                <a class="dropdown-item" href="<?= base_url('akademik') ?>">Jadwal</a>
                                <a class="dropdown-item" href="<?= base_url('akademik/rombonganbelajar') ?>">Rombongan Belajar</a>
                                <a class="dropdown-item" href="<?= base_url('akademik/materi') ?>">Materi Pelajaran</a>
                                <a class="dropdown-item" href="<?= base_url('akademik/kalender') ?>">Kalender Akademik</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('lembaga') ?>"><strong>Lembaga</strong></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <div class="nav-link dropdown-toggle" href="#" role="button" id="alumni" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <strong>Alumni</strong>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="alumni">
                                <a class="dropdown-item" href="<?= base_url('alumni/th2018') ?>">2018</a>
                                <a class="dropdown-item" href="<?= base_url('alumni/th2019') ?>">2019</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('kontak') ?>"><strong>Hubungi Kami</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin') ?>"><strong><?= ($this->session->userdata('admin')) ? "Dashboard" : "Login" ?></strong></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="right-float">
        <a href="https://tk.alkhairiyahbanyuwangi.sch.id">
            <div class="right-float-button">
                <img src="<?= base_url('assets/img/logotk2.png') ?>" alt="logo tk islam al-khairiyah banyuwangi">
                TK Islam Al-Khairiyah Banyuwangi
            </div>
        </a>
        <a href="https://instagram.com/al_khairiyah_banyuwangi">
            <div class="right-float-button2">
                <img src="<?= base_url('assets/img/logoig.png') ?>" alt="logo instagram">
                <b>Instagram</b>
            </div>
        </a>
        <a href="https://youtube.com/channel/UCeCetMNd5sPxLJICi-R9bBw">
            <div class="right-float-button3">
                <img src="<?= base_url('assets/img/logoyt.png') ?>" alt="logo youtube">
                <b>YouTube</b>
            </div>
        </a>
    </div>
    <!-- <div class="container"> -->