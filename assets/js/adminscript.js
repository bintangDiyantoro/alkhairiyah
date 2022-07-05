$(function() {
    let title = $('title').html().split(' ')
    var maintitle = title[3]
    if (title.length > 4) {
        for (var i = 4; i < title.length; i++) {
            maintitle += " " + title[i];
        }
    }
    const navlink = $('.nav-item:contains(' + maintitle + ')')
    const fill = $('.fill')
    const success = $('.success').val()
    const postimg = $('.image-style-side').children('img')
    const postimgwide = $('.image').not('.image-style-side').children('img')
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
    const livetime = $('.live-time')
    const addClassBtn = $('#tambahkelas')
    const idguru = $('#tambahkelas').data('idguru')
    const plhthncsrfname = $('#tambahkelas').data('csrfname')
    const plhthncsrfhash = $('#tambahkelas').data('csrfhash')
    const carisiswa = $('.ajax-cari-siswa')
    const triggercarisiswa = $('.trigger-cari-siswa')
    const keluarkansiswa = document.querySelectorAll('.keluarkan-siswa')

    triggercarisiswa.on('click', (e) => {
        e.preventDefault()
        carisiswa.load('/admin/carisiswa/')
    })

    addClassBtn.on('click', () => {
        if (addClassBtn.data('session')) {
            $('.ajax-tambah-kelas').load('/admin/tambahkelas/' + idguru + '/' + plhthncsrfname + '/' + plhthncsrfhash)
        } else {
            window.location.href = '/admin/login'
        }
    })

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

    if (first) {
        Swal.fire({
            type: 'info',
            title: 'Selamat datang di Form Pendaftaran!',
            html: `<br />Dimohon mengisi form dengan teliti!<br />Setelah mengisi form silahkan tekan tombol
            <strong>Selanjutnya</strong> untuk melanjutkan proses pendaftaran.<br/><br/>
            Setelah melakukan pendaftaran online silahkan melengkapi persyaratan <strong>verifikasi secara offline</strong> sebagai berikut:
            <br /><br />
            <div style="text-align:left;margin-left:30px;display:flex">
            <li>
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
    if (url[3] == "admin" && url[4] == "ubahbiodata") {
        pickmeup('#tgl_lahir_edit', {
            default_date: false,
            current: document.getElementById('tgl_lahir_edit').value
        })
    }


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

    setInterval(() => {
        livetime.load('http://localhost/admin/livetime')
    }, 1000)

    document.getElementById('sidebarToggleTop').addEventListener('click', () => {
        const req = new XMLHttpRequest()
        req.onreadystatechange = function() {
            if (this.onreadystatechange == 4 && this.status == 200) {
                console.log(this.status)
            }
        }
        req.open("GET", "/admin/togglesidebar")
        req.send()
    })
    document.getElementById('sidebarToggle').addEventListener('click', () => {
        const req = new XMLHttpRequest()
        req.onreadystatechange = function() {
            if (this.onreadystatechange == 4 && this.status == 200) {
                console.log(this.status)
            }
        }
        req.open("GET", "/admin/togglesidebar")
        req.send()
    })


    for (let i = 0; i < keluarkansiswa.length; i++) {
        keluarkansiswa[i].addEventListener('click', function(event) {
            event.preventDefault()
            Swal.fire({
                title: 'Perhatian!',
                text: "Apakah anda yakin ingin mengeluarkan " + event.path[0].dataset.name + " dari kelas anda?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    window.location.href = event.path[0].href
                }
            })
        })

    }

    if (url[3] == "admin" && url[4] == "biodatasiswa" || url[3] == "admin" && url[4] == "ubahbiodata") {
        const status = document.getElementById("editBiodataAlert").dataset.alert
        const name = document.getElementById("editBiodataAlert").dataset.name
        if (status == "Gagal") {
            Swal.fire({
                type: 'warning',
                title: status,
                html: 'Biodata ' + name + ' Tidak Berubah',
                // footer: '<a href>Butuh dana cepat?</a>'
            })
        } else if (status == "Berhasil") {
            Swal.fire({
                type: 'success',
                title: status,
                html: "Biodata " + name + " Berhasil Diubah!"
            })
        }
    }

})


const url = window.$.ajaxSettings.url.split('/')

function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function nilaiSikap() {
    document.getElementById('simpanNilaiSikap').addEventListener('click', function(e) {
        e.preventDefault()
        let idsiswa = document.getElementById('idsiswa').value
        let els = document.querySelectorAll('.ubah-nilai-sikap')
        let input = []
        let data = ""
        let dataerror = ""
        let pattern = /^[a-z.,()0-9-\s]+$/i
        let error = []
        for (let i = 0; i < els.length; i++) {
            if (els[i].value) {
                if (pattern.test(els[i].value) == true) {
                    input[i] = els[i].name + '=' + els[i].value
                    data = data + input[i] + "&"
                } else {
                    error[i] = els[i].name
                    dataerror = dataerror + error[i] + "&"
                }
            }
        }
        data = data.slice(0, -1)
        data = data + "&submit= "


        if (dataerror == false) {
            const xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('ajax-sikap').innerHTML = this.responseText
                    updateSikap()
                }
            }
            xhr.open("POST", url[0] + "//" + url[2] + "/" + url[3] + "/simpannilaisikap/" + idsiswa)
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            xhr.send(data)
            document.getElementById('ajax-sikap').focus()
        } else {
            let parent = document.querySelectorAll('.form-group')
            for (let k = 0; k < parent.length; k++) {
                if (parent[k].contains(document.querySelector('small'))) {
                    parent[k].removeChild(document.querySelector('small'))
                }
            }

            for (let j = 0; j < error.length; j++) {
                if (error[j]) {
                    var el = document.createElement("small");
                    el.setAttribute('style', 'padding:0 5px 0 5px;border-radius:5px;color:red;background-color:#F8F9FC;box-shadow: 0 0 5px #F8F9FC')
                    el.innerHTML = "Data tidak valid";
                    var div = document.getElementById(error[j]);
                    insertAfter(div, el);
                }
            }
        }
    })
}

function updateSikap() {
    if (url[3] == "admin" && url[4] == "kelolanilai") {

        const triggersikap = document.getElementsByClassName('update-sikap')
        const idsiswa = document.getElementById("ajax-sikap").dataset.idsiswa
        const idkelas = document.getElementById("ajax-sikap").dataset.idkelas
        const tahun = document.getElementById("ajax-sikap").dataset.tahun

        triggersikap[0].addEventListener('click', function() {
            const req = new XMLHttpRequest()
            req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("ajax-sikap").innerHTML = this.responseText;
                    nilaiSikap();
                }
            }
            req.open("GET", "/admin/ubahnilaisikap/" + idsiswa + "/" + idkelas + "/" + tahun)
            req.send()
            document.getElementById("ajax-sikap").focus()
        })
    }
}

updateSikap()