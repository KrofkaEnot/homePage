<?php
$pdo = require 'system/connect_db.php';
$query_news = "SELECT news.id as id_news,first_name,last_name,avatar,authors.id as id_authors,category,title,short_text,full_text,news_image,add_date FROM authors,news WHERE authors.id = news.author_id";
$result = $pdo->query($query_news);

while ($news_item = $result->fetch(PDO::FETCH_ASSOC)) {
    echo <<<_HTML_
    <div class="news_item">
        
        <h2>$news_item[title]</h2>
            
            <div class="news_preview">
                <img src="$news_item[news_image]" alt="$news_item[title]">
                <p>$news_item[short_text]</p>
            </div>
            
            <span>Дата публикации: $news_item[add_date]</span>
            <span>Автор: $news_item[last_name] $news_item[first_name]</span>
            <span>Категория: $news_item[category]</span>
            <a class="news_link" href="news_detail.php?id=$news_item[id_news]"><p >По подробнее ка.....</p></a>
     </div>
    _HTML_;
}

// $news_item[avatar]
// $news_item[full_text]

// function d($arr)
// {
//     echo "<pre>";
//     print_r($arr);
//     echo "</pre><hr>";
// }
