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
$textAreas = ['life','eco'];

// acceptable continent field names for the arrays to be copied and checked later
$contArrays = ['asia', 'africa', 'europe'];
// this is an array of arrays, its keys being the countries arrays copied from $formInput
$inpArray = array_fill_keys($contArrays, '');


//another array of arrays to store the available countries according to their continents, to be validated against later
$countries = [
    'asia' => ['Afghanistan', 'Israel', 'Palestine', 'SaudiArabia', 'Pakistan', 'India', 'China', 'Thailand', 'Japan', 'SouthKorea'],
    'africa' => ['Algeria', 'Egypt', 'Nigeria', 'Ethiopia', 'Ghana', 'SouthAfrica', 'Tanzania', 'Morocco'],
    'europe' => ['UnitedKingdom', 'France', 'Germany', 'Hungary', 'Poland',  'Spain', 'Greece', 'Italy', 'Russia', 'Ukraine']
];

// acceptable values for opinion radio fields
$ops = ['yes', 'no', 'unknown'];
// array of radio field options to validate against later
$radios = [
    'cont' => ['Asia', 'Africa', 'Europe', 'NorthAmerica', 'SouthAmerica', 'Oceania', 'Antarctica'],
    'gov' => ['PresidentalRepublic', 'SemiPresidentalRepublic', 'OnePartyState', 'ParliamentaryRepublic', 'ConstitutionalMonarchy', 'SemiConstitutionalMonarchy', 'AbsoluteMonarchy', 'Unknown'],
    'view' => $ops,
    'strive' => $ops,
];


// they may insert or replace in a foreign field not existing here so this part of the function prevents this
forEach($formInput as $field => $value) {
    if (!in_array($field, $required)) {
        if(!in_array($field, $optional)) {
            $errors[$field] = 'This field is illegitimate.';
        }
    }
// they may also change one of the field names used for an array to the one used for strings    
    $fieldData = $formInput[$field];
    if (!in_array($field, $contArrays)) {
        if(is_array($fieldData)) {
            $errors[$field] = '"'.$field.'" must not be an array.';
        }
    } else {
        if(!is_array($fieldData)) {
            $errors[$field] = '"'.$field.'" must be an array.';
        }
    }
}

// loop through the required fields and perform a blank/nonexistent field check
forEach($required as $field) {
    if (!isset($formInput[$field])) {
        $errors[$field] = '"'.$field.'" must exist.';
    } else if ($formInput[$field]==='') {
        $errors[$field] = '"'.$field.'" must not be blank.';
    }
}

// validates the email using FILTER_VALIDATE_EMAIL default constant
if (!filter_var($formInput['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Email is not in a valid format';
}

// ctype_digit() checks if the string is all numerical digits
if($formInput['age'] !==''){
    if(!ctype_digit($formInput['age'])) {
        $errors['age'] = '"age" must be a number.';
    }
}

// loop through the continents' names as the keys
forEach($contArrays as $field) {
    // for each key, copy their respective countries from the field whose name is that key 
    // add them into a sub-array of $inpArray by the respective continent key
    $inpArray[$field] = $formInput[$field] ?? [];
    // then loop through this sub-array and check if a country name belongs to the available sublist of countries by this key
    forEach($inpArray[$field] as $country) {
        if(!in_array($country, $countries[$field])) {
            // log an error if the country name is not found in the sublist
            $errors[$field] = '"'.$country.'" is not in the available list.';            
        }
    }
}


// loop through the array containing radio fields and their option lists, then check if the field value of $formInput is within that list
forEach($radios as $field => $options) {
    if(!in_array($formInput[$field], $options)) {
        $errors[$field] = '"'.$formInput[$field].'" is not in the available options.';
    }   
}

// check if the text areas is over the character limits by its string length
forEach($textAreas as $field) {
    if(strlen($formInput[$field]) > 850) {
        $errors[$field] = '"'.$field.'" is over the character limit.';
    }
}


// the following checks if it's a valid date, which is optional (can be blank)
// using strtotime(), which returns false if it's not recognized as any kind of date
if($formInput['govdate']!=='') {
    if(!strtotime($formInput['govdate'])) {
        $errors['govdate'] = '"govdate" must be a valid date.';
    }
}


// validate if it's a valid color
// use a regular expression to find the string pattern that starts with #, then 6 numerical digits or letters from A-Z, then ends
if(!preg_match('/^[#][a-f0-9]{6}$/', $formInput['col'])) {
    $errors['col'] = '"col" must be a hex number from #000000 to #ffffff.';
}




$_SESSION['form_errors'] = $errors;
$_SESSION['form_input'] = $formInput;

// redirects to the main page
header('Location: /jake_russell_php_survey/index.php');
