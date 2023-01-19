<div class="myfooter">
    <div class="row">
        <div class="col-sm-3 footer-col">
            <div>
                <h4>Sitemap:</h4>
                <ul>
                    <li><a href="<?= base_url() ?>">Halaman Utama</a></li>
                    <li><a href="<?= base_url('profil') ?>">Profil</a></li>
                    <li><a href="<?= base_url('dakwah') ?>">Dakwah</a></li>
                    <li><a href="<?= base_url('akademik/kalender') ?>">Kalender Akademik</a></li>
                    <li><a href="<?= base_url('akademik/materi') ?>">Materi</a></li>
                    <li><a href="<?= base_url('kontak') ?>">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-3 footer-col">
            <div>
                <h4>Visi:</h4>
                <ul>
                    <li>
                        Terwujudnya generasi islami sebagai pembelajar sepanjang hayat yang berjiwa pancasila
                    </li>
                </ul>

            </div>
        </div>
        <div class="col-sm-3 footer-col">
            <div>
                <h4>Misi:</h4>
                <ul>
                    <li>Mengembangkan kehidupan islami yang menjunjung tinggi persaudaraan dan kebersamaan</li>
                    <li>Menumbuhkan semangat fastabiqul khairat dalam mencapai prestasi</li>
                    <li>Mengembangkan program sekolah yang inovatif dan cepat tanggap terhadap perubahan zaman </li>
                    <li>Mengembangkan kemandirian, nalar kritis dan kreativitas yang memfasilitasi keragaman minat dan bakat peserta didik</li>
                    <li>Menerapkan pembelajaran yang berpusat pada siswa dan kearifan lokal yang islami</li>
                    <li>Menerapkan manajemen partisipatif dari semua warga sekolah</li>
                </ul>
            </div>
        </div>
        <div class="col-sm-3 footer-col">
            <div>
                <h4>Tujuan:</h4>
                <ul>
                    <li>Meningkatkan dasar keimanan dan ketaqwaan Allah SWT.</li>
                    <li>Membentuk peserta didik yang cerdas dan berprestasi</li>
                    <li>Memiliki kreatifitas yang tinggi melalui pengembangan bakat dan minat peserta didik.</li>
                    <li>Memiliki sikap kedisiplinan, kejujuran, sopan santun dan tanggung jawab.</li>
                    <li>Melaksanakan rasa cinta tanah air dalam kehidupan bermasyarakat.</li>
                    <li>Perolehan Nilai Ujian Nasional rata-rata naik memenuhi standar kelulusan.</li>
                    <li>Memiliki kegiatan ekstra kurikuler yang maju dan berprestasi disegala bidang.</li>
                    <li>Terwujudnya disiplin yang tinggi dari seluruh warga sekolah.</li>
                    <li>Terwujudnya suasana pergaulan sehari-hari yang berlandaskan keimanan dan ketaqwaan.</li>
                    <li>Terwujudnya manajemen sekolah yang transparan dan partisipatif, melibatkan seluruh warga sekolah dan kelompok kepentingan yang terkait.</li>
                    <li>Terwujudnya lingkungan sekolah yang bersih, indah, resik dan asri.</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-bottom: 65px;">
        <small class="text-center">
            Copyright &#169; 2019 SDI Al-Khairiyah Banyuwangi
        </small>
    </div>
</div>
<script src="<?= base_url() ?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>assets/js/scrolltotop.js"></script>
<script src="<?= base_url() ?>assets/js/pickmeup1.js"></script>
<script src="<?= base_url() ?>assets/js/mainscript.js"></script>
<script src="<?= base_url() ?>assets/js/app5.js"></script>
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