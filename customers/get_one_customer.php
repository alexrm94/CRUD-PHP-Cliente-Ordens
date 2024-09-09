<?php

require_once('../_inc/init.php');

$params = [ ':customer_id' => $_GET['customer_id'] ];

$results = $db->execute_query("SELECT * FROM customers WHERE customer_id = :customer_id", $params);

$res->set_status('success');
$res->set_response_data($results->results);
$res->response();
