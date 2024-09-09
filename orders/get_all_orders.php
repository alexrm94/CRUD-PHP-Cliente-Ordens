<?php

require_once('../_inc/init.php'); 

$sql = "SELECT orders.order_id, orders.order_total
FROM orders
JOIN customers ON orders.customer_id = customers.customer_id";

$results = $db->execute_query($sql);

$res->set_status('success');
$res->set_response_data($results->results);

// aditional field
$res->set_aditional_field('total_clients', $results->affected_rows);

$res->response();
