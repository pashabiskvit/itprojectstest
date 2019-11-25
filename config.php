<?php
// текущий домен
$host = preg_replace("/[^0-9A-Za-z-.]/","",trim($_SERVER['HTTP_HOST']));
$host = mb_strtolower($host, 'utf-8');
$host = str_replace("www.", "", $host);

$config = array(
    "baseUrl" => "http://{$host}",
    "db" => array(
        "userName" => "",
        "userPassword" => "",
        "dbName" => "",
        "dbHost" => "localhost"
    )
);