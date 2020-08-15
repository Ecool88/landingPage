<?php
    include('parts/header.php');
?>

<div class="wrapper">
    <h3>Новости MyMoscow</h3>
    <div class="content">
        <?php
            include_once($_SERVER['DOCUMENT_ROOT'] . '/landing/config/config.php'); 
            if($link !== false){
                if(!isset($_GET['page'])) $page = 1; else $page = htmlspecialchars($_GET['page']);
                if(ctype_digit($page) === false) $page = 1;
                $count_query = mysqli_query($link, "select count(*) from news");
                $count_array = mysqli_fetch_array($count_query, MYSQLI_NUM);
                $count = $count_array[0];
                $limit = 5;
                $start = ($page * $limit) - $limit;
                $length = ceil($count / $limit);
            
                if((int)$page > $length || $page <= 0) $start = 0;  
            
                function pagination($length, $page){
                    if ($length < 5) foreach (range(1, $length) as $p)  echo '<a href="//localhost/landing/news.php?page='.$p.'">'.$p.'</a>';     
                    if ($length > 4 && $page < 5) foreach (range(1, 5) as $p)  echo '<a href="//localhost/landing/news.php?page='.$p.'">'.$p.'</a>'; 
                    if ($length - 5 < 5 && $page > 5 && $length - 5 > 0) foreach (range($length-4, $length) as $p)  echo '<a href="//localhost/landing/news.php?page='.$p.'"> '.$p.' </a>';
                    if ($length > 4 && $length - 5 < 5 && $page == 5) foreach (range($page-2, $length) as $p)  echo '<a href="//localhost/landing/news.php?page='.$p.'"> '.$p.' </a>';
                    if ($length > 4 && $length -5 > 5 && $page >= 5 && $page <= $length-4) foreach (range($page-2, $page+2) as $p)  echo '<a href="//localhost/landing/news.php?page='.$p.'"> '.$p.' </a>';
                    if ($length > 4 && $length - 5 > 5 && $page > $length - 4) foreach (range($length-4, $length) as $p)  echo '<a href="//localhost/landing/news.php?page='.$p.'"> '.$p.' </a>';
                };
            
                $query = "select * from news order by id desc limit $start, $limit";
                $res = mysqli_query($link, $query);
                if (!mysqli_num_rows($res)){
                    echo 'Новостей нет';
                }
                while ($item = mysqli_fetch_assoc($res)){
                    echo '<h4>Заголовок статьи:<span> ' . htmlspecialchars($item['title']) . '</span></h4>
                        <div class="news">
                        <span>Создатель статьи: ' . htmlspecialchars($item['autor']) . '</span>
                        <br><span>Дата публикации: ' . htmlspecialchars($item['date']) . '</span>
                        <br><br>Интро статьи: ' . nl2br(htmlspecialchars($item['intro']), false) . '                        
                        <br><br><a href="/landing/article.php?id='.$item['id'].'"><button class="more">Прочитать полностью статью</button></a>
                    </div>';
                };
                mysqli_close($link);
            }
        ?>
    </div>


    <div>
        <?php
            $next = $page + 1;
            if ($page > 4) echo '<a href="//localhost/landing/news.php?page=1" title="Начальная страница">В начало</a>';        
            pagination($length, $page);
            if ($page != $length) echo '<a href="//localhost/landing/news.php?page='.$next.'" title="Следующая страница">дальше</a>'; 
        ?>
    </div>

</div>

<?php
    include('parts/footer.php');
?>

<style>
    body > div.wrapper{
        margin-left: 50px;
        max-width: 1200px;    
        padding: 0;
    }
    body > div.wrapper > h3{
        color: #709dca;
        font-size: 1.3rem;
        margin: 0;
        margin-top: 2rem;
        text-align: center;
    }
    body > div.wrapper > h3:after{
        content: '';
        width: 200px;
        height: 2px;
        background-color: #e7ad48;
        display: block;
        margin-top: 7px;
        margin: 1rem auto;
    }
    body > div.wrapper > div.content{
        margin: 2rem;        
    }    
    body > div.wrapper > div.content > h4{
        color: #e7ad48;
        margin: 15px;
        font-size: 1.1rem;
        margin: 0;
        text-align: left;
    }  
    body > div.wrapper > div.content > h4 > span{
        color: #709dca;
        margin: 15px;
        font-size: 1.1rem;
        margin: 0;
        text-align: left;
        margin-bottom: 10px;
    }  
    body > div.wrapper > div.content > div.news{
        margin-bottom: 20px;
        padding: 20px 0 25px;
        border-bottom: 1px solid #ddd;
        font-size: 1.1rem;
        color: #394b50;
    }
    body > div.wrapper > div.content > div.news > span{
        font-size: 1rem;
        color: #394b50;
        text-shadow: 1px 1px 1px rgba(0,0,0,.4), 0 0 1em rgba(0,0,0,.4);
    }
    body > div.wrapper > div.content > div.news > span{
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    body > div.wrapper > div.content > div.news > a > button{
        cursor: pointer;
        height: 35px;
        background-color: #1e73be;
        color: white;
        border-radius: 15px;
        border: 2px solid #e7ad48;
        font-size: 1.1rem;
        padding: 5px;
    }
    body > div.wrapper > div:last-child{
        text-align: center;
    }
    body > div.wrapper > div > a{
    margin: 0 4px;
    border-radius: 19px;
    display: inline-block;
    min-width: 38px;
    font-size: 18px;
    line-height: 38px;
    text-align: center;
    color: #333;
    cursor: pointer;
    text-decoration: none;    
}

body > div.wrapper > div > a:hover{
    background: #ffeba0;
}
</style>

