<?php

$input = file_get_contents('input.txt');

$total = 0; // Sum of all IDs

// Split the input file on ","
$ranges = explode(',', $input);

foreach ($ranges as $range) {
    // For each range, define the start and finish by splitting on "-"
    list($from, $to) = explode('-', $range);

    $from = (int)$from;
    $to = (int)$to;

    // Check all numbers in the range
    for ($i = $from; $i <= $to; $i++) {
        if (strlen($i) % 2 == 0) {  // Only numbers that can be split in two equal parts
            $first_part = substr($i, 0, strlen($i) / 2);
            $last_part = substr($i, strlen($i) / 2);

            // If the first part of the number and the last part are the same, add the number to the total
            if ($first_part == $last_part) {
                $total += $i;
            }
        }
    }
}

echo $total;