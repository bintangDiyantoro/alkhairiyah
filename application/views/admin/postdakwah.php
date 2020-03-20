<div class="container">
    <h1>Buat Artikel Dakwah</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="srctoken" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
        <textarea class="form-control" name="content" id="editor" rows="3" autofocus></textarea>
        <button type="submit" name="submit" class="btn btn-primary mt-3">Post</button>
    </form>
</div>