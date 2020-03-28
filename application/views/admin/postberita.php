<div class="container pb-3">
    <h1>Post Berita Baru</h1>

    <form method="post">
        <input type="hidden" class="srctoken" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
        <textarea class="form-control" name="content" id="editor" rows="3" autofocus></textarea>
        <button type="submit" name="submit" class="btn btn-primary mt-3">Post</button>
    </form>

</div>