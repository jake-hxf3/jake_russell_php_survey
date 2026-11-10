<?php

declare(strict_types=1);

function prettyDump($x)
{
    echo '<pre><code>';
    var_dump($x);
    echo '</code></pre>';
}

function prettyDumpAndExit($x)
{
    prettyDump($x);
    exit;
}
?>