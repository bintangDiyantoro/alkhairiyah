<div class="row justify-content-center sticky-bottom my-5">
    <small class="text-center">
        Copyright &#169; 2019 SDI Al-Khairiyah
    </small>
</div>
<script src="<?= base_url() ?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>assets/js/scrolltotop.js"></script>
<script src="<?= base_url() ?>assets/js/pickmeup.js"></script>
<script src="<?= base_url() ?>assets/js/script.js"></script>
<script>
    const title = $('title').html().split(' ')[4]
    if (title !== 'Pendaftaran' && title !== 'Tutup' && title !== 'Materi') {
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