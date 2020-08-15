<?php
    ini_set('session.cookie_lifetime', 5);
    // print_r($_GET);

    if ( !empty($_GET) ) {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/landing/config/config.php');

        $password = md5(md5($_GET['pass']));
        $query = "  SELECT `id`, `admin`   
                    FROM `users` 
                    WHERE `password` = '{$password}' 
                    AND `login` = '{$_GET['login']}'
                    ";

        $result = $link -> query($query);

        if ($result -> num_rows != 0 ) {

            $userInfo = $result -> fetch_assoc();
            // print_r($userInfo);
            if ( $userInfo['admin'] == 1 ) {
                echo 'Привет, админ!';

                session_set_cookie_params(3600);
                session_start();
                $_SESSION['admin'] = true;
                header('location: /landing/admin/a_home.php');

            } } else {
            echo 'Такого пользователя не существует! =(';
        };        
    }
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход в панель администратора</title>
</head>
<body>
    <h1>Вход в панель администратора</h1>
    <form action="" method="GET">
        <input type="text" name="login" placeholder="Укажите логин"><br>
        <input type="password" name="pass" placeholder="Укажите пароль"><br>
        <input type="submit" value="войти">
    </form>
</body>
</html>


<style>
    body{
        text-align: center;
        display: block;
    }
    h1{
        margin-bottom: 15px;
        font-size: 20px;        
    }
    form{        
        font-size: 13px;
    }
    form > input{
        margin-bottom: 10px;
        width: 270px;
        padding: 6px 12px 8px;
        border-radius: 3px;
        border: 1px solid grey;
        background: white;
        font-size: 14px;
        box-sizing: border-box;
    }
    form > input:last-child{
        background: #0dbbbb;
    }
</style> 