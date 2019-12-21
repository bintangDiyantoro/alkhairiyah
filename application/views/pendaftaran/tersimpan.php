<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-md-6 justify-content-center">
            <h1>Daftar calon siswa</h1>
            <table class="table table-hover table-success mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col">Nama</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($calon_siswa as $cs) : ?>
                        <tr>
                            <th scope="row" class="text-center"><?= ++$start ?></th>
                            <td class="text-center">
                                <?php
                                $zeroes = '000';
                                $cs['id'] = (string) $cs['id'];
                                echo 'CS-' . substr($zeroes . $cs['id'], -4, 4);
                                ?>
                            </td>
                            <td><?= $cs['nama'] ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('pendaftaran/detail/' . $cs['id']) ?>" class="badge badge-primary badge-pill detail">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links() ?>
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