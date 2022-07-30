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
        document.getElementsByClassName('ajax-cari-siswa')[0].innerHTML = '<div class="d-flex justify-content-center align-items-center" ><img src="/assets/img/greenloading.gif" height="70"></div>'
        carisiswa.load('/admin/carisiswa/')
    })

    addClassBtn.on('click', () => {
        if (addClassBtn.data('session')) {
            document.getElementsByClassName('ajax-tambah-kelas')[0].innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:50px"><img src="/assets/img/greenloading.gif" height="45"></div>'
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
        this.parentElement.parentElement.children[3].innerHTML = '<div class="d-flex justify-content-center align-items-center" style="margin:-10px"><img src="/assets/img/greenloading.gif" height="40"></div>'
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
        livetime.load('/admin/livetime')
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

if (url[3] == "admin" && url[4] == "kelolanilai") {
    var b_i_url = window.location.href
}

var monsterBookGate = 1

function NSupdater(e) {
    window.location.href = '#ajax-sikap-title'
    window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
    if (document.getElementById('simpanNilaiSikap').dataset.session) {
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
                    monsterBookGate = 1
                    updateSikap()
                    Swal.fire({
                        type: 'success',
                        title: 'Berhasil! &#128522;',
                        html: 'Data tabel sikap telah tersimpan &#128522;',
                        // footer: '<a href>Butuh dana cepat?</a>'
                    })
                } else {
                    document.getElementById("ajax-sikap").innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:500px"><img src="/assets/img/greenloading.gif" height="100"></div>'
                }
            }
            xhr.open("POST", url[0] + "//" + url[2] + "/" + url[3] + "/simpannilaisikap/" + idsiswa)
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            xhr.send(data)
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
                    el.setAttribute('style', 'display:block;margin-top:-15px;padding:0 5px 0 5px;border-radius:5px;color:red;background-color:#F8F9FC;box-shadow: 0 0 5px #F8F9FC')
                    el.innerHTML = "Data tidak valid";
                    var div = document.getElementById(error[j]);
                    insertAfter(div, el);
                }
            }
            Swal.fire({
                type: 'warning',
                title: 'Gagal &#128543;',
                html: 'Ada data yang tidak valid &#128543;',
                // footer: '<a href>Butuh dana cepat?</a>'
            })
        }
    } else {
        window.location.href = '/admin/login'
    }
}

function nilaiSikap() {
    const uns = document.getElementsByClassName('ubah-nilai-sikap')
    for (let l = 0; l < uns.length; l++) {
        uns[l].addEventListener('keypress', (e) => {
            if (e.key === "Enter") {
                NSupdater(e)
            }
        })
    }

    document.getElementById('simpanNilaiSikap').addEventListener('click', function(e) {
        NSupdater(e)
    })
}


function updateSikap() {
    if (url[3] == "admin" && url[4] == "kelolanilai") {

        const triggersikap = document.getElementsByClassName('update-sikap')
        const idsiswa = document.getElementById("ajax-sikap").dataset.idsiswa
        const idkelas = document.getElementById("ajax-sikap").dataset.idkelas
        const tahun = document.getElementById("ajax-sikap").dataset.tahun
        triggersikap[0].addEventListener('click', function() {
            window.location.href = '#ajax-sikap-title'
            window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
            if (monsterBookGate == 1) {
                if (this.dataset.session) {
                    const req = new XMLHttpRequest()
                    req.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("ajax-sikap").innerHTML = this.responseText;
                            monsterBookGate = 0
                            nilaiSikap();
                        } else {
                            document.getElementById("ajax-sikap").innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:500px"><img src="/assets/img/greenloading.gif" height="100"></div>'
                        }
                    }
                    req.open("GET", "/admin/ubahnilaisikap/" + idsiswa + "/" + idkelas + "/" + tahun)
                    req.send()
                    document.getElementById("ajax-sikap").focus()
                } else {
                    window.location.href = '/admin/login'
                }
            } else {
                Swal.fire({
                    type: 'warning',
                    title: 'Maaf &#128543;',
                    html: 'Ada data tabel yang belum tersimpan, <br> tolong disimpan dulu ya... &#128543;',
                    // footer: '<a href>Butuh dana cepat?</a>'
                })
            }
        })
    }
}


