<?php

// add new client

require_once('../_inc/init.php');

// get JSON data
$data = json_decode(file_get_contents("php://input"), true);

// check if request method is valid
check_request_method($request_method, 'POST');

// check for required fields

$required_fields = ['name'];
if(!check_required_fields_in_json($data, $required_fields)){
    $res->set_status('error');
    $res->set_error_message('Missing fields.');
    $res->response();
}

// check if there is already another client with the same name
$params = [
    'name' => $data['name']
];
$results = $db->execute_query("SELECT customer_id from customers WHERE name = :name", $params);
if($results->affected_rows != 0){
    $res->set_status('error');
    $res->set_error_message('There is another client with the same name.');
    $res->response();
}

// params
$params = [
    'name' => $data['name']
];

$db->execute_non_query(
    "INSERT INTO customers VALUES(" . 
    "0, " .  
    ":name)"
    , $params
);

$res->response();
