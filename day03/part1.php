<?php

$input = file('input.txt');

$total = 0;

// Check all lines
foreach ($input as $line) {
    $line = trim($line);
    
    $largest_tenfold = 0;
    $largest_unit = 0;

    // Search all numbers on a line for the largest tenfold
    for ($i = 0; $i < strlen($line) - 1; $i++) {
        $number = (int)substr($line, $i, 1);

        if ($number > $largest_tenfold) {
            // The current number is larger than the previous tenfold, so it is always larger
            $largest_tenfold = $number;

            // Now find the largest unit
            $largest_unit = (int)substr($line, $i + 1, 1); // Start with the next number
            for ($j = $i + 1; $j < strlen($line); $j++) { // Loop over all following numbers
                $unit = (int)substr($line, $j, 1);
                if ($unit > $largest_unit) {
                    $largest_unit = $unit;
                }
            }
        }
    }

    $largest_number = 10 * $largest_tenfold + $largest_unit;
    $total += $largest_number;
}

echo $total;