updateSikap()

function NPKupdater(e) {
    window.location.href = '#ajax-pengetahuan-keterampilan-title'
    window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
    if (document.getElementById('simpanNilaiPengetahuanKeterampilan').dataset.session) {
        e.preventDefault()
        let idsiswa = document.getElementById('idsiswa').value
        let els = document.querySelectorAll('.ubah-nilai-pengetahuan-keterampilan')
        let input = []
        let data = ""
        let dataerror = ""
        let pattern = /[1-9][0-9]/
        let error = []
        for (let i = 0; i < els.length; i++) {
            if (els[i].value) {
                if (els[i].name == "csrf_token") {
                    input[i] = els[i].name + '=' + els[i].value
                    data = data + input[i] + "&"
                } else {
                    if (pattern.test(els[i].value) == true) {
                        input[i] = els[i].name + '=' + els[i].value
                        data = data + input[i] + "&"
                    } else {
                        error[i] = els[i].name
                        dataerror = dataerror + error[i] + "&"
                    }
                }
            }
        }
        data = data.slice(0, -1)
        data = data + "&submit="


        if (dataerror == false) {
            const xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('ajax-pengetahuan-keterampilan').innerHTML = this.responseText
                    monsterBookGate = 1
                    updatePengetahuanKeterampilan()
                    Swal.fire({
                        type: 'success',
                        title: 'Berhasil! &#128522;',
                        html: 'Nilai pengetahuan & keterampilan telah tersimpan &#128522;',
                        // footer: '<a href>Butuh dana cepat?</a>'
                    })
                } else {
                    document.getElementById("ajax-pengetahuan-keterampilan").innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:500px"><img src="/assets/img/greenloading.gif" height="100"></div>'
                }
            }
            xhr.open("POST", url[0] + "//" + url[2] + "/" + url[3] + "/simpannilaipengetahuanketerampilan/" + idsiswa)
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            xhr.send(data)
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
                    el.setAttribute('style', 'display:block;line-height:13px;padding:5px 0 5px 0;margin-top:15px;margin-bottom:-17px;color:red')
                    el.innerHTML = "Data tidak valid";
                    var div = document.getElementById(error[j]);
                    insertAfter(div, el);
                }
            }
            Swal.fire({
                type: 'warning',
                title: 'Gagal &#128543;',
                html: 'Ada data yang tidak valid &#128543;',
                // footer: '<a href>Butuh dana cepat?</a>'
            })
        }
    } else {
        window.location.href = '/admin/login'
    }
}

function nilaiPengetahuanKeterampilan() {
    const unpk = document.getElementsByClassName('ubah-nilai-pengetahuan-keterampilan')
    for (let l = 0; l < unpk.length; l++) {
        unpk[l].addEventListener('keypress', (e) => {
            if (e.key === "Enter") {
                NPKupdater(e)
            }
        })
    }
    document.getElementById('simpanNilaiPengetahuanKeterampilan').addEventListener('click', function(e) {
        NPKupdater(e)
    })
}


function updatePengetahuanKeterampilan() {
    if (url[3] == "admin" && url[4] == "kelolanilai") {

        const triggerpengetahuanketerampilan = document.getElementsByClassName('update-pengetahuan-keterampilan')
        const idsiswa = document.getElementById("ajax-pengetahuan-keterampilan").dataset.idsiswa
        const idkelas = document.getElementById("ajax-pengetahuan-keterampilan").dataset.idkelas
        const tahun = document.getElementById("ajax-pengetahuan-keterampilan").dataset.tahun
        triggerpengetahuanketerampilan[0].addEventListener('click', function() {
            window.location.href = '#ajax-pengetahuan-keterampilan-title'
            window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
            if (monsterBookGate == 1) {
                if (this.dataset.session) {
                    const req = new XMLHttpRequest()
                    req.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("ajax-pengetahuan-keterampilan").innerHTML = this.responseText;
                            monsterBookGate = 0
                            nilaiPengetahuanKeterampilan();
                        } else {
                            document.getElementById("ajax-pengetahuan-keterampilan").innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:500px"><img src="/assets/img/greenloading.gif" height="100"></div>'
                        }
                    }
                    req.open("GET", "/admin/ubahnilaipengetahuanketerampilan/" + idsiswa + "/" + idkelas + "/" + tahun)
                    req.send()
                    document.getElementById("ajax-pengetahuan-keterampilan").focus()
                } else {
                    window.location.href = '/admin/login'
                }
            } else {
                Swal.fire({
                    type: 'warning',
                    title: 'Maaf &#128543;',
                    html: 'Ada data tabel yang belum tersimpan, <br> tolong disimpan dulu ya... &#128543;',
                    // footer: '<a href>Butuh dana cepat?</a>'
                })
            }
        })
    }
}


