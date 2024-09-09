<?php

// Include database initialization script
require_once('../_inc/init.php');

// Get JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if request method is POST
check_request_method($request_method, 'POST');

// Define required fields
$required_fields = ['customer_id', 'order_total'];
if (!check_required_fields_in_json($data, $required_fields)) {
    $res->set_status('error');
    $res->set_error_message('Missing fields.');
    $res->response();
}

$params = [
    'customer_id' => $data['customer_id'],
    'order_total' => $data['order_total']
];

$insert_query = "INSERT INTO orders (customer_id, order_total) VALUES (:customer_id, :order_total)";
$db->execute_non_query($insert_query, $params);

// Send success response
$res->set_status('success');
$res->response();
