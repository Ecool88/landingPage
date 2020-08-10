<?php 
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'web0812'
    );
    mysqli_set_charset($link , "utf8");    

    if(!empty($_POST)){
        if(
            !empty($_POST['name']) && !empty($_POST['message']) 
        ){
            $query = "insert into reviews(name, message) 
                values('" . htmlspecialchars($_POST['name']) . "',
                '" . htmlspecialchars($_POST['message']) . "')";
            $res = mysqli_query($link, $query);
            if($res){
                $success = true;
                $_POST = [];
            }
            else{
                $success = false;
            }
        }
    }
?>

<?php
    include('parts/header.php');
?>

<section class='form'>
    <form method="post" action="">
        <h3>Оставьте отзыв о экскурсии</h3>
        <div class='row'>
            <div>
                <input type="text" name="name" placeholder="Как вас зовут" required/>
                <button type="submit">Отправить отзыв</button>
            </div>
            <div>
                <textarea name="message" placeholder="Ваше сообщение" required></textarea>                
            </div>
        </div>
        
    </form>
</section>

<h1>Список отзывов</h1>

<?php
    if($link !== false){
        if(!isset($_GET['page'])) $page = 1; else $page = htmlspecialchars($_GET['page']);
        if(ctype_digit($page) === false) $page = 1;
        $count_query = mysqli_query($link, "select count(*) from reviews");
        $count_array = mysqli_fetch_array($count_query, MYSQLI_NUM);
        $count = $count_array[0];
        $limit = 5;
        $start = ($page * $limit) - $limit;
        $length = ceil($count / $limit);
    
        if((int)$page > $length || $page <= 0) $start = 0;  
    
        function pagination($length, $page){
            if ($length < 5) foreach (range(1, $length) as $p)  echo '<a href="//localhost/landing/reviews.php?page='.$p.'">'.$p.'</a>';     
            if ($length > 4 && $page < 5) foreach (range(1, 5) as $p)  echo '<a href="//localhost/landing/reviews.php?page='.$p.'">'.$p.'</a>'; 
            if ($length - 5 < 5 && $page > 5 && $length - 5 > 0) foreach (range($length-4, $length) as $p)  echo '<a href="//localhost/landing/reviews.php?page='.$p.'"> '.$p.' </a>';
            if ($length > 4 && $length - 5 < 5 && $page == 5) foreach (range($page-2, $length) as $p)  echo '<a href="//localhost/landing/reviews.php?page='.$p.'"> '.$p.' </a>';
            if ($length > 4 && $length -5 > 5 && $page >= 5 && $page <= $length-4) foreach (range($page-2, $page+2) as $p)  echo '<a href="//localhost/landing/reviews.php?page='.$p.'"> '.$p.' </a>';
            if ($length > 4 && $length - 5 > 5 && $page > $length - 4) foreach (range($length-4, $length) as $p)  echo '<a href="//localhost/landing/reviews.php?page='.$p.'"> '.$p.' </a>';
        };
    
        $query = "select * from reviews order by id desc limit $start, $limit";
        $res = mysqli_query($link, $query);
        if (!mysqli_num_rows($res)){
            echo 'Отзывы отсутствуют';
        }
        while ($item = mysqli_fetch_assoc($res)){
            echo '<div class="reviews">
                <span>Отправитель: ' . htmlspecialchars($item['name']) . '</span>
                Отзыв: ' . nl2br(htmlspecialchars($item['message']), false) . '
            </div>';
        };
        mysqli_close($link);
    }
?>

<div>
    <?php
        $next = $page + 1;
        if ($page > 4) echo '<a href="//localhost/landing/reviews.php?page=1" title="Начальная страница">В начало</a>';        
        pagination($length, $page);
        if ($page != $length) echo '<a href="//localhost/landing/reviews.php?page='.$next.'" title="Следующая страница">дальше</a>'; 
    ?>
</div>

<?php
    include('parts/footer.php');
?>

<style>
/* Стиль вкладки отзывов */
body{
    margin-left: 50px;
    padding: 0;
    background-color: rgba(0,0,0,.06);
    max-width: 1200px;    
}
section.form{
    padding: 2rem 0;
    width: 100%;
}

section.form > form > h3{
    color: #709dca;
    text-transform: uppercase;
    font-size: 1.3rem;
    margin: 0;
    margin-bottom: 2rem;
    text-align: center;
}
section.form > form > h3:after{
    content: '';
    width: 200px;
    height: 2px;
    background-color: #e7ad48;
    display: block;
    margin-top: 7px;
    margin: 1rem auto;
}
section.form > form > div.row{
    display: flex;
    justify-content: space-evenly;    
}
section.form > form > div.row > div{
    width: 45%;
    display: flex;
    flex-direction: column;
}
section.form > form > div.row > div > input,
section.form > form > div.row > div > button{
    border: 2px solid #ffc155;
    font-size: 1.2rem;
    padding: 5px;
}
section.form > form > div.row > div > input{
    margin-bottom: 10px;
}
section.form > form > div.row > div > button{
    border: 2px solid #ffc155;
    background-color: #273a43;
    padding: 10px 0;
    color: white;
    font-size: 1.1rem;
}
section.form > form > div.row > div > textarea{
    height: 100%;
    box-sizing: border-box;
    resize: none;
    min-height: 5rem;
    border: 2px solid #ffc155;
    font-size: 1.2rem;
    padding: 5px;
}

h1{
    color: #eac336;
    font-size: 35px; 
    /* transform: translate(-50%, -50%); */
    text-align: center;  
    text-shadow: 1px 1px 1px rgba(0,0,0,.7), 0 0 1em rgba(0,0,0,.7);
}

div > a{
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

div > a:hover{
    background: #ffeba0;
}

.reviews{
    background: #d5dde6;
    color: #000;
    padding: 15px;
    border-radius: 10px;
    margin: 10px 0;
    width: 90%;
}
.reviews > span{
    display: block;
    font-size: 12px;
    margin-bottom: 10px;
}
</style>