<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';

    $page = preg_replace('/\\?.*/', '', str_replace(array('../'), '', @$_POST['page']));

    if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/views' . $page . '.php')) {
        success(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/views' . $page . '.php'));
    } else {	
        error('Страница `' . $page . '` не найдена.');
    }
?> 