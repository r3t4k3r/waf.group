<?php
include_once "security/config.php";
include_once "security/project-security.php";
    $config = array(
        'db' => array(
            'host' => 'aws.connect.psdb.cloud',
            'port' => '3306',
            'ssl_ca' => true,
            'user' => '4ey70b672wme3p3520o2',
            'pass' => 'pscale_pw_MVSzVMIr4YvjKgKQfZeeMkfKPCOBA5goCig6sDQavOz',
            'name' => 'adenobill'
        )
    );
    
    $enot = array(
        'secret_key' => '32d9fbeb87f81b48a1a56996e900f98b5511d54c',
        'subkey' => '1f526e7e294e5803c5eeb22b35ede568dd94012e',
        'shop_id' => '73040'
    );
    
    $recapthca = array(
        'public' => '6LfLnbomAAAAAALy17WktBaM9I89JDRYkVY8FNEZ',
        'secret' => '6LfLnbomAAAAAA-WrQL5WJZxJqSvZ-y7lGHuNupG'
    );
    
    $mail = array(
        'email' => 'noreply@waf.group',
        'password' => 'eoUDF8wlFcsC5gNu',
        'name' => 'Хостинг-провайдер WaF'
    );
?>