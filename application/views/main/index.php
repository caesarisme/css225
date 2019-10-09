<p>Главная страница</p>

<?php foreach ($news as $article): ?>
    <h3><?= $article['title'] ?></h3>
    <p><?= $article['description'] ?></p>
    <hr>
<?php endforeach; ?>