updatePengetahuanKeterampilan()


function cekAksesWaliKelas(el) {
    let idsiswa = document.getElementById('idsiswa').value
    const cawkXHR = new XMLHttpRequest()
    cawkXHR.onreadystatechange = () => {
        if (this.readyState == 4 && this.status == 200) {
            el.innerHTML = this.responseText
        }
    }
    cawkXHR.open('GET', '/admin/checkakseswalikelasekskul/' + idsiswa)
    cawkXHR.send()
}

var x1 = 1
var x2 = 1

function pilihEkskul(x1) {
    let tbeks1 = document.getElementById('tambah-ekskul-s1')
    let idsiswa = document.getElementById('idsiswa').value
    tbeks1.innerHTML = "Pilih"
    tbeks1.setAttribute('class', 'btn-info')
    tbeks1.style = "cursor:pointer"
    tbeks1.removeEventListener('click', tbeks1function)
    let selectedEkskul = document.getElementById('ekskulSelect')
    let selectedEkskulId = document.getElementById('ekskulSelect').value
    selectedEkskul.addEventListener('change', function() {
        selectedEkskulId = this.value
    })

    tbeks1.addEventListener('click', function submitEkskul() {
        const pilihEkskulXHR = new XMLHttpRequest()
        pilihEkskulXHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (x1 <= 2) {
                    tbeks1.parentElement.previousSibling.innerHTML = '<th style="font-size:bolder;vertical-align:middle;text-align:center" rowspan="2">Semester I</th>' + this.responseText
                    tbeks1.parentElement.previousSibling.style = "text-align:left;padding-left:20px!important;"
                } else {
                    tbeks1.parentElement.previousSibling.innerHTML = this.responseText
                    tbeks1.parentElement.previousSibling.style = "text-align:left;padding-left:20px!important;"
                }
                nilaiEkstrakurikuler()
                if (ekskulAdds1 < ekskulCount.value) {
                    tbeks1.innerHTML = "Tambah Ekstrakurikuler"
                    tbeks1.setAttribute('class', 'btn-success')
                    tbeks1.style = "cursor:pointer"
                    tbeks1.removeEventListener('click', submitEkskul)
                    tbeks1.addEventListener('click', function remclick() {
                        this.removeEventListener('click', remclick)
                        this.addEventListener('click', tbeks1function(selectedEkskulId))
                    })
                } else {
                    let parentTbeks = tbeks1.parentElement.parentElement
                    let Tbeks = tbeks1.parentElement
                    parentTbeks.children[0].children[0].rowSpan = ekskulCount.value
                    parentTbeks.removeChild(Tbeks)
                }
            } else {
                tbeks1.parentElement.previousSibling.innerHTML = '<div class="d-flex justify-content-center"><img src="/assets/img/greenloading.gif" height="30"></div>'
            }
        }
        pilihEkskulXHR.open('GET', '/admin/getekstrakurikulerinputtr/' + selectedEkskulId + "/" + idsiswa + "/" + x1 + "/1")
        pilihEkskulXHR.send()
    })
}

