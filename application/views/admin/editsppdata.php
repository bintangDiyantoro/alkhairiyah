<div class="container">
    <div class="row">
        <form action="" method="get">
            <div class="input-group mb-3 mt-3 ml-3">
                <input type="hidden" class="csrf-token" name="csrf_token" value="<?= $csrf['hash'] ?>">
                <input type="text" class="form-control no-induk" placeholder="No. Induk" aria-label="Cari data spp dengan No. Induk" maxlength="4">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="search">Cari Data</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row hasil-pencarian-spp"></div>
</div>