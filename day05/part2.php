<?php

$input = file(__DIR__ . '/input.txt');

$ranges = array();
$spoilt = 0;

foreach ($input as $line) {
    $line = trim($line);

    if ($line == '') {
        // Here is the split between ranges of fresh ingredients and ingredients to check
        break;
    }

    list($from, $to) = explode('-', $line);
    $ranges[] = array(
        'from'  => (int)$from,
        'to'    => (int)$to
    );
}

// Sort ranges by start
usort($ranges, function($a, $b) {
    return $a['from'] > $b['from'];
});

// Remove overlapping ranges
$new_ranges = array();
$current_range = $ranges[0];
for ($i = 1; $i < sizeof($ranges); $i++) {
    if ($ranges[$i]['from'] > $current_range['to']) {
        // If the from in the new range > to in the old range ==> it's a completely new range
        $new_ranges[] = $current_range;
        $current_range = $ranges[$i];
    } else {
        // Overlapping range
        if ($ranges[$i]['to'] > $current_range['to']) {
            // If the new "to" > the old "to" ==> change the "to" in the range
            $current_range['to'] = $ranges[$i]['to'];
        }
    }
}
$new_ranges[] = $current_range;

// Calculte the number of fresh goods
$fresh_goods = 0;
foreach ($new_ranges as $range) {
    $fresh_goods += $range['to'] - $range['from'] + 1;
}

echo $fresh_goods;