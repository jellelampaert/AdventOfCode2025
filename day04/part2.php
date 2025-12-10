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

// Check the array as long as there are possible changes
do {
    $result = check_array($rolls);
    $rolls = $result['rolls'];
    $total += $result['changes'];
} while ($result['changes'] > 0);


// Function to check the array
function check_array($rolls) {
    $changes = 0;

    // Copy the $rolls-array to a new array
    // We neede a new array, because we will remove "@"s from certain positions
    // If we remove an "@" in the original array, it would infect the surrounding places furnther in the loop
    $new_rolls = $rolls;

    // Check the array
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

                // If there are less than 4 ats ==> Change the position in the new array to a "." and add one to the number of changes
                if ($ats < 4) {
                    $new_rolls[$x][$y] = '.';
                    $changes++;
                }
            }
        }
    }

    // Return the new array and the number of changes
    return array(
        'rolls'     => $new_rolls,
        'changes'   => $changes
    );
}

echo $total;