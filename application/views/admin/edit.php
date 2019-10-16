<div id="form">
    <div class="form-wrapper">
        <h2><?php echo $title; ?></h2>
        <form action="/admin/edit/<?php echo $post['id']; ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($post['title'], ENT_QUOTES); ?>">
            <textarea name="content" cols="30" rows="10"><?php echo htmlspecialchars($post['content'], ENT_QUOTES); ?></textarea>
            <select name="category_id">
                <option value="">--Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?php if ($category['id']==$post['category_id']) echo 'selected'; ?> ><?= $category['title'] ?></option>
                <?php endforeach ?>
            </select>
            <input type="file" name="image">
            <input type="submit" name="submit" value="Save">
        </form>
    </div>
</div>