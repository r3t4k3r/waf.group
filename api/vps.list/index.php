<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';

    $auth = checkAuth($db);

    if(!$auth['id']) {
        error('Пользователь не авторизован');
    }

    $response = $db->prepare('SELECT * FROM `vps` WHERE `account` = :id');
    $response->execute(['id' => $auth['id']]);
    $response = $response->fetchAll();

    for($i = 0; $i < count($response); $i++) {
        $tariffData = $db->prepare('SELECT * FROM `tariffs` WHERE `id` = :id');
        $tariffData->execute(['id' => $response[$i]['tariffid']]);
        $tariffData = $tariffData->fetch();

        $response[$i]['price'] = $tariffData['tariff.price'];
    }

    success($response);
?>