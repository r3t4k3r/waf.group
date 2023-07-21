<?php
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';
    
    $cookie = @$_COOKIE['key'];
    
    $session = $db->prepare('SELECT * FROM `sessions` WHERE `hash` = :code');
    $session->execute(['code' => $cookie]);
    $session = $session->fetch();
    
    if (!$session) {
        
        error($recapthca['public']);
    }
    
    $user = $db->prepare('SELECT * FROM `users` WHERE `id` = :code');
    $user->execute(['code' => $session['account']]);
    $user = $user->fetch();
    
    $user = array_merge($user, array('recaptcha' => $recapthca['public']));
    
    unset($user['password']);
    unset($user['2']);
    
    $deposits = $db->prepare('SELECT SUM(`balance`) FROM `payments` WHERE `account` = :code');
    $deposits->execute(['code' => $session['account']]);
    $deposits = $deposits->fetchAll();
    
    $services = $db->prepare('SELECT `id` FROM `vps` WHERE `account` = :code');
    $services->execute(['code' => $session['account']]);
    $services = $services->fetchAll();
    
    $user['deposits'] = number_format($deposits[0][0]);
    
    $user['services'] = count($services);
    
    $user['balance'] = number_format($user['balance']);
    
    success($user);
?>