function pilihEkskul2(x2) {
    let tbeks2 = document.getElementById('tambah-ekskul-s2')
    let idsiswa = document.getElementById('idsiswa').value
    tbeks2.innerHTML = "Pilih"
    tbeks2.setAttribute('class', 'btn-info')
    tbeks2.style = "cursor:pointer"
    tbeks2.removeEventListener('click', tbeks2function)
    let selectedEkskul = document.getElementById('ekskulSelect')
    let selectedEkskulId = document.getElementById('ekskulSelect').value
    selectedEkskul.addEventListener('change', function() {
        selectedEkskulId = this.value
    })

    tbeks2.addEventListener('click', function submitEkskul() {
        const pilihEkskul2XHR = new XMLHttpRequest()
        pilihEkskul2XHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (x2 <= 2) {
                    tbeks2.parentElement.previousSibling.innerHTML = '<th style="font-size:bolder;vertical-align:middle;text-align:center" rowspan="2" id="smt2">Semester II</th>' + this.responseText
                    tbeks2.parentElement.previousSibling.style = "text-align:left;padding-left:20px!important;"
                } else {
                    tbeks2.parentElement.previousSibling.innerHTML = this.responseText
                    tbeks2.parentElement.previousSibling.style = "text-align:left;padding-left:20px!important;"
                }
                nilaiEkstrakurikuler()
                if (ekskulAdds2 < ekskulCount.value) {
                    tbeks2.innerHTML = "Tambah Ekstrakurikuler"
                    tbeks2.setAttribute('class', 'btn-success')
                    tbeks2.style = "cursor:pointer"
                    tbeks2.removeEventListener('click', submitEkskul)
                    tbeks2.addEventListener('click', function remclick() {
                        this.removeEventListener('click', remclick)
                        this.addEventListener('click', tbeks2function(selectedEkskulId))
                    })
                } else {
                    let parentTbeks = tbeks2.parentElement.parentElement
                    let Tbeks = tbeks2.parentElement
                    document.getElementById('smt2').rowSpan = ekskulCount.value + 1
                    parentTbeks.removeChild(Tbeks)
                }
            } else {
                tbeks2.parentElement.previousSibling.innerHTML = '<div class="d-flex justify-content-center"><img src="/assets/img/greenloading.gif" height="30"></div>'
            }
        }
        pilihEkskul2XHR.open('GET', '/admin/getekstrakurikulerinputtr/' + selectedEkskulId + "/" + idsiswa + "/" + x2 + "/2")
        pilihEkskul2XHR.send()
    })
}

var idEkskul1 = ""
var ekskulAdds1 = 0
var idEkskul2 = ""
var ekskulAdds2 = 0

function tbeks1function(ekskulId) {
    const tbeks1 = document.getElementById('tambah-ekskul-s1')
    if (x1 == 1) {
        x1 = this.parentElement.parentElement.children[0].children[0].rowSpan
        ekskulAdds1 = this.parentElement.parentElement.children[0].children[0].rowSpan - 1
        if (this.parentElement.parentElement.children[0].children[0].rowSpan > 1) {
            for (let i = 0; i < this.parentElement.parentElement.children.length; i++) {
                if (i == 0) {
                    if (this.parentElement.parentElement.children[i].children[1].dataset.idekskul && this.parentElement.parentElement.children[i].children[1].dataset.idsmt == 1) {
                        idEkskul1 = this.parentElement.parentElement.children[i].children[1].dataset.idekskul
                    }
                } else {
                    if (this.parentElement.parentElement.children[i].children[0].dataset.idekskul && this.parentElement.parentElement.children[i].children[0].dataset.idsmt == 1) {
                        idEkskul1 = idEkskul1 + "_" + this.parentElement.parentElement.children[i].children[0].dataset.idekskul
                    }
                }
            }
        }
    }
    let newtr = document.createElement('tr')
    let newth = document.createElement('th')
    newth.innerHTML = "Semester I"
    newth.rowSpan = 2
    newth.style = "vertical-align:middle;font-size:bolder"
    newtd1 = document.createElement('td')
    newtd1.innerHTML = '<img src="/assets/img/greenloading.gif" height="30">'
    newtd2 = document.createElement('td')
    newtd2.colSpan = 6

    if (ekskulAdds1 < ekskulCount.value) {
        if (x1 == 1) {
            let semester1 = document.getElementsByTagName('tbody')[2].children[0].children[0]
            document.getElementsByTagName('tbody')[2].children[0].removeChild(semester1)
            newtr.append(newth)
        } else {
            let newsmt1 = document.getElementsByTagName('tbody')[2].children[0].children[0]
            newsmt1.rowSpan = x1 + 1
        }
        newtr.append(newtd1)
        newtr.append(newtd2)
        tbeks1.parentElement.before(newtr)

        const xhr1 = new XMLHttpRequest()
        xhr1.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                newtd1.innerHTML = this.responseText
                pilihEkskul(x1)
                ekskulAdds1++
            }
        }
        if (ekskulId.type !== 'click') {
            idEkskul1 = idEkskul1 + "_" + ekskulId
            xhr1.open('GET', '/admin/tambahekstrakurikuler/' + idEkskul1)
        } else {
            if (idEkskul1.length > 0) {
                xhr1.open('GET', '/admin/tambahekstrakurikuler/' + idEkskul1)
            } else {
                xhr1.open('GET', '/admin/tambahekstrakurikuler/')
            }
        }
        xhr1.send()
        x1++
    }

}

