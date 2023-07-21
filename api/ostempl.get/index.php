<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';

    $billmgr = @$_POST['q'];

    $ostempl = $db->prepare('SELECT * FROM `ostempl`');
    $ostempl->execute(['id' => $billmgr]);
    success($ostempl->fetchAll());
?>