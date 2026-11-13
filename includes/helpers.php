<?php

declare(strict_types=1);

function prettyDump(mixed $x)
{
    echo '<pre><code>';
    var_dump($x);
    echo '</code></pre>';
}

function prettyDumpAndExit(mixed $x)
{
    prettyDump($x);
    exit;
}

function errorCountReset(array &$errors) {
    if(count($errors)>0) {
        // returns the first error message
        echo reset($errors);
    }    
}

function errorStyle(array &$errors, string $name) {
    // change style of an erroneous field
    if(!empty($errors[$name])) {
        echo 'error';
    }
}


// this one will keep the entered value if submitted incorrectly
function showLastInput(array &$record, string $field) {
    if(isset($record[$field])) {
        echo $record[$field];
    }
}

?>