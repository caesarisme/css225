<section id="index">
    <h2>Posts:</h2>

    <div class="filter">
        <h3>Filter news:</h3>
        <form action="/api/filter" method="POST">
            <label>By title
                <input type="text" name="title" placeholder="title">
            </label>
            <label>By date from
                <input type="date" name="date_from">
            </label>
            <label>to
                <input type="date" name="date_to">
            </label>
            <label>By category
                <select name="category_id">
                    <option value="">--Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endforeach ?>
                </select>
            </label>
            <input type="submit" value="Filter">
        </form>
    </div>

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
                    <a href="/post/<?= $post['id'] ?>" class="btn-more">More</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<script src="/public/js/fetch_form.js"></script>

