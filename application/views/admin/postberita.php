<div class="container pb-4 pt-4 d-flex justify-content-center">

    <form method="post" class="col-md-8">
        <input type="hidden" class="srctoken" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
        <textarea class="form-control" name="content" id="editor" rows="3" autofocus></textarea>
        <button type="submit" name="submit" class="btn btn-primary mt-3">Post</button>
    </form>

</div>