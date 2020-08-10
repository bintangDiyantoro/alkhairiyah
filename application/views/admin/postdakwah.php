<div class="container pt-4 pb-3 d-flex justify-content-center">

    <form method="post" class="col-md-8">
        <input type="hidden" class="srctoken" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
        <textarea class="form-control" name="content" id="editor" rows="3" autofocus></textarea>
        <button type="submit" name="submit" class="btn btn-primary mt-3">Post</button>
    </form>

</div>
<script src="<?= base_url('assets/js/ckeditor.js') ?>"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                options: {
                    resourceType: 'Images'
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>