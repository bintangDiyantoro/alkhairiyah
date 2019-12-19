$(function(){

    const title = $('title').html().split(' ')[3]
    const navlink = $('a:contains('+title+')')
    const navtersimpan = $('a:contains(Lihat Data Calon Siswa)')
    const navdaftar = $('a:contains(Daftarkan Siswa Baru)')
    const first = $('.first').val()
    const error = $('.error').val()
    const wali = $('.wali').val()
    const waliback = $('.waliback')
    const stuback = $('.stuback')

    navlink.addClass('active')
    const otherlink = $('a').not('.active')
    
    if(first){
        Swal.fire({
            type: 'info',
            title: 'Selamat datang di Form Pendaftaran!',
            html: `Silahkan isi form dengan teliti! </br></br> Setelah mengisi form silahkan tekan tombol <strong>Selanjutnya</strong> untuk melanjutkan proses pendaftaran.`,
            footer: '<a href>Butuh dana cepat?</a>'
        })
    }
    
    if (title !== 'Pendaftaran'){
        navlink.on('click',()=>{
            return false
        })
    }
    
    if(title == 'Pendaftaran' && $('#tersimpan').val() !== 'ok'){
        navdaftar.hide()
        otherlink.on('click', function(e){
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
    }else if (title == 'Pendaftaran' && $('#tersimpan').val() == 'ok'){
        navtersimpan.hide()
    }
    
    if(error){
        Swal.fire({
            type: 'warning',
            title: 'Maaf',
            html: 'Sepertinya ada data yang terlewat!</br> Silahkan periksa ulang form isian dengan teliti.',
            footer: '<a href>Butuh dana cepat?</a>'
        })
    }
    waliback.on('click',(e)=>{
        e.preventDefault()
        window.location.href = '/pendaftaran'
    })
    stuback.on('click', function(e){
        e.preventDefault()
        if(wali == 'Ayah' || wali == 'Ibu'){
            window.location.href = '/pendaftaran'
        }else if(wali == 'Lainnya'){
            window.location.href = '/pendaftaran/wali'
        }
    })

    if($('#sukses').val() == 'ok'){
        $('#MyModal').modal('show')
    }

    $('#modal-close').on('click', function(){
        $.ajax({
            url: 'http://localhost/pendaftaran/berhasil',
            method: 'get'
        })
    })
})