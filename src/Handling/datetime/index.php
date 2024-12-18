<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.07 - DateTime");

/* */
fullStackPHPClassSession("DateTime Class", __LINE__);

const DATE_BR = 'd/m/Y H:i:s';
const DATE_BR_WH = 'd/m/Y';

$dateNow = new DateTime();
$dateBirth = new DateTime('1997-06-01');
$dateStatic = DateTime::createFromFormat(DATE_BR, '10/03/2025 00:00:00');

var_dump($dateNow, $dateBirth, $dateStatic);

var_dump([
    'formated_br' => $dateNow->format(DATE_BR),
    'day' => $dateNow->format('d')
]);

/* */
fullStackPHPClassSession("DateInterval", __LINE__);

$years = '10';
$months = '2';
$minutes = '10';

$dateInterval = new DateInterval("P{$years}Y{$months}MT{$minutes}M");
$dateNowInterval = new DateTime('now');
$dateNowInterval->add($dateInterval);

var_dump([
    'interval' => $dateNowInterval,
    'date_br' => $dateNowInterval->format(DATE_BR),
    'sub' => $dateNowInterval->sub($dateInterval)->format(DATE_BR)
]);

$currentYear = date('Y');
$newDateBirth = new DateTime($currentYear . '-03-01');
$dateDiff = $dateNow->diff($newDateBirth);

$message = $dateDiff->invert
    ? "Your birthday was {$dateDiff->days} days ago."
    : "{$dateDiff->days} days left until you birthday";

echo "<p>{$message}</p>";

$newDate = new DateTime('now');

var_dump([
    'current_date' => $newDate->format(DATE_BR),
    'sub' => $newDate->sub(DateInterval::createFromDateString('10 days'))->format(DATE_BR),
    'add' => $newDate->add(DateInterval::createFromDateString('20 days'))->format(DATE_BR)
]);

/* */
fullStackPHPClassSession("DatePeriod", __LINE__);

$period = 'P1M';
$start = new DateTime('now');
$end = clone $start;

$end->add(DateInterval::createFromDateString('1year'));

$interval = new DateInterval($period);
$monthlySubscription = new DatePeriod($start, $interval, $end);

var_dump($monthlySubscription, get_class_methods($monthlySubscription));

echo "<h1>Subscription:</h1>";
echo "<p> Start: {$start->format(DATE_BR_WH)} End: {$end->format(DATE_BR_WH)}</p>";
echo "<hr>";

foreach($monthlySubscription as $subscription) {
    echo "<p>Next monthly payment: {$subscription->format(DATE_BR_WH)} </p>";
}
