$('.cari-lagi').on('click', function(e) {
    e.preventDefault()
    document.getElementsByClassName('ajax-cari-siswa')[0].innerHTML = '<div class="d-flex justify-content-center align-items-center" ><img src="/assets/img/greenloading.gif" height="70"></div>'
    $('.ajax-cari-siswa').load('/admin/carisiswa/')
})

if (url[4] == "sppkelas") {
    const sppBatalCari = document.querySelector('.spp-cari-siswa-batal')
    if (sppBatalCari) {
        sppBatalCari.addEventListener('click', function() {
            document.querySelector('.ajax-cari-siswa').innerHTML = ''
        })
    }
}

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
            alamat_ortu: $("#alamat_ortu").val().trim(),
            nama_wali: $("#nama_wali").val().trim(),
            pekerjaan_wali: $("#pekerjaan_wali").val().trim(),
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
            $("#alamat_ortu").after(data.alamat_ortu_error)
            $("#nama_wali").after(data.nama_wali_error)
            $("#pekerjaan_wali").after(data.pekerjaan_wali_error)
            $("#alamat_wali").after(data.alamat_wali_error)
            $("#no_hp_ortu").after(data.no_hp_ortu_error)

            if (data.status == "valid") {
                Swal.fire({
                    type: 'success',
                    title: "Data " + data.keyword + " berhasil disimpan!",
                })
                data.keyword = data.keyword.trim().replace(/\s/gm, '+')
                $(".ajax-cari-siswa").load('/admin/carisiswa?csrf_token=' + data.csrf + '&keyword=' + data.keyword + '&submit=')
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