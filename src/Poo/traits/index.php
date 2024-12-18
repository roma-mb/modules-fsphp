<?php

use app\Register;
use app\User;
use app\Address;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/app/autoload.php';

fullStackPHPClassName('Traits');

/** */
fullStackPHPClassSession('trait', __LINE__);

$user = new User('John', 'Doe');
$address = new Address('Street A', 123, 'Complement A');
$register = new Register($user, $address);

var_dump(
    $register,
    $register->getAddress()->getStreet(),
    $register->getUser()->getFirstName()
);
