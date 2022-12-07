<div class="container d-flex justify-content-center">
    <div class="row p-1">
        <div class="align-bottom mx-1 mb-2" style="margin-top: 6px;width:80px;">
            Cari Siswa:
        </div>
        <form class="d-flex align-items-center" action="<?= base_url('admin/carisiswa') ?>" method="get" style="display: inline;">
            <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
            <div class="form-group mx-1" style="width: 215px;">
                <input type="text" class="form-control ajax-text-input-cari-siswa" name="keyword" data-csrf="<?= $csrf["hash"] ?>" placeholder="NISN/No Induk/Nama Siswa" autofocus>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary form-control btn-cari-siswa" data-session="<?= $this->session->userdata('admin') ?>">Cari</button>
            </div>
        </form>
        <?php if (explode('/', $_SERVER["HTTP_REFERER"])[4]) : ?>
            <span style="height: 35px;margin-left: 3px;" class="btn btn-secondary spp-cari-siswa-batal">Batal</span>
        <?php else : ?>
            <a href="<?= base_url('admin/daftarsiswa/' . $this->session->userdata('id_kelas') . '/' . $this->session->userdata('tahun')) ?>" style="height: 35px;margin-left: 3px;" class="btn btn-secondary">Kembali</a>
        <?php endif ?>
    </div>
</div>

<!-- <script>
    var csrf = $('.ajax-text-input-cari-siswa').data('csrf')
    if (url[4] == "sppkelas") {
        const sppBatalCari = document.querySelector('.spp-cari-siswa-batal')
        sppBatalCari.addEventListener('click', function(){
            document.querySelector('.ajax-cari-siswa').innerHTML = ''
        })
    }

    function loader(keyword, e) {
        e.preventDefault()
        let pattern = /^\++$/gm
        if (keyword && !pattern.test(keyword)) {
            document.getElementsByClassName('ajax-cari-siswa')[0].innerHTML = '<div class="d-flex justify-content-center align-items-center" ><img src="/assets/img/greenloading.gif" height="70"></div>'
            $('.ajax-cari-siswa').load('/admin/carisiswa?csrf_token=' + csrf + '&keyword=' + keyword + '&submit=')
        }
    }

    function carisiswa(el, even) {
        $(el).on(even, function(e) {
            if ($('.btn-cari-siswa').data('session')) {
                const keyword = $('.ajax-text-input-cari-siswa').val().trim().replace(/\s/gm, '+')
                if (even == "keypress") {
                    if (e.key === "Enter") {
                        loader(keyword, e)
                    }
                } else {
                    loader(keyword, e)
                }
            } else {
                e.preventDefault()
                window.location.href = '/admin/login'
            }
        })
    }

    carisiswa('.ajax-text-input-cari-siswa', 'keypress')
    carisiswa('.btn-cari-siswa', 'click')
</script> -->