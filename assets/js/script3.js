$(function() {

    const title = $('title').html().split(' ')[3]
    const navlink = $('.nav-link:contains(' + title + ')')
    const fill = $('.fill')
    const success = $('.success').val()
    const postimg = $('.image-style-side').children('img')
    const postimgwide = $('.image').not('.image-style-side').children('img')
    const carousel = document.querySelector('.carousel-item')
    const carouselIndicator = document.querySelector('.c-ind')
    const navtersimpan = $('a:contains(Lihat Data Calon Siswa)')
    const navdaftar = $('a:contains(Daftarkan Siswa Baru)')
    const first = $('.first').val()
    const error = $('.error').val()
    const wali = $('.wali').val()
    const waliback2 = $('.waliback2')
    const stuback2 = $('.stuback2')
    const keyword = $('.mr-sm-2')
    navlink.addClass('active')
    const otherlink = $('a').not('.active')

    if (fill.val()) {
        const len = fill.val().length
        fill[0].focus()
        fill[0].setSelectionRange(len, len)
    }

    if (success) {
        Swal.fire({
            type: 'success',
            title: 'Berhasil!',
            html: success
        })
    }

    postimg.attr('align', 'right')
    postimg.css({
        "width": "50%",
        "margin-left": "20px"
    })

    postimgwide.attr('align', 'center')
    postimgwide.css({
        "display": "block",
        "margin": "auto",
        "width": "70%"
    })

    if (carousel) {
        if (title == 'Halaman' && $('.display-3:first').html() == 'Ahlan Wa Sahlan!') {
            carousel.className += " active";
            carouselIndicator.className += " active";
        }
    }

    if (first) {
        Swal.fire({
            type: 'info',
            title: 'Selamat datang di Form Pendaftaran!',
            html: `Silahkan isi form dengan teliti! </br></br> Setelah mengisi form silahkan tekan tombol <strong>Selanjutnya</strong> untuk melanjutkan proses pendaftaran.`,
            // footer: '<a href>Butuh dana cepat?</a>'
        })
    }

    if (title !== 'Pendaftaran' && title !== 'Profil' && title !== 'Akademik' && title !== 'Alumni' && $('.display-3:first').html() == 'Ahlan Wa Sahlan!') {
        navlink.on('click', () => {
            return false
        })
    }

    if (title == 'Pendaftaran' && $('#tersimpan').val() !== 'ok') {
        navdaftar.hide()
        otherlink.on('click', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Data anda belum tersimpan!',
                text: "Apakah anda yakin ingin meninggalkan halaman ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    window.location.href = $(this).attr('href')
                }
            })
        })
    } else if (title == 'Pendaftaran' && $('#tersimpan').val() == 'ok') {
        navtersimpan.hide()
    }

    if (error) {
        Swal.fire({
            type: 'warning',
            title: 'Maaf',
            html: 'Sepertinya ada data yang terlewat!</br> Silahkan periksa ulang form isian dengan teliti.',
            // footer: '<a href>Butuh dana cepat?</a>'
        })
    }

    waliback2.on('click', (e) => {
        e.preventDefault()
        window.location.href = '/admpendaftaran'
    })

    stuback2.on('click', function(e) {
        e.preventDefault()
        if (wali == 'Ayah' || wali == 'Ibu') {
            window.location.href = '/admpendaftaran'
        } else if (wali == 'Lainnya') {
            window.location.href = '/admpendaftaran/wali'
        }
    })

    if ($('#sukses').val() == 'ok') {
        $('#MyModal').modal('show')
    }

    $('#modal-close').on('click', function() {
        $.ajax({
            url: '/pendaftaran/berhasil',
            method: 'get'
        })
    })

    if (keyword.val()) {
        const len = keyword.val().length
        keyword[0].focus();
        keyword[0].setSelectionRange(len, len);
    }

    // keyword.on('keyup', function () {
    //     $('.srctest').load('http://localhost/csrf');
    // })

    pickmeup('#tgl_lahir2')

    if (title !== 'Pendaftaran') {
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

})