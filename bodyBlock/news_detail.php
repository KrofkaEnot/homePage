<?php
$id = htmlspecialchars(trim($_GET['id']));
$pdo = require 'system/connect_db.php';
$query_news = "SELECT id,category,title,short_text,full_text,news_image,add_date,author_id FROM news WHERE id=?";
$result = $pdo->prepare($query_news);
$result->execute([$id]);

while ($news_item = $result->fetch(PDO::FETCH_ASSOC)) {
    echo <<<_HTML_
    <div class="news_item">
        
    <h2>$news_item[title]</h2>
        
        <div class="news_preview">
            <p><img src="$news_item[news_image]" alt="$news_item[title]" class="leftimg">
            $news_item[full_text]</p>
        </div>
        
        <span>Дата публикации: $news_item[add_date]</span>
        
        <span>Категория: $news_item[category]</span>
        <a class="news_link" href="show_news.php"><p>Список новостей</p></a>
        </div>
    _HTML_;
}
