<?php

use src\Account;
use src\AccountCurrent;
use src\AccountSaving;
use src\User;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/src/autoload.php';

fullStackPHPClassName('Abstraction Foundation');

/** */
fullStackPHPClassSession('superclass', __LINE__);

$user = new User('John', 'Doe', 'developer');
//$account = new Account(123, 1541400, $user,  1000.00);

var_dump($user);

/** */
fullStackPHPClassSession('sṕecialization.a ', __LINE__);

$accountSaving = new AccountSaving(123, 1541400, $user,  1000.00);

var_dump($accountSaving);

echo $accountSaving->deposit(500.00);
echo $accountSaving->withdrawal(500.00);
echo $accountSaving->extract();
echo $accountSaving->withdrawal(2000.00);
echo $accountSaving->extract();
echo $accountSaving->withdrawal(1000.00);
echo $accountSaving->extract();


/** */
fullStackPHPClassSession('sṕecialization.b', __LINE__);


$accountCurrent = new AccountCurrent(123, 1541400, $user,  1000.00);

var_dump($accountCurrent);

echo $accountCurrent->deposit(500.00);
echo $accountCurrent->withdrawal(500.00);
echo $accountCurrent->extract();
echo $accountCurrent->withdrawal(2000.00);
echo $accountCurrent->extract();
echo $accountCurrent->withdrawal(1600.00);
echo $accountCurrent->extract();

