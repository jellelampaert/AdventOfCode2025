<?php

$input = file(__DIR__ . '/input.txt');

$process_ranges = true;
$fresh = array();
$spoilt = 0;

foreach ($input as $line) {
    $line = trim($line);

    if ($line == '') {
        // Here is the split between ranges of fresh ingredients and ingredients to check
        $process_ranges = false;
    } else {
        if ($process_ranges) {
            // We are processing ranges
            // Add all number in an array
            list($from, $to) = explode('-', $line);
            $fresh[] = array(
                'from'  => (float)$from,
                'to'    => (float)$to
            );
        } else {
            // Checking ingredients for freshness
            $num = (float)$line;
            foreach ($fresh as $range) {
                if ($num >= $range['from'] && $num <= $range['to']) {
                    $spoilt++;
                    break;
                }
            }
        }
    }
}

echo $spoilt;