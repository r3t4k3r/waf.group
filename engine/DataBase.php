<?php

    class Database {

        public function connect() {

            global $config;

            try {
                $options = [];
                if ($config['db']['ssl_ca']) {
                  $options[PDO::MYSQL_ATTR_SSL_CA] = '/etc/ssl/certs/ca-certificates.crt';
                }
                $connect = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'], $config['db']['user'], $config['db']['pass'], $options);

                return $connect;

            } catch (PDOException $e) {

                print "Error!: " . $e->getMessage() . "<br/>";

                http_response_code(449);

                die();

            }

        }

    }

    $db = new Database;
    $db = $db->connect();
?>