<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/alkhairiyah.png">
    <title>SDI Al-Khairiyah | <?= $title; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark anu sticky-top">
        <div class="container">
            <img src="<?= base_url() ?>assets/img/alkhairiyah.png" width="50px" height="50px" style="margin-right:7px"></img>
            <a class="navbar-brand" href="<?= base_url() ?>">SDI Al-Khairiyah</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('profile') ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pendaftaran
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="<?= base_url('pendaftaran') ?>">Daftarkan Siswa Baru</a>
                                <a class="dropdown-item" href="<?= base_url('pendaftaran/tersimpan') ?>">Lihat Data Calon Siswa</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">