function tbeks2function(ekskulId) {
    let newtr = document.createElement('tr')
    if (x2 == 1) {
        x2 = document.getElementById('smt2').rowSpan
        ekskulAdds2 = document.getElementById('smt2').rowSpan - 1
        if (document.getElementById('smt2').rowSpan > 1) {
            for (let j = 0; j < document.getElementsByClassName('ekskul-2').length; j++) {
                idEkskul2 = idEkskul2 + '_' + document.getElementsByClassName('ekskul-2')[j].dataset.idekskul
            }
        }
    }
    let newth = document.createElement('th')
    newth.innerHTML = "Semester II"
    newth.rowSpan = 2
    newth.style = "vertical-align:middle;font-size:bolder"
    newth.setAttribute('id', 'smt2')
    newtd1 = document.createElement('td')
    newtd1.innerHTML = '<img src="/assets/img/greenloading.gif" height="30">'
    newtd2 = document.createElement('td')
    newtd2.colSpan = 6
    const tbeks2 = document.getElementById('tambah-ekskul-s2')
    if (tbeks2.parentNode.children[0].innerHTML == "Semester II") {
        tbeks2.parentNode.removeChild(tbeks2.parentNode.children[0])
        newtr.append(newth)
    } else {
        document.getElementById('smt2').rowSpan = x2 + 1
    }
    newtr.append(newtd1)
    newtr.append(newtd2)
    tbeks2.parentNode.before(newtr)
    const xhr2 = new XMLHttpRequest()
    xhr2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            newtd1.innerHTML = this.responseText
            pilihEkskul2(x2)
            ekskulAdds2++
        }
    }
    if (ekskulId.type !== 'click') {
        idEkskul2 = idEkskul2 + "_" + ekskulId
        xhr2.open('GET', '/admin/tambahekstrakurikuler/' + idEkskul2)
    } else {
        if (idEkskul2.length > 0) {
            xhr2.open('GET', '/admin/tambahekstrakurikuler/' + idEkskul2)
        } else {
            xhr2.open('GET', '/admin/tambahekstrakurikuler/')
        }
    }
    xhr2.send()
    x2++
}

function tambahEkstrakurikuler() {
    const tbeks1 = document.getElementById('tambah-ekskul-s1')
    const tbeks2 = document.getElementById('tambah-ekskul-s2')
    if (tbeks1) {
        tbeks1.addEventListener('click', tbeks1function)
    }
    if (tbeks2) {
        tbeks2.addEventListener('click', tbeks2function)
    }
}

