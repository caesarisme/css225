<section id="index">
    <h2>Starred posts:</h2>
    <div class="news-wrapper">
        <?php foreach ($posts as $post): ?>
            <article>
                <div class="article-img">
                    <img src="<?= $post['image'] ?>" alt="">
                </div>
                <div class="article-info">
                    <h4><?= $post['title'] ?></h4>
                    <p>
                        <?= substr($post['content'], 0, 300) ?>
                    </p>
                    <a href="/admin/edit/<?= $post['id'] ?>" class="btn-edit">Edit</a>
                    <a href="/admin/delete/<?= $post['id'] ?>" class="btn-delete">Delete</a>
                </div>
            </article>
        <?php endforeach; ?>

    </div>
</section>