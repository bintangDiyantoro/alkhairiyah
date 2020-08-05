<div class="form-group custom-file mb-2 mt-2">
    <div>
        <input type="file" class="custom-file-input" name="attachment<?= (int)$this->uri->segment(3) + 1 ?>">
        <label class="custom-file-label mr-2" for="attachment<?= (int)$this->uri->segment(3) + 1 ?>">Pilih file</label>
    </div>
</div>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>