function NEupdater(e) {
    window.location.href = '#ajax-ekstrakurikuler-title'
    window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
    if (document.getElementById('simpanNilaiEkstrakurikuler').dataset.session) {
        e.preventDefault()
        let idsiswa = document.getElementById('idsiswa').value
        let els = document.querySelectorAll('.ubah-nilai-ekstrakurikuler')
        let input = []
        let data = ""
        let dataerror = ""
        let pattern = /[1-9][0-9]/
        let error = []
        for (let i = 0; i < els.length; i++) {
            if (els[i].value) {
                if (els[i].name == "csrf_token") {
                    input[i] = els[i].name + '=' + els[i].value
                    data = data + input[i] + "&"
                } else {
                    if (pattern.test(els[i].value) == true) {
                        input[i] = els[i].name + '=' + els[i].value
                        data = data + input[i] + "&"
                    } else {
                        error[i] = els[i].name
                        dataerror = dataerror + error[i] + "&"
                    }
                }
            }
        }
        data = data.slice(0, -1)
        data = data + "&submit="

        if (dataerror == false) {
            const xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('ajax-ekstrakurikuler').innerHTML = this.responseText
                    monsterBookGate = 1
                    updateEkstrakurikuler()
                    x1 = 1
                    ekskulAdds1 = 0
                    x2 = 1
                    ekskulAdds2 = 0
                    idEkskul1 = ""
                    idEkskul2 = ""
                    Swal.fire({
                        type: 'success',
                        title: 'Berhasil! &#128522;',
                        html: 'Nilai ekstrakurikuler telah tersimpan &#128522;',
                        // footer: '<a href>Butuh dana cepat?</a>'
                    })
                } else {
                    document.getElementById("ajax-ekstrakurikuler").innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:500px"><img src="/assets/img/greenloading.gif" height="100"></div>'
                }
            }
            xhr.open("POST", url[0] + "//" + url[2] + "/" + url[3] + "/simpannilaiekstrakurikuler/" + idsiswa)
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            xhr.send(data)
            document.getElementById('ajax-ekstrakurikuler').focus()
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
                    el.setAttribute('style', 'display:block;width:100%;line-height:13px;padding:5px 5px 5px 5px;margin-top:15px;margin-bottom:-17px;color:red')
                    el.innerHTML = "Data tidak valid";
                    var div = document.getElementById(error[j]);
                    insertAfter(div, el);
                }
            }
            Swal.fire({
                type: 'warning',
                title: 'Gagal &#128543;',
                html: 'Ada data yang tidak valid &#128543;',
                // footer: '<a href>Butuh dana cepat?</a>'
            })
        }
    } else {
        window.location.href = '/admin/login'
    }
}

function nilaiEkstrakurikuler() {
    const une = document.getElementsByClassName('ubah-nilai-ekstrakurikuler')
    for (let l = 0; l < une.length; l++) {
        une[l].addEventListener('keypress', (e) => {
            if (e.key === "Enter") {
                NEupdater(e)
            }
        })
    }
    document.getElementById('simpanNilaiEkstrakurikuler').addEventListener('click', function(e) {
        NEupdater(e)
    })
}


function updateEkstrakurikuler() {
    if (url[3] == "admin" && url[4] == "kelolanilai") {
        const triggerekstrakurikuler = document.getElementsByClassName('update-ekstrakurikuler')
        const idsiswa = document.getElementById("ajax-ekstrakurikuler").dataset.idsiswa
        const idkelas = document.getElementById("ajax-ekstrakurikuler").dataset.idkelas
        const tahun = document.getElementById("ajax-ekstrakurikuler").dataset.tahun
        var ekskulCount = 0
        triggerekstrakurikuler[0].addEventListener('click', function() {
            window.location.href = '#ajax-ekstrakurikuler-title'
            window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
            if (monsterBookGate == 1) {
                if (this.dataset.session) {
                    const req = new XMLHttpRequest()
                    req.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("ajax-ekstrakurikuler").innerHTML = this.responseText;
                            monsterBookGate = 0
                            tambahEkstrakurikuler()
                            ekskulCount = document.getElementById("ekskulCount").value
                            nilaiEkstrakurikuler()
                        } else {
                            document.getElementById("ajax-ekstrakurikuler").innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:500px"><img src="/assets/img/greenloading.gif" height="100"></div>'
                        }
                    }
                    req.open("GET", "/admin/ubahnilaiekstrakurikuler/" + idsiswa + "/" + idkelas + "/" + tahun)
                    req.send()
                } else {
                    window.location.href = '/admin/login'
                }
            } else {
                Swal.fire({
                    type: 'warning',
                    title: 'Maaf &#128543;',
                    html: 'Ada data tabel yang belum tersimpan, <br> tolong disimpan dulu ya... &#128543;',
                    // footer: '<a href>Butuh dana cepat?</a>'
                })
            }
        })
    }
}

updateEkstrakurikuler()

