<?php
function getBarStatus() {

    $result = "";
    // German days mapping to English
    $daysMapping = [
        'Montag' => 'Monday',
        'Dienstag' => 'Tuesday',
        'Mittwoch' => 'Wednesday',
        'Donnerstag' => 'Thursday',
        'Freitag' => 'Friday',
        'Samstag' => 'Saturday',
        'Sonntag' => 'Sunday',
    ];

    // Initialize cURL session
    $ch = curl_init('https://admin.airstreambar.ch/api/content/items/openingHours');

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and decode the JSON response
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response into PHP array
    $openingHours = json_decode($response, true);

    // Get current time and day
    $currentDay = date('l'); // Returns the English day of the week
    $currentDayGerman = array_search($currentDay, $daysMapping); // Get German day
    $currentTime = strtotime(date('H:i'));
    $isPastMidnight = date('H:i') < '06:00'; // Assuming "past midnight" as before 6 AM

    // Function to check if the current time is within the opening hours
    function isOpenNow($dayHours, $currentTime, $isPastMidnight) {
        if ($dayHours['open'] === 'geöffnet') {
            $startTime = strtotime($dayHours['startTime']);
            $endTime = $dayHours['endTime'] === '00:00' ? strtotime('23:59') : strtotime($dayHours['endTime'] . ' +1 day');

            // If it's past midnight and the bar's end time is on the next day
            if ($isPastMidnight && $endTime > strtotime('23:59')) {
                return $currentTime < $endTime;
            } else {
                return $currentTime >= $startTime && $currentTime < $endTime;
            }
        }
        return false;
    }

    // Find out if the bar is currently open or opens later today
    $barStatusFound = false;
    foreach ($openingHours as $dayHours) {
        if ($daysMapping[$dayHours['dayName']] === $currentDay) {
            if (isOpenNow($dayHours, $currentTime, $isPastMidnight)) {
                $result =  "Geöffnet bis {$dayHours['endTime']} Uhr.";
                $barStatusFound = true;
                break;
            } elseif ($dayHours['open'] === 'geöffnet' && strtotime($dayHours['startTime']) > $currentTime) {
                $result =  "Geschlossen. Öffnet um {$dayHours['startTime']} Uhr.";
                $barStatusFound = true;
                break;
            }
        }
    }

    // If the bar's status for today is not found and it's past midnight, check yesterday's schedule
    if (!$barStatusFound && $isPastMidnight) {
        foreach ($openingHours as $dayHours) {
            if ($daysMapping[$dayHours['dayName']] === date('l', strtotime('yesterday'))) {
                if (isOpenNow($dayHours, $currentTime, $isPastMidnight)) {
                    $result =  "Geöffnet bis {$dayHours['endTime']} Uhr.";
                    $barStatusFound = true;
                    break;
                }
            }
        }
    }

    // If the bar is not open, find the next open day
    if (!$barStatusFound) {
        foreach ($openingHours as $futureDayHours) {
            $dayOfWeekToday = date('N'); // Numeric representation of the day of the week
            $dayOfWeekOpen = array_search($daysMapping[$futureDayHours['dayName']], array_values($daysMapping)) + 1;
            if ($futureDayHours['open'] === 'geöffnet' && $dayOfWeekOpen > $dayOfWeekToday) {
                $result =  "Geschlossen. Öffnet {$futureDayHours['dayName']} um {$futureDayHours['startTime']} Uhr.";
                break;
            }
        }
    }
    return $result;
} //close function


// to call the function, run the following:
// $barOpeningHourScript = getBarStatus();

// and use the result using: <?php echo $barOpeningHourScript;
?>