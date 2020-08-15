<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] . '/landing/functions/functions.php');
    // ini_set('session.gc_maxlifetime', 5);
    // ini_set('session.cookie_lifetime', 5);
    // ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] .'/sessions');

    checkUser('admin');
    // echo session_name() . '<br>';
    // echo session_id() . '<br>';

    // echo 'Привет, админ';

    // session_destroy();
?>

<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . '/landing/config/config.php');   

    if(!empty($_POST)){        
        $query = "insert into news(title, intro, autor, text) 
            values('" . htmlspecialchars($_POST['title']) . "',
            '" . htmlspecialchars($_POST['intro']) . "',
            '" . htmlspecialchars($_POST['autor']) . "',
            '" . htmlspecialchars($_POST['text']) . "')";
        $res = mysqli_query($link, $query);
        if($res){
            $success = true;
            $_POST = [];
        }
        else{
            $success = false;
        }
    }    
    # Если кнопка нажата
    if( isset( $_GET['logout'] ) )
    {    
        session_destroy();    
        header('Location: http://localhost/landing/admin/a_home.php');        
    }
?>



<form method="GET">
    <input type="submit" name="logout" value="Выход" />
</form>



<form method="post" action="">
    <h3>Добавьте новость</h3><br>
    <div>
        <label for="title">Заголовок статьи</label>
        <input type="text" name="title">
    </div>
    <div>
        <label for="autor">Автор статьи</label>
        <input type="text" name="autor">
    </div>
    <div>
        <label for="intro">Введите интро статьи</label>
        <textarea name="intro"></textarea>
    </div>
    <div>
        <label for="text">Введите статью</label>
        <textarea name="text"></textarea>
    </div>
    <div class="wrapper-button">
        <button type="submit">Добавить статью</ button>   
    </div> 
</form>
<a href="/landing/admin/feedbacks.php"><button>Посмотреть заявки</button></a>


<style>
    body{
        background-color: rgba(0,0,0,.06);
    }
    form:first-child{
        margin: 0;
        position: absolute;
        top: 10px;
        right: 10px;
    }
    form:first-child > input{
        cursor: pointer;
        height: 25px;
        background-color: #1e73be;
        color: white;
        border-radius: 3px;
        border: 1px solid #1e73be;
        font-size: 1.1rem;
    }
    h3{
        font-size: 1.6rem;
        text-transform: uppercase;
        display: inline-block;
        line-height: 40px;
        border-bottom: 2px solid #1e73be;
    }    
    form{
        display: block;
        text-align: left;
    }
    form > div{
        width: 600px;
        margin-bottom: 15px;
        display: flex;
    }
    form > div > label{
        width: 100px;
        font-weight: 500;
        font-size: 1rem;
        line-height: 20px;
        text-align: left;
        color: #333;  
        margin-right: 50px;      
    }
    form > div > input{
        width: 450px;
        height: 26px;
        color: #333;
        line-height: 26px;
        border-radius: 2px;
        background: white;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        padding: 4px 6px;
        text-align: left;
    }
    form > div > textarea{
        width: 450px;
        height: 200px;
        color: #333;
        line-height: 26px;
        border-radius: 2px;
        background: white;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        padding: 4px 6px;
        text-align: start;
        resize: none;
    }    form > div > textarea:first-child{
        height: 100px;
    }
    form > div.wrapper-button{
        display: flex;    
        justify-content: center;    
        width: 600px;
    }
    form > div.wrapper-button > button{        
        cursor: pointer;
        width: 80%;
        height: 25px;
        background-color: #1e73be;
        color: white;
        border-radius: 3px;
        border: 1px solid #1e73be;
        font-size: 1.1rem;
    }
    body > a{
        margin: 0;
        position: absolute;
        top: 10px;
        right: 90px;
    }
    body > a > button{
        cursor: pointer;
        height: 25px;
        background-color: #1e73be;
        color: white;
        border-radius: 3px;
        border: 1px solid #1e73be;
        font-size: 1.1rem;
    }
</style> 