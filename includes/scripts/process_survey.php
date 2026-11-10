<?php

declare(strict_types=1);

session_start();

// use require_once in case a script uses another script that has been required here
require_once __DIR__ . '/../helpers.php';

// this prevents requests other than POST, specified in the form from index.php
$requestType = $_SERVER['REQUEST_METHOD'];
if ($requestType !== 'POST') {
    http_response_code(500);
    exit('Must be a POST request!');
}

$formInput = $_POST;

$_SESSION['form_input'] = $formInput;

prettyDump($formInput);