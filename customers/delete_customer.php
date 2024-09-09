<?php

// delete client

require_once('../_inc/init.php');

// get JSON data
$data = json_decode(file_get_contents("php://input"), true);

// check if request method is valid
check_request_method($request_method, 'DELETE');

// check for required fields
$required_fields = ['customer_id'];
if(!check_required_fields_in_json($data, $required_fields)){
    $res->set_status('error');
    $res->set_error_message('Missing fields.');
    check_integration_key_json($data);
    $res->response();
}

// params
$params = [
    ':customer_id' => $data['customer_id']
];

$db->execute_non_query(
    "DELETE FROM customers " . 
    "WHERE customer_id = :customer_id"
    , $params
);

$res->response();