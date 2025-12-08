<?php

$input = file('input.txt');
$batteries_needed = 12;

$total = 0;

// Check all lines
$linenum = 0;
foreach ($input as $line) {
    $line = trim($line);

    $start_index = 0;
    $line_largest_array = array();

    // Loop for the number of batteries needed
    for ($i = 0; $i < $batteries_needed; $i++) {
        // First determine what part of the line we need to search in
        $search_string_length = strlen($line) - ($batteries_needed - $i) - $start_index + 1; // How long is the string we need to search in
        $search_string = substr($line, $start_index, $search_string_length); // We need to find the largest number in this string

        // Find the biggest number in this string and the place this number was found on
        $biggest_number = 0;
        $biggest_place = 0;
        for ($j = 0; $j < strlen($search_string); $j++) {
            $this_num = (int)substr($search_string, $j, 1);

            if ($this_num > $biggest_number) {
                $biggest_number = $this_num;
                $biggest_place = $j;
            }
        }

        // Next number must be searched after this number
        $start_index += $biggest_place + 1;
        // Put the number in an array
        $line_largest_array[] = $biggest_number;
    }

    $line_largest = implode('', $line_largest_array);
    $total += (int)$line_largest;
}

echo $total;