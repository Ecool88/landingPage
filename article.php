<?php
    include('parts/header.php');
    $id = $_GET['id'];
?>

<div class="wrapper">
    <div class="content">
        <?php
            include_once($_SERVER['DOCUMENT_ROOT'] . '/landing/config/config.php'); 
            if($link !== false){                
                $query = "select * from news where id={$id}";
                $res = mysqli_query($link, $query);

                while ($item = mysqli_fetch_assoc($res)){
                    echo '<h2>' . htmlspecialchars($item['title']) . '</h2>
                        <div class="news">
                        <span>Создатель статьи: ' . htmlspecialchars($item['autor']) . '</span>
                        <br><span>Дата публикации: ' . htmlspecialchars($item['date']) . '</span>
                        <div class="intro"><br><br>Интро статьи: ' . nl2br(htmlspecialchars($item['intro']), false) . '</div>                        
                        <br><br>Статья: ' . nl2br(htmlspecialchars($item['text']), false) . '
                    </div>';
                };

                if(!isset($_GET['page'])) $page = 1; else $page = htmlspecialchars($_GET['page']);
                if(ctype_digit($page) === false) $page = 1;
                $count_query = mysqli_query($link, "select count(*) from news");
                $count_array = mysqli_fetch_array($count_query, MYSQLI_NUM);
                $count = $count_array[0];
            }
        ?>
    


        <div class="pagination">
            <a href="//localhost/landing/news.php" title="Новости">К новостям</a>
            <?php
                $next = $id + 1;
                $previous = $id - 1;
                if ($id != 1) echo '<a href="//localhost/landing/article.php?id='.$previous.'" title="Предыдущая статья">Предыдущая статья</a>';
                if ($id != $count) echo '<a href="//localhost/landing/article.php?id='.$next.'" title="Следующая статья">Следующая статья</a>'; 
            ?>
        </div>

        <section class='form'>
            <form method="post" action="">
                <h3>Оставьте отзыв о статье</h3>
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

        <?php 
            if(!empty($_POST)){
                if(
                    !empty($_POST['name']) && !empty($_POST['message']) 
                ){
                    $query = "insert into comment(name, article_id, message) 
                        values('" . htmlspecialchars($_POST['name']) . "',
                        '" . $id . "',
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

        <h3>Список отзывов</h3>

        <?php
            if($link !== false){
                $query = "select * from comment where article_id={$id} order by id desc";
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

    </div>
</div>

<?php
    include('parts/footer.php');
?>


<style>
    body > div.wrapper{
        margin-left: 50px;
    }
    body > div.wrapper > div.content{
        margin: 2rem;
    }
    body > div.wrapper > div.content > h2{
        color: #e7ad48;
        font-size: 2rem;
        margin-bottom: 1rem;
        text-align: center;
    }
    body > div.wrapper > div.content > h2:after{
        content: '';
        width: 400px;
        height: 2px;
        background-color: #3498db;
        display: block;
        margin-top: 7px;
        margin: 1rem auto;
    }
    body > div.wrapper > div.content > div.news{
        margin-bottom: 20px;
        padding: 20px 0 25px;
        border-bottom: 1px solid #ddd;
        font-size: 1.2rem;
        color: #394b50;
    }
    body > div.wrapper > div.content > div.news > span{
        font-size: .9rem;
        color: #709dca;
        text-shadow: 1px 1px 1px rgba(0,0,0,.4), 0 0 1em rgba(0,0,0,.4);
    }   
    body > div.wrapper > div.content > div.news > div.intro{
        font-size: 1rem;
        color: #394b50;
    }
    body > div.wrapper > div.content > div.pagination{
        text-align: center;
    }
    body > div.wrapper > div.content > div > a{
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

body > div.wrapper > div.content > div > a:hover{
    background: #ffeba0;
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
h3{
    color: #eac336;
    font-size: 35px; 
    text-align: center;  
    text-shadow: 1px 1px 1px rgba(0,0,0,.7), 0 0 1em rgba(0,0,0,.7);
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