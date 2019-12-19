<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col">
            <h1>Daftar calon siswa</h1>
            <ul class="list-group col-md-5">
                <?php foreach($calon_siswa as $cs):?>
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <?= $cs['nama'] ?>
                    <a href="<?= base_url('pendaftaran/detail/'.$cs['id'])?>" class="badge badge-primary badge-pill detail">Detail</a>
                </li>
                <?php endforeach;?>
            </ul>
            <input type="hidden" name="tersimpan" id="tersimpan" value="ok">
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">
                    <h1>Sabar ya tadz!</h1>
                    <h2>Masih proses</h2>
                    <span class="text-center" style='font-size:100px;'>&#128540;</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal-close" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>