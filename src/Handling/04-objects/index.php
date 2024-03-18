<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.04 - Objects");

/* [manipulation] - https://www.php.net/manual/en/language.types.object.php */
fullStackPHPClassSession('Manipulation', __LINE__);

$profile = [
    'name' => 'John Doe',
    'company' => 'Company ABC',
    'mail' => 'mail@doe.com',
];

$objectProfile = (object) $profile;

echo "<p>" . "Name {$profile['name']} | Company: {$profile['company']} | Mail: {$profile['mail']}" . "</p>";
echo "<p>" . "Name {$objectProfile->name} | Company: {$objectProfile->company} | Mail: {$objectProfile->mail}" . "</p>";

unset($objectProfile->mail);
var_dump($objectProfile);

$stdClass = new stdClass();
$stdClass->name = 'Jane Doe';
$stdClass->company = 'Company CDF';
$stdClass->address = new stdClass();
$stdClass->address->street = 'Avenue ABC';
$stdClass->address->number = '45';

var_dump($stdClass);

fullStackPHPClassSession('Analysis', __LINE__);

$date = new DateTime();

var_dump([
    'class' => get_class($date),
    'methods' => get_class_methods($date),
    'vars' => get_class_vars(get_class($date)),
    'parent' => get_parent_class($date),
    'subclass' => is_subclass_of($date, 'DateTime'),
]);

$pdoException = new PDOException();

var_dump([
    'class' => get_class($pdoException),
    'methods' => get_class_methods($pdoException),
    'vars' => get_class_vars(get_class($pdoException)),
    'parent' => get_parent_class($pdoException),
    'subclass' => is_subclass_of($pdoException, 'Exception'),
]);