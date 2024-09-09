<?php
header("Content-Type: application/json; charset=UTF-8");  

require_once('config.php');
require_once('Database.php');
require_once('Response.php');
require_once('Helper.php');

// set API timezone
date_default_timezone_set('Europe/Lisbon');

// prepare any response
$res = new Response();

// check if API is enabled or in maintenance
if(!API_ACTIVE){
    $res->set_status('error');
    $res->set_error_message(API_MESSAGE);
    $res->response();
}

// get request method (http verb)
$request_method = $_SERVER['REQUEST_METHOD'];

// set mysql options
$mysql_config = [
    'host' => MYSQL_HOST,
    'database' => MYSQL_DATABASE,
    'username' => MYSQL_USER,
    'password' => MYSQL_PASS
];

// create database object
$db = new Database($mysql_config);

