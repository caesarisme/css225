<div id="form">
    <div class="form-wrapper">
        <h2><?php echo $title; ?></h2>
        <form action="/admin/edit/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($data['title'], ENT_QUOTES); ?>">
            <textarea name="content" cols="30" rows="10"><?php echo htmlspecialchars($data['content'], ENT_QUOTES); ?></textarea>
            <input type="file" name="image">
            <input type="submit" name="submit" value="Save">
        </form>
    </div>
</div>