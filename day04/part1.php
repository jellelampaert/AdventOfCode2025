<?php

$input = file(__DIR__ . '/input.txt');

$total = 0;

// Convert file to array
$rolls = array();
for ($y = 0; $y < sizeof($input); $y++) {
    $line = trim($input[$y]);

    for ($x = 0; $x < strlen($line); $x++) {
        $rolls[$x][$y] = substr($line, $x, 1);
    }
}

// Now check the array
for ($x = 0; $x < sizeof($rolls); $x++) {
    for ($y = 0; $y < sizeof($rolls[$x]); $y++) {
        $ats = 0;

        if ($rolls[$x][$y] == '@') { // Current position needs to be an "@"
            // Check all surrounding posistions for an "@"
            if (isset($rolls[$x - 1][$y - 1]) && $rolls[$x - 1][$y - 1] == '@') {
                $ats++;
            }
            if (isset($rolls[$x][$y - 1]) && $rolls[$x][$y - 1] == '@') {
                $ats++;
            }
            if (isset($rolls[$x + 1][$y - 1]) && $rolls[$x + 1][$y - 1] == '@') {
                $ats++;
            }

            if (isset($rolls[$x - 1][$y]) && $rolls[$x - 1][$y] == '@') {
                $ats++;
            }
            if (isset($rolls[$x + 1][$y]) && $rolls[$x + 1][$y] == '@') {
                $ats++;
            }

            if (isset($rolls[$x - 1][$y + 1]) && $rolls[$x - 1][$y + 1] == '@') {
                $ats++;
            }
            if (isset($rolls[$x][$y + 1]) && $rolls[$x][$y + 1] == '@') {
                $ats++;
            }
            if (isset($rolls[$x + 1][$y + 1]) && $rolls[$x + 1][$y + 1] == '@') {
                $ats++;
            }

            // If there are less than 4 ats ==> Add one to the total
            if ($ats < 4) {
                $total++;
            }
        }
    }
}

echo $total;