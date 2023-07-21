<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Api.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/DataBase.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/Mail.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/engine/vm.php';

    $auth = checkAuth($db);

    if(!$auth['id']) {
        error('Пользователь не авторизован');
    }

    $tariffname = @$_POST['tariffname'];
    $osname = @$_POST['osname'];

    $userData = $db->prepare('SELECT * FROM `users` WHERE `id` = :id');
    $userData->execute(['id' => $auth['id']]);
    $userData = $userData->fetch();

    $tariffData = $db->prepare('SELECT * FROM `tariffs` WHERE `tariff.name` = :tariffname');
    $tariffData->execute(['tariffname' => $tariffname]);
    $tariffData = $tariffData->fetch();

    if(!$tariffData) {
        error('Не удалось найти тарифный план!');
    }

    $osData = $db->prepare('SELECT * FROM `ostempl` WHERE `os.name` = :name');
    $osData->execute(['name' => $osname]);
    $osData = $osData->fetch();

    if(!$osData) {
        error('Выберите операционную систему.');
    }

    if(preg_match("/window/", mb_strtolower($osData['os.name']))) {
        if($tariffData['win'] != 1) {
            error('Вы не можете выбрать данную ОС для данного тарифа.');
        }
    }

    if($userData['balance'] < $tariffData['tariff.price']) {
        error('Недостаточно средств.');
    }

    $user = $tariffData['win'] == 1 ? 'Administrator' : 'root';
    $password = md5(microtime(true));

    $cluster = json_decode($tariffData['clusters'], 1);
    $node = json_decode($tariffData['nodes'], 1);
    $storage = json_decode($tariffData['storages'], 1);

    $cluster = $cluster[mt_rand(0, count($cluster) - 1)];
    $node = $node[mt_rand(0, count($node) - 1)];
    $storage = $storage[mt_rand(0, count($storage) - 1)];

    $ip = $db->prepare('SELECT * FROM `ips` WHERE `node` = :node AND `use` = 0 LIMIT 1');
    $ip->execute(['node' => $node]);
    $ip = $ip->fetch();
    $ip = @$ip['ip'];
    
    if ($tariffData['dedicated'] == 1) {
        
        $request = createVM($cluster, $node, $storage, $osData['os.id'], $tariffData['ram'], $tariffData['rom'], $tariffData['cpus'], $ip, $password);
        
       if(!$request) {
        error('Ошибка создания сервера, обратитесь в ТП.');
    }
        
        $update = $db->prepare('UPDATE `ips` SET `use` = 1 WHERE `ip` = :ip');
        
        $update->execute(['ip' => $ip]);
        
        $insert = $db->prepare('INSERT INTO `vps`(`id`, `tariffid`, `vps.ip`, `vps.user`, `vps.password`, `vmmgr.id`, `status`, `date.end`, `account`) VALUES (NULL, :tariffid, :ip, :user, :pass, :vmmgrid, 1, :dateend, :id)');
        $insert->execute(['ip' => $ip, 'vmmgrid' => $request, 'id' => $auth['id'], 'tariffid' => $tariffData['id'], 'user' => $user, 'pass' => $password, 'dateend' => date('Y-m-d', (time() + (60 * 60 * 24 * 30)))]);
        
        $update = $db->prepare('UPDATE `users` SET `balance` = `balance` - :price WHERE `id` = :id');
        $update->execute(['price' => $tariffData['tariff.price'], 'id' => $auth['id']]);
        
        send(array('email' => $userData['email'], 'subject' => 'Обработка виртуального сервера', 'text' => 'Здравствуйте! Вы только что заказали виртуальный сервер за <b>' . $tariffData['tariff.price'] . ' RUB</b>. Сервер будет отправлен на установку в течение 60-ти секунд, установка займет до 5-ти минут, пожалуйста, ожидайте.<br><br>С уважением, хостинг-провайдер WaF'));
        
        success('VPS сервер обрабатывается');
    } else {
        
        $data = [
            'chat_id' => '1929445518',
            'text' => 'Заказали выделеный сервер за '. $tariffData['tariff.price'] .'₽, тарифный план '. $tariffData['tariff.name']
        ];
        
        $token = '5754016872:AAEBABw6r8RbBxYM4tzZq05C2YXWYTadkvg';
        
        file_get_contents('https://api.telegram.org/bot'. $token .'/sendMessage?'. http_build_query($data));
        
        success('Выделенный сервер обрабатывается');
    }
?>