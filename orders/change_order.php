<?php

// update client's name

require_once('../_inc/init.php');

// get JSON data
$data = json_decode(file_get_contents("php://input"), true);

// check if request method is valid
check_request_method($request_method, 'PUT');

// check for required fields
$required_fields = ['order_id','order_total'];
if(!check_required_fields_in_json($data, $required_fields)){
    $res->set_status('error');
    $res->set_error_message('Missing fields.');
    $res->response();
}

// params
$params = [
    ':order_id' => $data['order_id'],
    ':order_total' => $data['order_total']
];

$db->execute_non_query(
    "UPDATE orders SET " . 
    "order_total = :order_total " . 
    "WHERE order_id = :order_id"
    , $params
);

$res->response();