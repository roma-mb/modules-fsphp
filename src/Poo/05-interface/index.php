<?php

use app\Login;
use app\User;
use app\UserAdmin;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/app/autoload.php';

fullStackPHPClassName('Interface');

/** */
fullStackPHPClassSession('superclass', __LINE__);

$user = new User('John', 'Doe');
$userAdmin = new UserAdmin('John', 'Jane');

var_dump([
    $user,
    $userAdmin
]);

$login = new Login();

var_dump([
    'user' => $login->connection($user)->getFirstName(),
    'admin' => $login->connection($userAdmin)->getLastName(),
]);