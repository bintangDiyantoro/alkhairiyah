</div>
<?= form_error('verified', '<small class="text-danger pl-3">', '</small>') ?>
<input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
<div class="row d-flex justify-content-center">
    <div class="col-md-6 mt-3">
        <button type="submit" class="btn btn-primary float-right" name="submit-btn" id="submit-btn">Kirim Data</button>
    </div>
</div>