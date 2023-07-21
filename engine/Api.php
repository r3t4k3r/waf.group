<?php
    function success($value) {
        $response = array();
        $response['type'] = 'success';
        $response['success'] = $value;

        exit(json_encode($response));
    }

    function error($value) {
        $response = array();
        $response['type'] = 'error';
        $response['error'] = $value;

        exit(json_encode($response));
    }

    function checkAuth($db) {
        $cookie = @$_COOKIE['key'];

        $session = $db->prepare('SELECT * FROM `sessions` WHERE `hash` = :key');
        $session->execute(['key' => $cookie]);
        $session = $session->fetch();

        return array('cookie' => $cookie, 'id' => (!$session ? false : $session['account']));
    }
?>