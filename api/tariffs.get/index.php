<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';
    
    $db->query("SET NAMES 'utf8'");
    $db->query("SET CHARACTER SET utf8");
    
    $tariffs = $db->query('SELECT * FROM `tariffs`')->fetchAll();
    $response = array();

    foreach($tariffs as $tariff) {
        if($tariff['tariff.status'] == 1 and $tariff['dedicated'] == 1) {
            $tariff['q'] = $tariff['billmanager.handler'];

            unset($tariff['billmanager.handler']);
            unset($tariff['datacenter']);
            unset($tariff['billmanager.tariffid']);

            array_push($response, $tariff);
        }
    }

    success(json_encode($response));
?>