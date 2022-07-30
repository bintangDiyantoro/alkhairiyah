<div class="input-group">
    <select class="custom-select" id="ekskulSelect">
        <?php foreach ($ekskul as $e) : ?>
            <option value="<?= $e["id"] ?>"><?= $e["ekskul"] ?></option>
        <?php endforeach ?>
    </select>
</div>