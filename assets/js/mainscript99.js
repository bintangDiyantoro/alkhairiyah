$(function () {

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

    // if (first) {
    //     Swal.fire({
    //         type: 'info',
    //         title: 'Selamat datang di Form Pendaftaran!',
    //         html: `<br />Dimohon mengisi form dengan teliti!<br />Setelah mengisi form silahkan tekan tombol
    //                 <strong>Selanjutnya</strong> untuk melanjutkan proses pendaftaran.<br/><br/>
    //         Setelah melakukan pendaftaran online silahkan melengkapi persyaratan <strong>verifikasi secara offline</strong> sebagai berikut:
    //         <br /><br />
    //                 <div style="text-align:left;margin-left:30px;display:flex">
    //                         <ul>
    //                         <li>Infaq Bulanan (Juli)<strong>: Rp 200.000,-</strong></li>
    //                         <li>Infaq Pemeliharaan Gedung<strong>: Rp 2.000.000,-</strong></li>
    //                         <li>FC Akta Kelahiran</li>
    //                         <li>FC Kartu Keluarga</li>
    //                         <li>Surat keterangan dari TK/RA (jika ada)</li>
    //                         <li>Pas Foto 3 x 4 background merah (3 lembar)</li>
    //                     </ul>
    //                 </div>
    //                 <br />`,
    //         // footer: '<a href>Butuh dana cepat?</a>'
    //     })
    // }

    if (title !== 'Pendaftaran' && title !== 'Profil' && title !== 'Akademik' && title !== 'Alumni' && $('.display-3:first').html() == 'Ahlan Wa Sahlan!') {
        navlink.on('click', () => {
            return false
        })
    }

    if (title == 'Pendaftaran' && $('#tersimpan').val() !== 'ok') {
        navdaftar.hide()
        otherlink.on('click', function (e) {
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
            html: 'Sepertinya ada data yang salah/terlewat!</br> Silahkan periksa ulang form isian dengan teliti.',
            // footer: '<a href>Butuh dana cepat?</a>'
        })
    }
    waliback.on('click', (e) => {
        e.preventDefault()
        window.location.href = '/ppdb'
    })
    stuback.on('click', function (e) {
        e.preventDefault()
        if (wali == 'Ayah' || wali == 'Ibu') {
            window.location.href = '/ppdb'
        } else if (wali == 'Lainnya') {
            window.location.href = '/ppdb/wali'
        }
    })

    if ($('#sukses').val() == 'ok') {
        $('#MyModal').modal('show')
    }

    $('#modal-close').on('click', function () {
        $.ajax({
            url: '/ppdb/daftar',
            method: 'get'
        })
    })

    if (keyword.val()) {
        const len = keyword.val().length
        keyword[0].focus();
        keyword[0].setSelectionRange(len, len);
    }


    if (title == "Pendaftaran") {
        pickmeup('#tgl_lahir');
    }


    if (title == "Pendaftaran" && window.location.href.split('/')[4] == 'formpelengkapandatalogin') {
        const submit = document.querySelector('#submit-btn');
        const loginform = document.querySelector('.login');
        submit.addEventListener('click', function () {
            loginform.innerHTML = '<div class="d-flex justify-content-center align-items-center" style="margin-top:-20px;margin-bottom:20px"><img src="/assets/img/greenloading.gif" height="70"></div>';
        });
    }

    function myAjax(place, requestLink, todo = function () { },anotherfn = function () { }) {
        document.querySelector(place).innerHTML = '<div class="d-flex justify-content-center align-items-center" ><img src="/assets/img/greenloading.gif" height="70"></div>'
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector(place).innerHTML = this.responseText;
                todo();
                anotherfn();
            }
        }
        xhr.open('get', requestLink);
        xhr.send();
    }
    function perwalian() {
        const sessiondata = document.querySelector("#session-data");
        const namawali = document.querySelector('#nama_wali');
        const nikwali = document.querySelector('#nik_wali');
        const tahunlahirwali = document.querySelector('#tahun_lahir_wali');
        const pendidikanwali = document.querySelector('#pendidikan_wali').childNodes;
        const pekerjaanwali = document.querySelector('#pekerjaan_wali').childNodes;
        const penghasilanwali = document.querySelector('#penghasilan_wali').childNodes;
        const kebutuhanKhususWali = document.querySelector('#kebutuhanKhususWali').childNodes;

        namawali.setAttribute('value', sessiondata.dataset.namawali);
        nikwali.setAttribute('value', sessiondata.dataset.nikwali);
        tahunlahirwali.setAttribute('value', sessiondata.dataset.tahunlahirwali);

        for (const element of pendidikanwali) {
            if (element.value == sessiondata.dataset.pendidikanwali) {
                element.setAttribute('selected', 'selected');
            }
        }
        for (const element of pekerjaanwali) {
            if (element.value == sessiondata.dataset.pekerjaanwali) {
                element.setAttribute('selected', 'selected');
            }
        }
        for (const element of penghasilanwali) {
            if (element.value == sessiondata.dataset.penghasilanwali) {
                element.setAttribute('selected', 'selected');
            }
        }
        for (const element of kebutuhanKhususWali) {
            if (element.value == sessiondata.dataset.kebutuhankhususwali) {
                element.setAttribute('selected', 'selected');
            }
        }
        if (sessiondata.dataset.namawalierror) {
            let warning = document.createElement('small');
            warning.className = 'text-danger pl-3';
            warning.innerHTML = sessiondata.dataset.namawalierror;
            namawali.parentElement.appendChild(warning);
        }
        if (sessiondata.dataset.nikwalierror) {
            let warning = document.createElement('small');
            warning.className = 'text-danger pl-3';
            warning.innerHTML = sessiondata.dataset.nikwalierror;
            nikwali.parentElement.appendChild(warning);
        }
        if (sessiondata.dataset.tahunlahirwalierror) {
            let warning = document.createElement('small');
            warning.className = 'text-danger pl-3';
            warning.innerHTML = sessiondata.dataset.tahunlahirwalierror;
            tahunlahirwali.parentElement.appendChild(warning);
        }
    }
    function konfimasiInputDataPelengkapan(){
        const text = `Apakah anda sudah memastikan bahwa semua data yang anda masukkan sudah sesuai dengan dokumen-dokumen aslinya?`
        const submit = document.querySelector('#submit-btn');
        submit.addEventListener('click', function (e) {
            e.preventDefault()
            var form = this.parentElement.closest('form');
            Swal.fire({
                title: 'Perhatian!',
                text: text,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            })
        })
    }
    if (title == "Pendaftaran" && window.location.href.split('/')[4] == 'formpelengkapandata') {
        pickmeup('#tgl_lahir_2');
        konfimasiInputDataPelengkapan();
        let kecamatanpilihan = document.querySelector('#session-data').dataset.kecamatan;
        let kelurahanpilihan = document.querySelector('#session-data').dataset.kelurahan;
        let punyaWali = document.querySelector('#mempunyaiWali');
        let tidakPunyaWali = document.querySelector('#tidakMempunyaiWali');
        const kecamatan = document.querySelector('#kecamatan');
        const kelurahan = document.querySelector('#kelurahan');
        if (kecamatanpilihan) {
            for (let i = 0; i < kecamatan.options.length; i++) {
                if (kecamatan.options[i].value == kecamatanpilihan) {
                    kecamatan.options[i].setAttribute('selected', 'selected');
                    break;
                }
            }
            if (kelurahanpilihan) {
                myAjax('.village-caller', `/ppdb/villagescaller/${kecamatan.options[kecamatan.selectedIndex].dataset.code}/${kelurahanpilihan}`,konfimasiInputDataPelengkapan);
                myAjax('.village-caller-postal-code', `/ppdb/villagescallerpostalcode/${kecamatan.options[kecamatan.selectedIndex].dataset.code}`,konfimasiInputDataPelengkapan);
            } else {
                myAjax('.village-caller', `/ppdb/villagescaller/${kecamatan.options[kecamatan.selectedIndex].dataset.code}`,konfimasiInputDataPelengkapan);
                myAjax('.village-caller-postal-code', `/ppdb/villagescallerpostalcode/${kecamatan.options[kecamatan.selectedIndex].dataset.code}`,konfimasiInputDataPelengkapan);
            }
                
        }
        
        if (punyaWali.attributes.checked) {
            myAjax('.place-for-data-wali-ajax', `/ppdb/waliajaxform`, perwalian,konfimasiInputDataPelengkapan);
        }
        punyaWali.addEventListener('change', function () {
            myAjax('.place-for-data-wali-ajax', `/ppdb/waliajaxform`, perwalian,konfimasiInputDataPelengkapan);
        });
        tidakPunyaWali.addEventListener('change', function () {
            myAjax('.place-for-data-wali-ajax', `/ppdb/tanpawaliajaxform`,konfimasiInputDataPelengkapan);
        });
        kecamatan.addEventListener('change', function () {
            let districtId = this.options[this.selectedIndex].dataset.code;
            if (!districtId) {
                districtId = "0";
            }
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector('.village-caller').innerHTML = this.responseText;
                }
            }
            xhr.open('get', `/ppdb/villagescaller/${districtId}`);
            xhr.send();
        });
        kecamatan.addEventListener('change', function () {
            let districtId = this.options[this.selectedIndex].dataset.code;
            // console.log(districtId);
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector('.village-caller-postal-code').value = this.responseText.split('<')[0];
                    // todo();
                    // console.log(this.responseText);

                }
            }
            xhr.open('get', `/ppdb/villagescallerpostalcode/${districtId}`);
            xhr.send();
        });
        kelurahan.addEventListener('change', function () {
            document.querySelector('#kode_pos').value = this.options[this.selectedIndex].dataset.code;
        });
    }



    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('.add-attachment').on('click', function (e) {
        e.preventDefault()
        counter += 1
        if (counter <= 4) {
            $('.additional-attachment').before(`< div class= "additional-attachment-` + counter + `" ></ > `)
            $('.additional-attachment-' + counter).load('/admin/newattach/' + counter)
        }
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

    delbut.on('click', function (e) {
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

    delbadge.on('click', function (e) {
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