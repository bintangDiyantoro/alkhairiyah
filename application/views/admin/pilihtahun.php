<div class="container d-flex justify-content-center m-3">
    <div class="row">
        <div class="align-bottom mr-2" style="margin-top: 6px;width:130px;margin-bottom: 10px;">
            Pilih Tahun Ajaran:
        </div>
        <form class="d-flex align-items-center" action="<?= base_url('admin/redirectPilihKelas') ?>" method="post" style="display: inline;">
            <input class="input-pilih-tahun" type="hidden" name="<?= $csrfname ?>" value="<?= $csrfhash ?>">
            <input class="input-pilih-tahun" type="hidden" name="id_staff" value="<?= $idstaff ?>">
            <select class="form-control mr-1" aria-label="Default select example" name="pilihtahun" id="pilihtahun" style="width: 102px;">
                <?php foreach ($tahun as $t) : ?>
                    <option value="<?= $t ?>"><?= $t ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit" name="submit" class="btn btn-primary mr-1" id="pilihTahunKelas">Pilih</button>
            <a href="<?= base_url('admin/bukuinduk') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<script>
    var tahun = document.getElementById('pilihtahun').value
    document.getElementById('pilihtahun').addEventListener('change', () => {
        tahun = document.getElementById('pilihtahun').value
    })

    let els = document.querySelectorAll('.input-pilih-tahun')
    let input = []
    let data = ""
    for (let i = 0; i < els.length; i++) {
        if (els[i].value) {
            if (els[i].name == "csrf_token") {
                input[i] = els[i].name + '=' + els[i].value
                data = data + input[i] + "&"
            } else {
                input[i] = els[i].name + '=' + els[i].value
                data = data + input[i] + "&"
            }
        }
    }
    data = data.slice(0, -1)

    document.getElementById('pilihTahunKelas').addEventListener('click', (e) => {
        data = data + "&pilihtahun=" + tahun + "&submit="
        e.preventDefault()
        const xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementsByClassName('ajax-tambah-kelas')[0].innerHTML = this.responseText
                pilihKelas()
            } else {
                document.getElementsByClassName("ajax-tambah-kelas")[0].innerHTML = '<div class="d-flex justify-content-center align-items-center"><img src="/assets/img/greenloading.gif" height="40"></div>'
            }
        }
        xhr.open("POST", url[0] + "//" + url[2] + "/" + url[3] + "/redirectPilihKelas/")
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xhr.send(data)
    })

    function pilihKelas() {
        var kelas = document.getElementById('pilihkelas').value
        document.getElementById('pilihkelas').addEventListener('change', () => {
            kelas = document.getElementById('pilihkelas').value
        })
        document.getElementById('submitKelas').addEventListener('click', function swal(e) {
            e.preventDefault()
            const classname = document.getElementsByClassName('classname')
            for (let j = 0; j < classname.length; j++) {
                if (classname[j].value == kelas) {
                    var chosenClass = classname[j].innerHTML
                }
            }
            Swal.fire({
                title: 'Perhatian!',
                text: "Apakah anda benar-benar menjadi wali kelas " + chosenClass + " pada tahun ajaran " + tahun + "?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('formPilihKelas').submit()
                }
            })
        })
    }
</script>