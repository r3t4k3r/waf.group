<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Mail.php';

    $email = @$_POST['email'];
    $password = @$_POST['password'];

    $userData = $db->prepare('SELECT * FROM `users` WHERE `email` = :email AND `password` = :password');
    $userData->execute(['email' => $email, 'password' => $password]);
    $userData = $userData->fetch();

    if(!$userData) {
        error('E-Mail или пароль введён неверно.');
    }
    
    if ( !function_exists('random_bytes') ) {
        function random_bytes($length = 6) {
            $characters = '0123456789';
            $characters_length = strlen($characters);
            $output = '';
            for ($i = 0; $i < $length; $i++)
                $output .= $characters[rand(0, $characters_length - 1)];
            
            return $output;
        }
    }
    
    $key = base64_encode(random_bytes(512));

    $session = $db->prepare('INSERT INTO `sessions` (`id`, `hash`, `account`) VALUES (NULL, :key, :account)');
    $session->execute(['key' => $key, 'account' => $userData['id']]);

    setcookie('key', $key, time() + (60 * 60 * 24 * 30 * 365), '/');

    function getUserIP() {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
        return $ip;
    }

    $_SERVER['REMOTE_ADDR'] = getUserIP();

    $msg = 'Здравствуйте! В Ваш аккаунт только что был произведен вход с IP-адреса <b>' . $_SERVER['REMOTE_ADDR'] . '</b>. Если это были не Вы, то срочно смените пароль в настройках аккаунта.<br><br>С уважением, хостинг-провайдер WaF';

    send(array('email' => $email, 'subject' => 'Произведен вход в Ваш аккаунт', 'text' => $msg));

    success('Вы успешно авторизировались!');
?>