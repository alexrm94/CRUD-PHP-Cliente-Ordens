<?php

require_once('../_inc/init.php'); 
$sql = "SELECT customer_id, name FROM customers";
$results = $db->execute_query($sql);

$res->set_status('success');
$res->set_response_data($results->results);

// aditional field
$res->set_aditional_field('total_clients', $results->affected_rows);

$res->response();