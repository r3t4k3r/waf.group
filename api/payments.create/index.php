<?php
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';

    $method = @$_GET['method'];
    $amount = @$_GET['num'];

    $auth = checkAuth($db);

    if (!$auth['id']) {
        
        header('Location: https://portal.waf.group/');
    }
    
    if ($method == 'enot') {
        
        $payment = round(microtime(true));
        
        $sign = md5($enot['shop_id'] .':'. $amount .':'. $enot['secret_key'] .':'. $payment);
        
        $url = 'https://enot.io/pay?m='. $enot['shop_id'] .'&oa='. $amount .'&o='. $payment .'&s='. $sign .'&cf='. $auth['id'];
        
        header('Location: '. $url);
    }
?>