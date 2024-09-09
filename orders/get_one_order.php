<?php

require_once('../_inc/init.php');

// Obtemos o customer_id do parâmetro GET
$params = [ ':order_id' => $_GET['order_id'] ];

// Executamos a consulta SQL
$results = $db->execute_query("SELECT * FROM orders WHERE order_id = :order_id", $params);

$res->set_status('success');
$res->set_response_data($results->results);

// aditional field
$res->set_aditional_field('total_orders', $results->affected_rows);

$res->response();