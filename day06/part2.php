<?php

$input = file(__DIR__ . '/input.txt');

$total = 0;

// Let's not trust all lines are the same length
$longest_line_length = 0;
for ($i = 0; $i < sizeof($input); $i++) {
    $input[$i] = trim($input[$i], "\r\n"); // Remove newlines
    // Find the longest line
    if (strlen($input[$i]) > $longest_line_length) {
        $longest_line_length = strlen($input[$i]);
    }
}

// Append zeroes when lines are not equal
for ($i = 0; $i < sizeof($input); $i++) {
    while(strlen($input[$i]) < $longest_line_length) {
        $input[$i] .= ' ';
    }
}


$nums_for_calculation = array();
$modifier = '';

// Take the last character from every line, until there are no characters left
while ($longest_line_length > 0) {
    $num = '';
    // Loop over every line
    for ($i = 0; $i < sizeof($input); $i++) {
        // Take the last char and remove it from the line
        $last_char = substr($input[$i], -1);
        $input[$i] = substr($input[$i], 0, strlen($input[$i]) -1);

        $last_char = trim($last_char);
        if ($last_char != '+' && $last_char != '*') {
            // Last char is not the modifier
            $num .= $last_char;
        } else {
            // Last char is the modifier
            $modifier = $last_char;
        }
    }
    $longest_line_length--;

    if ($num != '') {
        $nums_for_calculation[] = $num;
    }

    // If the num is empty, or we're at the beginning of the line
    // do the calculation
    if ($num == '' || $longest_line_length == 0) {
        $colresult = 0;
        switch ($modifier) {
            case '*':
                $colresult = array_product($nums_for_calculation);
                break;
            case '+':
                $colresult = array_sum($nums_for_calculation);
                break;
            default:
                break;
        }

        $total += $colresult;

        // Reset the number
        $nums_for_calculation = [];
    }
}

echo $total;