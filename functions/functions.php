<?php
    
    // 1. Записать время старта сессии 

    function checkUser($status): bool {
        session_set_cookie_params(3600);
        
        session_start();

        // print_r( session_get_cookie_params() );
        $status = $_SESSION[$status];
        if (!$status) {
            header('Location: http://localhost/landing/admin/a_login.php');
            die();
        }
        $lifetime = 60;
        // setcookie(session_name(), session_id(), time() + $lifetime);
        return true;
    }
?>

