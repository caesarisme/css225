<div id="form">
    <div class="form-wrapper">
        <h2><?php echo $title; ?></h2>
        <form action="/admin/add" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title">
            <textarea name="content" cols="30" rows="10">Article content</textarea>
            <select name="category_id">
                <option value="">--Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endforeach ?>
            </select>
            <input type="file" name="image">
            <input type="submit" name="submit" value="Save">
        </form>
    </div>
</div>