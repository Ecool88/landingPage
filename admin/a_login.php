<?php
    ini_set('session.cookie_lifetime', 5);

    if ( !empty($_GET) ) {
        // 1. Запрос к БД на поиск пользователя с
        //     указанными данными
        include_once($_SERVER['DOCUMENT_ROOT'] . '/landing/admin/config.php');

        $password = md5(md5($_GET['pass']));
        $query = "  SELECT `id`, `admin`   
                    FROM `users` 
                    WHERE `password` = '{$password}' 
                    AND `login` = '{$_GET['login']}'
                    ";

        $result = $link -> query($query);

        if ($result -> num_rows != 0 ) {

            $userInfo = $result -> fetch_assoc();
            if ( $userInfo['admin'] == '1' ) {
                echo 'Привет, админ!';

                session_set_cookie_params(5);
                session_start();
                $_SESSION['admin'] = true;
                header('Location: http://localhost/landing/admin/a_home.php');

            }
        } else {
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
