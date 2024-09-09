<?php

function check_request_method($request_method, $expected_request_method)
{
    if(strtoupper($request_method) !== strtoupper($expected_request_method)){
        global $res;
        $res->set_status('error');
        $res->set_error_message('Invalid request method. Expected ' . strtoupper($expected_request_method));
        $res->response();
    }
}


function check_required_fields_in_json($data, $fields)
{
    foreach ($fields as $key) {
        if (!key_exists($key, $data)) {
            return false;
        }
    }

    return true;
}

function missing_request_parameter($parameter)
{ 
    global $res;
    $res->set_status('error');
    $res->set_error_message('Missing parameter: ' . $parameter);
    $res->response();
}