function JAupdater(e) {
    if (document.getElementById('simpanJumlahAbsensi').dataset.session) {
        window.location.href = '#ajax-absensi-title'
        window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
        e.preventDefault()
        let idsiswa = document.getElementById('idsiswa').value
        let els = document.querySelectorAll('.ubah-jumlah-absensi')
        let input = []
        let data = ""
        let dataerror = ""
        let pattern = /^[0-9-\s]+$/
        let error = []
        for (let i = 0; i < els.length; i++) {
            if (els[i].value) {
                if (els[i].name == "csrf_token") {
                    input[i] = els[i].name + '=' + els[i].value
                    data = data + input[i] + "&"
                } else {
                    if (pattern.test(els[i].value) == true) {
                        input[i] = els[i].name + '=' + els[i].value
                        data = data + input[i] + "&"
                    } else {
                        error[i] = els[i].name
                        dataerror = dataerror + error[i] + "&"
                    }
                }
            }
        }
        data = data.slice(0, -1)

        if (dataerror == false) {
            data = data + "&submit= "
            const xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('ajax-absensi').innerHTML = this.responseText
                    monsterBookGate = 1
                    updateAbsensi()
                    Swal.fire({
                        type: 'success',
                        title: 'Berhasil! &#128522;',
                        html: 'Data ketidakhadiran telah tersimpan &#128522;',
                        // footer: '<a href>Butuh dana cepat?</a>'
                    })
                } else {
                    document.getElementById("ajax-absensi").innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:300px"><img src="/assets/img/greenloading.gif" height="100"></div>'
                }
            }
            xhr.open("POST", url[0] + "//" + url[2] + "/" + url[3] + "/simpanjumlahabsensi/" + idsiswa)
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            xhr.send(data)
            document.getElementById('ajax-absensi').focus()
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
                    el.setAttribute('style', 'display:block;width:100%;line-height:13px;padding:5px 5px 5px 5px;margin-top:15px;margin-bottom:-17px;color:red')
                    el.innerHTML = "Data tidak valid";
                    var div = document.getElementById(error[j]);
                    insertAfter(div, el);
                }
            }
            Swal.fire({
                type: 'warning',
                title: 'Gagal &#128543;',
                html: 'Ada data yang tidak valid &#128543;',
                // footer: '<a href>Butuh dana cepat?</a>'
            })
        }
    } else {
        window.location.href = '/admin/login'
    }
}

function jumlahAbsensi() {
    const uja = document.getElementsByClassName('ubah-jumlah-absensi')
    for (let l = 0; l < uja.length; l++) {
        uja[l].addEventListener('keypress', (e) => {
            if (e.key === "Enter") {
                JAupdater(e)
            }
        })
    }
    document.getElementById('simpanJumlahAbsensi').addEventListener('click', function(e) {
        JAupdater(e)
    })
}

function updateAbsensi() {
    if (url[3] == "admin" && url[4] == "kelolanilai") {

        const triggerabsensi = document.getElementsByClassName('update-absensi')
        const idsiswa = document.getElementById("ajax-absensi").dataset.idsiswa
        const idkelas = document.getElementById("ajax-absensi").dataset.idkelas
        const tahun = document.getElementById("ajax-absensi").dataset.tahun
        triggerabsensi[0].addEventListener('click', function() {
            window.location.href = '#ajax-absensi-title'
            window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
            if (monsterBookGate == 1) {
                if (this.dataset.session) {
                    const req = new XMLHttpRequest()
                    req.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("ajax-absensi").innerHTML = this.responseText;
                            monsterBookGate = 0
                            jumlahAbsensi();
                        } else {
                            document.getElementById("ajax-absensi").innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:300px"><img src="/assets/img/greenloading.gif" height="100"></div>'
                        }
                    }
                    req.open("GET", "/admin/ubahjumlahabsensi/" + idsiswa + "/" + idkelas + "/" + tahun)
                    req.send()
                    document.getElementById("ajax-absensi").focus()
                } else {
                    window.location.href = '/admin/login'
                }
            } else {
                Swal.fire({
                    type: 'warning',
                    title: 'Maaf &#128543;',
                    html: 'Ada data tabel yang belum tersimpan, <br> tolong disimpan dulu ya... &#128543;',
                    // footer: '<a href>Butuh dana cepat?</a>'
                })
            }
        })
    }
}

updateAbsensi()