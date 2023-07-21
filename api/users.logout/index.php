<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';
    
    setcookie('key', '', -1, '/');

    success('OK');
?>