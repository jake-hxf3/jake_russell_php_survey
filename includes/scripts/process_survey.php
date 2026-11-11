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


$errors = [];
// fields by types: required and optional
// these fields have to be validated
$required = ['fname', 'lname', 'email', 'city', 'cstate', 'bstate', 'view', 'strive'];
$optional = ['age', 'fstate', 'asia', 'africa', 'europe', 'cont', 'gov', 'life', 'eco', 'govdate', 'col'];

// to be encapsulated
// they may insert or replace in a foreign field not existing here so this part of the function prevents this
forEach($formInput as $field => $value) {
    if (!in_array($field, $required)) {
        if(!in_array($field, $optional)) {
            $errors[$field] = "This field is illegitimate.";
        }
    }
}

$_SESSION['form_errors'] = $errors;


if (count($errors) === 0) {
    prettyDump($formInput);
} else {
    prettyDump($errors);
}
