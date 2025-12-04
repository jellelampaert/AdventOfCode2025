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

        // Check for patterns in the number.
        // Length divided by two, because the second half must be at least as long as the first half
        $total += check_number($i);
    }
}

echo $total;

function check_number($number) {
    for ($j = 1; $j <= strlen($number) / 2; $j++) {
        $pattern = substr($number, 0, $j);
        $check_in = substr($number, $j);

        if (check_pattern($pattern, $check_in)) {
            // Number is ok. Return the number and don't check further
            // If we would check further, a number like 222222, would be counted multiple times
            // 2 2 2 2 2 2, 22 22 22 and 222 222 all match for the same number
            return $number;
        }
    }
    return 0;
}

function check_pattern($pattern, $check_in) {
    $length_of_pattern = strlen($pattern);
    $next_pattern = substr($check_in, 0, $length_of_pattern);

    if ($pattern == $next_pattern) {
        // Patterns match. Is there a next pattern?
        if (strlen($check_in) > strlen($pattern)) {
            // The string to check for the pattern is longer than the pattern. Check the next sequence
            return check_pattern($pattern, substr($check_in, $length_of_pattern));
        } else {
            return true;
        }
    } else {
        // Patterns do not match
        return false;
    }
}