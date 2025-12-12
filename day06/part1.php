<?php

$input = file(__DIR__ . '/input.txt');

$matrix = array();
$total = 0;

foreach ($input as $line) {
    $line = trim($line);

    preg_match_all('@\d+|\\+|\\*@', $line, $matches);

    for ($i = 0; $i < sizeof($matches[0]); $i++) {
        if (!isset($matrix[$i])) {
            $matrix[$i] = array();
        }
        $matrix[$i][] = ($matches[0][$i]);
    }
}

foreach ($matrix as $calculation) {
    $modifier = array_pop($calculation);

    $colresult = 0;
    switch ($modifier) {
        case '*':
            $colresult = array_product($calculation);
            break;
        case '+':
            $colresult = array_sum($calculation);
            break;
        default:
            break;
    }
    $total += $colresult;
}

echo $total;