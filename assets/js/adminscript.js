$(function() {

    const title = $('title').html().split(' ')[4]
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
    const waliback = $('.waliback')
    const stuback = $('.stuback')
    const keyword = $('.mr-sm-2')
    navlink.addClass('active')
    const otherlink = $('a').not('.active')
    var counter = $('.custom-file').length - 1
    const myalert = $('#myalert').data('alert')
    const scroll = $('.scroll').val()
    const delbut = $('.btn-danger')
    const delbadge = $('.badge-danger')
    var admvrf = $('.admvrfchl').parent().contents()

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
            html: `<br />Dimohon mengisi form dengan teliti!<br />Setelah mengisi form silahkan tekan tombol
            <strong>Selanjutnya</strong> untuk melanjutkan proses pendaftaran.<br/><br/>
            Setelah melakukan pendaftaran online silahkan melengkapi persyaratan <strong>verifikasi secara offline</strong> sebagai berikut:
            <br /><br />
            <div style="text-align:left;margin-left:30px;display:flex">
            <ul>
            <li>Infaq Bulanan (Juli)<strong>: Rp 200.000,-</strong></li>
            <li>Infaq Pemeliharaan Gedung<strong>: Rp 2.000.000,-</strong></li>
            <li>FC Akta Kelahiran</li>
            <li>FC Kartu Keluarga</li>
            <li>Surat keterangan dari TK/RA (jika ada)</li>
            <li>Pas Foto 3 x 4 background merah (3 lembar)</li>
            </ul>
            </div>
            <br />`,
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
    waliback.on('click', (e) => {
        e.preventDefault()
        window.location.href = '/admin/pendaftaran'
    })
    stuback.on('click', function(e) {
        e.preventDefault()
        if (wali == 'Ayah' || wali == 'Ibu') {
            window.location.href = '/admin/pendaftaran'
        } else if (wali == 'Lainnya') {
            window.location.href = '/admin/wali'
        }
    })

    if ($('#sukses').val() == 'ok') {
        $('#MyModal').modal('show')
    }

    $('#modal-close').on('click', function() {
        $.ajax({
            url: '/admin/daftar',
            method: 'get'
        })
    })

    if (keyword.val()) {
        const len = keyword.val().length
        keyword[0].focus();
        keyword[0].setSelectionRange(len, len);
    }

    pickmeup('#tgl_lahir')

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('.add-attachment').on('click', function(e) {
        e.preventDefault()
        counter += 1
        if (counter <= 4) {
            $('.additional-attachment').before(`<div class="additional-attachment-` + counter + `"></div>`)
            $('.additional-attachment-' + counter).load('/admin/newattach/' + counter)
        }
    })

    $('.add-media').on('click', function(e) {
        e.preventDefault()
        counter += 1
        if (counter <= 49) {
            $('.additional-attachment').before(`<div class="additional-attachment-` + counter + `"></div>`)
            $('.additional-attachment-' + counter).load('/admin/newattach/' + counter)
        }
    })

    $(document).on('click', '.adminvrf', function(e) {
        e.preventDefault()
        $.ajax({
            url: '/admin/aktivasiadmin/' + $(this).data('id'),
            method: 'get',
            success: () => {
                $('.ajax-adminvrf').load('/admin/ajaxadminvrf')
            }
        })
    })

    if (myalert) {
        if (myalert == "Gagal") {
            Swal.fire({
                type: 'warning',
                title: myalert,
                html: 'Format file yang anda upload tidak valid!',
                // footer: '<a href>Butuh dana cepat?</a>'
            })
        } else if (myalert == "Berhasil") {
            Swal.fire({
                type: 'success',
                title: myalert,
                html: "Materi baru berhasil ditambahkan!"
            })
        }
    }

    if (scroll) {
        window.location.replace('#comment')
    }

    delbut.on('click', function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        let judul = $(this).data('judul')

        Swal.fire({
            title: 'Perhatian!',
            text: "Apakah anda yakin ingin menghapus artikel " + judul + "?",
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

    delbadge.on('click', function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        let judul = $(this).data('judul')

        Swal.fire({
            title: 'Perhatian!',
            text: "Apakah anda yakin ingin menghapus data " + judul + "?",
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

})