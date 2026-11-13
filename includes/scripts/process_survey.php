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

// stores error messages for developers
$errors = [];
// stores error messages for users
$warning = [];
// fields by types: required and optional
// these fields have to be validated
$required = ['fname', 'lname', 'email', 'city', 'cstate', 'bstate', 'view', 'strive'];
$optional = ['age', 'fstate', 'asia', 'africa', 'europe', 'cont', 'gov', 'life', 'eco', 'govdate', 'col'];
$textAreas = ['life','eco'];

$names = ["fname", "lname", "city", "cstate", "bstate", "fstate"];

// acceptable continent field names for the arrays to be copied and checked later
$contArrays = ['asia', 'africa', 'europe'];
// this is an array of arrays, its keys being the countries arrays copied from $formInput
$inpArray = array_fill_keys($contArrays, '');


//another array of arrays to store the available countries according to their continents, to be validated against later
$countries = [
    'asia' => ['Afghanistan', 'Israel', 'Palestine', 'Saudi Arabia', 'Pakistan', 'India', 'China', 'Thailand', 'Japan', 'South Korea'],
    'africa' => ['Algeria', 'Egypt', 'Nigeria', 'Ethiopia', 'Ghana', 'South Africa', 'Tanzania', 'Morocco'],
    'europe' => ['United Kingdom', 'France', 'Germany', 'Hungary', 'Poland',  'Spain', 'Greece', 'Italy', 'Russia', 'Ukraine']
];

// acceptable values for opinion radio fields
$ops = ['yes', 'no', 'unknown'];
// array of radio field options to validate against later
$radios = [
    'cont' => ['Asia', 'Africa', 'Europe', 'North America', 'South America', 'Oceania', 'Antarctica'],
    'gov' => ['Presidental Republic', 'Semi Presidental Republic', 'One Party State', 'Parliamentary Republic', 'Constitutional Monarchy', 'Semi Constitutional Monarchy', 'Absolute Monarchy', 'Unknown'],
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
        $warning[] = "Please answer the required questions.";
    }
}

forEach ($names as $field) {
    $string = (string)$formInput[$field];
    if(!empty($string) && !ctype_alpha($string)) {
        $errors[$field] = 'This field only accepts all letter strings.';
        $warning[] = "Please enter a valid name without numbers or special characters";
    }
}

// validates the email using FILTER_VALIDATE_EMAIL default constant
if (!filter_var($formInput['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = '"email" is not in a valid format';
    $warning[] = "Your email is not in a correct format.";
}

// ctype_digit() checks if the string is all numerical digits
if(!empty($formInput['age'])){
    if(!ctype_digit($formInput['age'])) {
        $errors['age'] = '"age" must be a natural number.';
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
    $radio = $formInput[$field] ?? '';
    if(!empty($radio) && !in_array($radio, $options)) {
        $errors[$field] = '"'.$radio.'" is not one of the available options.';
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
$govdate = '';
if(!empty($formInput['govdate'])) {
    $govdate = strtotime($formInput['govdate']);
    if(!$govdate) {
        $errors['govdate'] = '"govdate" must be a valid date.';
    } else if ($govdate > time()) {
        // check if the time value for $govdate is greater than that of current time, meaning it's in the future
        $errors['govdate'] = '"govdate" must not be in the future.';
        $warning[] = "Please enter a past date for your country's government establishment event";
    }
}


// validate if it's a valid color
// use a regular expression to find the string pattern that starts with #, then 6 numerical digits or letters from A-Z, then ends
if(!empty($formInput['col'])) {
    if(!preg_match('/^[#][a-f0-9]{6}$/', $formInput['col'])) {
        $errors['col'] = '"col" must be a hex number from #000000 to #ffffff.';
    }
}


$_SESSION['form_errors'] = $errors;
$_SESSION['warning'] = $warning;
$_SESSION['form_input'] = $formInput;

if (count($errors) === 0) {
    $email = $formInput['email'];
    $fname = $formInput['fname'];
    $lname = $formInput['lname'];
    $ccity = $formInput['city'];
    $cstate = $formInput['cstate'];

    $viewSummary = match($formInput['view']) {
        'yes' => "You are a proud citizen of your nation.",
        'no' => "You don't consider yourself a patriot or nationalist",
        'unknown' => "You have mixed feelings about your nation."
    };

    $striveSummary = match($formInput['strive']) {
        'yes' => "You believe it's important for your nation to develop economically",
        'no' => "You don't believe that economic position should be a priority for your country",
        'unknown' => "You are not ready to give opinion about your country's economical development"
    };

    $cont = $formInput['cont'] ?? 'Earth';
    $gov = $formInput['gov'] ?? '';
    $asia = $inpArray['asia'] ?? [];
    $africa = $inpArray['africa'] ?? [];
    $europe = $inpArray['europe'] ?? [];

    // email survey results if there are no errors
    $to      = $email;
    $subject = 'Your Geography Attitude - Geobusters';
    $message = '';

    $message .= '<h1>Thanks for Participating Our Survey</h1>';
    $message .= '<p><i>Greetings, '.$fname.'</i></p>';
    $message .= '<p>from '.$ccity.', '.$cstate;
    $message .= ', '.$cont;
    $message .= '</p>';
    $message .= '<p>Your geopolitical viewpoint has been recorded and listened.</p>';
    $message .= '<p>According to your responses:</p>';
    $message .= '<ul>';
    $message .= '<li>'.$viewSummary.'</li>';
    $message .= '<li>'.$striveSummary.'</li>';
    if(!empty($gov) && ($gov !== 'Unknown')) {
        $message .= '<li> Your national government is: '.$gov.'</li>';
    }
    $message .= '</ul>';

    if(!empty($inpArray)) {
        $message .= '<p>You have a favorable view toward these countries</p>';
        $message .= '<ul>';
        forEach($inpArray as $field => $list) {
            if(empty($list)) continue;
            $message .= '<li>From ';
            $message .= ucfirst($field);
            $message .= ': ';
            $message .= implode(", ", $list);
            $message .= '</li>';
        }
    }
    
    $message .= '</ul>';
    $message .= '<p>Stay tuned for more Geobusters news & activities!</p>';

    
    
    //mail($to, $subject, $message);
    echo($message);
}


//prettyDump($formInput);
//prettyDump($errors);

// redirects to the main page
header('Location: /jake_russell_php_survey/index.php');
