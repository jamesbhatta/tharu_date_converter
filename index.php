<?php

require_once __DIR__ . './nepali_calendar.php';
require_once __DIR__ . './tharu_date_functions.php';

// Get tharu date today
function tharu_date_today()
{
    $yy = date('Y');
    $mm = date('m');
    $dd = date('d');
    $tharu_date = get_tharu_date($yy, $mm, $dd);
    return $tharu_date['date']  . ' ' . $tharu_date['month_name'] . ' ' . $tharu_date['year'] . ', ' . $tharu_date['day'];
}
echo "Today's tharu date is: " . tharu_date_today();
echo '<br>';

// Let's convert some nepali dates to tharu
$nepaliDates = [
    [
        'year' => '2076',
        'month' => '10',
        'day' => '01',
    ],
    [
        'year' => '2077',
        'month' => '09',
        'day' => '29',
    ],
    [
        'year' => '2077',
        'month' => '10',
        'day' => '12',
    ],
    [
        'year' => '2077',
        'month' => '10',
        'day' => '02',
    ],
    [
        'year' => '2078',
        'month' => '01',
        'day' => '01',
    ],
    [
        'year' => '2078',
        'month' => '10',
        'day' => '01',
    ],
    [
        'year' => '2079',
        'month' => '01',
        'day' => '01',
    ],
    [
        'year' => '2079',
        'month' => '10',
        'day' => '01',
    ],
];

$nepaliCalendar = new Nepali_Calendar();

foreach ($nepaliDates as $nepaliDate) {
    // Convert to english date
    $englishDate = $nepaliCalendar->nep_to_eng($nepaliDate['year'], $nepaliDate['month'], $nepaliDate['day']);

    // Now get thary date
    $tharu_date = get_tharu_date($englishDate['year'], $englishDate['month'], $englishDate['date']);

    // Print out result
    echo $tharu_date['date']  . ' ' . $tharu_date['month_name'] . ' ' . $tharu_date['year'] . ', ' . $tharu_date['day'];
    echo '<br>';
}
