<?php

$_REQUEST['host'] = 'localhost';
$_REQUEST['port'] = '3306';
$_REQUEST['username'] = 'root';
$_REQUEST['password'] = '';
$_REQUEST['database'] = 'helpdesk_industrial';

connect($_REQUEST['host'], $_REQUEST['port'], $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['database']);

if (!function_exists('connect')) {
    function connect($host, $port, $username, $password, $database)
    {
        $connection = mysqli_connect($host, $username, $password, $database, $port);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $connection;
    }
}

?>