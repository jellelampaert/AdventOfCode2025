<?php

$input = file('input.txt');
$times_zero = 0;    // Number of times the dial lands on 0
$dial = 50;         // Current location of the dial

foreach ($input as $line) {
    // Determine direction and rotation
    $direction = substr($line, 0, 1);
    $rotations = (int)substr($line, 1);

    // Rotate the dial
    if ($direction == "L") {
        $dial -= $rotations;
    } else {
        $dial += $rotations;
    }

    // Rotations passing zero must be recalculated
    $dial = $dial % 100;

    // If the dial is negative, make it positive again
    if ($dial < 0) {
        $dial = 100 + $dial;
    }

    // If the dial lands on zero, add 1 to the code
    if ($dial == 0) {
        $times_zero++;
    }
}

echo $times_zero;