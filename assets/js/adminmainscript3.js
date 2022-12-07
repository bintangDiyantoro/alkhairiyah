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
    const idstaff = $('#tambahkelas').data('idstaff')
    const plhthncsrfname = $('#tambahkelas').data('csrfname')
    const plhthncsrfhash = $('#tambahkelas').data('csrfhash')
    const triggercarisiswa = $('.trigger-cari-siswa')
    const keluarkansiswa = document.querySelectorAll('.keluarkan-siswa')

    function mainToggleControl(el) {
        const navbar = document.querySelector('nav')
        el.addEventListener('click', function() {
            if (navbar.classList[10] == "toggled") {
                navbar.classList.add("not_toggled")
                navbar.classList.remove("toggled")
            } else {
                navbar.classList.add("toggled")
                navbar.classList.remove("not_toggled")
            }
        })
    }

    if (url[3] == "admin") {
        const sidebarToggle = document.querySelector('#sidebarToggle')
        const hamburger = document.querySelector('#sidebarToggleTop')
        mainToggleControl(sidebarToggle)
        mainToggleControl(hamburger)
    }

    function addStudentModal() {
        $('.cari-lagi').on('click', function(e) {
            e.preventDefault()
            const carisiswa = document.querySelector('.ajax-cari-siswa')
            carisiswa.innerHTML = '<div class="d-flex justify-content-center align-items-center" ><img src="/assets/img/greenloading.gif" height="70"></div>'
            const xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    carisiswa.innerHTML = this.responseText
                    studentSearch()
                }
            }
            xhr.open('get', '/admin/carisiswa/')
            xhr.send()
        })

        if (url[4] == "sppkelas") {
            const sppBatalCari = document.querySelector('.spp-cari-siswa-batal')
            if (sppBatalCari) {
                sppBatalCari.addEventListener('click', function() {
                    document.querySelector('.ajax-cari-siswa').innerHTML = ''
                })
            }
        }

        const urlAPIwilayah = 'https://bintangdiyantoro.github.io/api-wilayah-indonesia/api/'

        const kelurahan_ortu = document.querySelector('#kelurahan_ortu')
        async function getVillagesOrtu(districtId) {
            const villages = await fetch(`${urlAPIwilayah}villages/${districtId}.json`).then(response => response.json())
            let villages_options = ''
            for (const village of villages) {
                villages_options += `<option value="${village.name}">${village.name}</option>`
            }
            kelurahan_ortu.innerHTML = villages_options
        }


        const kecamatan_ortu = document.querySelector('#kecamatan_ortu')
        async function getDistrictsOrtu(regencyId) {
            const districts = await fetch(`${urlAPIwilayah}districts/${regencyId}.json`).then(response => response.json())
            let districts_options = ''
            for (const district of districts) {
                districts_options += `<option value="${district.name}" data-district_id="${district.id}">${district.name}</option>`
            }
            kecamatan_ortu.innerHTML = districts_options
            kecamatan_ortu.addEventListener('change', function() {
                for (const district of districts) {
                    if (district.name == this.value) {
                        getVillagesOrtu(district.id)
                    }
                }
            })
            kecamatan_ortu.addEventListener('click', function() {
                for (const district of districts) {
                    if (district.name == this.value) {
                        getVillagesOrtu(district.id)
                    }
                }
            })
        }

        const kabupaten_ortu = document.querySelector('#kabupaten_ortu')
        async function getRegenciesOrtu(provId) {
            const regencies = await fetch(`${urlAPIwilayah}regencies/${provId}.json`).then(response => response.json())
            let regencies_options = ''
            for (const regency of regencies) {
                regencies_options += `<option value="${regency.name}" data-regency_id="${regency.id}">${regency.name}</option>`
            }
            kabupaten_ortu.innerHTML = regencies_options
            kabupaten_ortu.addEventListener('change', function() {
                for (const regency of regencies) {
                    if (regency.name == this.value) {
                        getDistrictsOrtu(regency.id)
                    }
                }
            })
            kabupaten_ortu.addEventListener('click', function() {
                for (const regency of regencies) {
                    if (regency.name == this.value) {
                        getDistrictsOrtu(regency.id)
                    }
                }
            })
        }

        async function getProvincesOrtu() {
            const provinces = await fetch(`${urlAPIwilayah}provinces.json`).then(response => response.json())
            let provinces_options = ''
            for (const province of provinces) {
                provinces_options += `<option value="${province.name}" data-prov_id="${province.id}">${province.name}</option>`
            }
            provinsi_ortu.innerHTML = provinces_options
            if (provinces) {
                provinsi_ortu.parentElement.removeEventListener('click', getProvincesOrtuCaller)
            }
        }

        function getProvincesOrtuCaller() {
            this.children[1].innerHTML = `<option value="">Sedang memuat...</option>`
            getProvincesOrtu()
        }

        const provinsi_ortu = document.querySelector('#provinsi_ortu')
        let selected_parents_province = ''
        provinsi_ortu.parentElement.addEventListener('click', getProvincesOrtuCaller)
        provinsi_ortu.addEventListener('change', async function() {
            selected_parents_province = this.value
            let provinces = await fetch(`${urlAPIwilayah}provinces.json`).then(response => response.json())
            for (const province of provinces) {
                if (province.name == selected_parents_province) {
                    getRegenciesOrtu(province.id)
                }
            }
        })
        provinsi_ortu.addEventListener('click', async function() {
            selected_parents_province = this.value
            let provinces = await fetch(`${urlAPIwilayah}provinces.json`).then(response => response.json())
            for (const province of provinces) {
                if (province.name == selected_parents_province) {
                    getRegenciesOrtu(province.id)
                }
            }
        })

        const kelurahan_wali = document.querySelector('#kelurahan_wali')
        async function getVillagesWali(districtId) {
            const villages = await fetch(`${urlAPIwilayah}villages/${districtId}.json`).then(response => response.json())
            let villages_options = ''
            for (const village of villages) {
                villages_options += `<option value="${village.name}">${village.name}</option>`
            }
            kelurahan_wali.innerHTML = villages_options
        }


        const kecamatan_wali = document.querySelector('#kecamatan_wali')
        async function getDistrictsWali(regencyId) {
            const districts = await fetch(`${urlAPIwilayah}districts/${regencyId}.json`).then(response => response.json())
            let districts_options = ''
            for (const district of districts) {
                districts_options += `<option value="${district.name}" data-district_id="${district.id}">${district.name}</option>`
            }
            kecamatan_wali.innerHTML = districts_options
            kecamatan_wali.addEventListener('change', function() {
                for (const district of districts) {
                    if (district.name == this.value) {
                        getVillagesWali(district.id)
                    }
                }
            })
            kecamatan_wali.addEventListener('click', function() {
                for (const district of districts) {
                    if (district.name == this.value) {
                        getVillagesWali(district.id)
                    }
                }
            })
        }

        const kabupaten_wali = document.querySelector('#kabupaten_wali')
        async function getRegenciesWali(provId) {
            const regencies = await fetch(`${urlAPIwilayah}regencies/${provId}.json`).then(response => response.json())
            let regencies_options = ''
            for (const regency of regencies) {
                regencies_options += `<option value="${regency.name}" data-regency_id="${regency.id}">${regency.name}</option>`
            }
            kabupaten_wali.innerHTML = regencies_options
            kabupaten_wali.addEventListener('change', function() {
                for (const regency of regencies) {
                    if (regency.name == this.value) {
                        getDistrictsWali(regency.id)
                    }
                }
            })
            kabupaten_wali.addEventListener('click', function() {
                for (const regency of regencies) {
                    if (regency.name == this.value) {
                        getDistrictsWali(regency.id)
                    }
                }
            })
        }

        async function getProvincesWali() {
            const provinces = await fetch(`${urlAPIwilayah}provinces.json`).then(response => response.json())
            let provinces_options = ''
            for (const province of provinces) {
                provinces_options += `<option value="${province.name}" data-prov_id="${province.id}">${province.name}</option>`
            }
            provinsi_wali.innerHTML = provinces_options
            if (provinces) {
                provinsi_wali.removeEventListener('click', getProvincesWaliCaller)
            }
            return provinces
        }

        function getProvincesWaliCaller() {
            this.children[1].innerHTML = `<option value="">Sedang memuat...</option>`
            getProvincesWali();
        }

        const provinsi_wali = document.querySelector('#provinsi_wali')
        let selected_trustee_province = ''
        provinsi_wali.parentElement.addEventListener('click', getProvincesWaliCaller)
        provinsi_wali.addEventListener('change', async function() {
            selected_trustee_province = this.value
            let provinces = await fetch(`${urlAPIwilayah}provinces.json`).then(response => response.json())
            for (const province of provinces) {
                if (province.name == selected_trustee_province) {
                    getRegenciesWali(province.id)
                }
            }
        })

        provinsi_wali.addEventListener('click', async function() {
            selected_trustee_province = this.value
            let provinces = await fetch(`${urlAPIwilayah}provinces.json`).then(response => response.json())
            for (const province of provinces) {
                if (province.name == selected_trustee_province) {
                    getRegenciesWali(province.id)
                }
            }
        })

        $('.ajax-tambah-siswa').on('click', (e) => {
            e.preventDefault()
            $.ajax({
                url: '/admin/tambahsiswa',
                method: 'post',
                data: {
                    csrf_token: $("#csrf").val().trim(),
                    nomor_induk: $("#nomor_induk").val().trim(),
                    nisn: $("#nisn").val().trim(),
                    nama: $("#nama").val().trim(),
                    ttl: $("#tmp_lahir").val() + ", " + $("#tgl_lahir").val().trim(),
                    jenis_kelamin: $("#jenis_kelamin").val().trim(),
                    agama: $("#agama").val().trim(),
                    pendidikan_sebelumnya: $("#pendidikan_sebelumnya").val().trim(),
                    alamat: $("#alamat").val().trim(),
                    nama_ayah: $("#nama_ayah").val().trim(),
                    pekerjaan_ayah: $("#pekerjaan_ayah").val().trim(),
                    nama_ibu: $("#nama_ibu").val().trim(),
                    pekerjaan_ibu: $("#pekerjaan_ibu").val().trim(),
                    provinsi_ortu: $("#provinsi_ortu").val().trim(),
                    kabupaten_ortu: $("#kabupaten_ortu").val().trim(),
                    kecamatan_ortu: $("#kecamatan_ortu").val().trim(),
                    kelurahan_ortu: $("#kelurahan_ortu").val().trim(),
                    alamat_ortu: $("#alamat_ortu").val().trim(),
                    nama_wali: $("#nama_wali").val().trim(),
                    pekerjaan_wali: $("#pekerjaan_wali").val().trim(),
                    provinsi_wali: $("#provinsi_wali").val().trim(),
                    kabupaten_wali: $("#kabupaten_wali").val().trim(),
                    kecamatan_wali: $("#kecamatan_wali").val().trim(),
                    kelurahan_wali: $("#kelurahan_wali").val().trim(),
                    alamat_wali: $("#alamat_wali").val().trim(),
                    no_hp_ortu: $("#no_hp_ortu").val().trim(),
                    submit: $("#submit").val().trim(),
                },
                success: (data) => {
                    data = JSON.parse(data)
                    $("#csrf").val(data.csrf)
                    $("small").remove()
                    $("#nomor_induk").after(data.nomor_induk_error)
                    $("#nisn").after(data.nisn_error)
                    $("#nama").after(data.nama_error)
                    $("#tgl_lahir").after(data.ttl_error)
                    $("#jenis_kelamin").after(data.jenis_kelamin_error)
                    $("#agama").after(data.agama_error)
                    $("#pendidikan_sebelumnya").after(data.pendidikan_sebelumnya_error)
                    $("#alamat").after(data.alamat_error)
                    $("#nama_ayah").after(data.nama_ayah_error)
                    $("#pekerjaan_ayah").after(data.pekerjaan_ayah_error)
                    $("#nama_ibu").after(data.nama_ibu_error)
                    $("#pekerjaan_ibu").after(data.pekerjaan_ibu_error)
                    $("#provinsi_ortu").after(data.provinsi_ortu_error)
                    $("#kabupaten_ortu").after(data.kabupaten_ortu_error)
                    $("#kecamatan_ortu").after(data.kecamatan_ortu_error)
                    $("#kelurahan_ortu").after(data.kelurahan_ortu_error)
                    $("#alamat_ortu").after(data.alamat_ortu_error)
                    $("#nama_wali").after(data.nama_wali_error)
                    $("#pekerjaan_wali").after(data.pekerjaan_wali_error)
                    $("#provinsi_wali").after(data.provinsi_wali_error)
                    $("#kabupaten_wali").after(data.kabupaten_wali_error)
                    $("#kecamatan_wali").after(data.kecamatan_wali_error)
                    $("#kelurahan_wali").after(data.kelurahan_wali_error)
                    $("#alamat_wali").after(data.alamat_wali_error)
                    $("#no_hp_ortu").after(data.no_hp_ortu_error)

                    if (data.status == "valid") {
                        Swal.fire({
                            type: 'success',
                            title: "Data " + data.keyword + " berhasil disimpan!",
                        })
                        data.keyword = data.keyword.trim().replace(/\s/gm, '+')
                        const xhr = new XMLHttpRequest()
                        xhr.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.querySelector('.ajax-cari-siswa').innerHTML = this.responseText
                                addStudentModal()
                            }
                        }
                        xhr.open('get', `/admin/carisiswa?keyword=${data.keyword}&submit=`)
                        xhr.send()
                        $("#page-top").removeClass("modal-open")
                        $(".modal-backdrop").remove()
                    } else {
                        Swal.fire({
                            type: 'warning',
                            title: "Data gagal disimpan!",
                            html: 'Periksa kembali data input.',
                        })
                    }
                }
            })
        })

        pickmeup('#tgl_lahir')

        for (let i = 0; i < document.querySelectorAll('.badge-masukkan-siswa').length; i++) {
            document.querySelectorAll('.badge-masukkan-siswa')[i].addEventListener('click', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Perhatian!',
                    text: "Apakah anda yakin ingin memasukkan " + e.path[0].dataset.name + " ke kelas ini?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then(async result => {
                    if (result.value) {
                        const formdata = new FormData()
                        formdata.append("csrf_token", this.dataset.csrf)
                        formdata.append("id_siswa", this.dataset.idsiswa)
                        formdata.append("id_kelas", this.dataset.idkelas)
                        formdata.append("tahun", this.dataset.tahun)
                        formdata.append("submit", '')
                        if (url[4] == "sppkelas") {
                            const response = await fetch('/admin/sppkelasinsertstudent', { method: 'post', body: formdata })
                                .then(response => response.json()).then(response => response)
                            if (response == "success") {
                                location.reload()
                            }
                        } else {
                            const response = await fetch('/admin/masukkankelas', { method: 'post', body: formdata })
                                .then(response => response.json()).then(response => response)
                            if (response == "success") {
                                location.reload()
                            }
                        }
                    }
                })
            })
        }
    }

    function cariSiswaLoader(keyword, e) {
        e.preventDefault()
        let pattern = /^\++$/gm
        if (keyword && !pattern.test(keyword)) {
            document.getElementsByClassName('ajax-cari-siswa')[0].innerHTML = '<div class="d-flex justify-content-center align-items-center" ><img src="/assets/img/greenloading.gif" height="70"></div>'
            const xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector('.ajax-cari-siswa').innerHTML = this.responseText
                    addStudentModal()
                }
            }
            xhr.open('get', `/admin/carisiswa?keyword=${keyword}&submit=`)
            xhr.send()
        }
    }

    function carisiswaFn(el, even) {
        $(el).on(even, function(e) {
            if ($('.btn-cari-siswa').data('session')) {
                const keyword = $('.ajax-text-input-cari-siswa').val().trim().replace(/\s/gm, '+')
                if (even == "keypress") {
                    if (e.key === "Enter") {
                        cariSiswaLoader(keyword, e)
                    }
                } else {
                    cariSiswaLoader(keyword, e)
                }
            } else {
                e.preventDefault()
                window.location.href = '/admin/login'
            }
        })
    }

    function studentSearch() {
        var csrf = $('.ajax-text-input-cari-siswa').data('csrf')
        if (url[4] == "sppkelas") {
            const sppBatalCari = document.querySelector('.spp-cari-siswa-batal')
            sppBatalCari.addEventListener('click', function() {
                document.querySelector('.ajax-cari-siswa').innerHTML = ''
            })
        }
        carisiswaFn('.ajax-text-input-cari-siswa', 'keypress')
        carisiswaFn('.btn-cari-siswa', 'click')
    }


    triggercarisiswa.on('click', (e) => {
        e.preventDefault()
        const carisiswa = document.querySelector('.ajax-cari-siswa')
        carisiswa.innerHTML = '<div class="d-flex justify-content-center align-items-center" ><img src="/assets/img/greenloading.gif" height="70"></div>'
        const xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                carisiswa.innerHTML = this.responseText
                studentSearch()
            }
        }
        xhr.open('get', '/admin/carisiswa/')
        xhr.send()
    })

    addClassBtn.on('click', () => {
        if (addClassBtn.data('session')) {
            document.getElementsByClassName('ajax-tambah-kelas')[0].innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height:50px"><img src="/assets/img/greenloading.gif" height="45"></div>'
            $('.ajax-tambah-kelas').load('/admin/tambahkelas/' + idstaff + '/' + plhthncsrfname + '/' + plhthncsrfhash)
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
                text: "Apakah anda yakin ingin mengeluarkan " + event.path[0].dataset.name + " dari kelas ini?",
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

if (document.getElementsByClassName('container')[0].dataset.tmbkls == 'sukses') {
    Swal.fire({
        type: 'success',
        title: "Berhasil!",
        html: "Kelas baru berhasil ditambahkan!"
    })
}

if (url[3] == "admin" && url[4] == "kelolanilai") {
    var b_i_url = window.location.href
}

var monsterBookGate = 1

function NSupdater(e) {
    window.location.href = '#ajax-sikap-title'
    window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
    if (document.getElementById('simpanNilaiSikap').dataset.session !== '') {
        e.preventDefault()
        let idsiswa = document.getElementById('idsiswa').value
        let els = document.querySelectorAll('.ubah-nilai-sikap')
        let input = []
        let data = ""
        let dataerror = ""
        let pattern = /^[a-z.,'()0-9-\s]+$/i
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
                if (this.dataset.session !== '') {
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
    if (document.getElementById('simpanNilaiPengetahuanKeterampilan').dataset.session !== '') {
        e.preventDefault()
        let idsiswa = document.getElementById('idsiswa').value
        let els = document.querySelectorAll('.ubah-nilai-pengetahuan-keterampilan')
        let input = []
        let data = ""
        let dataerror = ""
        let pattern = /([1-9][0-9]|[\s-])/
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
                if (this.dataset.session !== '') {
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

    console.log(`${x1}`)
    if (ekskulAdds1 < ekskulCount.value) {
        if (x1 == 1) {
            let semester1 = document.getElementsByTagName('tbody')[4].children[0].children[0]
            document.getElementsByTagName('tbody')[4].children[0].removeChild(semester1)
            newtr.append(newth)
        } else {
            let newsmt1 = document.getElementsByTagName('tbody')[4].children[0].children[0]
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
    if (document.getElementById('simpanNilaiEkstrakurikuler').dataset.session !== '') {
        e.preventDefault()
        let idsiswa = document.getElementById('idsiswa').value
        let els = document.querySelectorAll('.ubah-nilai-ekstrakurikuler')
        let input = []
        let data = ""
        let dataerror = ""
        let pattern = /([1-9][0-9]|[-\s])/
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
        const triggerekstrakurikuler = document.querySelector('.update-ekstrakurikuler')
        const idsiswa = document.getElementById("ajax-ekstrakurikuler").dataset.idsiswa
        const idkelas = document.getElementById("ajax-ekstrakurikuler").dataset.idkelas
        const tahun = document.getElementById("ajax-ekstrakurikuler").dataset.tahun
        let ekskulCount = 0
        triggerekstrakurikuler.addEventListener('click', function() {
            window.location.href = '#ajax-ekstrakurikuler-title'
            window.history.pushState({ data: 'nonfe' }, 'sdrandom', b_i_url)
            if (monsterBookGate == 1) {
                if (this.dataset.session !== '') {
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
    if (document.getElementById('simpanJumlahAbsensi').dataset.session !== '') {
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
                if (this.dataset.session !== '') {
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

function pilihWaliKelas(classname = null) {
    const pilihwalikelas = document.getElementById('submitWaliKelas')
    const inputpilihwalikelas = document.getElementsByClassName('input-pilih-wali-kelas')
    const opsiwalikelas = document.getElementsByClassName('opsiwalikelas')
    var walikelas = ''
    var idwalikelas = document.getElementById('pilihwalikelas').value
    document.getElementById('pilihwalikelas').addEventListener('change', () => {
        idwalikelas = document.getElementById('pilihwalikelas').value
    })

    pilihwalikelas.addEventListener('click', (event) => {
        for (let i = 0; i < opsiwalikelas.length; i++) {
            if (opsiwalikelas[i].value == idwalikelas) {
                walikelas = opsiwalikelas[i].innerHTML
            }
        }
        event.preventDefault()
        if (mode !== 'newtch') {
            Swal.fire({
                title: 'Perhatian!',
                text: "Apakah anda yakin memilih " + walikelas + " sebagai wali kelas " + pilihwalikelas.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].innerHTML + " pada tahun ajaran " + inputpilihwalikelas[2].value + "?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('formPilihWaliKelas').submit()
                } else {
                    window.location.href = '/admin/mkkelas/' + inputpilihwalikelas[2].value
                }
            })
        } else {
            Swal.fire({
                title: 'Perhatian!',
                text: "Apakah anda yakin memilih " + walikelas + " sebagai wali kelas " + classname + "?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('formPilihWaliKelas').submit()
                } else {
                    window.location.href = '/admin/classesmanagement'
                }
            })
        }
    })
}

var twkswitch = 1

function tambahWaliKelas() {
    const waliKelasBaru = document.getElementById('mkWaliKelasBaru')
    if (waliKelasBaru && waliKelasBaru.dataset.walibaru == 'success') {
        Swal.fire({
            type: 'success',
            title: 'Berhasil! &#128522;',
            html: 'Data wali kelas baru telah tersimpan &#128522;',
            // footer: '<a href>Butuh dana cepat?</a>'
        })
    }
    const tbwaliKelas = document.getElementsByClassName('tb-wali-kelas')
    for (let itr = 0; itr < tbwaliKelas.length; itr++) {
        let twk = tbwaliKelas[itr]
        twk.addEventListener('click', (e) => {
            twk.setAttribute('class', 'badge badge-secondary px-2 py-1')
            e.preventDefault()
            if (twkswitch == 1) {
                const conn = new XMLHttpRequest()
                conn.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        twkswitch = 0
                        twk.parentElement.parentElement.parentElement.children[2].innerHTML = this.responseText
                        pilihWaliKelas()
                    } else {
                        twk.parentElement.parentElement.parentElement.children[2].innerHTML = '<div class="d-flex justify-content-center align-items-center" style="margin:-6px"><img src="/assets/img/greenloading.gif" height="35"></div>'
                    }
                }
                conn.open('get', '/admin/getwalikelas/' + twk.href.split('/')[5] + '/' + twk.href.split('/')[6] + '/' +
                    twk.href.split('/')[7])
                conn.send()
            } else {
                Swal.fire({
                    type: 'warning',
                    title: 'Eeeeh...!',
                    html: 'Selesaikan dulu yang tadi &#128530;',
                    // footer: '<a href>Butuh dana cepat?</a>'
                })
            }
        })
    }
}

tambahWaliKelas()

function mkTmbKls() {
    const mktmbkls = document.getElementById('mktambahkelas')
    if (mktmbkls) {
        mktmbkls.addEventListener('click', () => {
            const ekshaer = new XMLHttpRequest()
            ekshaer.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementsByClassName('ajax-tambah-kelas')[0].innerHTML = this.responseText
                    mkSubmitKelas()
                } else {
                    document.getElementsByClassName('ajax-tambah-kelas')[0].innerHTML = '<div class="d-flex justify-content-center align-items-center" style="margin:-6px"><img src="/assets/img/greenloading.gif" height="35"></div>'
                }
            }
            ekshaer.open('GET', '/admin/mktambahkelas')
            ekshaer.send()
        })
    }
}

mkTmbKls()

var mode = ''

function mkSubmitKelas() {
    const mksubmitkelas = document.getElementById('submitKelas')
    const pilihkelas = document.getElementById('pilihkelas')
    let classname = document.getElementsByClassName('classname')
    let chosenclass = ''
    let classid = pilihkelas.value

    pilihkelas.addEventListener('change', () => {
        classid = pilihkelas.value
    })


    if (mksubmitkelas) {
        mksubmitkelas.addEventListener('click', function(e) {
            for (let i = 0; i < classname.length; i++) {
                if (classname[i].value == classid) {
                    chosenclass = classname[i].innerHTML
                }
            }
            e.preventDefault()
            const req = new XMLHttpRequest()
            req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementsByClassName('ajax-tambah-kelas')[0].innerHTML = this.responseText
                    mode = 'newtch'
                    pilihWaliKelas(chosenclass)
                    document.getElementById('pilihwalikelas').parentElement.setAttribute("class", "row pilih-wali-kelas-baru")
                } else {
                    document.getElementsByClassName('ajax-tambah-kelas')[0].innerHTML = '<div class="d-flex justify-content-center align-items-center" style="margin:-6px"><img src="/assets/img/greenloading.gif" height="35"></div>'
                }
            }
            req.open('get', '/admin/getwalikelas/' + classid + '/' + mksubmitkelas.dataset.mknewtchtahun)
            req.send()
        })
    }
}

function thisYearClass() {
    const pilihKelasTahunIni = document.getElementById('thisYearClass')
    if (pilihKelasTahunIni) {
        const parent = pilihKelasTahunIni.parentElement
        pilihKelasTahunIni.addEventListener('click', (e) => {
            e.preventDefault()
            const xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    parent.innerHTML = this.responseText
                    confirmThisYearClass()
                } else {
                    parent.innerHTML = '<div class="d-flex justify-content-center align-items-center" style="margin:-6px"><img src="/assets/img/greenloading.gif" height="35"></div>'
                }
            }
            xhr.open('get', pilihKelasTahunIni.href)
            xhr.send()
        })
    }
}

thisYearClass()

function confirmThisYearClass() {
    var kelasthini = document.getElementById('pilihkelastahuniniselect').value
    document.getElementById('pilihkelastahuniniselect').addEventListener('change', () => {
        kelasthini = document.getElementById('pilihkelastahuniniselect').value
    })
    const ctyc = document.getElementById('confirmThisYearClass')
    ctyc.addEventListener('click', (e) => {
        e.preventDefault()
        const newyearclassname = document.getElementsByClassName('newyearclassname')
        for (let j = 0; j < newyearclassname.length; j++) {
            if (newyearclassname[j].value == kelasthini) {
                var chosenClass = newyearclassname[j].innerHTML
            }
        }
        Swal.fire({
            title: 'Perhatian!',
            text: "Apakah anda benar-benar menjadi wali kelas " + chosenClass + " pada tahun ajaran ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                document.getElementById('ctycForm').submit()
            } else {
                window.location.href = '/admin/bukuinduk'
            }
        })
    })
}

let sppPertingkat = document.querySelector('.nominal-spp-kelas-row')

if (sppPertingkat && sppPertingkat.dataset.update === "success") {
    Swal.fire({
        type: 'success',
        title: 'Berhasil!',
        html: 'Nominal SPP Tersimpan!'
    })
}

function myAjax(method, link, el, loadingheight, fn = () => {}, data = null, fnData = null) {
    const xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            el.innerHTML = this.responseText
            if (fnData == null) {
                fn()
            } else {
                fn(fnData)
            }
        } else {
            el.innerHTML = `<div class="d-flex justify-content-center align-items-center" style="margin:-6px;height:100%">
                                <img src="/assets/img/greenloading.gif" height="${loadingheight}">
                            </div>`
        }
    }
    xhr.open(method, link)
    if (method == "post" || method == "POST") {
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xhr.send(data)
    } else {
        xhr.send()
    }
}

var new_spp_csrf_token = null
var spp_csrf_token = null

async function justPostSpp() {
    if (new_spp_csrf_token == null) {
        spp_csrf_token = document.querySelector('.bukti-tf-spp-ajax').dataset.csrf
    } else {
        spp_csrf_token = new_spp_csrf_token
    }
    const tanggal = document.querySelector('.tanggal')
    const siswa = document.querySelector('.siswa')
    const bulan = document.querySelector('.bulan')
    const tahun = document.querySelector('.tahun')
    const nominal = document.querySelector('.nominal')
    const metodebayar = document.querySelector('.metode-bayar-options')
    const formdata = new FormData()
    formdata.append("csrf_token", spp_csrf_token)
    formdata.append("tanggal", tanggal.dataset.tanggal)
    formdata.append("id_siswa", siswa.dataset.id)
    formdata.append("id_kelas_siswa", siswa.dataset.idkelassiswa)
    formdata.append("id_detail_status_spp", siswa.dataset.detailstatusspp)
    formdata.append("bulan", bulan.dataset.bulan)
    formdata.append("tahun_ajaran", tahun.dataset.tahun)
    formdata.append("nominal", nominal.dataset.nominal)
    formdata.append("metode_bayar", metodebayar.value)
    formdata.append("submit", "")
    sppModalPaymentContent.innerHTML = `<div class="d-flex justify-content-center align-items-center" style="height:100%">
                                <img src="/assets/img/greenloading.gif" height="100">
                            </div>`
    await fetch('/admin/uploadbuktitfspp', { method: 'POST', body: formdata })
        .then(response => response.json())
        .then(response => {
            window.location.href = window.location.href + "/" + response.idtransaksi
        })
}

async function postImgNewToken() {
    if (url[4] == "sppkelas" || url[4] == "sppsiswa") {
        if (new_spp_csrf_token == null) {
            spp_csrf_token = document.querySelector('.bukti-tf-spp-ajax').dataset.csrf
        } else {
            spp_csrf_token = new_spp_csrf_token
        }
        const tanggal = document.querySelector('.tanggal')
        const siswa = document.querySelector('.siswa')
        const bulan = document.querySelector('.bulan')
        const tahun = document.querySelector('.tahun')
        const nominal = document.querySelector('.nominal')
        const metodebayar = document.querySelector('.metode-bayar-options')
        const buktitfspp = document.querySelector('#buktitf')
        const formdata = new FormData()
        formdata.append("csrf_token", spp_csrf_token)
        formdata.append("tanggal", tanggal.dataset.tanggal)
        formdata.append("id_siswa", siswa.dataset.id)
        formdata.append("id_kelas_siswa", siswa.dataset.idkelassiswa)
        formdata.append("id_detail_status_spp", siswa.dataset.detailstatusspp)
        formdata.append("bulan", bulan.dataset.bulan)
        formdata.append("tahun_ajaran", tahun.dataset.tahun)
        formdata.append("nominal", nominal.dataset.nominal)
        formdata.append("metode_bayar", metodebayar.value)
        formdata.append("submit", "")
        formdata.append("buktitf", buktitfspp.files[0])
        const sppMpc = document.querySelector('.spp-mpc')

        if (buktitfspp.files[0]) {
            if (buktitfspp.files[0].size <= 8300000) {
                await fetch('/admin/uploadbuktitfspp/upload', { method: 'POST', body: formdata })
                    .then(response => response.json())
                    .then(response => {
                        if (response.error) {
                            sppMpc.classList.add('modal-payment-content')
                            const submitbtn = document.querySelector('.payment-submit')
                            submitbtn.removeEventListener('click', postImgNewToken)
                            new_spp_csrf_token = response.new_csrf_token.hash
                            submitbtn.addEventListener('click', postImgNewToken)
                            if (buktitfspp.parentElement.childNodes.length > 4) {
                                document.querySelector('small').remove()
                            }
                            let newel = document.createElement('small')
                            newel.style = "position:relative;color:red;z-index:255;line-height:0.2!important"
                            newel.innerHTML = response.error
                            buktitfspp.parentElement.append(newel)
                        } else {
                            sppModalPaymentContent.innerHTML = `<div class="d-flex justify-content-center align-items-center" style="height:100%">
                                            <img src="/assets/img/greenloading.gif" height="100">
                                        </div>`;
                            window.location.href = window.location.href + "/" + response.idtransaksi
                        }
                    })
            } else {
                const submitbtn = document.querySelector('.payment-submit')
                const randomWarning = [
                    "buset... gede banget filenya...",
                    "ayolah... jangan main-main...",
                    "hayooo... becanda nih..."
                ]
                sppMpc.classList.add('modal-payment-content')
                submitbtn.removeEventListener('click', postImgNewToken)
                submitbtn.addEventListener('click', postImgNewToken)
                if (buktitfspp.parentElement.childNodes.length > 4) {
                    document.querySelector('small').remove()
                }
                let newel = document.createElement('small')
                newel.style = "position:relative;color:red;z-index:255;line-height:0.2!important"
                newel.innerHTML = randomWarning[Math.round(Math.random() * 2)]
                buktitfspp.parentElement.append(newel)
            }
        } else {
            const submitbtn = document.querySelector('.payment-submit')
            sppMpc.classList.add('modal-payment-content')
            submitbtn.removeEventListener('click', postImgNewToken)
            submitbtn.addEventListener('click', postImgNewToken)
            if (buktitfspp.parentElement.childNodes.length > 4) {
                document.querySelector('small').remove()
            }
            let newel = document.createElement('small')
            newel.style = "position:relative;color:red;z-index:255;line-height:0.2!important"
            newel.innerHTML = "anda belum memilih file"
            buktitfspp.parentElement.append(newel)
        }
    }
}

function attachTfSpp() {
    var submitbtn = document.querySelector('.payment-submit')
    submitbtn.addEventListener('click', postImgNewToken)
    document.querySelector('.tf-spp-attachment').addEventListener('change', function() {
        let fileName = this.value.split('\\').pop()
        this.nextElementSibling.innerHTML = fileName
        submitbtn.removeEventListener('click', postImgNewToken)
        submitbtn.addEventListener('click', postImgNewToken)
    })
}

function sppPaymentFn(idsiswa) {
    changeSppStatus(idsiswa)
    sppModalPaymentContent.classList.add('spp-mpc')
    sppModalPaymentContent.classList.remove('modal-payment-content')
    let metodeBayar = document.querySelector('.metode-bayar-options')
    const elbuktitfspp = document.querySelector('.bukti-tf-spp-ajax')
    const submitbtn = document.querySelector('.payment-submit')
    submitbtn.addEventListener('click', justPostSpp)
    metodeBayar.addEventListener('change', function() {
        if (this.value == "2") {
            submitbtn.removeEventListener('click', justPostSpp)
            myAjax('get', '/admin/uploadbuktitfspp', elbuktitfspp, '40', attachTfSpp)
        } else {
            const sppMpc = document.querySelector('.spp-mpc')
            sppMpc.classList.remove('modal-payment-content')
            submitbtn.removeEventListener('click', postImgNewToken)
            submitbtn.addEventListener('click', justPostSpp)
            elbuktitfspp.innerHTML = ''
        }
    })
}

let sppPayment = document.getElementsByClassName('spp-payment')
var sppModalPaymentContent = document.querySelector('.modal-payment-content')

for (let sp of sppPayment) {
    sp.addEventListener('click', function() {
        myAjax('get', '/admin/modalpaymentajax/' + this.dataset.idsiswa + '/' + this.dataset.idkelas + '/' + this.dataset.idbulan + '/' + this.dataset.tahun, sppModalPaymentContent, '235', sppPaymentFn, null, [this.dataset.idsiswa, this.dataset.idkelas, this.dataset.tahun])
    })
}

if ((url[4] == "sppkelas" && url[8]) || (url[4] == "sppsiswa" && url[9])) {
    if (url[4] == "sppsiswa") {
        window.history.pushState({ data: 'nonfe' }, 'sdrandom', '/' + url[3] + '/' + url[4] + '/' + url[5] + '/' + url[6] + '/' + url['7'] + '/' + url['8'])
    } else {
        window.history.pushState({ data: 'nonfe' }, 'sdrandom', '/' + url[3] + '/' + url[4] + '/' + url[5] + '/' + url[6] + '/' + url['7'])
    }
    if (document.querySelector('.idtransaksi').dataset.idtransaksi) {
        let idtr = document.querySelector('.idtransaksi').dataset.idtransaksi
        let pembayar = document.querySelector('.idtransaksi').dataset.pembayar
        Swal.fire({
            title: 'Berhasil!',
            type: 'success',
            html: 'Pembayaran SPP <strong>' + pembayar + '</strong> telah berhasil!',
            showCloseButton: true,
            showCancelButton: true,
            // focusConfirm: true,
            confirmButtonText: `<a href="/admin/buktipembayaranspp/${idtr}" class="text-light" target="_blank">Unduh Bukti Pembayaran &nbsp;&nbsp;<i class="fas fa-file-download"></i></a>`,
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: 'Tutup',
            cancelButtonAriaLabel: 'Thumbs down'
        })
    }
}

let paidSppBadge = document.querySelectorAll('.paid-off-spp-badge')
var sppPaidOffModalContent = document.querySelector('.paid-off-modal-content')

for (const psb of paidSppBadge) {
    psb.addEventListener('click', function() {
        myAjax('get', '/admin/paidoffsppajax/' + this.dataset.idtrspp, sppPaidOffModalContent, '235')
    })
}

function sppStatusChangeWarningMessage(message) {
    let warning = document.createElement('small')
    warning.setAttribute('style', 'color:red')
    warning.innerHTML = message
    keterangan.parentElement.appendChild(warning)
}

async function sppStatusChangeInput(args) {
    const semuaNominalSPP = await fetch('/admin/getallnominalsppajax')
        .then(response => response.json()).then(response => response)
    const remSmall = document.getElementsByTagName('small')
    const csrftoken = document.querySelector('.csrf-ubah-status-spp').dataset.csrf
    const idsiswa = document.querySelector('.siswa').dataset.idsiswa
    const statusspp = document.querySelector('.status-keringanan-spp')
    const nominal = document.querySelector('.nominal-spp-payment-select')
    const idnominalkelas = document.querySelector('.nominal-spp-kelas').dataset.nominalspp
    let nominalkelas = ''
    for (const sn of semuaNominalSPP) {
        nominalkelas += `<option value="${sn.id}" ${(sn.id == idnominalkelas)?'selected':''}>${sn.nominal}</option>`
    }
    const keterangan = document.querySelector('.keterangan-keringanan-spp')
    const submitchange = document.querySelector('.change-spp-status-submit-btn')
    const pattern = /^[a-z\s.'\-]+$/i
    let statussppid = statusspp.value
    let nominalid = nominal.value
    if (statussppid == '1') {
        nominal.setAttribute('disabled', '')
        keterangan.setAttribute('disabled', '')
    } else if (statussppid == '3') {
        nominal.setAttribute('disabled', '')
    }

    statusspp.addEventListener('change', function() {
        statussppid = this.value
        if (statussppid == '1') {
            nominal.innerHTML = nominalkelas
            keterangan.value = ''
            keterangan.setAttribute('disabled', '')
            nominal.setAttribute('disabled', '')
        } else {
            if (statussppid == '3') {
                nominal.innerHTML = ''
                for (const sns of semuaNominalSPP) {
                    nominal.innerHTML += `<option value="${sns.id}" ${(sns.id == '1')?'selected':''}>${sns.nominal}</option>`
                }
                nominal.setAttribute('disabled', '')
                keterangan.innerHTML = ''
            } else {
                nominal.removeAttribute('disabled')
            }
            keterangan.removeAttribute('disabled')
        }
    })

    nominal.addEventListener('change', function() {
        nominalid = this.value
    })

    submitchange.addEventListener('click', async() => {
        if (remSmall.length > 2) {
            keterangan.parentElement.removeChild(remSmall[1])
        }

        if (statussppid == '3' && keterangan.value.length == 0) {
            sppStatusChangeWarningMessage('Maaf, keterangan harus diisi')
        } else {
            if (keterangan.value.length <= 200) {
                if (keterangan.value.length == 0 || pattern.test(keterangan.value) == true) {
                    const formdata = new FormData()
                    formdata.append('csrf_token', csrftoken)
                    formdata.append('id_siswa', idsiswa)
                    formdata.append('id_status_spp', statussppid)
                    if (statussppid == '1') {
                        formdata.append('nominal', '')
                        formdata.append('keterangan', '')
                    } else {
                        if (statussppid == '3') {
                            formdata.append('nominal', '1')
                        } else {
                            formdata.append('nominal', nominalid)
                        }
                        formdata.append('keterangan', keterangan.value)
                    }
                    formdata.append('submit', '')
                    sppModalPaymentContent.innerHTML = `<div class="d-flex justify-content-center align-items-center" style="height:100%">
                                                            <img src="/assets/img/greenloading.gif" height="100">
                                                        </div>`
                    await fetch('/admin/changesppstatus/' + args[0] + '/' + args[1] + '/' + args[2], { method: 'POST', body: formdata })
                        .then(response => response.json())
                        .then(response => {
                            if (response == "success")
                                window.location.href = window.location.href
                        })
                } else {
                    sppStatusChangeWarningMessage('Maaf, anda memasukkan karakter selain abjad, titik (.) dan strip (-)')
                }
            } else {
                sppStatusChangeWarningMessage('Maaf, anda mengetik lebih dari 200 karakter')
            }
        }
    })
}

function changeSppStatus(args) {
    const chgsttssppbtn = document.querySelector('.change-spp-status-btn')
    chgsttssppbtn.addEventListener('click', function loadSppStatusChangeContent() {
        myAjax('get', '/admin/changesppstatus/' + args[0] + '/' + args[1] + '/' + args[2], sppModalPaymentContent, '235', sppStatusChangeInput, null, args)
        sppModalPaymentContent.classList.add('change-spp-status')
        sppModalPaymentContent.classList.remove('modal-payment-content')
    })
}

let freeChargedSppChangeStatusBtns = document.getElementsByClassName('free-charged-spp-change-status')

for (const fcscsb of freeChargedSppChangeStatusBtns) {
    fcscsb.addEventListener('click', function() {
        const args = [this.dataset.idsiswa, this.dataset.idkelas, this.dataset.tahun]
        myAjax('get', '/admin/changesppstatus/' + this.dataset.idsiswa + '/' + this.dataset.idkelas + '/' + this.dataset.tahun, sppModalPaymentContent, '235', sppStatusChangeInput, null, args)
    })
}

function checkStudentBill() {
    const checkBtn = document.querySelectorAll('.check-student-bill')
    const tahunajaran = document.querySelector('.spp-main-page-academic-year').value
    sppInsertStudentToClassModal()
    for (const cb of checkBtn) {
        cb.addEventListener('click', function() {
            window.location.href = `/admin/sppsiswa/${this.dataset.classid}/${tahunajaran}/${this.dataset.idsiswa}`
        })
    }
}

function fetchTotalSppMasukTahunTsb(tahunAjaran) {
    const totalSpp = document.querySelector('.total-spp-th-tsb-span')
    myAjax('get', `/admin/gettotalsppthtsb/${tahunAjaran}`, totalSpp, '0')
}

function sppFindStudentCore(el, evt) {
    const academicYear = document.querySelector('.spp-main-page-academic-year')
    const maincontent = document.querySelector('.spp-main-page-content-container')
    const searchresult = document.querySelector('.spp-main-page-student-search-result')
    const sppFindStudent = document.querySelector('.spp-find-student')
    let selectedAcademicYear = academicYear.value
    academicYear.addEventListener('change', function() {
        selectedAcademicYear = this.value
        fetchTotalSppMasukTahunTsb(this.value)
    })
    el.addEventListener(evt, () => {
        pattern = /(^[a-z*\s]+$|^[0-9]+$)/gi
        if (sppFindStudent.value.length > 0 && pattern.test(sppFindStudent.value)) {
            maincontent.setAttribute('style', 'display:none')
            searchresult.setAttribute('style', 'display:block')
            myAjax('GET', `/admin/sppmainstudentsearch/${(sppFindStudent.value!=='*')?sppFindStudent.value:'all_students'}/${selectedAcademicYear}`, searchresult, '150', checkStudentBill)
        } else {
            maincontent.setAttribute('style', 'display:block')
            searchresult.setAttribute('style', 'display:none')
        }
    })
}

function sppFindStudent() {
    const sppFindStudent = document.querySelector('.spp-find-student')
    const sppFindStudentBtn = document.querySelector('.spp-find-student-button')
    if (sppFindStudent && sppFindStudentBtn) {
        sppFindStudentCore(sppFindStudent, 'keyup')
        sppFindStudentCore(sppFindStudentBtn, 'click')
    }
}

function sppCustomSearchToggleCore() {
    const mainspptotal = document.querySelector('.main-spp-total')
    const tahunAjaranRow = document.querySelector('.spp-tahun-ajaran-row')
    const customSppSearch = document.querySelector('#customSppSearchToggle')
    if (customSppSearch.classList[1] == "not_toggled") {
        customSppSearch.classList.add('toggled')
        customSppSearch.classList.remove('not_toggled')
    } else {
        customSppSearch.classList.add('not_toggled')
        customSppSearch.classList.remove('toggled')
    }
    if (tahunAjaranRow.classList[2] == "not_toggled") {
        tahunAjaranRow.classList.add('toggled')
        tahunAjaranRow.classList.remove('not_toggled')
    } else {
        tahunAjaranRow.classList.add('not_toggled')
        tahunAjaranRow.classList.remove('toggled')
    }
    if (mainspptotal.classList[1] == "not_toggled") {
        mainspptotal.classList.add('toggled')
        mainspptotal.classList.remove('not_toggled')
    } else {
        mainspptotal.classList.add('not_toggled')
        mainspptotal.classList.remove('toggled')
    }
}

function sppCustomSearchToggle() {
    const hamburger = document.querySelector('#sidebarToggleTop')
    const bottomSidebarToggle = document.querySelector('#sidebarToggle')

    hamburger.addEventListener('click', () => {
        sppCustomSearchToggleCore()
    })
    bottomSidebarToggle.addEventListener('click', () => {
        sppCustomSearchToggleCore()
    })
}

function sppInsertStudentToClass() {
    const insertBtn = document.querySelector('.spp-insert-student-to-class-btn')
    const chosenClass = document.querySelector('.spp-chosen-class')
    const classes = document.getElementsByClassName('class-option')
    insertBtn.addEventListener('click', function() {
        let classname = ''
        for (const c of classes) {
            if (c.classList[1] == chosenClass.value) {
                classname = c.innerHTML
            }
        }
        Swal.fire({
            title: 'Perhatian!',
            html: `Apakah anda yakin akan memasukkan <strong>${this.dataset.namasiswa}</strong> ke kelas <strong>${classname}</strong>?`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin Banget!',
            cancelButtonText: 'Tidak'
        }).then(async result => {
            if (result.value) {
                console.log(`id siswa = ${this.dataset.idsiswa} - id staff= ${this.dataset.idstaff} - chosen class= ${chosenClass.value} - year= ${this.dataset.acyearsrc} csrf=${this.dataset.csrf}`)
                let formdata = new FormData()
                formdata.append('csrf_token', this.dataset.csrf)
                formdata.append('id_siswa', this.dataset.idsiswa)
                formdata.append('id_kelas', chosenClass.value)
                formdata.append('tahun', this.dataset.acyearsrc)
                formdata.append('submit', '')
                let insert = await fetch(`/admin/sppinsertstudentajax`, { method: "POST", body: formdata })
                    .then(response => response.json()).then(response => response)
                if (insert == "success") {
                    window.location.href = window.location.href + '/' + this.dataset.namasiswa + '/' + classname
                }
            }
        })
    })
}

function sppInsertStudentToClassModal() {
    const insertBtn = document.querySelectorAll('.spp-insert-student-to-class')
    const insertModal = document.querySelector('.modal-for-insert-student-content')
    for (const ib of insertBtn) {
        ib.addEventListener('click', function() {
            myAjax('get', `/admin/sppinsertstudenttoclass/${this.dataset.idsiswa}/${this.dataset.tahun}`, insertModal, '150', sppInsertStudentToClass)
        })
    }
}

if (url[3] == "admin" && url[4] == "spp") {
    sppFindStudent()
    sppCustomSearchToggle()
    if (url[5] && url[6]) {
        Swal.fire(
            'Berhasil!',
            `<strong>${url[5]}</strong> telah dimasukkan ke kelas <strong>${url[6]}</strong>`,
            'success'
        )
        window.history.pushState({ data: 'nonfe' }, 'sdrandom', '/' + url[3] + '/' + url[4])
    }
}

if (url[4] == "keuangan") {
    const academicYear = document.querySelector('.spp-keuangan-academic-year')
    const academicMonth = document.querySelector('.spp-keuangan-academic-month')
    const belumbayarcontainer = document.querySelector('.spp-keuangan-belum-pada-bayar')
    const totalSppBlnTsb = document.querySelector('.total-spp-bulan-tsb')
    let year = academicYear.value
    let month = academicMonth.value
    academicYear.addEventListener('change', function() {
        fetchTotalSppMasukTahunTsb(this.value)
        year = academicYear.value
        myAjax('get', `/admin/belumbayar/${month}/${year}`, belumbayarcontainer, '250')
        myAjax('get', `/admin/gettotalsppblntsb/${month}/${year}`, totalSppBlnTsb, '30')
    })
    academicMonth.addEventListener('change', function() {
        month = academicMonth.value
        myAjax('get', `/admin/belumbayar/${month}/${year}`, belumbayarcontainer, '250')
        myAjax('get', `/admin/gettotalsppblntsb/${month}/${year}`, totalSppBlnTsb, '30')
    })
}