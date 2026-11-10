<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../helpers.php';


$requestType = $_SERVER['REQUEST_METHOD'];

if ($requestType !== 'POST') {
    http_response_code(500);
    exit('Must be a POST request!');
}

$formInput = $_POST;

$_SESSION['form_input'] = $formInput;

prettyDump($formInput);