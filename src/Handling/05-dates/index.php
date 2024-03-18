<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.05 - Dates");

/* [timezone] - https://www.php.net/manual/en/timezones.php */
fullStackPHPClassSession('Date functions', __LINE__);

var_dump([
    'date_default_timezone_get' => date_default_timezone_get(),
    'date_w3c' => date(DATE_W3C),
    'date_format' => date('d/m/y H:i:s')
]);

define('BR_DATE', 'd/m/y H:i:s');
define('DATE_TIMEZONE_APIA', 'Pacific/Apia');
define('DATE_TIMEZONE_SAO_PAULO', 'America/Sao_Paulo');

date_default_timezone_set(DATE_TIMEZONE_APIA);

var_dump([
    'date_default_timezone_get' => date_default_timezone_get(),
    'date_w3c' => date(DATE_W3C),
]);

$date = getdate();
var_dump($date);

echo "<p> Today is ", $date['month'], ' ', $date['mday'], "</p>";

/* [intldateformatter] - https://www.php.net/manual/en/intldateformatter.format.php*/
fullStackPHPClassSession('String to date', __LINE__);

date_default_timezone_set(DATE_TIMEZONE_SAO_PAULO);

var_dump([
    'strtotime_now' => strtotime('now'),
    'time' => time(),
    'strtotime_add_10days' => strtotime('+10days'),
    'date_+_10days' => date(BR_DATE, strtotime('+10days')),
    'date_-_10days' => date(BR_DATE, strtotime('-10days')),
    'date_+_1year' => date(BR_DATE, strtotime('+1year')),
]);
